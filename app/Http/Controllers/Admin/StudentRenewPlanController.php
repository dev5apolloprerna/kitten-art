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
use App\Models\StudentLedger;
use App\Models\StudentSubscription;
use App\Repositories\RenewPlan\RenewPlanRepositoryInterface;
use App\Repositories\RenewPlan\RenewPlanRepository;
use App\Repositories\StudentSubscription\StudentSubscriptionRepositoryInterface;
use App\Repositories\StudentSubscription\StudentSubscriptionRepository;
use App\Repositories\Ledger\LedgerRepositoryInterface;
use App\Repositories\Ledger\LedgerRepository;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Student\StudentRepository;
use Illuminate\Support\Facades\Mail; // Import Mail Facade

class StudentRenewPlanController extends Controller

{

    protected $RenewPlan;

    protected $studentsubscription;

    protected $ledger;

    protected $student;



    public function __construct(StudentRepositoryInterface $student,RenewPlanRepositoryInterface $RenewPlan,StudentSubscriptionRepositoryInterface $studentsubscription,LedgerRepositoryInterface $ledger)

    {

        $this->RenewPlan = $RenewPlan;

        $this->studentsubscription = $studentsubscription;

        $this->ledger = $ledger;

        $this->student = $student;

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



    public function renew_plan(Request $request)
    {

        try{

         $Student = Renewplan::select('student_renew_plan.*','student_master.student_first_name','student_master.student_last_name','student_master.email','student_master.mobile',

                    DB::raw('(select category_name from category_master where category_master.category_id = student_renew_plan.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_renew_plan.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_renew_plan.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_renew_plan.batch_id limit 1) as batchname')
                )
                ->when($request->search, function ($query, $search) {
                    return $query->where('student_first_name', 'LIKE', "%{$search}%")
                                 ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                })
                ->when($request->batch, function ($query, $batchDay) {
                    return $query->whereIn('batch_id', function ($subQuery) use ($batchDay) {
                        $subQuery->select('batch_id')
                            ->from('batch_master')
                            ->where('batch_name', $batchDay);
                    });
                })
                ->join('student_master', 'student_master.student_id', '=', 'student_renew_plan.student_id')
                ->orderBy('student_id','desc')->paginate(env('PER_PAGE_COUNT'));

         return view('admin.renew_plan.renew_student_plan', compact('Student'));

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }

     public function edit_renew_student(plan $plan,$id)
    {
        try{

            $data = RenewPlan::select('student_renew_plan.*',DB::raw("(SELECT CONCAT(student_first_name, ' ', student_last_name) FROM student_master WHERE student_master.student_id = student_renew_plan.student_id  LIMIT 1) AS student_name"))->where(['renewplan_id'=>$id])->first();

            $plans=Plan::where(['iStatus'=>1,'isDelete'=>0])->get();
            $batches=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();
            $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();
            if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');
            }else
            {

                return view('admin.renew_plan.edit_renew_student',compact('data','plans','category','batches'));
             }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function update_renew_student(Request $request, $id)
    {
             $request->validate([
                'category_id' => 'required', 
                'plan_id' => 'required', 
                'student_name' => 'required', 
                'batch_id' => 'required', 
            ], [
                'category_id.required' => 'Please select a category.',
                'plan_id.required' => 'Please select a plan.',
                'student_name.required' => 'Student Name is required.',
                'batch_id.required' => 'Please select a batch.'
            ]);
        try
        {
            $this->RenewPlan->createOrUpdate($request, $id);
           return redirect()->route('renewPlan.renew_plan')->with('success','Student Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatestatus(Request $request)
    {
           try{
                $id=$request->renewplan_id;
                $status = $request->status;
                $this->RenewPlan->updateStatus(['status' => $status], $id);
                $student=RenewPlan::find($id);
                $sdata=Student::select('parent_name','email')->where(['student_id'=>$student->student_id])->first(); 
             
             $subscription=StudentSubscription::where(['student_id'=>$student->student_id,'status'=>1])->count();
             if($subscription != 0 && $request->status == 1)
                {
                return redirect()->back()->with('error', 'You already have an active plan.!');

                }
            else
            {

                 if($request->status == 1)
             {

                $plan=Plan::find($student->plan_id);
                $data = [
                    'student_id' => $student->student_id,
                    'plan_id' => $student->plan_id,
                    'batch_id' => $student->batch_id,
                    'category_id' => $student->category_id,
                    'total_session' => $plan->plan_session,
                    'amount' => $plan->plan_amount,
                    'activate_date' => date('Y-m-d'),
                    'expired_date' => date('Y-m-d')
                ];
                $subscription = $this->studentsubscription->createOrUpdate($data);
                $subscriptionId = $subscription->subscription_id ?? null; // Assuming createOrUpdate returns the saved model
               // $ledger = StudentLedger::where('student_id', $student->student_id)->latest()->first();
                $new_sessions=$plan->plan_session;


                            $ledgerData = [
                                'subscription_id' => $subscriptionId,
                                'student_id' => $student->student_id,
                                'opening_balance' => 0,
                                'credit_balance' => $new_sessions, // Start with the new sessions
                                'debit_balance' => 0,
                                'closing_balance' => $new_sessions, // Same as credit balance
                            ];
                
                    $this->ledger->createOrUpdate($ledgerData);
                   


                $SendEmailDetails = DB::table('sendemaildetails')
                    ->where(['id' => 17])
                    ->first();


                    $data=array(
                        'parent_name' => $sdata->parent_name,
                        'plan_name' => $plan->plan_name,
                        'amount' => $student->amount,
                        'plan_session' => $student->plan_session,
                    );

                $msg = array(
                        'FromMail' => $SendEmailDetails->strFromMail,
                        'Title' => 'Kitten Art Classes',
                        'ToEmail' => $sdata->email,
                        'Subject' => 'Thank You For Your Registration'
                    );

                    $mail = Mail::send('emails.registration', ['data' => $data], function ($message) use ($msg) {
                        $message->from($msg['FromMail'], $msg['Title']);
                        $message->to($msg['ToEmail'])->subject($msg['Subject']);
                    });

                    $request['plan_id'] = $student->plan_id;
                    $request['isRegister'] = 1;
                    $request['isPaid'] = 1;
                    $this->student->createOrUpdate($request, $student->student_id);
                    $this->RenewPlan->destroy($id);

                    return redirect()->route('student.active_student')->with('success', 'Status Changed successfully!');
                }
                return redirect()->back()->with('success', 'Status Changed successfully!');

            }
        } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
    }
     public function create_abcd(Request $request)
    {

        try{

                $student=Student::find($request->student_id);

                $this->student->createOrUpdate($request, $request->student_id);

             $plan=Plan::find($request->plan_id);
                $data = [
                    'student_id' => $request->student_id,
                    'plan_id' => $request->plan_id,
                    'amount' => $plan->plan_amount,
                    'activate_date' => date('Y-m-d'),
                    'expired_date' => date('Y-m-d')
                ];


                $subscription = $this->studentsubscription->createOrUpdate($data);
                $subscriptionId = $subscription->subscription_id ?? null; // Assuming createOrUpdate returns the saved model
                $ledger = StudentLedger::where('student_id', $student->student_id)->latest()->first();
                $new_sessions=$plan->plan_session;

                    if ($ledger) 
                    {
                            $new_opening_balance = $ledger->closing_balance;
                            $new_credit_balance =  $new_sessions; // Add 15 sessions
                            $new_closing_balance = $new_opening_balance + $new_sessions;

                         $ledgerData = [
                                'subscription_id' => $subscriptionId,
                                'student_id' => $student->student_id,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => 0, // No change in debit balance yet
                                'closing_balance' => $new_closing_balance,
                            ];
                    } else {

                            $ledgerData = [
                                'subscription_id' => $subscriptionId,
                                'student_id' => $student->student_id,
                                'opening_balance' => 0,
                                'credit_balance' => $new_sessions, // Start with the new sessions
                                'debit_balance' => 0,
                                'closing_balance' => $new_sessions, // Same as credit balance
                            ];
                    }
                    $this->ledger->createOrUpdate($ledgerData);
                
                
            return redirect()->route('student.active_student')->with('success', 'Plan Renew Successfully');


        } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
    }
    public function create(Request $request)
    {
         try{
                   $studentId=$request->student_id;
                    $student=Student::find($studentId);
                    
                    $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 14])->first();

                        $data=array(
                            'parent_name' => $student->parent_name,
                            'url' => "https://kittenart.com/newkittenart/renew-subscription/" . $studentId,
                            'admin'=>1,
                        );

                        $msg = array(
                            'FromMail' => $SendEmailDetails->strFromMail,
                            'Title' => 'Kitten Art Classes',
                            'ToEmail' => $student->email,
                            'Subject' => $SendEmailDetails->strSubject
                        );

                        $mail = Mail::send('emails.renew_subsctiption', ['data' => $data], function ($message) use ($msg) {
                            $message->from($msg['FromMail'], $msg['Title']);
                            $message->to($msg['ToEmail'])->subject($msg['Subject']);
                        });

            return redirect()->route('student.active_student')->with('success', 'Plan Renew Successfully');

        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','An error occurred while updating the student');
        }
    }
    public function admin_submit_renew_plan(Request $request)

    {

        try{

            

            $renew=Renewplan::where(['student_id'=>$request->student_id,'category_id'=>$request->category_id,'plan_id'=>$request->plan_id,'status'=>0])->first();
                    
                
            if(empty($renew))

            {

            
                $sdata=Student::select('parent_name','email')->where(['student_id'=>$request->student_id])->first(); 
                 $plan=Plan::find($request->plan_id);

                $Renewplan=new Renewplan();

                $Renewplan->student_id=$request->student_id;

                $Renewplan->category_id=$request->category_id;

                $Renewplan->plan_id=$request->plan_id;

                $Renewplan->batch_id=$request->batch_id;

                $Renewplan->amount=$request->amount;

                $Renewplan->plan_session=$request->plan_session;

                $Renewplan->save();

                $data['iStatus']=1;                               
                $this->student->changeStatus($data,$request->student_id);


                /*$SendEmailDetails = DB::table('sendemaildetails')
                    ->where(['id' => 17])
                    ->first();


                    $data=array(
                        'parent_name' => $sdata->parent_name,
                        'plan_name' => $plan->plan_name,
                        'amount' => $request->amount,
                        'plan_session' => $request->plan_session,
                    );

                $msg = array(
                        'FromMail' => $SendEmailDetails->strFromMail,
                        'Title' => 'Kitten Art Classes',
                        'ToEmail' => $sdata->email,
                        'Subject' => 'Thank You For Your Registration'
                    );

                    $mail = Mail::send('emails.registration', ['data' => $data], function ($message) use ($msg) {
                        $message->from($msg['FromMail'], $msg['Title']);
                        $message->to($msg['ToEmail'])->subject($msg['Subject']);
                    });*/

           return redirect()->route('renewPlan.renew_plan')->with('success','Student Plan Renewed Successfully');

               // return redirect()->route('FrontrenewalThankyou')->with('success','Plan Renew Successfully');

            }else{

                return redirect()->back()->with('error','Plan Alredy Renewed');



            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }

}

