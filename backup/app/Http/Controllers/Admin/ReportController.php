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
         // try{

                $Student = Student::select('student_master.*', 
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_master.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'),
                    DB::raw('(select credit_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id asc limit 1) as credit_balance'),
                    DB::raw('(select debit_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id desc limit 1) as debit_balance'),
                    DB::raw('(select closing_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id desc limit 1) as closing_balance')

                )
                ->when($request->search, function ($query, $search) {
                    return $query->where('student_name', 'LIKE', "%{$search}%");
                })
                ->when($request->batch, function ($query, $batchsearch) {
                    return $query->where('batch_id',$batchsearch);
                })            
                ->leftjoin('student_ledger', 'student_ledger.student_id', '=', 'student_master.student_id')
                ->leftjoin('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')
                ->where('closing_balance', '<=', 2)
                ->latest()->paginate(env('PER_PAGE_COUNT'));

            $search=$request->search;
            $batch=$request->batch;

            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();

        return view('admin.report.index', compact('Student','search','batch','batchdata'));
        /*} catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }*/
    }
     public function upcoming_view($id)
    {
        try{
            
            $data=Student::select('student_master.*',DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'))->where(['student_id'=>$id])->first();
    
            $subscription=StudentSubscription::select('student_subscription.*'
                ,DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'),
                DB::raw('(select credit_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id asc limit 1) as credit_balance'),
                DB::raw('(select debit_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id desc limit 1) as debit_balance'),
                DB::raw('(select closing_balance from student_ledger where student_ledger.student_id = student_subscription.student_id order by ledger_id desc limit 1) as closing_balance')
    
            )->where(['student_id'=>$id])->orderBy('subscription_id','desc')->get();
    
    
            $attendance=StudentAttendanceMaster::select('student_attendance_master.*','student_attendance.*',
                        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                        DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'))->where(['student_attendance.student_id'=>$id])
            ->join('student_attendance', 'student_attendance.sattendanceid', '=', 'student_attendance_master.sattendanceid')
            ->join('student_master', 'student_attendance.student_id', '=', 'student_master.student_id')->orderBy('student_attendance_master.sattendanceid','desc')->get();
    
            return view('admin.report.upcoming_view',compact('data','subscription','attendance'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
}
