<?php

namespace App\Http\Controllers\admin;



use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Batch;

use App\Models\Plan;

use App\Models\Student;

use App\Models\Renewplan;

use App\Models\StudentAttendanceMaster;

use App\Models\StudentLedger;

use App\Models\StudentSubscription;

use App\Models\StudentAttendance;

use Hash;



use App\Repositories\Student\StudentRepositoryInterface;

use App\Repositories\Student\StudentRepository;



use App\Repositories\Plan\PlanRepositoryInterface;

use App\Repositories\Plan\PlanRepository;



use App\Repositories\StudentSubscription\StudentSubscriptionRepositoryInterface;

use App\Repositories\StudentSubscription\StudentSubscriptionRepository;



use App\Repositories\RenewPlan\RenewPlanRepositoryInterface;

use App\Repositories\RenewPlan\RenewPlanRepository;





use App\Repositories\Ledger\LedgerRepositoryInterface;

use App\Repositories\Ledger\LedgerRepository;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail; // Import Mail Facade


class ReportController extends Controller

{

    protected $plan;

    protected $student;

    protected $studentsubscription;

    protected $ledger;

    protected $RenewPlan;



    public function __construct(PlanRepositoryInterface $plan

                                ,StudentRepositoryInterface $student,

                                StudentSubscriptionRepositoryInterface $studentsubscription,

                                LedgerRepositoryInterface $ledger,

                                RenewPlanRepositoryInterface $RenewPlan

                                )

    {

        $this->student = $student;

        $this->plan = $plan;

        $this->studentsubscription = $studentsubscription;

        $this->ledger = $ledger;

        $this->RenewPlan = $RenewPlan;

    }

   public function upcoming_renew(Request $request)

    {

         try{



                $Student = Student::select('student_master.*', 

                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 

                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 

                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_master.plan_id limit 1) as amount'), 

                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'),

/*                    DB::raw('(select credit_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id asc limit 1) as credit_balance'),

                    DB::raw('(select debit_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id desc limit 1) as debit_balance'),

                    DB::raw('(select closing_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id desc limit 1) as closing_balance')*/

                    DB::raw('(select sum(credit_balance) from student_ledger where student_ledger.student_id = student_master.student_id and student_ledger.subscription_id !=0 order by ledger_id desc limit 1) as credit_balance'),
                    DB::raw('(select sum(debit_balance) from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as debit_balance'),
                    DB::raw('(select closing_balance from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as closing_balance')




                )

                ->when($request->search, function ($query, $search) {
                    return $query->where('student_first_name', 'LIKE', "%{$search}%")
                                 ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                })

                ->when($request->batch, function ($query, $batchsearch) {

                    return $query->where('batch_id',$batchsearch);

                })            

                ->join('student_ledger', 'student_ledger.student_id', '=', 'student_master.student_id')

                ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')

                ->where('closing_balance', '<=', 2)
                ->groupBy('student_subscription.student_id')
                ->latest()->paginate(env('PER_PAGE_COUNT'));



            $search=$request->search;

            $batch=$request->batch;



            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();


           
                return view('admin.report.index', compact('Student','search','batch','batchdata'));
           
        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

     public function upcoming_view($id)

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

    

    

            $attendance=StudentAttendanceMaster::select('student_attendance_master.*','student_attendance.*',

                        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 

                        DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'))->where(['student_attendance.student_id'=>$id])

            ->join('student_attendance', 'student_attendance.sattendanceid', '=', 'student_attendance_master.sattendanceid')

            ->join('student_master', 'student_attendance.student_id', '=', 'student_master.student_id')->orderBy('student_attendance_master.sattendanceid','desc')->get();
            $debit_balance=StudentLedger::where(['student_id'=>$id])->sum('debit_balance');

    
            if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');
            }else
            {
                return view('admin.report.upcoming_view',compact('data','subscription','attendance','debit_balance'));
            }
        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }
    public function attendance_report(Request $request)
    {
            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();

            $search=$request->search;
            $batch=$request->batch;



   $Student = StudentAttendance::select(
        'student_attendance.*', 
        'student_attendance.attendence_id as aid',
        'student_attendance.created_at as attendance_date',
        'student_master.*',
        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
        DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
        DB::raw('(select plan_session from plan_master where plan_master.planId = student_attendance.plan_id limit 1) as planSession'), 
        DB::raw('(select sum(credit_balance) from student_ledger where student_ledger.student_id = student_master.student_id and student_ledger.subscription_id !=0 order by ledger_id desc limit 1) as credit_balance'),
        DB::raw('(select sum(debit_balance) from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as debit_balance'),
        DB::raw('(select closing_balance from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as closing_balance'),

        // Calculate total used sessions till the subscription ID changes
        DB::raw('(SELECT SUM(student_ledger.debit_balance) 
                 FROM student_attendance AS sa 
                 JOIN student_ledger ON student_ledger.attendence_id = sa.attendence_id 
                 WHERE sa.student_id = student_attendance.student_id 
                 AND student_ledger.subscription_id = 0) AS totalUsedSessions')
    )
    ->when($request->search, function ($query, $datee) {
        return $query->whereDate('student_attendance.created_at', '=', $datee);
    })
    ->when($request->batch, function ($query, $batchsearch) {
        return $query->where('student_attendance.batch_id', $batchsearch);
    })
    ->where(['isWaiting' => 0, 'isRegister' => 1, 'isPaid' => 1,'student_master.iStatus'=>1])

    ->join('student_master', 'student_master.student_id', '=', 'student_attendance.student_id')
    ->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')
    ->orderBy('attendance_date', 'desc')
    ->paginate(env('PER_PAGE_COUNT'));


        return view('admin.report.attendance_report',compact('batchdata','batch','search','Student'));

    }
    public function ajax_attendance_report(Request $request)
    {
        try
        {
             $Student = StudentAttendance::select(
        'student_attendance.*', 
        'student_attendance.attendence_id as aid',
        'student_master.*',
        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
        DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
        DB::raw('(select plan_session from plan_master where plan_master.planId = student_attendance.plan_id limit 1) as planSession'), 
        DB::raw('(select closing_balance from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as closing_balance'),

        // Calculate total used sessions till the subscription ID changes
        DB::raw('(SELECT SUM(student_ledger.debit_balance) 
                 FROM student_attendance AS sa 
                 JOIN student_ledger ON student_ledger.attendence_id = sa.attendence_id 
                 WHERE sa.student_id = student_attendance.student_id 
                 AND student_ledger.subscription_id = 0) AS totalUsedSessions')
    )
    ->when($request->date, function ($query, $datee) {
        return $query->whereDate('student_attendance.created_at', '=', $datee);
    })
    ->when($request->batch, function ($query, $batchsearch) {
        return $query->where('student_attendance.batch_id', $batchsearch);
    })
    ->where(['isWaiting' => 0, 'isRegister' => 1, 'isPaid' => 1])
    ->join('student_master', 'student_master.student_id', '=', 'student_attendance.student_id')
    ->orderBy('student_master.student_first_name', 'asc')
    ->paginate(env('PER_PAGE_COUNT'));




        return view('admin.report.ajax_attendance', compact('Student'))->render();

        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
      public function editAttendance(Request $request)
    {
        /*try
        {*/

            $status=$request->status;
            $search=$request->searchh;
            $batch=$request->batchh;
            $submit=$request->submit;

            $student=StudentAttendance::where(['attendence_id'=>$request->attendence_id])->first();
            $s=Student::where(['student_id'=>$student->student_id])->first();
            $studentId=$student->student_id;
            if($status == 'P' && $submit == 'yes')
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
        if($status == 'A' && $submit == 'yes')
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
                    $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();


 $Student = StudentAttendance::select(
        'student_attendance.*', 
        'student_attendance.attendence_id as aid',
        'student_master.*',
        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
        DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
        DB::raw('(select plan_session from plan_master where plan_master.planId = student_attendance.plan_id limit 1) as planSession'), 
        DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
        DB::raw('(select plan_session from plan_master where plan_master.planId = student_attendance.plan_id limit 1) as planSession'), 
        DB::raw('(select sum(credit_balance) from student_ledger where student_ledger.student_id = student_master.student_id and student_ledger.subscription_id !=0  order by ledger_id desc limit 1) as credit_balance'),
        DB::raw('(select sum(debit_balance) from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as debit_balance'),
        DB::raw('(select closing_balance from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as closing_balance'),


        // Calculate total used sessions till the subscription ID changes
        DB::raw('(SELECT SUM(student_ledger.debit_balance) 
                 FROM student_attendance AS sa 
                 JOIN student_ledger ON student_ledger.attendence_id = sa.attendence_id 
                 WHERE sa.student_id = student_attendance.student_id 
                 AND student_ledger.subscription_id = 0) AS totalUsedSessions')
    )
    ->when($search, function ($query, $datee) {
        return $query->whereDate('student_attendance.created_at', '=', $datee);
    })
    ->when($batch, function ($query, $batchsearch) {
        return $query->where('student_attendance.batch_id', $batchsearch);
    })
    ->where(['isWaiting' => 0, 'isRegister' => 1, 'isPaid' => 1])
    ->join('student_master', 'student_master.student_id', '=', 'student_attendance.student_id')
    ->orderBy('student_master.student_first_name', 'asc')
    ->paginate(env('PER_PAGE_COUNT'));
//return view('admin.report.attendance_report', compact('batchdata', 'batch', 'search', 'Student'))->with('success', 'Attendance Updated Successfully');


return redirect()->back()->with('success', 'Attendance Updated Successfully');
     /*} catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
     }*/
  }

    

}

