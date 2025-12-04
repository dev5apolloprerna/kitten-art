<?php

namespace App\Http\Controllers\Front;



use App\Http\Controllers\Controller;



use Illuminate\Http\Request;



use App\Models\Batch;

use App\Models\Plan;

use App\Models\Student;

use App\Models\Category;

use App\Models\Renewplan;

use App\Models\StudentAttendanceMaster;

use App\Models\StudentSubscription;

use App\Models\StudentAttendance;

use App\Models\StudentLedger;



use Illuminate\Support\Facades\DB;



use App\Repositories\Student\StudentRepositoryInterface;

use App\Repositories\Student\StudentRepository;



use App\Repositories\StudentSubscription\StudentSubscriptionRepositoryInterface;

use App\Repositories\StudentSubscription\StudentSubscriptionRepository;



use App\Repositories\Ledger\LedgerRepositoryInterface;

use App\Repositories\Ledger\LedgerRepository;



use App\Repositories\Testimonial\TestimonialRepositoryInterface;

use App\Repositories\Testimonial\TestimonialRepository;

use Illuminate\Support\Facades\Mail; // Import Mail Facade


class FrontStudentController extends Controller

{

    protected $student;

    protected $studentsubscription;

    protected $ledger;

    protected $testimonial;



    public function __construct(StudentRepositoryInterface $student,

                                StudentSubscriptionRepositoryInterface $studentsubscription,

                                LedgerRepositoryInterface $ledger,

                                TestimonialRepositoryInterface $testimonial

                                )

    {

        $this->student = $student;

        $this->studentsubscription = $studentsubscription;

        $this->ledger = $ledger;

        $this->testimonial = $testimonial;

    }





    public function student_dashboard(Request $request)

    {

        try

        {

            

		  $id=session()->get('student_id');

		  if(session()->get('student_id'))

		  {

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

            ->orderBy('student_id','desc')->get();
    

            $debit_balance = StudentLedger::where('student_id', $id)
                ->where('attendence_id', '!=', 0)
                ->where('attendence_detail_id', '!=', 0)
                ->sum('debit_balance');

            $credit_balance = StudentLedger::where('student_id', $id)
                ->where('attendence_id', '!=', 0)
                ->where('attendence_detail_id', '!=', 0)
                ->sum('credit_balance');


            $attendance=StudentAttendanceMaster::select('student_attendance_master.*','student_attendance.*',
                        DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                        DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'))->where(['student_attendance.student_id'=>$id])
            ->join('student_attendance', 'student_attendance.sattendanceid', '=', 'student_attendance_master.sattendanceid')
            ->join('student_subscription', 'student_subscription.subscription_id', '=', 'student_attendance.subscription_id')
            ->join('student_master', 'student_attendance.student_id', '=', 'student_master.student_id')
            ->orderBy('student_attendance_master.sattendanceid','desc')->get();



            return view('frontview.student_dashboard',compact('data','subscription','attendance','debit_balance','credit_balance'));

            

		  }else{

		   return redirect()->route('FrontLogin');



		  }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }

     public function student_active_plan(Request $request)

    {

        try{

            

        $id=session()->get('student_id');

        

        if(session()->get('student_id'))

		{

        $plan=Student::select('student_master.*',

            DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'),

            DB::raw('(select batch_to_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_to_time'),

            DB::raw('(select batch_from_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_from_time'))->where(['student_master.student_id'=>$id])        

            ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')

            ->join('student_ledger', 'student_ledger.subscription_id', '=', 'student_subscription.subscription_id')->first();

            

            

         $active_plan= Student::select('student_master.*','student_subscription.total_session','student_subscription.activate_date',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'), 
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'), 
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as amount'), 
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_subscription.batch_id limit 1) as batchname') ,
                    DB::raw('(select plan_image from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as plan_image'),
                DB::raw('(select batch_from_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_from_time'),
                DB::raw('(select batch_to_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_to_time'),
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
                ->orderBy('student_subscription.subscription_id','desc')->get();

 $debit_balance = StudentLedger::where('student_id', $id)
                ->where('attendence_id', '!=', 0)
                ->where('attendence_detail_id', '!=', 0)
                ->sum('debit_balance');

        /* StudentLedger::select(

    'student_ledger.*','student_subscription.amount','student_subscription.activate_date','student_subscription.total_session',

    DB::raw('(select plan_name from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as planName'),

    DB::raw('(select plan_session from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as plan_session'),

    DB::raw('(select plan_image from plan_master where plan_master.planId = student_subscription.plan_id limit 1) as plan_image'),
)

->join('student_subscription', 'student_subscription.subscription_id', '=', 'student_ledger.subscription_id')->where(['student_ledger.student_id'=>$id])

->orderBy('ledger_id', 'DESC')->get();*/




        return view('frontview.student_plan',compact('active_plan','debit_balance'));

		}else{

		   return redirect()->route('FrontLogin');



		  }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }

    public function student_testimonial(Request $request)

    {

         $id=session()->get('student_id');

          if(session()->get('student_id'))

          {
    
        $id=session()->get('student_id');

        return view('frontview.student_testimonial',compact('id'));

        }else{

           return redirect()->route('FrontLogin');



          }

    }

    public function storeFeedback(Request $request)

    {

        try{

            

        $student_photo = "";

            $parent_photo = "";

            

            if ($request->hasFile('student_photo')) {

                $root = $_SERVER['DOCUMENT_ROOT'];

                $image1 = $request->file('student_photo');

                $student_photo = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();

                $destinationpath = $root . '/Testimonial/';

                if (!file_exists($destinationpath)) {

                    mkdir($destinationpath, 0755, true);

                }

                $image1->move($destinationpath, $student_photo);

            }

            

            if ($request->hasFile('parent_photo')) {

                $root = $_SERVER['DOCUMENT_ROOT'];

                $image2 = $request->file('parent_photo');

                $parent_photo = time() . '_' . uniqid() . '.' . $image2->getClientOriginalExtension();

                $destinationpath1 = $root . '/Testimonial/';

                if (!file_exists($destinationpath1)) {

                    mkdir($destinationpath1, 0755, true);

                }

                $image2->move($destinationpath1, $parent_photo);

            }

            

            $data = [

                'student_name' => $request->student_name,

                'parent_photo' => $parent_photo,

                'student_photo' => $student_photo,

                'parent_name' => $request->parent_name,

                'description' => $request->description,

            ];

            

            $this->testimonial->createOrUpdate($data);



        return redirect()->back()->with('success', 'Testimonial saved successfully!');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }



    }
    public function student_renew_plan(Request $request)
    {
        try{

            

        $id=session()->get('student_id');

        

        if(session()->get('student_id'))

        {

        $plan=Student::select('student_master.*',

            DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'),

            DB::raw('(select batch_to_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_to_time'),

            DB::raw('(select batch_from_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_from_time'))->where(['student_master.student_id'=>$id])        

            ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')

            ->join('student_ledger', 'student_ledger.student_id', '=', 'student_master.student_id')->first();

            

            

        $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();

       $plans=Plan::where(['iStatus'=>1,'isDelete'=>0])->get();

        $batches=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();



        return view('frontview.student_renew_plan',compact('plan','category','plans','batches','id'));

        }else{

           return redirect()->route('FrontLogin');



          }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }

    public function student_submit_renew_plan(Request $request)

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
                //$this->student->changeStatus($data,$request->student_id);


                $SendEmailDetails = DB::table('sendemaildetails')
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
                        'Title' => 'Kitten Art Classes ,LLC',
                        'ToEmail' => $sdata->email,
                        'Subject' => 'Thank You For Your Registration'
                    );

                    $mail = Mail::send('emails.registration', ['data' => $data], function ($message) use ($msg) {
                        $message->from($msg['FromMail'], $msg['Title']);
                        $message->to($msg['ToEmail'])->subject($msg['Subject']);
                    });


                return redirect()->route('FrontrenewalThankyou')->with('success','Plan Renew Successfully');

            }else{

                return redirect()->back()->with('error','Plan Alredy Renewed');



            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }

    public function renew_subscription($id)

    {

        try{

             $Student=Student::where(['student_id'=>$id])->first();

            if(!empty($Student))

    		{

                $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();

                $plan=Student::select('student_master.*','plan_master.plan_name','plan_master.plan_session','plan_master.plan_amount','plan_master.plan_image',

                DB::raw('(select category_name from category_master where category_master.category_id = plan_master.category_id limit 1) as categoryName'),

                DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'),

                DB::raw('(select batch_to_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_to_time'),

                DB::raw('(select batch_from_time from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batch_from_time'))->where(['student_master.student_id'=>$id])        

                ->join('plan_master', 'plan_master.planId', '=', 'student_master.plan_id')

                ->join('student_subscription', 'student_subscription.student_id', '=', 'student_master.student_id')->first();

                

    

            return view('frontview.renew_subscription',compact('id','category','plan'));

        }else{

		   return redirect()->route('FrontLogin');



		  }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }

    public function student_profile(Request $request)

    {



        try{



            $id=session()->get('student_id');
          if(session()->get('student_id'))

          {

            $Student=Student::find($id);
            return view('frontview.user_profile',compact('Student','id'));

          }else{

        

             return redirect()->route('FrontLogin');



          }

            

             } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }



    }

    public function student_update(Request $request)
    {

        try{



            $id=session()->get('student_id');

          if(session()->get('student_id'))

          {

            $student=Student::find($id);

            $this->student->createOrUpdate($request, $id);

            

              return redirect()->back()->with('success','Student Updated Successfully');

         

          }else{

             return redirect()->route('FrontLogin');



          }

            

             } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }



    }





}

