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

        return view('admin.student.register_student', compact('Student','search','batch','batchdata'));

        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     public function active_student(Request $request)
    {
        try
        {
             $Student = Student::select('student_master.*', 
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_master.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname') ,
                    DB::raw('(select sum(credit_balance) from student_ledger where student_ledger.student_id = student_master.student_id order by ledger_id desc limit 1) as credit_balance'),
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
                ->where(['isWaiting'=>0,'isRegister'=>1,'isPaid'=>1])
            ->orderBy('student_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;
            $batch=$request->batch;

            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();

        return view('admin.student.active_student', compact('Student','search','batch','batchdata'));

        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function create(Request $request)
    {
        try{
            
            $plan=Plan::all();
            $batch=Batch::all();
            $category=Category::all();

            return view('admin.student.add',compact('plan','category','batch'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function getBatch($categoryId)
    {
        $batch = Batch::where('category_id', $categoryId)->get();
        return response()->json($batch);
    }
    public function getPlan($categoryId)
    {
        $plan = Plan::where('category_id', $categoryId)->get();
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
            $plans=Plan::all();
            $batches=Batch::all();
            $category=Category::all();


        return view('admin.student.edit',compact('data','plans','category','batches'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }

    public function update(Request $request, $id)
    {
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
    public function delete(Request $request)
    {   
        try
        {

            $id=$request->student_id;
            $this->student->destroy($id);
            
            return back()->with('success','Student Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
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
        return view('admin.student.show',compact('data'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function active_student_view($id)
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
    
            return view('admin.student.active_student_view',compact('data','subscription','attendance','debit_balance'));
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

            $student=Student::find($id);

            $plan=Plan::where('planId',$student->plan_id)->first();

            $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 3])->first();

            $root = $_SERVER['DOCUMENT_ROOT'];
            $file = file_get_contents($root . '/kitten_craft/mailers/payment_request.html', 'r');
            //$file = file_get_contents("https://getdemo.in/mas_solutions/mailers/welcome-company.html", "r");
            $file = str_replace('#parent_name', $student->parent_name, $file);
            $file = str_replace('#amount', $plan->plan_amount, $file);
            $file = str_replace('#website', 'website', $file);

            $setting = DB::table("setting")->select('email')->first();
            $toMail = $student->email; // "shahkrunal83@gmail.com";//

            $to = $toMail;
            $subject = $SendEmailDetails->strSubject;
            // dd($subject);
            $message = $file;
            $header = "From:" . $SendEmailDetails->strFromMail . "\r\n";
            //$header .= "Cc:afgh@somedomain.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail($to, $subject, $message, $header);

            $data['isRegister']=1;
            $data['isWaiting']=0;
            $this->student->changeStatus($data,$id);
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

            $root = $_SERVER['DOCUMENT_ROOT'];
            $file = file_get_contents($root . '/kitten_craft/mailers/payment_confirmation.html', 'r');
            //$file = file_get_contents("https://getdemo.in/mas_solutions/mailers/welcome-company.html", "r");
            $file = str_replace('#parent_name', $student->parent_name, $file);
            $file = str_replace('#amount', $plan->plan_amount, $file);
            $file = str_replace('#plan', $plan->plan_name, $file);
            $file = str_replace('#loginId', $student->login_id, $file);
            $file = str_replace('#password', '123456', $file);


            $setting = DB::table("setting")->select('email')->first();
            $toMail = $student->email; // "shahkrunal83@gmail.com";//

            $to = $toMail;
            $subject = $SendEmailDetails->strSubject;
            // dd($subject);
            $message = $file;
            $header = "From:" . $SendEmailDetails->strFromMail . "\r\n";
            //$header .= "Cc:afgh@somedomain.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail($to, $subject, $message, $header);

            $data['isWaiting']=0;
            $data['isRegister']=1;
            $data['isPaid']=1;
            $this->student->changeStatus($data,$id);

            $sdata1 = [
                'student_id' => $id,
                'plan_id' => $plan->planId,
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
