<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Plan;
use App\Models\Batch;
use App\Models\Category;
use App\Models\EBook;
use App\Models\Testimonial;
use App\Models\Events;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Page;
use App\Models\ServiceImages;
use App\Models\Student;

use Illuminate\Support\Facades\DB;

use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\Contact\ContactRepository;

use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Student\StudentRepository;

use App\Repositories\TrialClass\TrialClassRepositoryInterface;
use App\Repositories\TrialClass\TrialClassRepository;

use App\Repositories\EBook\EBookRepositoryInterface;
use App\Repositories\Ebook\EbookRepository;

use App\Repositories\Events\EventRepositoryInterface;
use App\Repositories\Events\EventRepository;

use Carbon\Carbon;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\Mail; // Import Mail Facade

use App\Mail\PaymentRequestMail;

class FrontController extends Controller
{
    protected $contact;
    protected $student;
    protected $ebook;
    protected $events;
    protected $trialclasss;

    public function __construct(ContactRepositoryInterface $contact,StudentRepositoryInterface $student,EBookRepositoryInterface $ebook,EventRepositoryInterface $events,TrialClassRepositoryInterface $trialclasss)
    {
        $this->contact = $contact;
        $this->student = $student;
        $this->ebook = $ebook;
        $this->events = $events;
        $this->trialclasss = $trialclasss;
    }


    public function index()
    {
        try{
            
        $plan=Plan::select('plan_master.*'
            ,DB::raw('(select category_name from category_master where category_master.category_id = plan_master.category_id limit 1) as categoryName'))->where(['isDelete'=>0])->take(6)->get();
        $batch=Batch::all();
        $category=Category::where(['isDelete'=>0])->get();
        $Testimonials=Testimonial::where('status',1)->take(4)->get();
        $gallery=Gallery::where(['type'=>2])->take(20)->get();
        $about=Page::find(1);
        $class=Page::find(2);


        return view('frontview.index',compact('category','plan','batch','Testimonials','gallery','about','class'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function about()
    {

        $gallery=Gallery::where(['type'=>1])->take(20)->get();

        return view('frontview.about',compact('gallery'));
    }
    public function class()
    {
        try{
            
        $plan = Plan::select('plan_master.*'
            ,DB::raw('(select category_name from category_master where category_master.category_id = plan_master.category_id limit 1) as categoryName')
            ,DB::raw('(select category_id from category_master where category_master.category_id = plan_master.category_id limit 1) as category_id')
            ,DB::raw('(select batch_id from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_id')
            ,DB::raw('(select batch_name from batch_master where batch_master.category_id = category_master.category_id limit 1) as batchname')
            ,DB::raw('(select batch_day from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_day')
            ,DB::raw('(select batch_from_time from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_from_time')
            ,DB::raw('(select batch_to_time from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_to_time')
        )
        ->join('category_master', 'category_master.category_id', '=', 'plan_master.category_id')->where(['plan_master.isDelete'=>0])->get();

        return view('frontview.class',compact('plan'));
    } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function class_detail($id)
    {
        try
        {
        
        $plan = Plan::select('plan_master.*'
            ,DB::raw('(select category_name from category_master where category_master.category_id = plan_master.category_id limit 1) as categoryName')
            ,DB::raw('(select category_id from category_master where category_master.category_id = plan_master.category_id limit 1) as category_id')
            ,DB::raw('(select batch_id from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_id')
            ,DB::raw('(select batch_name from batch_master where batch_master.category_id = category_master.category_id limit 1) as batchname')
            ,DB::raw('(select batch_day from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_day')
            ,DB::raw('(select batch_from_time from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_from_time')
            ,DB::raw('(select batch_to_time from batch_master where batch_master.category_id = category_master.category_id limit 1) as batch_to_time')
        )->join('category_master', 'category_master.category_id', '=', 'plan_master.category_id')->where('plan_master.planId', $id)
            ->where(['plan_master.isDelete'=>0])
        ->first();
        $batch=Batch::where('category_id',$id)->first();

        $category=Category::where(['isDelete'=>0])->where('category_id',$id)->first();

        return view('frontview.classdetail',compact('plan','category','batch'));


        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }

    public function getBatch($categoryId)
    {
        $batch = Batch::where(['isDelete'=>0])->where('category_id', $categoryId)->get();
        return response()->json($batch);
    }
    public function getPlan($categoryId)
    {
        $plan = Plan::where(['isDelete'=>0])->where('category_id', $categoryId)->get();
        return response()->json($plan);
    }
    public function getPlanAmount($planId)
    {
        $plan = Plan::where(['isDelete'=>0])->where('planId', $planId)->first();
        return response()->json($plan);
    }
  
    public function contact()
    {
        
        $plan=Plan::where(['isDelete'=>0])->get();
        $batch=Batch::where(['isDelete'=>0])->get();
        $category=Category::where(['isDelete'=>0])->get();
        return view('frontview.contact',compact('plan','batch','category'));
    }
    public function contactStore(Request $request)
    {
         $request->validate([
                'category_id' => 'required', 
                'plan_id' => 'required', 
                // 'batch_id' => 'required', 
                'student_first_name' => 'required', 
                'student_last_name' => 'required',        
                'student_age' => 'required|integer',        
                'mobile' => 'required|digits:10',        
                'email' => 'required',        
                'parent_name' => 'required',        
                'communication_mode' => 'required',        
            ], [
                'category_id.required' => 'Please select a category.',
                'plan_id.required' => 'Please select a plan.',
                // 'batch_id.required' => 'Please select a batch.',
                'student_first_name.required' => 'Student first name is required.',
                'student_last_name.required' => 'Student last name is required.',
                'student_age.required' => 'Please enter the student\'s age.',
                'student_age.integer' => 'The age must be a number.',
                'mobile.required' => 'Mobile number is required.',
                'mobile.digits' => 'Mobile number must be 10 digits.',
                'email.required' => 'Email  is required.',
                'parent_name.required' => 'Parent name is required.',
                'communication_mode.required' => 'Please select a communication mode.',
            ]);

        try
        {
            $contactsus = $this->contact->createOrUpdate($request);

            $plan=Plan::where('planId',$request->plan_id)->first();
            $category=Category::where(['category_id'=>$request->category_id])->first();
            //$batch=Batch::where(['batch_id'=>$request->batch_id])->first();


                $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 3])->first();

                    $data=array(
                            'parent_name' => $request->parent_name,
                            'amount' => $plan->plan_amount,
                        );

                    $msg = array(
                            'FromMail' => $SendEmailDetails->strFromMail,
                            'Title' => 'Kitten Art Classes',
                            'ToEmail' => $request->email,
                            'Subject' => 'Thank You For Your Registration'
                        );

                        $mail = Mail::send('emails.payment_request', ['data' => $data], function ($message) use ($msg) {
                            $message->from($msg['FromMail'], $msg['Title']);
                            $message->to($msg['ToEmail'])->subject($msg['Subject']);
                        });

                    $setting = DB::table("setting")->select('email')->first();

                    $student_name=$request->student_first_name.' '.$request->student_last_name;    

                    $data1=array(
                            'student_name'=>$student_name,
                            'student_age'=>$request->student_age,
                            'parent_name'=>$request->parent_name,
                            'mobile'=>$request->mobile,
                            'email'=>$request->email,
                            'class'=>$category->category_name,
                            'plan'=>$plan->plan_name,
                            // 'batch'=>$batch->batch_name,
                            'mode'=>$request->communication_mode
                    );

                        $adminmsg = array(
                            'FromMail' => $SendEmailDetails->strFromMail,
                            'Title' => 'Kitten Art Classes',
                            'ToEmail' => $setting->email,
                            //'ToEmail' => 'dev4.apolloinfotech@gmail.com',
                            'Subject' => 'New Student Registration.'
                        );

                        $mail = Mail::send('emails.adminmail1', ['data' => $data1], function ($message) use ($adminmsg) {
                            $message->from($adminmsg['FromMail'], $adminmsg['Title']);
                            $message->to($adminmsg['ToEmail'])->subject($adminmsg['Subject']);
                        });

           
            return redirect()->route('FrontThankyou1');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
  
    public function registration(Request $request)
    {
        try{
            
        if($request)
        {
            $categoryId=$request->category_id;
            $batchId=$request->batch_id;
            $planId=$request->plan_id;
        }        

        $plan=Plan::where(['isDelete'=>0])->get();
        $batch=Batch::where(['isDelete'=>0])->get();
        $category=Category::where(['isDelete'=>0])->get();

        return view('frontview.registration',compact('plan','batch','category','categoryId','planId','batchId'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function student_registration(Request $request)
    {
        try{
            
        /*    request()->validate([
            'captcha' => 'required|captcha'

        ],

        ['captcha.captcha'=>'Invalid captcha code.']);
*/


        $this->student->createOrUpdate($request);

            $SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 13])
                ->first();

            $category=Category::where(['category_id'=>$request->category_id])->first();
            $plan=Plan::where(['planId'=>$request->plan_id])->first();
            $batch=Batch::where(['batch_id'=>$request->batch_id])->first();


            $data=array(
                    'parent_name' => $request->parent_name,
                );

            $msg = array(
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $request->email,
                    'Subject' => 'Thank You For Your Registration'
                );

                $mail = Mail::send('emails.registration', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });
            $setting = DB::table("setting")->select('email')->first();

            $student_name=$request->student_first_name.' '.$request->student_last_name;    

                $data1=array(
                        'student_name'=>$student_name,
                        'student_age'=>$request->student_age,
                        'parent_name'=>$request->parent_name,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'class'=>$category->category_name,
                );

                $adminmsg = array(
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $setting->email,
                    'Subject' => 'New Student Registration.'
                );

                $mail = Mail::send('emails.adminmail', ['data' => $data1], function ($message) use ($adminmsg) {
                    $message->from($adminmsg['FromMail'], $adminmsg['Title']);
                    $message->to($adminmsg['ToEmail'])->subject($adminmsg['Subject']);
                });

       return redirect()->route('FrontThankyou');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
       // return redirect()->back()->with('success','Student Register Successfully');
    }
    public function trialclass_registration(Request $request)
    {
        
    
    /*        request()->validate([
            'captcha' => 'required|captcha'

        ],

        ['captcha.captcha'=>'Invalid captcha code.']);
    */
        $request->validate([
                'category_id' => 'required', 
                'student_first_name' => 'required', 
                'student_last_name' => 'required',        
                'student_age' => 'required|integer',        
                'mobile' => 'required|digits:10',        
                'email' => 'required',        
                'parent_name' => 'required',        
            ], [
                'category_id.required' => 'Please select a category.',
                'student_first_name.required' => 'Student first name is required.',
                'student_last_name.required' => 'Student last name is required.',
                'student_age.required' => 'Please enter the student\'s age.',
                'student_age.integer' => 'The age must be a number.',
                'mobile.required' => 'Mobile number is required.',
                'mobile.digits' => 'Mobile number must be 10 digits.',
                'email.required' => 'Email  is required.',
                'parent_name.required' => 'Parent name is required.',
            ]);
    try
    {

        $this->trialclasss->createOrUpdate($request);

        $category=Category::where(['category_id'=>$request->category_id])->first();


            $SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 12])
                ->first();


                $data=array(
                    'parent_name' => $request->parent_name,
                    'admin' =>1,
                );

                $msg = array(
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $request->email,
                    'Subject' => 'Thank You For Your Trial Class Registration'
                );

                $mail = Mail::send('emails.requestfortrial-email', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });
            $setting = DB::table("setting")->select('email')->first();

                $student_name=$request->student_first_name.' '.$request->student_last_name;    

                $data1=array(
                        'student_name'=>$student_name,
                        'student_age'=>$request->student_age,
                        'parent_name'=>$request->parent_name,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'class'=>$category->category_name,
                );

                $adminmsg = array(
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $setting->email,
                    'Subject' => 'New Student Registration For Free Trial Class'
                );

                $mail = Mail::send('emails.adminmail', ['data' => $data1], function ($message) use ($adminmsg) {
                    $message->from($adminmsg['FromMail'], $adminmsg['Title']);
                    $message->to($adminmsg['ToEmail'])->subject($adminmsg['Subject']);
                });

           
               return redirect()->route('FrontThankyou');

        //return redirect()->back()->with('success','Student Register For Trial Class Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function gallery()
    {
        $gallery=Gallery::where(['type'=>2])->get();
        return view('frontview.gallery',compact('gallery'));
    }
    public function trial_class()
    {
        $plan=Plan::where(['isDelete'=>0])->get();
        $batch=Batch::where(['isDelete'=>0])->get();
        $category=Category::where(['isDelete'=>0])->get();

        return view('frontview.trial_class',compact('category','plan','batch'));
    }
    public function events()
    {
        $events=Events::select('event_master.*',DB::raw('(select category_name from category_master where category_master.category_id = event_master.category_id limit 1) as categoryName'))->get();
        return view('frontview.events',compact('events'));
    }
    public function event_detail($id)
    {
        $events=Events::select('event_master.*',DB::raw('(select category_name from category_master where category_master.category_id = event_master.category_id limit 1) as categoryName'))->find($id);
         return view('frontview.event_detail',compact('events'));
    }
    public function event_calander(Request $request)
    {
           $events = Batch::select('batch_master.*',DB::raw('(SELECT category_name FROM category_master WHERE category_master.category_id = batch_master.category_id LIMIT 1) as categoryName'))->get()
        ->map(function ($event) {
            // Convert the batch_day (weekday number) to the ISO format used by FullCalendar
            $event->dayOfWeek = $event->batch_day; // Assuming batch_day stores 0 (Sunday) to 6 (Saturday)
            $event->title = $event->batch_name; // Add title for the event
            return $event;
            });

        return view('frontview.event_calander',compact('events'));
    }
    public function login(){
        return view('frontview.login');
    }
    public function blogs(){
        return view('frontview.blogs');
    }
    public function blogdetail(){
        return view('frontview.blogdetail');
    }
    
    public function ebooks()
    {
        $EBook=EBook::paginate(8);
        return view('frontview.ebooks',compact('EBook'));
    }
    public function ebook_registration(Request $request)
    {
        try{
            
        $id=$request->ebook_id;
        // Register the eBook and get the result
        $ebookRegister = $this->ebook->ebookRegister($request);

        // Assuming $ebookRegister contains the ID or data of the registered eBook
        if ($ebookRegister) {
            // Retrieve the eBook details from the database
            $ebookDetails = $this->ebook->find($id); // Adjust as per your model and logic

            if ($ebookDetails && $ebookDetails['ebook_pdf']) {
                // Generate the full path or URL to the PDF file
                $pdfPath = public_path('EBook/' . $ebookDetails['ebook_pdf']);

                // Check if the file exists
                if (file_exists($pdfPath)) {
                    return response()->file($pdfPath);
                } else {
                    return back()->with('error', 'PDF file not found.');
                }
            }
        }

        return back()->with('error', 'Failed to register.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function event_registration(Request $request)
    {
        /*request()->validate([
            'captcha' => 'required|captcha'

        ],

        ['captcha.captcha'=>'Invalid captcha code.']);
*/
         try{
              $id=session()->get('student_id');
              if(session()->get('student_id'))
              {
                  $student=Student::where(['student_id'=>$id])->first();
                $category=Category::where(['category_id'=>$student->category_id])->first();
                $plan=Plan::where(['planId'=>$student->plan_id])->first();
                $student_name=$request->student_first_name.' '.$request->student_last_name;  
                $setting = DB::table("setting")->select('email')->first();

                $data=array(
                    'student_name' => $student_name,
                    'student_age' => $request->student_age,
                    'parent_name' => $request->parent_name,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'class' => $request->class,
                    'plan' => $request->plan,
                );

                $msg = array(
                    //'FromMail' => $request->email,
                    'FromMail' => 'no-reply@kittenart.com',
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $setting->email,
                    'Subject' => 'Event Registration'
                );

                $mail = Mail::send('emails.admin_event_registration', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });

                return redirect()->route('FrontThankyou');
    
              }else{
                return redirect()->route('FrontLogin');
              }

        } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
    }
    public function services()
    {
        $service=Service::orderBy('service_id', 'DESC')->get();
        return view('frontview.service',compact('service'));
    }
    public function service_gallery($id)
    {
        try{


        $service=Service::where(['service_id'=>$id])->orderBy('service_id', 'DESC')->first();
        if($service)
        {
            $ServiceImages=ServiceImages::where(['service_id'=>$id])->orderBy('service_image_id', 'DESC')->get();
            return view('frontview.service_details',compact('ServiceImages','service'));
        }else{
     return view('errors.404');

        }

        } catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }
    }
    
    public function service_registration(Request $request)
    {

        /*try{*/

        $id=$request->service_id;
      
        $service=Service::find($id);

            $root = $_SERVER['DOCUMENT_ROOT'];
            $setting = DB::table("setting")->select('email')->first();

            $student_name=$request->student_first_name.' '.$request->student_last_name;  

            if($request->service_id != 2)
            {
                $data=array(
                    'student_name' => $student_name,
                    'student_age' => $request->student_age,
                    'parent_name' => $request->parent_name,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                );

                $msg = array(
                   // 'FromMail' => $request->email,
                    'FromMail' => 'no-reply@kittenart.com',
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $setting->email,
                    'Subject' => $service->service_name.' Registration'
                );

                $mail = Mail::send('emails.admin_service_registration', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });

            }else{

                $data=array(
                      "Name" => $request->Name,
                      "mobile" =>$request->mobile,
                      "email" => $request->email,
                      "event_date" => $request->event_date,
                      "event_time" =>  $request->event_time,
                      "event_location" => $request->event_location,
                      "occasion" => $request->occasion,
                      "painters" => $request->painters,
                      "question" => $request->question,
                );

                $msg = array(
                   // 'FromMail' => $request->email,
                    'FromMail' => 'no-reply@kittenart.com',
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $setting->email,
                    'Subject' => 'Paint Party Registration'
                );

                $mail = Mail::send('emails.paint_party_registration', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });
            }

            return redirect()->route('FrontThankyou')->with('data', [
                        'service_id' => $request->service_id,
                    'service_name' => $service->service_name,
            ]);

        /*} catch (\Exception $e) {
            // Log the exception or handle it in any other way you prefer
            return redirect()->back()->with('error', 'An error occurred while updating the student.');
        }*/
          
    }
    public function thankyou(){
        return view('frontview.thankyou');
    }
    public function thankyou1(){
        return view('frontview.thankyou1');
    }
     public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    

}

