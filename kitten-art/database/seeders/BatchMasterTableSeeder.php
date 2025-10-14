<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BatchMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('batch_master')->delete();
        
        \DB::table('batch_master')->insert(array (
            0 => 
            array (
                'batch_id' => 11,
                'category_id' => 1,
                'batch_name' => 'Little Kitten 5-8 Tuesday',
                'batch_day' => '2',
                'batch_from_time' => '17:30:00',
                'batch_to_time' => '18:30:00',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-16 13:24:45',
                'updated_at' => '2025-01-16 13:24:45',
            ),
            1 => 
            array (
                'batch_id' => 17,
                'category_id' => 1,
                'batch_name' => 'Little Kitten',
                'batch_day' => '1',
                'batch_from_time' => '17:30:00',
                'batch_to_time' => '18:30:00',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-02-10 13:16:04',
                'updated_at' => '2025-02-10 13:16:04',
            ),
            2 => 
            array (
                'batch_id' => 12,
                'category_id' => 1,
                'batch_name' => 'Little Kitten 5-8 Friday',
                'batch_day' => '5',
                'batch_from_time' => '17:30:00',
                'batch_to_time' => '18:30:00',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-16 13:25:07',
                'updated_at' => '2025-01-16 13:25:07',
            ),
            3 => 
            array (
                'batch_id' => 13,
                'category_id' => 1,
                'batch_name' => 'young Kittens 5-8 Saturday',
                'batch_day' => '6',
                'batch_from_time' => '10:00:00',
                'batch_to_time' => '11:00:00',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-16 13:25:28',
                'updated_at' => '2025-01-20 05:26:07',
            ),
            4 => 
            array (
                'batch_id' => 15,
                'category_id' => 8,
                'batch_name' => 'Smart Kiddo\'s',
                'batch_day' => '3',
                'batch_from_time' => '10:00:00',
                'batch_to_time' => '11:00:00',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-22 04:58:13',
                'updated_at' => '2025-01-22 04:58:13',
            ),
            5 => 
            array (
                'batch_id' => 16,
                'category_id' => 8,
                'batch_name' => 'Smart kiddo',
                'batch_day' => '4',
                'batch_from_time' => '17:30:00',
                'batch_to_time' => '19:00:00',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-02-10 13:14:03',
                'updated_at' => '2025-02-10 13:14:03',
            ),
        ));
        
        
    }
}