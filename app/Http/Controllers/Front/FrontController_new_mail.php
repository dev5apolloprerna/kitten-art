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
            ,DB::raw('(select category_name from category_master where category_master.category_id = plan_master.category_id limit 1) as categoryName'))->take(6)->get();
        $batch=Batch::all();
        $category=Category::all();
        $Testimonials=Testimonial::where('status',1)->take(4)->get();
        $gallery=Gallery::where(['type'=>2])->take(6)->get();
        $about=Page::find(1);
        $class=Page::find(2);


        return view('frontview.index',compact('category','plan','batch','Testimonials','gallery','about','class'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function about()
    {

        $gallery=Gallery::where(['type'=>1])->take(6)->get();

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
        )->join('category_master', 'category_master.category_id', '=', 'plan_master.category_id')->get();

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
        )->join('category_master', 'category_master.category_id', '=', 'plan_master.category_id')->where('plan_master.planId', $id)->first();
        $batch=Batch::where('category_id',$id)->first();

        $category=Category::where('category_id',$id)->first();

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
        
        $plan=Plan::all();
        $batch=Batch::all();
        $category=Category::all();
        return view('frontview.contact',compact('plan','batch','category'));
    }
    public function contactStore(Request $request)
    {
        try
        {
            
          /*  request()->validate([
            'captcha' => 'required|captcha'

        ],

        ['captcha.captcha'=>'Invalid captcha code.']);

            */
        $contactsus = $this->contact->createOrUpdate($request);
        
        
                $plan = Plan::where('planId', $request->plan_id)->first();

            // Fetch email sender details
            $SendEmailDetails = DB::table('sendemaildetails')->where('id', 3)->first();
            $setting = DB::table('setting')->select('email')->first();

            // Set email parameters
            $toMail = $request->email;
            $fromEmail = $SendEmailDetails->strFromMail ?? config('mail.from.address');
            $fromName = "Kitten Art Classes";

            // Send email using Laravel Mailable
            Mail::to($toMail)
                //->cc('shahkrunal83@gmail.com') // Add CC if required
                ->send(new PaymentRequestMail($request->parent_name, $plan->plan_amount, 'website', $fromEmail, $fromName));




            /*$SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 11])
                ->first();

            $root = $_SERVER['DOCUMENT_ROOT'];
            $file = file_get_contents(public_path('mailers/contact_us.html'));
            //$file = file_get_contents($root . '/mailers/contact_us.html', 'r');
            $file = str_replace('#titleparent_name', $request->parent_name, $file);
            $setting = DB::table("setting")->select('email')->first();
                       
            $toMail = $setting->email; // "shahkrunal83@gmail.com";//

            $to = $request->email;
            $subject = $SendEmailDetails->strSubject;
            $message = $file;
            $header = "From:" . $SendEmailDetails->strFromMail . "\r\n";
            $header .= "Cc:shahkrunal83@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail($to, $subject, $message, $header);*/



            $category=Category::where(['category_id'=>$request->category_id])->first();
            $plan=Plan::where(['planId'=>$request->plan_id])->first();
            $batch=Batch::where(['batch_id'=>$request->batch_id])->first();

            $student_name=$request->student_first_name.' '.$request->student_last_name;    

            $file1 = file_get_contents(public_path('mailers/adminmail1.html'));
            $file1 = str_replace('#student_name', $student_name, $file1);
            $file1 = str_replace('#student_age', $request->student_age, $file1);
            $file1 = str_replace('#parent_name', $request->parent_name, $file1);
            $file1 = str_replace('#mobile', $request->mobile, $file1);
            $file1 = str_replace('#email', $request->email, $file1);
            $file1 = str_replace('#class', $category->category_name, $file1);
            $file1 = str_replace('#plan', $plan->plan_name, $file1);
            $file1 = str_replace('#batch', $batch->batch_name, $file1);
            $file1 = str_replace('#mode', $request, $file1);
            
            $to1 = $setting->email;
            $message1 = $file1;
            $subject1="New Student Registration.";
            $fromName = "Kitten Art Classes";
            $fromEmail = $SendEmailDetails->strFromMail; // Ensure this contains a valid email

            $header = "From: $fromName <$fromEmail>\r\n"; // Proper format
            //$header .= "Cc:shahkrunal83@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

           // $retval1 = mail($to1, $subject1, $message1, $header);


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

        $plan=Plan::all();
        $batch=Batch::all();
        $category=Category::all();

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
            
            $root = $_SERVER['DOCUMENT_ROOT'];
            $file = file_get_contents(public_path('mailers/registration.html'));
            $file = str_replace('#titleparent_name', $request->parent_name, $file);

            $setting = DB::table("setting")->select('email')->first();
            $toMail = $setting->email; // "shahkrunal83@gmail.com";//

            $to = $request->email;
            $subject = $SendEmailDetails->strSubject;
            $message = $file;
            $fromName = "Kitten Art Classes";
            $fromEmail = $SendEmailDetails->strFromMail; // Ensure this contains a valid email

            $header = "From: $fromName <$fromEmail>\r\n"; // Proper format
           
            $header .= "Cc:shahkrunal83@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            //$header .= "Content-type: text/html\r\n";
			$header .= "Content-type: image/jpeg\r\n";
            $retval = mail($to, $subject, $message, $header);

            $student_name=$request->student_first_name.' '.$request->student_last_name;    
            $file1 = file_get_contents(public_path('mailers/adminmail.html'));
            $file1 = str_replace('#student_name', $student_name, $file1);
            $file1 = str_replace('#student_age', $request->student_age, $file1);
            $file1 = str_replace('#parent_name', $request->parent_name, $file1);
            $file1 = str_replace('#mobile', $request->mobile, $file1);
            $file1 = str_replace('#email', $request->email, $file1);
            $file1 = str_replace('#class', $category->category_name, $file1);
            $file1 = str_replace('#plan', $plan->plan_name, $file1);
            $file1 = str_replace('#batch', $batch->batch_name, $file1);
            $file1 = str_replace('#mode', $request, $file1);


            $to1 = $toMail;
            $message1 = $file1;
            $subject1="New Student Registration Notification";
            $message = $file1;
            $retval1 = mail($to1, $subject1, $message1, $header);

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
    try
    {

        $this->trialclasss->createOrUpdate($request);

        $category=Category::where(['category_id'=>$request->category_id])->first();


            $SendEmailDetails = DB::table('sendemaildetails')
                ->where(['id' => 12])
                ->first();

            $root = $_SERVER['DOCUMENT_ROOT'];
            $file = file_get_contents(public_path('mailers/requestfortrial-email.html'));
            $file = str_replace('#parent_name', $request->parent_name, $file);
            $setting = DB::table("setting")->select('email')->first();
            $toMail = $setting->email; // "shahkrunal83@gmail.com";//

            $to = $request->email;
            $subject = 'Thank You For Your Trial Class Registration';
            $message = $file;
            $fromName = "Kitten Art Classes";
            $fromEmail = $SendEmailDetails->strFromMail; // Ensure this contains a valid email

            $header = "From: $fromName <$fromEmail>\r\n"; // Proper format
         
            $header .= "Cc:shahkrunal83@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail($to, $subject, $message, $header);

            $student_name=$request->student_first_name.' '.$request->student_last_name;            

            $file1 = file_get_contents(public_path('mailers/adminmail.html'));
            $file1 = str_replace('#student_name', $student_name, $file1);
            $file1 = str_replace('#student_age', $request->student_age, $file1);
            $file1 = str_replace('#parent_name', $request->parent_name, $file1);
            $file1 = str_replace('#mobile', $request->mobile, $file1);
            $file1 = str_replace('#email', $request->email, $file1);
            $file1 = str_replace('#class', $category->category_name, $file1);
            
            $to1 = $toMail;
            $message1 = $file1;
            $subject1="New Student Registration For Trial Class";
            $retval1 = mail($to1, $subject1, $message1, $header);

               return redirect()->route('FrontThankyou');

        //return redirect()->back()->with('success','Student Register For Trial Class Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }
    public function gallery()
    {
        $gallery=Gallery::all();
        return view('frontview.gallery',compact('gallery'));
    }
    public function trial_class()
    {
        $plan=Plan::all();
        $batch=Batch::all();
        $category=Category::all();

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

                $root = $_SERVER['DOCUMENT_ROOT'];
                $setting = DB::table("setting")->select('email')->first();
                $file = file_get_contents(public_path('admin_event_registration.html'));
                $file = str_replace('#student_name', $student_name, $file);
                $file = str_replace('#student_age', $request->student_age, $file);
                $file = str_replace('#parent_name', $request->parent_name, $file);
                $file = str_replace('#mobile', $request->mobile, $file);
                $file = str_replace('#email', $request->email, $file);
                $file = str_replace('#class', $category->category_name, $file);
                $file = str_replace('#plan', $plan->plan_name, $file);
                
                $to = $setting->email;
                $subject = 'Event Registration';
                $message = $file;
                $header = "From:" . $request->email . "\r\n";
                //$header .= "Cc:afgh@somedomain.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
    
                $retval = mail($to, $subject, $message, $header);
                   
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
        $service=Service::where(['service_id'=>$id])->orderBy('service_id', 'DESC')->first();

        $ServiceImages=ServiceImages::where(['service_id'=>$id])->orderBy('service_image_id', 'DESC')->get();
        return view('frontview.service_details',compact('ServiceImages','service'));
    }
    
    public function service_registration(Request $request)
    {
/*        request()->validate([
            'captcha' => 'required|captcha'

        ],

        ['captcha.captcha'=>'Invalid captcha code.']);

*/
        $id=$request->service_id;
      
      $service=Service::find($id);

            $root = $_SERVER['DOCUMENT_ROOT'];
            $setting = DB::table("setting")->select('email')->first();

            $student_name=$request->student_first_name.' '.$request->student_last_name;  

            $file = file_get_contents(public_path('admin_service_registration.html'));
            $file = str_replace('#student_name', $student_name, $file);
            $file = str_replace('#student_age', $request->student_age, $file);
            $file = str_replace('#parent_name', $request->parent_name, $file);
            $file = str_replace('#mobile', $request->mobile, $file);
            $file = str_replace('#email', $request->email, $file);
            
            $to = $setting->email;
            $subject = $service->service_name.'  Registration';
    
            $message = $file;
            $header = "From:" . $request->email . "\r\n";
            //$header .= "Cc:afgh@somedomain.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail($to, $subject, $message, $header);
               
            return redirect()->route('FrontThankyou');

          
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

