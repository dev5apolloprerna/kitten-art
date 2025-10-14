<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SendemaildetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sendemaildetails')->delete();
        
        \DB::table('sendemaildetails')->insert(array (
            0 => 
            array (
                'id' => 1,
                'strSubject' => 'Login Otp',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => '',
                'strBCC' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'strSubject' => 'Forget Password',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'strSubject' => 'Payment Request',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'strSubject' => 'Payment Confirmation',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            4 => 
            array (
                'id' => 11,
                'strSubject' => 'Contact Us',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            5 => 
            array (
                'id' => 12,
                'strSubject' => 'Trial Class Registration',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            6 => 
            array (
                'id' => 13,
                'strSubject' => 'Registration',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            7 => 
            array (
                'id' => 14,
                'strSubject' => 'Renew Subscription',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            8 => 
            array (
                'id' => 15,
                'strSubject' => 'Trial Class Schedule',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
            9 => 
            array (
                'id' => 16,
                'strSubject' => 'Cancel Subscription',
                'strTitle' => 'Kitten Art Class',
                'strFromMail' => 'no-reply@kittenart.com',
                'ToMail' => NULL,
                'strCC' => NULL,
                'strBCC' => NULL,
            ),
        ));
        
        
    }
}