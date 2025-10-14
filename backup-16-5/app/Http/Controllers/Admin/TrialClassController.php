<?php

namespace App\Http\Controllers\admin;



use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Plan;

use App\Models\TrialClass;

use Hash;



use App\Repositories\TrialClass\TrialClassRepositoryInterface;

use App\Repositories\TrialClass\TrialClassRepository;



use App\Repositories\Plan\PlanRepositoryInterface;

use App\Repositories\Plan\PlanRepository;



use App\Repositories\Student\StudentRepositoryInterface;

use App\Repositories\Student\StudentRepository;
use App\Repositories\Contact\ContactRepository;



class TrialClassController extends Controller

{

    protected $plan;

    protected $trial;

    protected $student;



    public function __construct(PlanRepositoryInterface $plan,TrialClassRepositoryInterface $trial,StudentRepositoryInterface $student,ContactRepository $contact)

    {

        $this->trial = $trial;

        $this->plan = $plan;

        $this->student = $student;
        $this->contact = $contact;

    }

   public function index(Request $request)

    {

         try{



        $Student = TrialClass::select('trial_master.*'

            ,DB::raw('(select category_name from category_master where category_master.category_id = trial_master.category_id limit 1) as categoryName')

            ,DB::raw('(select batch_name from batch_master where batch_master.batch_id = trial_master.batch_id limit 1) as batchName')

            ,DB::raw('(select plan_name from plan_master where plan_master.planId = trial_master.plan_id limit 1) as planName'))

                ->when($request->search, function ($query, $search) {
                    return $query->where('student_first_name', 'LIKE', "%{$search}%")
                                 ->orWhere('student_last_name', 'LIKE', "%{$search}%");
                })

            ->orderBy('trialclass_student_id','desc')->paginate(env('PER_PAGE_COUNT'));

            $search=$request->search;





        return view('admin.trial_class.index', compact('Student','search'));

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }



    public function view($id)

    {

        try{



        $data=TrialClass::select('trial_master.*'

            ,DB::raw('(select plan_name from plan_master where plan_master.planId = trial_master.plan_id limit 1) as planName')

            ,DB::raw('(select batch_name from batch_master where batch_master.batch_id = trial_master.batch_id limit 1) as batchName')

            ,DB::raw('(select category_name from category_master where category_master.category_id = trial_master.category_id limit 1) as categoryName')

        )->where(['trialclass_student_id'=>$id])->first();

            if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');
            }else
            {
                return view('admin.trial_class.show',compact('data'));
            }   
        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }

    public function sendmail(Request $request)

    {

        /*try

        {*/

            

            $id=$request->trialclass_student_id;

            $class=TrialClass::where(['trialclass_student_id'=>$id])->first();



            $date=date('d-m-Y',strtotime($request->date));

            $time=date('h:i a',strtotime($request->time));



            $root = $_SERVER['DOCUMENT_ROOT'];

            $file = file_get_contents(public_path('mailers/trial-email.html'));

            $file = str_replace('#parent_name', $class->parent_name, $file);

            $file = str_replace('#date', $date, $file);

            $file = str_replace('#time', $time, $file);

            // $file = str_replace('#day', $request->day, $file);



                $SendEmailDetails = DB::table('sendemaildetails')

                ->where(['id' => 15])

                ->first();

            $toMail = $class->email; // "shahkrunal83@gmail.com";//



            $to = $toMail;

            $subject = $SendEmailDetails->strSubject;

            $message = $file;

            $header = "From:" . $SendEmailDetails->strFromMail . "\r\n";

            //$header .= "Cc:afgh@somedomain.com \r\n";

            $header .= "MIME-Version: 1.0\r\n";

            $header .= "Content-type: text/html\r\n";



            

            $retval = mail($to, $subject, $message, $header);

                    

            





            if($class->no_of_reminder_sent ==0)

            {

                 TrialClass::where('trialclass_student_id' , $request->trialclass_student_id)

             ->update([

                'no_of_reminder_sent' => 1

                ]);

            }else{

                $total=$class->no_of_reminder_sent + 1;

                 TrialClass::where('trialclass_student_id' , $request->trialclass_student_id)

             ->update([

                'no_of_reminder_sent' => $total

                ]);



            }





            return redirect()->back()->with('success','TrialClass Mail Send Successfully');

        /*} catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }*/



    }



    public function updatestatus(Request $request)

    {

        try{



        $id=$request->trialclass_student_id;



        if($request->status == 1)

        {



            $trialclass=TrialClass::find($id);  

            $this->contact->createOrUpdate($trialclass->toArray());



            $this->trial->destroy($id);

             return redirect()->back()->with('success','TrialClass Accepted');

        }else{

        

        $status = $request->status; // Assuming the status comes from the request

        $this->trial->updateStatus(['status' => $status], $id);

            

        return redirect()->back()->with('success','TrialClass Status Changes Successfully');



        }

         } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }



    public function delete(Request $request)

    {   

    try{



        $id=$request->trialclass_student_id;

        $this->trial->destroy($id);

        

        return back()->with('success','Student Deleted Successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

    

}

