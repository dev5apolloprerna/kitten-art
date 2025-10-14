<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentRenewPlanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_renew_plan')->delete();
        
        \DB::table('student_renew_plan')->insert(array (
            0 => 
            array (
                'renewplan_id' => 2,
                'student_id' => 2,
                'category_id' => 1,
                'plan_id' => 10,
                'batch_id' => 11,
                'amount' => '250.00',
                'plan_session' => 24,
                'status' => '0',
            ),
        ));
        
        
    }
}