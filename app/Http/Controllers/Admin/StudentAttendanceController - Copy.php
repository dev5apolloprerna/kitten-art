<?php



namespace App\Http\Controllers\admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Student;

use App\Models\StudentAttendance;

use App\Models\StudentAttendanceMaster;

use App\Models\StudentLedger;

use App\Models\Batch;

use Illuminate\Support\Facades\DB;



use App\Services\AttendanceService;

use Illuminate\Support\Carbon;



use App\Repositories\Student\StudentRepositoryInterface;

use App\Repositories\Student\StudentRepository;

use Illuminate\Support\Facades\Mail; // Import Mail Facade


class StudentAttendanceController extends Controller

{

     protected $attendanceService;

     protected $student;



    public function __construct(AttendanceService $attendanceService,StudentRepositoryInterface $student)

    {

        $this->attendanceService = $attendanceService;

        $this->student = $student;

    }

    public function index(Request $request)
    {
        try
        {

                $dayNumber = date('N');
                 $Student = Student::select(
                    'student_master.*',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'),
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'),
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_master.plan_id limit 1) as amount'),
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'),
                    DB::raw('(select batch_day from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchday')
                )
                ->when($request->search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('student_first_name', 'LIKE', "%{$search}%")
                          ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                    });
                })

                ->when($request->batch, function ($query, $batchsearch) {
                    return $query->where('student_master.batch_id', $batchsearch);
                });

                if (empty($request->search) && empty($request->batch)) 
                {
                    $Student->leftJoin(DB::raw("(SELECT student_id, MAX(day) as latest_day, attendance 
                                                 FROM student_attendance 
                                                 GROUP BY student_id) as sa"), 
                                       'sa.student_id', '=', 'student_master.student_id')
                            ->where(function ($query) use ($dayNumber) {
                                $query->whereNull('sa.attendance')
                                      ->orWhere('sa.attendance', '!=', 'P')
                                      ->orWhere('sa.latest_day', '!=', $dayNumber);
                            });
                        $Student->where(['batch_master.batch_day'=>$dayNumber]);

                }

                $Student = $Student->where([
                    'isWaiting' => 0,
                    'isRegister' => 1,
                    'isPaid' => 1,
                    'student_master.iStatus' => 1
                ])
                ->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')
                ->distinct()
                ->orderBy('student_id', 'desc')
                ->paginate(env('PER_PAGE_COUNT'));


            $search=$request->search;
            $batch=$request->batch;
            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();

        return view('admin.student_attendance.index', compact('Student','search','batch','batchdata'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

   public function markAttended(Request $request)
    {
        /*try
        {*/
            $studentIds = $request->input('student_ids');
            $batch = Student::whereIn('student_master.student_id',$studentIds)->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')->first();
        if (empty($studentIds)) 
        {
            return response()->json(['message' => 'No students selected!'], 400);
        }
        $today = Carbon::today();
        
        $attendancemaster=StudentAttendanceMaster::where('batch_id',$batch->batch_id)->whereDate('created_at', '=', $today)->latest()->first();
        if($attendancemaster)
        {
            $masterData = [
                'sattendanceid' => $attendancemaster->sattendanceid,
                'attendance_date' => date('Y-m-d'),
                'batch_id' => $batch->batch_id,
            ];
        }else{

            $masterData = [
                'attendance_date' => date('Y-m-d'),
                'batch_id' => $batch->batch_id,
            ];
        }

        $attendance = StudentAttendance::whereIn('student_id', $studentIds)->whereDate('created_at', '=', $today)->whereIn('attendance', ['P'])->get();
        if(sizeof($attendance) == 0)
        {
            foreach ($studentIds as $studentId) 
            {
                $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.parent_name','student_master.plan_id','student_master.email')
                    ->where('student_master.student_id', $studentId)
                    ->join('plan_master', 'plan_master.planId', '=', 'student_master.plan_id')
                    ->first();
                if (!$session) 
                {
                    return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                }
                $attendance=StudentAttendance::where('student_id', $studentId)->whereDate('created_at', '=', $today)->latest()->first();
                if($attendance)
                {
                    $attendanceData = [
                        'attendence_id' => $attendance->attendence_id ?? null,
                        'sattendanceid' => $attendance->sattendanceid ?? null,
                        'student_id' => $studentId,
                        'attendance' => 'P',
                        'batch_id' => $batch->batch_id,
                        'plan_id' => $session->plan_id,
                        'day' => $batch->batch_day,
                    ];
                }else{

                    $attendanceData = [
                        'student_id' => $studentId,
                        'attendance' => 'P',
                        'batch_id' => $batch->batch_id,
                        'plan_id' => $session->plan_id,
                        'day' => $batch->batch_day,
                    ];
                }

                $ledger = StudentLedger::where('student_id', $studentId)->latest()->first();
                if ($ledger && $ledger->closing_balance != 0) 
                {

                    $used_session = 1;
                    $new_opening_balance = $ledger->closing_balance;
                    $new_credit_balance = 0;
                    $new_debit_balance = $used_session;
                    $new_closing_balance = ($new_opening_balance + $new_credit_balance) - $new_debit_balance;

                    $attendance=StudentAttendance::where('student_id', $studentId)->whereDate('student_attendance_master.created_at', '=', $today)
                    ->join('student_attendance_master','student_attendance_master.sattendanceid','student_attendance.sattendanceid')->first();
                    if($attendance)
                    {

                        $ledgerData = [
                            'attendence_id' => $attendance->attendence_id ?? null,
                            'sattendanceid' => $attendance->sattendanceid ?? null,
                            'student_id' => $studentId,
                            'opening_balance' => $new_opening_balance,
                            'credit_balance' => $new_credit_balance,
                            'debit_balance' => $new_debit_balance,
                            'closing_balance' => $new_closing_balance,
                        ];
                    }else{
                     $ledgerData = [
                            'student_id' => $studentId,
                            'opening_balance' => $new_opening_balance,
                            'credit_balance' => $new_credit_balance,
                            'debit_balance' => $new_debit_balance,
                            'closing_balance' => $new_closing_balance,
                        ];   
                    }


                    if($new_closing_balance <= 2)
                    {

                        $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 14])->first();

                        $data=array(
                            'parent_name' => $session->parent_name,
                            'url' => "https://kittenart.com/newkittenart/renew-subscription/" . $studentId
                        );

                        $msg = array(
                            'FromMail' => $SendEmailDetails->strFromMail,
                            'Title' => 'Kitten Art Classes',
                            'ToEmail' => $session->email,
                            'Subject' => $SendEmailDetails->strSubject
                        );

                        $mail = Mail::send('emails.renew_subsctiption', ['data' => $data], function ($message) use ($msg) {
                            $message->from($msg['FromMail'], $msg['Title']);
                            $message->to($msg['ToEmail'])->subject($msg['Subject']);
                        });

                     }
                }
                else 
                {
                            $data['iStatus']=0;
                            $this->student->changeStatus($data,$studentId);
                            return response()->json(['message' => 'Students Have No More Available Session!']);
                 }
               $snkg=$this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
               return response()->json(['message' => 'Students marked as attended successfully!']);
        }
        }else{
            return response()->json(['message' => 'Attendance Already Marked!']);
        }
        /*} catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }*/
    }

    public function markAbsent(Request $request)
    {
        // try{   
        $studentIds = $request->input('student_ids');

        $batch = Student::whereIn('student_master.student_id',$studentIds)->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')->first();
        if (empty($studentIds)) {
            return response()->json(['message' => 'No students selected!'], 400);
        }
                $today = Carbon::today();

        $attendancemaster=StudentAttendanceMaster::where('batch_id',$batch->batch_id)->whereDate('created_at', '=', $today)->latest()->first();
        if($attendancemaster)
        {
            $masterData = [
                'sattendanceid' => $attendancemaster->sattendanceid,
                'attendance_date' => date('Y-m-d'),
                'batch_id' => $batch->batch_id,
            ];
        }else{

            $masterData = [
                'attendance_date' => date('Y-m-d'),
                'batch_id' => $batch->batch_id,
            ];
        }

        $attendance = StudentAttendance::whereIn('student_id', $studentIds)->whereDate('created_at', '=', $today)->whereIn('attendance', ['A'])->get();
        if(sizeof($attendance) == 0)
        {

            foreach ($studentIds as $studentId) 
            {
                $attendancePresent = StudentAttendance::whereIn('student_id', $studentIds)->whereDate('created_at', '=', $today)->whereIn('attendance', ['P'])->get();
                if (sizeof($attendancePresent) > 0) 
                {
                        $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.parent_name','student_master.plan_id','student_master.email')
                        ->where('student_master.student_id', $studentId)
                        ->join('plan_master', 'plan_master.planId', '=', 'student_master.plan_id')
                        ->first();

                    if (!$session) 
                    {
                        return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                    }
                $attendance=StudentAttendance::where('student_id', $studentId)->whereDate('created_at', '=', $today)->latest()->first();
                if($attendance)
                {
                    $attendanceData = [
                        'attendence_id' => $attendance->attendence_id ?? null,
                        'sattendanceid' => $attendance->sattendanceid ?? null,
                        'student_id' => $studentId,
                        'attendance' => 'A',
                        'batch_id' => $batch->batch_id,
                        'plan_id' => $session->plan_id,
                        'day' => $batch->batch_day,
                    ];
                }else{

                    $attendanceData = [
                        'student_id' => $studentId,
                        'attendance' => 'A',
                        'batch_id' => $batch->batch_id,
                        'plan_id' => $session->plan_id,
                        'day' => $batch->batch_day,
                    ];
                }

                    
                    $ledger = StudentLedger::where('student_id', $studentId)->latest()->first();    

                    if ($ledger) 
                    {
                        // Define the amount to revert
                        $revert_session = 1;

                        if ($ledger->debit_balance > 0) 
                        {
                                $new_opening_balance = $ledger->closing_balance; // Keep the opening balance same
                                $new_credit_balance = $ledger->credit_balance + $revert_session; // Refund session
                                $new_debit_balance = 0; // No session is deducted
                                $new_closing_balance = $new_opening_balance + $revert_session; // Adjust closing balance

                            // Recalculate closing balance accordingly

                            //$new_closing_balance = $new_opening_balance + $new_debit_balance - $new_credit_balance;
                    $attendance=StudentAttendance::where('student_id', $studentId)->whereDate('student_attendance_master.created_at', '=', $today)
                    ->join('student_attendance_master','student_attendance_master.sattendanceid','student_attendance.sattendanceid')->first();
                        if($attendance)
                        {
                            $ledgerData = [
                                'attendence_id' => $attendance->attendence_id ?? null,
                                'sattendanceid' => $attendance->sattendanceid ?? null,
                                'student_id' => $studentId,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $new_debit_balance,
                                'closing_balance' => $new_closing_balance,

                            ];

                        }
                        else{
                            $ledgerData = [
                                'student_id' => $studentId,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $new_debit_balance,
                                'closing_balance' => $new_closing_balance,

                            ];
                        }
                             //   StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                    }
                        else {
                            echo "No further reversion is possible as the used session is already 0.";
                        }
                        $this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
                    }
                    $startOfMonth = Carbon::now()->startOfMonth();
                    $today = Carbon::now();
                        $absentCount = StudentAttendance::whereIn('student_id', $studentIds)
                            ->where('attendance', 'A') // Filter by attendance 'A'
                            ->whereBetween('created_at', [$startOfMonth, $today]) // Filter within the current month
                            ->orderBy('created_at', 'desc') // Order by most recent attendance
                            ->take(4) // Limit to the last 4 records
                            ->count(); // Get the count of records
                        if($absentCount == 4)
                        {
                            $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 16])->first();
                            $data=array(
                                    'parent_name' => $session->parent_name
                                );

                                $msg = array(
                                    'FromMail' => $SendEmailDetails->strFromMail,
                                    'Title' => 'Kitten Art Classes',
                                    'ToEmail' => $session->email,
                                    'Subject' => $SendEmailDetails->strSubject
                                );

                                $mail = Mail::send('emails.cancel_subsctiption', ['data' => $data], function ($message) use ($msg) {
                                    $message->from($msg['FromMail'], $msg['Title']);
                                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                                });
                            $request['iStatus']=0;
                            $this->student->changeStatus($request,$studentIds);
                        }
                }
                else
                {
                    //echo "2"; exit;
                    $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.email','student_master.parent_name','student_master.plan_id','student_master.email')
                        ->where('student_master.student_id', $studentId)
                        ->join('plan_master', 'plan_master.planId', '=', 'student_master.plan_id')
                        ->first();
                        if (!$session) 
                        {
                            return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                        }

                        $attendanceData = [
                            'student_id' => $studentId,
                            'attendance' => 'A',
                            'batch_id' => $batch->batch_id,
                            'plan_id' => $session->plan_id,
                            'day' => $batch->batch_day,
                        ];
                        $ledger = StudentLedger::where('student_id', $studentId)->latest()->first();
                        $ledgerData = []; // Initialize with an empty array

                        if ($ledger) 
                        {
                            $revert_session = 1;

                                // If debit balance is greater than 0, proceed with reverting
                                $new_opening_balance = $ledger->opening_balance; // Opening balance remains the same
                                $new_credit_balance = 0 ; // Add back the reverted session
                                $new_debit_balance =  0; // Reduce the debit balance
                                $new_closing_balance = $ledger->closing_balance; // Adjust closing balance
                                if ($new_debit_balance < 0) {
                                    $new_debit_balance = 0;
                                }
                                // Recalculate closing balance accordingly

                                //$new_closing_balance = $new_opening_balance + $new_debit_balance - $new_credit_balance;

                                $ledgerData = [
                                    'student_id' => $studentId,
                                    'opening_balance' => $new_opening_balance,
                                    'credit_balance' => $new_credit_balance,
                                    'debit_balance' => $new_debit_balance,
                                    'closing_balance' => $new_closing_balance,
                                ];
                                    //StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                           
                        }

                        $this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
                        $startOfMonth = Carbon::now()->startOfMonth();
                        $today = Carbon::now();

                        $absentCount = StudentAttendance::whereIn('student_id', $studentIds)
                            ->where('attendance', 'A') // Filter by attendance 'A'
                            ->whereBetween('created_at', [$startOfMonth, $today]) // Filter within the current month
                            ->orderBy('created_at', 'desc') // Order by most recent attendance
                            ->take(4) // Limit to the last 4 records
                            ->count(); // Get the count of records


                        if($absentCount == 4)
                        {
                            $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 16])->first();
                            $data=array(
                                    'parent_name' => $session->parent_name
                                );

                                $msg = array(
                                    'FromMail' => $SendEmailDetails->strFromMail,
                                    'Title' => 'Kitten Art Classes',
                                    'ToEmail' => $session->email,
                                    'Subject' => $SendEmailDetails->strSubject
                                );

                                $mail = Mail::send('emails.cancel_subsctiption', ['data' => $data], function ($message) use ($msg) {
                                    $message->from($msg['FromMail'], $msg['Title']);
                                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                                });

                            $request['iStatus']=0;
                            $this->student->changeStatus($request,$studentIds);
                        }
                    }
            }
        return response()->json(['message' => 'Students marked as Absent successfully!']);
        }
        if(sizeof($attendance) != 0)
        { 
            foreach ($attendance as $val) 
            {
                if($val->attendance == 'P')
                {
                     $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.plan_id')
                        ->where('student_master.student_id', $val->student_id)
                        ->join('plan_master', 'plan_master.planId', '=', 'student_master.plan_id')
                        ->first();
                    if (!$session) 
                    {
                        return response()->json(['message' => "Plan session not found for student ID: $val->student_id"], 404);
                    }
                    $attendanceData = [
                       'student_id' => $val->student_id,
                        'attendance' => 'A',
                        'batch_id' => $batch->batch_id,
                        'plan_id' => $session->plan_id,
                        'day' => $batch->batch_day,
                    ];
                    $ledger = StudentLedger::where('student_id', $val->student_id)->latest()->first();
                    if ($ledger) 
                    {
                        $revert_session = 1;

                        if ($ledger->debit_balance > 0) {
                            // If debit balance is greater than 0, proceed with reverting
                            $new_opening_balance = $ledger->closing_balance; // Opening balance remains the same
                            $new_credit_balance = $ledger->credit_balance + $revert_session; // Add back the reverted session
                            $new_debit_balance =  0; // Reduce the debit balance
                            $new_closing_balance = $new_opening_balance + $revert_session; // Adjust closing balance
                            if ($new_debit_balance < 0) {
                                $new_debit_balance = 0;
                            }
                            // Recalculate closing balance accordingly

                            //$new_closing_balance = $new_opening_balance + $new_debit_balance - $new_credit_balance;

                            $ledgerData = [
                                'student_id' => $studentId,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $new_debit_balance,
                                'closing_balance' => $new_closing_balance,
                            ];
                                StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                        }
                        else {
                            echo "No further reversion is possible as the used session is already 0.";
                        }
                    }
                    $this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
                     return response()->json(['message' => 'Students marked as Absent successfully!']);
                }else{
                     return response()->json(['message' => 'Attendance Already Marked!']);
                }
            }   
        }
        else
        {
            return response()->json(['message' => 'Students already Absent successfully!']);
        }
       

        /*} catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }*/
    }
    public function delete(Request $request)
    {
        try{

            $id=$request->student_id;
            $this->inquiry->destroy($id);
        return redirect()->route('attendance.index')->with('success', 'Attendance Deleted Successfully!.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
    public function view($id)
    {

    try{        
            $data=Student::select('student_master.*',DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'))->where(['student_id'=>$id])->first();
    
            $subscription = StudentLedger::select(
                'student_ledger.*','student_subscription.amount','student_subscription.activate_date',
                DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'),
                DB::raw('(select plan_session from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as plan_session'),
                DB::raw('(select sum(debit_balance) from student_ledger where student_ledger.student_id = student_subscription.student_id and student_ledger.subscription_id = 0 ) as debit_balance'),
                DB::raw('(select closing_balance from student_ledger where student_ledger.subscription_id = student_subscription.subscription_id order by ledger_id desc limit 1) as closing_balance')
            )
            ->join('student_subscription', 'student_subscription.subscription_id', '=', 'student_ledger.subscription_id')->where(['student_ledger.student_id'=>$id])
            ->orderBy('ledger_id', 'ASC')->get();
            
            $debit_balance=StudentLedger::where(['student_id'=>$id])->sum('debit_balance');
            $attendance=StudentAttendanceMaster::select('student_attendance_master.*','student_attendance.*',
                        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                        DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'))->where(['student_attendance.student_id'=>$id])
            ->join('student_attendance', 'student_attendance.sattendanceid', '=', 'student_attendance_master.sattendanceid')
            ->join('student_master', 'student_attendance.student_id', '=', 'student_master.student_id')->orderBy('student_attendance_master.sattendanceid','desc')->get();
    
            if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');
            }
            else
            {
              return view('admin.student_attendance.student_view',compact('data','subscription','attendance','debit_balance'));
            }
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function edit(Request $request)
    {
        try
        {

            $status=$request->status;
            $student=StudentAttendance::where(['attendence_id'=>$request->attendence_id])->first();
            $s=Student::where(['student_id'=>$student->student_id])->first();
            $studentId=$student->student_id;
            if($status == 'P')
            {
                    $data = array(
                        'attendance' => 'P',
                    );
                    StudentAttendance::where("attendence_id","=",$request->attendence_id)->update($data);
                    $ledger = StudentLedger::where('student_id', $student->student_id)->latest()->first();
                    if ($ledger && $ledger->closing_balance != 0) 
                    {
                        $used_session = 1;
                        $new_opening_balance = $ledger->closing_balance;
                        $new_credit_balance = 0;
                        $new_debit_balance = $used_session;
                        $new_closing_balance = ($new_opening_balance + $new_credit_balance) - $new_debit_balance;
                    $today = Carbon::today();
                    
                    $attendance=StudentAttendance::where('student_id', $student->student_id)->whereDate('student_attendance_master.created_at', '=', $today)
                    ->join('student_attendance_master','student_attendance_master.sattendanceid','student_attendance.sattendanceid')->first();

                    if($attendance)
                    {

                        $ledgerData = [
                            'attendence_id' => $attendance->attendence_id ?? null,
                            'attendence_detail_id' => $attendance->sattendanceid ?? null,
                            'student_id' => $student->student_id,
                            'opening_balance' => $new_opening_balance,
                            'credit_balance' => $new_credit_balance,
                            'debit_balance' => $new_debit_balance,
                            'closing_balance' => $new_closing_balance,
                        ];
                    }else
                    {
                     $ledgerData = [
                            'student_id' => $student->student_id,
                            'opening_balance' => $new_opening_balance,
                            'credit_balance' => $new_credit_balance,
                            'debit_balance' => $new_debit_balance,
                            'closing_balance' => $new_closing_balance,
                        ];   
                    }
                     StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);

                        if($new_closing_balance <= 2)
                        {

                            $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 14])->first();

                        $data=array(
                            'parent_name' => $s->parent_name,
                            'url' => "https://kittenart.com/newkittenart/renew-subscription/" . $student->student_id
                        );

                        $msg = array(
                            'FromMail' => $SendEmailDetails->strFromMail,
                            'Title' => 'Kitten Art Classes',
                            'ToEmail' => $s->email,
                            'Subject' => $SendEmailDetails->strSubject
                        );

                        $mail = Mail::send('emails.renew_subsctiption', ['data' => $data], function ($message) use ($msg) {
                            $message->from($msg['FromMail'], $msg['Title']);
                            $message->to($msg['ToEmail'])->subject($msg['Subject']);
                        });

                           
                         }
                    }
                    else {
                            $data['iStatus']=0;                               
                            $this->student->changeStatus($data,$student->student_id);
                            return response()->json(['message' => 'Students Have No More Available Session!']);
                     }
        }
        if($status == 'A')
        {
                  $data = array(
                        'attendance' => 'A',
                    );
                 StudentAttendance::where("attendence_id","=",$request->attendence_id)->update($data);

                 $ledger = StudentLedger::where('student_id', $studentId)->latest()->first();
                    if ($ledger) 
                    {
                        // Define the amount to revert
                        $revert_session = 1;

                        if ($ledger->debit_balance > 0) {
                            // If debit balance is greater than 0, proceed with reverting
                            $new_opening_balance = $ledger->opening_balance; // Opening balance remains the same
                            //$new_credit_balance = $ledger->credit_balance + $revert_session; // Add back the reverted session
                            $new_credit_balance = 0; // Add back the reverted session
                            $new_debit_balance =  0; // Reduce the debit balance
                            //$new_closing_balance = $new_opening_balance + $revert_session; // Adjust closing balance
                            $new_closing_balance = $new_opening_balance; // Adjust closing balance
                            if ($new_debit_balance < 0) {
                                $new_debit_balance = 0;
                            }
                            // Recalculate closing balance accordingly

                            //$new_closing_balance = $new_opening_balance + $new_debit_balance - $new_credit_balance;

                            $ledgerData = [
                                'student_id' => $studentId,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $new_debit_balance,
                                'closing_balance' => $new_closing_balance,
                            ];
                                StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                        }
                        else {
                            echo "No further reversion is possible as the used session is already 0.";
                        }
                    }

                        $startOfMonth = Carbon::now()->startOfMonth();
                        $today = Carbon::now();
                        $absentCount = StudentAttendance::where('student_id', $studentId)
                            ->where('attendance', 'A') // Filter by attendance 'A'
                            ->whereBetween('created_at', [$startOfMonth, $today]) // Filter within the current month
                            ->orderBy('created_at', 'desc') // Order by most recent attendance
                            ->take(4) // Limit to the last 4 records
                            ->count(); // Get the count of records

                        if($absentCount == 4)
                        {
                            $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 16])->first();


                        $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 14])->first();

                        $data=array(
                            'parent_name' => $s->parent_name,
                            'url' => "https://kittenart.com/newkittenart/renew-subscription/" . $studentId
                        );

                                $msg = array(
                                    'FromMail' => $SendEmailDetails->strFromMail,
                                    'Title' => 'Kitten Art Classes',
                                    'ToEmail' => $s->email,
                                    'Subject' => $SendEmailDetails->strSubject
                                );

                                $mail = Mail::send('emails.renew_subsctiption', ['data' => $data], function ($message) use ($msg) {
                                    $message->from($msg['FromMail'], $msg['Title']);
                                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                                });


                                $data1=array(
                                    'parent_name' => $s->parent_name
                                );

                                $msg1 = array(
                                    'FromMail' => $SendEmailDetails->strFromMail,
                                    'Title' => 'Kitten Art Classes',
                                    'ToEmail' => $s->email,
                                    'Subject' => $SendEmailDetails->strSubject
                                );

                                $mail = Mail::send('emails.cancel_subsctiption', ['data' => $data1], function ($message) use ($msg1) {
                                    $message->from($msg1['FromMail'], $msg1['Title']);
                                    $message->to($msg1['ToEmail'])->subject($msg1['Subject']);
                                });
                           $request['iStatus']=0;
                            $this->student->changeStatus($request,$studentId);
                        }
        }
            return redirect()->back()->with('success','Attendance Updated Successfully');

     } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
     }
  }

}

