<?php



namespace App\Http\Controllers\Front;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Models\Student;

use Session;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;



use Mail;



class StudentLoginController extends Controller

{

    

    public function studentlogin(Request $request)

    {



                $request->validate([

            'loginId' => 'required|string',

            'password' => 'required|string',

        ]);



        // Retrieve credentials

        $credentials = [

            'login_id' => $request->loginId,

            'password' => $request->password,

        ];



        // Check if the user exists

        $user = Student::where('login_id', $request->loginId)->first();



        if ($user) 

        {

            // Attempt authentication

            if (Auth::guard('student')->attempt($credentials)) 

            {



                $user=Student::select('student_first_name','student_last_name','student_id','email','mobile')->where(['student_id'=>$user->student_id,'isWaiting'=>0,'isRegister'=>1,'isPaid'=>1,'iStatus'=>1])->first();
                if(!empty($user))

                {
                    $studentname=$user->student_first_name.''.$user->student_last_name;

                    $request->session()->put('student_id', $user->student_id);

                    $request->session()->put('student_name',$studentname);

                    $request->session()->put('email',$user->email);

                    $request->session()->put('mobile',$user->mobile);

                    $request->session()->put('student_role_id','2');

                }else 

                {

                    

                    return redirect()->back()->with('error', 'Student Not Found');

                }

                

                return redirect()->route('student_profile');

                

            } else 

            {

                

                return redirect()

                    ->back()

                    ->with('error', 'Invalid password');

            }

        } else {



            return redirect()

                ->back()

                ->with('error', 'No Student account found with this login ID.');

        }

    }



    public function studentlogout(Request $request)

    {

        Auth::logout();

        $request->session()->forget('student_id');

        $request->session()->forget('email');

        $request->session()->forget('student_name');

        $request->session()->forget('mobile');

        $request->session()->forget('student_role_id');

                

        return redirect()->route('FrontLogin');

    }

     public function forgotpassword(Request $request)

    {

        return view('frontview.forgotpassword');

    }





    //send mail for new pass

    public function forgotpasswordsubmit(Request $request)

    {

        try{

        $Student = Student::where(['email' => $request->email, 'iStatus' => 1, 'isDelete' => 0])->first();



        if (!empty($Student)) {

            $token = Str::random(64);

            $data = array(

                'email' => $request->email,

                'fetch' => $Student,

                'token' => $token,

            );



            $update = Student::where(['iStatus' => 1, 'isDelete' => 0, 'student_id' => $Student->student_id])
                ->update([
                    'token' => $token,
                    'token_time' => date('Y-m-d H:i:s'),
                ]);

                $SendEmailDetails = DB::table('sendemaildetails')->where(['id' => 2])->first();

            $data=array(
                    'parent_name' => $Student->parent_name,
                    'email' => 'https://kittenart.com/newkittenart/New-Password/' . $token,
                );

                $msg = array(
                    'FromMail' => $SendEmailDetails->strFromMail,
                    'Title' => 'Kitten Art Classes',
                    'ToEmail' => $Student->email,
                    'Subject' => $SendEmailDetails->strSubject
                );

                $mail = Mail::send('emails.forgetpassword', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });

           
            return back()->with('success', 'We have emailed your password reset link!');

        } else {

            return back()->with('error', 'Email Is Not Registered');

        }

        

        

    } catch (\Exception $e) {



        report($e);

 

        return false;

    }

    }



    public function newpassword(Request $request, $token)

    {

        $tokenData = Student::select('token_time')->where(['token' => $token])->first();

        

        if (!$tokenData) {

            return redirect()->back()->with('error','Invalid token');

        }

        

        $storedTime = strtotime($tokenData->token_time);

        $currentTime = time();

        $timeDifference = ($currentTime - $storedTime) / 60; // Convert to minutes

        

        if ($timeDifference >= 30) 

        {

            return redirect()->route('forgotpassword')->with('error' , 'The link for set new password has expired.');

        }

    

        return view('frontview.newpassword', ['token' => $token]);

    }



    public function newpasswordsubmit(Request $request)

    {

        

          $validatedData = $request->validate([

                'newpassword' => 'required|min:6',

                'confirmpassword' => 'required|min:6'

            ], [

                'newpassword.required' => 'The New Password is required',

                'confirmpassword.required' => 'The Confirm Password is required'

            ]);

             try{

        $newpassword = $request->newpassword;

        $confirmpassword = $request->confirmpassword;



        $Student = Student::where(['token' => $request->token, 'iStatus' => 1, 'isDelete' => 0])->first();

        // dd($Customer);



        if ($Student->token == $request->token) {

            if ($newpassword == $confirmpassword) 

            {

                 Student::where(['iStatus' => 1, 'student_id' => $Student->student_id])

                        ->update([

                            'password' => Hash::make($request->confirmpassword),

                        ]);

                        

                return redirect()->route('FrontLogin')->with('success', 'Your password has been successfully changed!');

            } else {

                return back()->with('error', 'Password And Confirm Password Does Not Match.');

            }

        } else {

            return back()->with('error', 'Token Not Match.');

        }

        

        

    } catch (\Exception $e) {



        report($e);

 

        return false;

    }

    }

 public function changepassword(Request $request)

    {
        $id=session()->get('student_id');

          if(session()->get('student_id'))

          {

                return view('frontview.changepassword'); 
        }else{

           return redirect()->route('FrontLogin');

          }
    }

    public function changepasswordsubmit(Request $request)

    {
        $id=session()->get('student_id');

          if(session()->get('student_id'))

          {
        $validatedData = $request->validate([

                'newpassword' => 'required|min:6',

                'confirmpassword' => 'required|min:6'

            ], [

                'newpassword.required' => 'The New Password is required',

                'confirmpassword.required' => 'The Confirm Password is required'

            ]);



        try{

         $session = $request->session()->get('student_id');

        $current_password=$request->current_password;

        $newpassword = $request->newpassword;

        $confirmpassword = $request->confirmpassword;



        $student=Student::where(['student_id'=>$session])->first();



        // The passwords matches

        if (!Hash::check($current_password, $student->password))

        {

            return back()->with('error', "Current Password is Invalid");

        }

        if ($newpassword == $confirmpassword) 

        {

            $User = DB::table('student_master')

                ->where(['iStatus' => 1, 'student_id' => $student->student_id])

                ->update([

                    'password' => Hash::make($confirmpassword),

                ]);

                

            

            $request->session()->forget('student_id');

            $request->session()->forget('student_name');

            $request->session()->forget('email');

            $request->session()->forget('mobile');

            $request->session()->forget('student_role_id');

            

          return redirect()->route('FrontLogin')->with('success', 'Change Password Successfully!');

            // return back()->with('success', 'Change Password Successfully!');

        } else {

            return back()->with('error', 'Password And Confirm Password Not Match!');

        }

        

        

    } catch (\Exception $e) {



        report($e);

 

        return false;

    }   
    }else{
           return redirect()->route('FrontLogin');

          }
    }



}

