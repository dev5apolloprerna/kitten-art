<?php



namespace App\Http\Controllers\admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Student;

use App\Models\StudentAttendance;

use App\Models\StudentAttendanceMaster;
use App\Models\StudentSubscription;

use App\Models\StudentLedger;

use App\Models\Batch;

use Illuminate\Support\Facades\DB;



use App\Services\AttendanceService;

use Illuminate\Support\Carbon;



use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Student\StudentRepository;

use App\Repositories\StudentSubscription\StudentSubscriptionRepositoryInterface;
use App\Repositories\StudentSubscription\StudentSubscriptionRepository;

use Illuminate\Support\Facades\Mail; // Import Mail Facade


class StudentAttendanceController extends Controller

{

     protected $attendanceService;

     protected $student;
     protected $studentSubscription;



    public function __construct(AttendanceService $attendanceService,StudentRepositoryInterface $student,StudentSubscriptionRepositoryInterface $studentSubscription)

    {

        $this->attendanceService = $attendanceService;

        $this->student = $student;
        $this->studentSubscription = $studentSubscription;

    }

    public function index(Request $request)
    {
        try
        {

                $dayNumber = date('N');
                 $Student = Student::select(
                    'student_master.*','student_subscription.subscription_id',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'),
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_subscription.batch_id limit 1) as batchname'),
                    DB::raw('(select batch_day from batch_master where batch_master.batch_id = student_subscription.batch_id limit 1) as batchday')
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
                    'student_master.iStatus' => 1,
                    'student_subscription.status' => 1
                ])
                ->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')
                ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
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
    /***********************model popup absent and present attendance code start ****************************************/
 public function getBatchesByCategory(Request $request)
    {
        $batches = Batch::where('category_id', $request->category_id)
            ->where('isDelete', 0)
            ->get();

        $formatted = $batches->map(function ($batch) {
            return [
                'batch_id' => $batch->batch_id,
                'batch_name' => $batch->batch_name,
                'batch_day' => $batch->batch_day,
                'batch_from_time' => \Carbon\Carbon::createFromFormat('H:i:s', $batch->batch_from_time)->format('h:i A'),
                'batch_to_time' => \Carbon\Carbon::createFromFormat('H:i:s', $batch->batch_to_time)->format('h:i A'),
            ];
        });

        return response()->json($formatted);
    }
 public function store(Request $request)
    {
        /*try
        {*/
            $studentId=$request->student_id;
            $subscriptionId=$request->subscription_id;
            $batchId=$request->batch_id;
            $attendance_date=$request->attendance_date;
            $status=$request->status;

        /*-------------------- status is present start code -------------------------*/
            if($status == 'P')
            {

                    $batch = Batch::where(['batch_id'=>$batchId])->first();

                    $today = Carbon::today();

                    $attendancemaster=StudentAttendanceMaster::where('batch_id',$batchId)->whereDate('attendance_date', '=', $attendance_date)->latest()->first();
                    if($attendancemaster)
                    {
                            return response()->json(['message' => 'Attendance Already Marked!']);
                
                        /*$masterData = [
                            'sattendanceid' => $attendancemaster->sattendanceid,
                            'attendance_date' => $attendance_date,
                            'batch_id' => $batchId,
                        ];*/
                    }else{

                        $masterData = [
                            'attendance_date' => $attendance_date,
                            'batch_id' => $batchId,
                        ];
                    }
                    $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.parent_name','student_master.plan_id','student_master.email','student_subscription.subscription_id')
                    ->where('student_master.student_id', $studentId)
                    ->where('student_subscription.subscription_id', $subscriptionId)
                    ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                    ->join('plan_master', 'plan_master.planId', '=', 'student_subscription.plan_id')
                    ->first();
                    if (!$session) 
                    {
                        return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                    }

                    $attendance = StudentAttendance::where('student_id', $studentId)
                    ->whereDate('student_attendance_master.attendance_date', '=', $attendance_date)
                    ->join('student_attendance_master', 'student_attendance_master.sattendanceid', '=', 'student_attendance.sattendanceid')
                    ->orderBy('student_attendance_master.created_at', 'desc')
                    ->first();

                    if($attendance)
                    {
                        $attendanceData = [
                            'attendence_id' => $attendance->attendence_id ?? null,
                            'sattendanceid' => $attendance->sattendanceid ?? null,
                            'student_id' => $studentId,
                            'attendance' => 'P',
                            'batch_id' => $batchId,
                            'subscription_id' => $subscriptionId,
                            'plan_id' => $attendance->plan_id,
                            'day' => $batch->batch_day,
                        ];
                    }else{
                        $attendanceData = [
                            'student_id' => $studentId,
                            'attendance' => 'P',
                            'batch_id' => $batchId,
                            'subscription_id' => $subscriptionId,
                            'plan_id' => $session->plan_id,
                            'day' => $batch->batch_day,
                        ];
                    }

                    $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();

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
                                    'subscription_id' => $subscriptionId ?? null,
                                    'student_id' => $studentId,
                                    'opening_balance' => $new_opening_balance,
                                    'credit_balance' => $new_credit_balance,
                                    'debit_balance' => $new_debit_balance,
                                    'closing_balance' => $new_closing_balance,
                                ];
                            }else{
                               $ledgerData = [
                                'student_id' => $studentId,
                                'subscription_id' => $subscriptionId ?? null,
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

                            /*$mail = Mail::send('emails.renew_subsctiption', ['data' => $data], function ($message) use ($msg) {
                                $message->from($msg['FromMail'], $msg['Title']);
                                $message->to($msg['ToEmail'])->subject($msg['Subject']);
                            });*/

                        }
                    }
                    else 
                    {
                         $data['status']=0;                               
                        $this->studentSubscription->changeStatus($data,$subscriptionId);
                        return redirect()->back()->with('error','No further reversion is possible as the used session is already 0.');
                    }
                      $snkg=$this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
                      $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();

                    if ($ledger && $ledger->closing_balance == 0) 
                    {
                         $data['status']=0;                               
                      $this->studentSubscription->changeStatus($data,$subscriptionId);
                    }
            return response()->json(['message' => 'Students marked as attended successfully!']);        
            }
                /*-------------------- status is present end code -------------------------*/

                /*-------------------- status is Absent  start code -------------------------*/
            if($status == 'A')
            {

                    $batch = Batch::where(['batch_id'=>$batchId])->first();

                    $today = Carbon::today();

                    $attendancemaster=StudentAttendanceMaster::where('batch_id',$batchId)->whereDate('attendance_date', '=', $attendance_date)->latest()->first();
                    if($attendancemaster)
                    {
                            return response()->json(['message' => 'Attendance Already Marked!']);
                
                        /*$masterData = [
                            'sattendanceid' => $attendancemaster->sattendanceid,
                            'attendance_date' => $attendance_date,
                            'batch_id' => $batchId,
                        ];*/
                    }else{

                        $masterData = [
                            'attendance_date' => $attendance_date,
                            'batch_id' => $batchId,
                        ];
                    }
                            $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.parent_name','student_master.plan_id','student_master.email','student_subscription.subscription_id')
                            ->where('student_master.student_id', $studentId)
                            ->where('student_subscription.subscription_id', $subscriptionId)
                            ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                            ->join('plan_master', 'plan_master.planId', '=', 'student_subscription.plan_id')
                            ->first();
                            if (!$session) 
                            {
                                return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                            }

                            $attendance = StudentAttendance::where('student_id', $studentId)
                            ->whereDate('student_attendance_master.attendance_date', '=', $attendance_date)
                            ->join('student_attendance_master', 'student_attendance_master.sattendanceid', '=', 'student_attendance.sattendanceid')
                            ->orderBy('student_attendance_master.created_at', 'desc')
                            ->first();

                            if($attendance)
                            {
                                $attendanceData = [
                                    'attendence_id' => $attendance->attendence_id ?? null,
                                    'sattendanceid' => $attendance->sattendanceid ?? null,
                                    'student_id' => $studentId,
                                    'attendance' => 'A',
                                    'batch_id' => $batchId,
                                    'subscription_id' => $subscriptionId,
                                    'plan_id' => $attendance->plan_id,
                                    'day' => $batch->batch_day,
                                ];
                            }else{
                                $attendanceData = [
                                    'student_id' => $studentId,
                                    'attendance' => 'A',
                                    'batch_id' => $batchId,
                                    'subscription_id' => $subscriptionId,
                                    'plan_id' => $session->plan_id,
                                    'day' => $batch->batch_day,
                                ];
                            }
                        $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();
                        $ledgerData = []; // Initialize with an empty array

                        if ($ledger) 
                        {
                            $revert_session = 1;

                                $new_opening_balance = $ledger->opening_balance;
                                $new_credit_balance = 0 ; 
                                $new_debit_balance =  0;
                                $new_closing_balance = $ledger->closing_balance; 
                                if ($new_debit_balance < 0) {
                                    $new_debit_balance = 0;
                                }

                                $ledgerData = [
                                    'student_id' => $studentId,
                                    'subscription_id' => $subscriptionId ?? null,
                                    'opening_balance' => $new_opening_balance,
                                    'credit_balance' => $new_credit_balance,
                                    'debit_balance' => $new_debit_balance,
                                    'closing_balance' => $new_closing_balance,
                                ];
                               // StudentLedger::create($ledgerData);

                                    //StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                        }

                        $this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
                        $startOfMonth = Carbon::now()->startOfMonth();
                        $today = Carbon::now();

                        $absentCount = StudentAttendance::where('student_id', $studentId)
                            ->where('attendance', 'A') 
                            ->whereBetween('created_at', [$startOfMonth, $today]) 
                            ->orderBy('created_at', 'desc') 
                            ->take(4) 
                            ->count(); 


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

                                /*$mail = Mail::send('emails.cancel_subsctiption', ['data' => $data], function ($message) use ($msg) {
                                    $message->from($msg['FromMail'], $msg['Title']);
                                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                                });*/

                             $data['status']=0;                               
                            $this->studentSubscription->changeStatus($data,$subscriptionId);
                        }
            return response()->json(['message' => 'Students marked as attended successfully!']);        
            }
                /*-------------------- status is Absent  end code -------------------------*/

        /*} catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }*/
    }

    public function markAttended(Request $request)
    {
        try
        {
            $students = $request->input('students'); // array of [student_id => ..., subscription_id => ...]

            if (empty($students)) {
                return response()->json(['message' => 'No students selected!'], 400);
            }

            $studentIds = collect($students)->pluck('student_id');
            $subscriptionIds = collect($students)->pluck('subscription_id');


            $batch = Student::whereIn('student_master.student_id',$studentIds)->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')->first();
            if (empty($studentIds)) 
            {
                return response()->json(['message' => 'No students selected!'], 400);
            }
            //$today = Carbon::today();

            if($request->attendance_date)
            {
                $today=$request->attendance_date;
            }else{

            $today = Carbon::today();
            }
            
                $attendancemaster = StudentAttendanceMaster::where('batch_id', $batch->batch_id)
                    ->whereDate('attendance_date', '=', $today)
                    ->first();

                $masterData = [
                    'attendance_date' => $today,
                    'batch_id' => $batch->batch_id,
                ];

                if ($attendancemaster) {
                    $masterData['sattendanceid'] = $attendancemaster->sattendanceid;
                }

            

            $attendance = StudentAttendance::whereIn('student_id', $studentIds)->whereDate('attendance_date', '=', $today)->whereIn('attendance', ['P'])->get();
            if(sizeof($attendance) == 0)
            {
                if($request->attendance_date)
                {
                    $today3=$request->attendance_date;
                }else{

                $today3 = Carbon::today();
                }
                
                foreach ($students as $entry) 
                {
                $studentId = $entry['student_id'];
                $subscriptionId = $entry['subscription_id'];
                
                $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.parent_name','student_master.plan_id','student_master.email','student_subscription.subscription_id')
                    ->where('student_master.student_id', $studentId)
                    ->where('student_subscription.subscription_id', $subscriptionId)
                    ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                    ->join('plan_master', 'plan_master.planId', '=', 'student_subscription.plan_id')
                    ->first();
                    if (!$session) 
                    {
                        return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                    }

                    $attendance = StudentAttendance::where('student_id', $studentId)
                    ->whereDate('student_attendance.attendance_date', '=', $today3)
                    ->join('student_attendance_master', 'student_attendance_master.sattendanceid', '=', 'student_attendance.sattendanceid')
                    ->orderBy('student_attendance_master.created_at', 'desc')
                    ->first();

                    if($attendance)
                    {
                        $attendanceData = [
                            'attendence_id' => $attendance->attendence_id ?? null,
                            'sattendanceid' => $attendance->sattendanceid ?? null,
                            'student_id' => $studentId,
                            'attendance' => 'P',
                            'batch_id' => $batch->batch_id,
                            'subscription_id' => $subscriptionId,
                            'plan_id' => $attendance->plan_id,
                            'day' => $batch->batch_day,
                            'attendance_date' => $today3,
                        ];
                    }else{
                        $attendanceData = [
                            'student_id' => $studentId,
                            'attendance' => 'P',
                            'batch_id' => $batch->batch_id,
                            'subscription_id' => $subscriptionId,
                            'plan_id' => $session->plan_id,
                            'day' => $batch->batch_day,
                            'attendance_date' => $today3,
                        ];
                    }

                    $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();

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
                                'subscription_id' => $subscriptionId ?? null,
                                'student_id' => $studentId,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $new_debit_balance,
                                'closing_balance' => $new_closing_balance,
                            ];
                        }else{
                           $ledgerData = [
                            'student_id' => $studentId,
                            'subscription_id' => $subscriptionId ?? null,
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
                   /* $data['iStatus']=0;
                    $this->student->changeStatus($data,$studentId);*/
                     $data['status']=0;                               
                    $this->studentSubscription->changeStatus($data,$subscriptionId);
                    return redirect()->back()->with('error','No further reversion is possible as the used session is already 0.');
                }
                $snkg=$this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);

                 $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();

                    if ($ledger && $ledger->closing_balance == 0) 
                    {
                         $data['status']=0;                               
                      $this->studentSubscription->changeStatus($data,$subscriptionId);
                    }

            }
                return response()->json(['message' => 'Students marked as attended successfully!']);
        }else{
            return response()->json(['message' => 'Attendance Already Marked!']);
        }
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

    public function markAbsent(Request $request)
    {
        try{   
            $students = $request->input('students'); // array of [student_id => ..., subscription_id => ...]

            if (empty($students)) {
                    return response()->json(['message' => 'No students selected!'], 400);
            }

            $studentIds = collect($students)->pluck('student_id');
            $subscriptionIds = collect($students)->pluck('subscription_id');


            $batch = Student::whereIn('student_master.student_id',$studentIds)->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')->first();
           
            if (empty($studentIds)) {
                return response()->json(['message' => 'No students selected!'], 400);
            }
                if($request->attendance_date)
                {
                    $today=$request->attendance_date;
                }else{

                $today = Carbon::today();
                }
                

                $attendancemaster = StudentAttendanceMaster::where('batch_id', $batch->batch_id)
                    ->whereDate('attendance_date', '=', $today)
                    ->first();

                $masterData = [
                    'attendance_date' => $today,
                    'batch_id' => $batch->batch_id,
                ];

                if ($attendancemaster) {
                    $masterData['sattendanceid'] = $attendancemaster->sattendanceid;
                }

        $attendance = StudentAttendance::whereIn('student_id', $studentIds)->whereDate('attendance_date', '=', $today)->whereIn('attendance', ['A'])->get();
        if(sizeof($attendance) == 0)
        {

            /*foreach ($students as $entry) 
            {
                $studentId = $entry['student_id'];
                $subscriptionId = $entry['subscription_id'];*/


                $attendancePresent = StudentAttendance::whereIn('student_id', $studentIds)->whereDate('attendance_date', '=', $today)->where('attendance', 'P')->get();
                if (sizeof($attendancePresent) == 0) 
                {
                     if($request->attendance_date)
                        {
                            $todayy=$request->attendance_date;
                        }else{

                        $todayy = Carbon::today();
                        }
                        
                    foreach ($students as $entry) 
                    {
                        $studentId = $entry['student_id'];
                        $subscriptionId = $entry['subscription_id'];


                    $session = Student::select('student_master.student_id','plan_master.plan_session','student_master.parent_name','student_subscription.plan_id','student_subscription.batch_id','student_master.email','student_subscription.subscription_id')
                    ->where('student_master.student_id', $studentId)
                    ->where('student_subscription.subscription_id', $subscriptionId)
                    ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                    ->join('plan_master', 'plan_master.planId', '=', 'student_subscription.plan_id')
                    ->first();

                        if (!$session) 
                        {
                            return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                        }

                        $attendanceData = [
                            'student_id' => $studentId,
                            'attendance' => 'A',
                            'batch_id' => $session->batch_id,
                            'plan_id' => $session->plan_id,
                            'subscription_id' => $subscriptionId,
                            'day' => $batch->batch_day,
                            'attendance_date' => $todayy,
                        ];

                        $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();
                        $ledgerData = []; // Initialize with an empty array

                        if ($ledger) 
                        {
                            $revert_session = 1;

                                $new_opening_balance = $ledger->opening_balance;
                                $new_credit_balance = 0 ; 
                                $new_debit_balance =  0;
                                $new_closing_balance = $ledger->closing_balance; 
                                if ($new_debit_balance < 0) {
                                    $new_debit_balance = 0;
                                }

                                $ledgerData = [
                                    'student_id' => $studentId,
                                    'subscription_id' => $subscriptionId ?? null,
                                    'opening_balance' => $new_opening_balance,
                                    'credit_balance' => $new_credit_balance,
                                    'debit_balance' => $new_debit_balance,
                                    'closing_balance' => $new_closing_balance,
                                ];
                               // StudentLedger::create($ledgerData);

                                    //StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                        }

                        $this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
                        $startOfMonth = Carbon::now()->startOfMonth();
                        $today = Carbon::now();

                        $absentCount = StudentAttendance::whereIn('student_id', $studentIds)
                            ->where('attendance', 'A') 
                            ->whereBetween('created_at', [$startOfMonth, $today]) 
                            ->orderBy('created_at', 'desc') 
                            ->take(4) 
                            ->count(); 
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

                               /* $mail = Mail::send('emails.cancel_subsctiption', ['data' => $data], function ($message) use ($msg) {
                                    $message->from($msg['FromMail'], $msg['Title']);
                                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                                });*/

                             $data['status']=0;                               
                           $this->studentSubscription->changeStatus($data,$subscriptionId);
                        }

                    }
                     return response()->json(['message' => 'Students marked as Absent successfully!']);

                }
                else
                {

                    if($request->attendance_date)
                        {
                            $today1=$request->attendance_date;
                        }else{

                        $today1 = Carbon::today();
                        }
                        
                    foreach ($students as $entry) 
                    {
                        $studentId = $entry['student_id'];
                        $subscriptionId = $entry['subscription_id'];

                   $session = Student::select('student_master.student_id','plan_master.plan_session','student_master.parent_name','student_subscription.plan_id','student_subscription.batch_id','student_master.email','student_subscription.subscription_id')
                    ->where('student_master.student_id', $studentId)
                    ->where('student_subscription.subscription_id', $subscriptionId)
                    ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                    ->join('plan_master', 'plan_master.planId', '=', 'student_subscription.plan_id')
                    ->first();

                    if (!$session) 
                    {
                        return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                    }
                    $attendance = StudentAttendance::where('student_id', $studentId)
                    ->whereDate('student_attendance.attendance_date', '=', $today1)
                    ->join('student_attendance_master', 'student_attendance_master.sattendanceid', '=', 'student_attendance.sattendanceid')
                    ->orderBy('student_attendance_master.created_at', 'desc')
                    ->first();

                    if($attendance)
                    {   
                        $attendanceData = [
                            'attendence_id' => $attendance->attendence_id ?? null,
                            'sattendanceid' => $attendance->sattendanceid ?? null,
                            'student_id' => $studentId,
                            'attendance' => 'A',
                            'batch_id' => $batch->batch_id,
                            'subscription_id' => $attendance->subscription_id,
                            'plan_id' => $attendance->plan_id,
                            'day' => $batch->batch_day,
                            'attendance_date' => $today1,
                        ];
                    }

                    if($attendance)
                    {   
                        $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$attendance->subscription_id)->latest()->first();
                    }else{
                        $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();
                    }
                    $ledgerData=[];  
                    if ($ledger) 
                    {
                        $revert_session = 1;

                            if ($ledger->debit_balance > 0) 
                            {
                                $new_opening_balance = $ledger->closing_balance; // Keep the opening balance same
                                $new_credit_balance = $ledger->credit_balance + $revert_session; // Refund session
                                $new_debit_balance = 0; // No session is deducted
                                $new_closing_balance = $new_opening_balance + $revert_session; // Adjust closing balance

                                if($attendance)
                                {
                                    $ledgerData = [
                                        'attendence_id' => $attendance->attendence_id ?? null,
                                        'sattendanceid' => $attendance->sattendanceid ?? null,
                                        'subscription_id' => $attendance->subscription_id ?? null,
                                        'student_id' => $studentId,
                                        'opening_balance' => $new_opening_balance,
                                        'credit_balance' => $new_credit_balance,
                                        'debit_balance' => $new_debit_balance,
                                        'closing_balance' => $new_closing_balance,

                                    ];

                                }
                                else
                                {
                                    $ledgerData = [
                                        'student_id' => $studentId,
                                        'subscription_id' => $subscriptionId ?? null,
                                        'opening_balance' => $new_opening_balance,
                                        'credit_balance' => $new_credit_balance,
                                        'debit_balance' => $new_debit_balance,
                                        'closing_balance' => $new_closing_balance,

                                    ];
                                }
                            }
                            else 
                            {
                            return redirect()->back()->with('error','No further reversion is possible as the used session is already 0.');
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

                            $data['status']=0;                               
                            $this->studentSubscription->changeStatus($data,$subscriptionId);
                        }
                    }
                     return response()->json(['message' => 'Students marked as Absent successfully!']);
                }
            // }
        }
        if(sizeof($attendance) != 0)
        { 
            foreach ($attendance as $val) 
            {
                if($val->attendance == 'P')
                {
                    $session = Student::select('student_master.student_id', 'plan_master.plan_session','student_master.parent_name','student_master.plan_id','student_master.email','student_subscription.subscription_id')
                    ->where('student_master.student_id', $val->student_id)
                    ->join('plan_master', 'plan_master.planId', '=', 'student_master.plan_id')
                    ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                    ->first();

                    if (!$session) 
                    {
                        return response()->json(['message' => "Plan session not found for student ID: $val->student_id"], 404);
                    }
                    $attendanceData = [
                       'student_id' => $val->student_id,
                        'attendance' => 'A',
                        'batch_id' => $val->batch_id,
                        'plan_id' => $val->plan_id,
                        'subscription_id' => $val->subscription_id,
                        'day' => $batch->batch_day,
                        'attendance_date' => $today,
                    ];
                    $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$subscriptionId)->latest()->first();

                    if ($ledger) 
                    {
                        $revert_session = 1;

                        if ($ledger->debit_balance > 0) {
                            $new_opening_balance = $ledger->closing_balance; 
                            $new_credit_balance = $ledger->credit_balance + $revert_session; 
                            $new_debit_balance =  0; 
                            $new_closing_balance = $new_opening_balance + $revert_session; 
                            if ($new_debit_balance < 0) {
                                $new_debit_balance = 0;
                            }
                            $ledgerData = [
                                'student_id' => $studentId,
                                'subscription_id' => $subscriptionId ?? null,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $new_debit_balance,
                                'closing_balance' => $new_closing_balance,
                            ];
                             /// StudentLedger::create($ledgerData);

                                //StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                        }
                        else {
                            return redirect()->back()->with('error','No further reversion is possible as the used session is already 0.');
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
       

        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
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

    // try{        
            $data=Student::select('student_master.*',DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'))->where(['student_id'=>$id])->first();
    

            $subscription = Student::select('student_master.*','student_subscription.total_session','student_subscription.activate_date',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_subscription.batch_id limit 1) as batchname') ,
                    DB::raw('(
                        SELECT 
                            SUM(debit_balance) - 
                            SUM(CASE 
                                WHEN attendence_id != 0 AND attendence_detail_id != 0 THEN credit_balance 
                                ELSE 0 
                            END)
                        FROM student_ledger 
                        WHERE student_ledger.student_id = student_master.student_id AND student_subscription.subscription_id = student_ledger.subscription_id
                    ) AS debit_balance'),
                )
                ->where(['student_master.student_id'=>$id,'student_subscription.status' => 1])
                ->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')
                ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')

            ->orderBy('student_id','desc')->paginate(env('PER_PAGE_COUNT'));

            $debit_balance = StudentLedger::where('student_id', $id)
                ->where('attendence_id', '!=', 0)
                ->where('attendence_detail_id', '!=', 0)
                ->sum('debit_balance');

            $credit_balance = StudentLedger::where('student_id', $id)
                ->where('attendence_id', '!=', 0)
                ->where('attendence_detail_id', '!=', 0)
                ->sum('credit_balance');

/*
            $attendance=StudentAttendanceMaster::select('student_attendance_master.*','student_attendance.*',
                        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                        DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_attendance.batch_id limit 1) as batchname'))->where(['student_attendance.student_id'=>$id])
            ->join('student_attendance', 'student_attendance.sattendanceid', '=', 'student_attendance_master.sattendanceid')
            ->join('student_subscription', 'student_subscription.subscription_id', '=', 'student_attendance.subscription_id')
            ->join('student_master', 'student_attendance.student_id', '=', 'student_master.student_id')
            ->orderBy('student_attendance_master.sattendanceid','desc')->get();
    */

    $subscriptions = StudentSubscription::select(
        'student_subscription.*',
        DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'),
        DB::raw('(select plan_amount from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planAmount'),
        DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_subscription.batch_id limit 1) as batchName'),
        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'),
        DB::raw('(
            SELECT 
                SUM(debit_balance) - 
                SUM(CASE 
                    WHEN attendence_id != 0 AND attendence_detail_id != 0 THEN credit_balance 
                    ELSE 0 
                END)
            FROM student_ledger 
            WHERE student_ledger.student_id = student_master.student_id AND student_subscription.subscription_id = student_ledger.subscription_id
        ) AS debit_balance')
    )
    ->join('student_master', 'student_subscription.student_id', '=', 'student_master.student_id')
    ->where(['student_subscription.student_id' => $id])
    ->orderBy('student_subscription.subscription_id', 'desc')
    ->get();

foreach ($subscriptions as $subscription) {
    $subscription->attendance = StudentAttendanceMaster::select(
            'student_attendance_master.*',
            'student_attendance.*',
            DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
            DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_attendance.batch_id limit 1) as batchName')
        )
        ->join('student_attendance', 'student_attendance.sattendanceid', '=', 'student_attendance_master.sattendanceid')
        ->join('student_master', 'student_attendance.student_id', '=', 'student_master.student_id')
        ->where('student_attendance.subscription_id', $subscription->subscription_id)
        ->orderBy('student_attendance_master.sattendanceid', 'desc')
        ->get();
}


            if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');
            }
            else
            {
              return view('admin.student_attendance.student_view',compact('data','subscriptions','debit_balance','credit_balance'));
            }
        // } catch (\Exception $e) {
        //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        // }
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

                    $attendance=StudentAttendance::where('attendence_id', $request->attendence_id)
                    ->join('student_attendance_master','student_attendance_master.sattendanceid','student_attendance.sattendanceid')->first();

                    $ledger = StudentLedger::where('student_id', $student->student_id)->where('subscription_id', $attendance->subscription_id)->latest()->first();

                    if ($ledger && $ledger->closing_balance != 0) 
                    {
                        $used_session = 1;
                        $new_opening_balance = $ledger->closing_balance;
                        $new_credit_balance = 0;
                        $new_debit_balance = $used_session;
                        $new_closing_balance = ($new_opening_balance + $new_credit_balance) - $new_debit_balance;
                        

                            if($attendance)
                            {

                                $ledgerData = [
                                    'attendence_id' => $attendance->attendence_id ?? null,
                                    'attendence_detail_id' => $attendance->sattendanceid ?? null,
                                    'subscription_id' => $attendance->subscription_id ?? null,
                                    'student_id' => $student->student_id,
                                    'opening_balance' => $new_opening_balance,
                                    'credit_balance' => $new_credit_balance,
                                    'debit_balance' => $new_debit_balance,
                                    'closing_balance' => $new_closing_balance,
                                ];
                            }
                            StudentLedger::create($ledgerData);

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
                    else 
                    {
                            $data['status']=0;                               
                            $this->studentSubscription->changeStatus($data,$attendance->subscription_id);
                            return redirect()->back()->with('error','No further reversion is possible as the used session is already 0.');
                    }

                    if ($ledger && $ledger->closing_balance == 0) 
                    {
                         $data['status']=0;                               
                      $this->studentSubscription->changeStatus($data,$subscriptionId);
                    }

        }
        if($status == 'A')
        {
                  $data = array(
                        'attendance' => 'A',
                    );
                 StudentAttendance::where("attendence_id","=",$request->attendence_id)->update($data);

                //$today = Carbon::today();
                
                $attendance=StudentAttendance::where("attendence_id","=",$request->attendence_id)
                //->whereDate('student_attendance_master.created_at', '=', $today)
                ->join('student_attendance_master','student_attendance_master.sattendanceid','student_attendance.sattendanceid')->first();


                 $ledger = StudentLedger::where('student_id', $studentId)->where('subscription_id',$attendance->subscription_id)->latest()->first();
                    if ($ledger) 
                    {
                        // Define the amount to revert
                        $revert_session = 1;

                        if ($ledger->closing_balance > 0) {
                            // If debit balance is greater than 0, proceed with reverting
                            $new_opening_balance = $ledger->closing_balance; // Opening balance remains the same
                            $new_credit_balance = $revert_session; // Add back the reverted session
                            $new_debit_balance =  0; // Reduce the debit balance
                            $new_closing_balance = $new_opening_balance + $revert_session; // Adjust closing balance
                            if ($new_debit_balance < 0) {
                                $new_debit_balance = 0;
                            }
                            // Recalculate closing balance accordingly

                            //$new_closing_balance = $new_opening_balance + $new_debit_balance - $new_credit_balance;

                            $ledgerData = [
                                'student_id' => $studentId,
                                'attendence_id' => $attendance->attendence_id ?? null,
                                'attendence_detail_id' => $attendance->sattendanceid ?? null,
                                'subscription_id' => $attendance->subscription_id ?? null,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $new_debit_balance,
                                'closing_balance' => $new_closing_balance,
                            ];
                                StudentLedger::create($ledgerData);
                               // StudentLedger::where("ledger_id","=",$ledger->ledger_id)->update($ledgerData);
                        }
                        else {
                            return redirect()->back()->with('error','No further reversion is possible as the used session is already 0.');
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
                           /*$request['iStatus']=0;
                            $this->student->changeStatus($request,$studentId);*/

                             $data['status']=0;                               
                            $this->studentSubscription->changeStatus($data,$attendance->subscription_id);
                        }
        }
            return redirect()->back()->with('success','Attendance Updated Successfully');

     } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
     }
  }

}

