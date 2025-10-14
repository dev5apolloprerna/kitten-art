<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InquiryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('inquiry')->delete();
        
        
        
    }
}