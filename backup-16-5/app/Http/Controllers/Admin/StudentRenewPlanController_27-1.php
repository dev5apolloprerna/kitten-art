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
        $batch = Batch::where('category_id', $categoryId)->get();
        return response()->json($batch);
    }
    public function getPlan($categoryId)
    {
        $plan = Plan::where('category_id', $categoryId)->get();
        return response()->json($plan);
    }

    public function renew_plan(Request $request)
    {
        try{
            
         $Student = Renewplan::select('student_renew_plan.*','student_master.student_name','student_master.email','student_master.mobile',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_renew_plan.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_renew_plan.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_renew_plan.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_renew_plan.batch_id limit 1) as batchname')
                )
                ->when($request->search, function ($query, $search) {
                    return $query->where('student_name', 'LIKE', "%{$search}%");
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

            $data = RenewPlan::select('student_renew_plan.*',DB::raw('(select student_name from student_master where student_master.student_id = student_renew_plan.student_id limit 1) as student_name'))->where(['renewplan_id'=>$id])->first();
            $plans=Plan::all();
            $batches=Batch::all();
            $category=Category::all();


        return view('admin.renew_plan.edit_renew_student',compact('data','plans','category','batches'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }

    public function update_renew_student(Request $request, $id)
    {
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

             if($request->status == 1)
             {

                $student=RenewPlan::find($id);
                $plan=Plan::find($student->plan_id);

                $data = [
                    'student_id' => $student->student_id,
                    'plan_id' => $student->plan_id,
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
                            $new_credit_balance = $ledger->credit_balance + $new_sessions; // Add 15 sessions
                            $new_closing_balance = $new_opening_balance + $new_sessions;

                            $ledgerData = [
                                'subscription_id' => $subscriptionId,
                                'student_id' => $student->student_id,
                                'opening_balance' => $new_opening_balance,
                                'credit_balance' => $new_credit_balance,
                                'debit_balance' => $ledger->debit_balance, // No change in debit balance yet
                                'closing_balance' => $new_closing_balance,
                            ];
                    } else {
                            // Handle case where no previous ledger exists
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
        
                }
                $request['plan_id'] = $student->plan_id;
                $this->student->createOrUpdate($request, $student->student_id);
                
                $this->RenewPlan->destroy($id);

            return redirect()->route('student.active_student')->with('success', 'Status Changed successfully!');

        } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
        
    }
}
