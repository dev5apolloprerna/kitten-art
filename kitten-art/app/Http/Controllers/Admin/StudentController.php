<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
use App\Models\StudentInquiry;
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

use Illuminate\Support\Facades\Mail; // Import Mail Facade

class StudentController extends Controller
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
   public function index(Request $request)
    {
         try{

         $Student = Student::select('student_master.*', 
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_master.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname')
                )
                ->when($request->search, function ($query, $search) {
                    return $query->where('student_first_name', 'LIKE', "%{$search}%")
                                 ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                })
                ->when($request->batch, function ($query, $batchsearch) {
                    return $query->where('batch_id',$batchsearch);
                })
                ->where(['isWaiting'=>1,'isRegister'=>0,'isPaid'=>0])
            ->orderBy('student_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;
            $batch=$request->batch;

            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();

        return view('admin.student.index', compact('Student','search','batch','batchdata'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function register_student(Request $request)
    {
        try
        {
             $Student = Student::select('student_master.*', 
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_master.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname')
                )
                ->when($request->search, function ($query, $search) {
                    return $query->where('student_first_name', 'LIKE', "%{$search}%")
                                 ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                })
                ->when($request->batch, function ($query, $batchsearch) {
                    return $query->where('batch_id',$batchsearch);
                })
                ->where(['isWaiting'=>0,'isRegister'=>1,'isPaid'=>0])
            ->orderBy('student_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;
            $batch=$request->batch;

            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();
            if(empty($Student))
        {
            return redirect()->route('student.index')->with('error','No Data Found');
        }else{

            return view('admin.student.register_student', compact('Student','search','batch','batchdata'));
            }
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     public function active_student(Request $request)
    {
        try
        {
             $Student = Student::select(
                    'student_master.*',
                    'student_subscription.total_session',
                    'student_subscription.status',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_subscription.batch_id limit 1) as batchname'),
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
                ->when($request->search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('student_first_name', 'LIKE', "%{$search}%")
                          ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                    });
                })
                ->when($request->batch, function ($query, $batchsearch) {
                    return $query->where('student_subscription.batch_id', $batchsearch);
                })
                ->where('student_master.isWaiting', 0)
                ->where('student_master.isRegister', 1)
                ->where('student_master.isPaid', 1)
                ->where('student_subscription.status', 1) // <-- Make sure this is fully qualified
                ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                ->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')
                ->orderBy('student_master.student_id', 'desc')
                ->paginate(env('PER_PAGE_COUNT'));

            $search=$request->search;
            $batch=$request->batch;

            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();

            $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();
            $plan=Plan::where(['iStatus'=>1,'isDelete'=>0])->get();

        if(empty($Student))
        {
            return redirect()->route('student.index')->with('error','No Data Found');
        }else{
        
        return view('admin.student.active_student', compact('Student','search','batch','batchdata','category','plan'));
        }


        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function inactive_student(Request $request)
    {
        try
        {
             $Student = StudentSubscription::select('student_subscription.*','student_master.student_first_name' ,'student_master.batch_id','student_master.mobile','student_master.email','student_master.student_age',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_subscription.batch_id limit 1) as batchname'),DB::raw('(
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
                ->when($request->search, function ($query, $search) {
                    return $query->where('student_first_name', 'LIKE', "%{$search}%")
                                 ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                })
                ->when($request->batch, function ($query, $batchsearch) {
                    return $query->where('batch_id',$batchsearch);
                })
                ->where(['status'=>0])
                ->join('student_master', 'student_master.student_id', '=', 'student_subscription.student_id')
                ->join('batch_master', 'batch_master.batch_id', '=', 'student_subscription.batch_id')

            ->orderBy('student_id','desc')->paginate(env('PER_PAGE_COUNT'));

            $search=$request->search;
            $batch=$request->batch;

            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();

            $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();
            $plan=Plan::where(['iStatus'=>1,'isDelete'=>0])->get();

        if(empty($Student))
        {
            return redirect()->route('student.index')->with('error','No Data Found');
        }else{
        
        return view('admin.student.inactive_student', compact('Student','search','batch','batchdata','category','plan'));
        }


        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function create(Request $request)
    {
        try{
            
            $plan=Plan::where(['iStatus'=>1,'isDelete'=>0])->get();
            $batch=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();
            $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();

            return view('admin.student.add',compact('plan','category','batch'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function getBatch($categoryId)
    {
        $batch = Batch::where('category_id', $categoryId)->where(['iStatus'=>1,'isDelete'=>0])->get();
        return response()->json($batch);
    }
    public function getPlan($categoryId)
    {
        $plan = Plan::where('category_id', $categoryId)->where(['iStatus'=>1,'isDelete'=>0])->get();
        return response()->json($plan);
    }
     public function getPlanAmount($planId)
    {
        $plan = Plan::where(['isDelete'=>0])->where('planId', $planId)->first();
        return response()->json($plan);
    }
    public function store(Request $request)
    {

        try
        {
            $this->student->createOrUpdate($request);

            return redirect()->route('student.index')->with('success', 'Student saved successfully!');

            
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }

    public function edit(plan $plan,$id)
    {

        try{

            $data = $this->student->find($id);
            $plans=Plan::where(['iStatus'=>1,'isDelete'=>0])->get();
            $batches=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();
            $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();

            if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');
            }else
            {
                return view('admin.student.edit',compact('data','plans','category','batches'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }

    public function update(Request $request, $id)
    {
            $request->validate([
                'category_id' => 'required', 
                'plan_id' => 'required', 
                'batch_id' => 'required', 
                'student_first_name' => 'required', 
                'student_last_name' => 'required',        
                'student_age' => 'required|integer',        
                'mobile' => 'required|digits:10',        
                'parent_name' => 'required',        
                'communication_mode' => 'required',        
            ], [
                'category_id.required' => 'Please select a category.',
                'plan_id.required' => 'Please select a plan.',
                'batch_id.required' => 'Please select a batch.',
                'student_first_name.required' => 'Student first name is required.',
                'student_last_name.required' => 'Student last name is required.',
                'student_age.required' => 'Please enter the student\'s age.',
                'student_age.integer' => 'The age must be a number.',
                'mobile.required' => 'Mobile number is required.',
                'mobile.digits' => 'Mobile number must be 10 digits.',
                'parent_name.required' => 'Parent name is required.',
                'communication_mode.required' => 'Please select a communication mode.',
            ]);


        try
        {
            $this->student->createOrUpdate($request, $id);
            
            if($request->isPaid == 1)
            {
            return redirect()->route('student.active_student')->with('success','Student Updated Successfully');

            }else if($request->isRegister == 1)
            {
                return redirect()->route('student.register_student')->with('success','Student Updated Successfully');
            }
            else
            {

            return redirect()->route('student.index')->with('success','Student Updated Successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    /*public function delete(Request $request)
    {   
        try
        {

            $id=$request->student_id;
            
            $this->student->destroy($id);
            
            return back()->with('success','Student Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }*/

    public function delete(Request $request)
{
    $id = $request->student_id; // int or array

    try {
        DB::transaction(function () use ($id) {
            $ids = is_array($id) ? $id : [$id];

            // 0) Soft delete students (do NOT hard delete)
            DB::table('student_master')->whereIn('student_id', $ids)->delete();

            // Keep your cleanup if you still really want it (optional)
            DB::table('student_attendance')->whereIn('student_id', $ids)->delete();
            DB::table('student_attendance_master')->whereNotExists(function ($q) {
                $q->select(DB::raw(1))
                  ->from('student_attendance')
                  ->whereColumn('student_attendance_master.sattendanceid', 'student_attendance.attendence_id');
            })->delete();
            DB::table('student_subscription')->whereIn('student_id', $ids)->delete();
            DB::table('student_ledger')->whereIn('student_id', $ids)->delete();

            
        });

        // If current browser belongs to a just-deleted student, log it out
        $ids = (array) $id;
        if (Auth::guard('student')->check()
            && in_array(Auth::guard('student')->id(), $ids, true)) {
            Auth::guard('student')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Clear your custom session keys (safe)
        $request->session()->forget([
            'student_id','student_name','email','mobile','student_role_id'
        ]);

        return back()->with('success', 'Student deleted successfully');
    } catch (\Throwable $e) {
        return back()->with('error', 'An error occurred: '.$e->getMessage());
    }
}


    public function view($id)
    {
        try{
            
        $data=Student::select('student_master.*'
            ,DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName')
            ,DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchName')
            ,DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName')

        )->where(['student_id'=>$id])->first();
        if(empty($data))
        {
            return redirect()->route('student.index')->with('error','No Data Found');
        }else{
        return view('admin.student.show',compact('data'));

        }
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function active_student_view($id)
    {
        try{
            
            $data=Student::select('student_master.*',DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'))->where(['student_id'=>$id])->first();
    
            $subscription =Student::select('student_master.*','student_subscription.total_session','student_subscription.activate_date',
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



           /* $attendance=StudentAttendanceMaster::select('student_attendance_master.*','student_attendance.*',
                        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                        DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_attendance.batch_id limit 1) as batchname'))->where(['student_attendance.student_id'=>$id])
            ->join('student_attendance', 'student_attendance.sattendanceid', '=', 'student_attendance_master.sattendanceid')
            ->join('student_master', 'student_attendance.student_id', '=', 'student_master.student_id')->orderBy('student_attendance_master.sattendanceid','desc')->get();
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

        if(empty($data))
        {
            return redirect()->route('student.index')->with('error','No Data Found');
        }else{
        
            return view('admin.student.active_student_view',compact('data','subscriptions'));
        }

        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function changepassword($id)
    {
        return view('admin.student.changepassword',compact('id'));
    }
    public function updatepassword(Request $request,$id)
    {
      try{

            $student = Student::find($id)->toArray();
    
            $newpassword = $request->password;
            $confirmpassword = $request->new_confirm_password;

            if ($newpassword == $confirmpassword) 
            {

                $student = $this->student->changePassword($request, $id);


                return redirect()->route('student.active_student')->with('success', 'Student Password Updated Successfully.');
            } else {
                return back()->with('error', 'password and confirm password does not match');
            }
        
         } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
    }
    public function payment_request(Request $request)
    {
       try 
        {

            $id=$request->student_request_id;

            $student=StudentInquiry::find($id);

            if(empty($student->plan_id))
            {
                return redirect()->back()->with('error', 'Please Select Plan And Batch For Send Payment Request');

            }
            $plan=Plan::where('planId',$student->plan_id)->first();

            $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 3])->first();

                $data=array(
                    'parent_name' => $request->parent_name,
                    'amount' => $plan->plan_amount,
                );

                 $msg = array(
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => 'Kitten Art Classes ,LLC',
                    'ToEmail' => $student->email,
                    'Subject' => 'Thank You For Your Registration'
                );

                $mail = Mail::send('emails.payment_request', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });

            
            return redirect()->back()->with('success', 'Payment Request Mail Send Successfully');

       } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
    }
    public function updatepaid_student(Request $request)
    {
        try
        {
            $id=$request->student_request_id;

            $student=Student::find($id);

            $plan=Plan::where('planId',$student->plan_id)->first();

            $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 4])->first();

                $data=array(
                    'parent_name' => $student->parent_name,
                    'amount' => $plan->plan_amount,
                    'plan' => $plan->plan_name,
                    'loginId' => $student->login_id,
                    'password' => '123456',
                );

                 $msg = array(
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => 'Kitten Art Classes ,LLC',
                    'ToEmail' => $student->email,
                    'Subject' => 'Thank You For Your Payment With Kitten Art Classes ,LLC'
                );

                $mail = Mail::send('emails.payment_confirmation', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });

           
            $data['isWaiting']=0;
            $data['isRegister']=1;
            $data['isPaid']=1;
            $this->student->changeStatus($data,$id);

            $sdata1 = [
                'student_id' => $id,
                'plan_id' => $plan->planId,
                'batch_id' => $student->batch_id,
                'category_id' => $student->category_id,
                'total_session' => $plan->plan_session,
                'amount' => $plan->plan_amount,
                'activate_date' => date('Y-m-d'),
                'expired_date' => date('Y-m-d'),
            ];

            $subscription = $this->studentsubscription->createOrUpdate($sdata1);

            $subscriptionId = $subscription->subscription_id ?? null; // Assuming createOrUpdate returns the saved model

            if ($subscriptionId) 
            {
                $ldata1 = [
                    'student_id' => $id,
                    'subscription_id' => $subscriptionId, // Use the subscription ID
                    'opening_balance' => 0,
                    'credit_balance' => $plan->plan_session,
                    'debit_balance' => 0,
                    'closing_balance' => $plan->plan_session,
                ];

                // Create or update the ledger record
                $this->ledger->createOrUpdate($ldata1);
            }


            return redirect()->route('student.active_student')->with('success', 'Payment processed successfully!');

        } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
    }
    
    
}
