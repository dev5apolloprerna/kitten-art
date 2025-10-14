<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('category_master')->delete();
        
        \DB::table('category_master')->insert(array (
            0 => 
            array (
                'category_id' => 1,
                'category_name' => '5-8 year',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2024-12-23 09:16:06',
                'updated_at' => '2024-12-23 09:16:06',
            ),
            1 => 
            array (
                'category_id' => 8,
                'category_name' => '9-14 year',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-21 05:34:36',
                'updated_at' => '2025-02-27 06:53:49',
            ),
            2 => 
            array (
                'category_id' => 14,
                'category_name' => '14-20 years',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-02-28 07:27:09',
                'updated_at' => '2025-02-28 07:27:20',
            ),
            3 => 
            array (
                'category_id' => 15,
                'category_name' => 'ww',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-03-03 08:34:07',
                'updated_at' => '2025-03-03 08:34:34',
            ),
            4 => 
            array (
                'category_id' => 16,
                'category_name' => '15-18 year',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-03-05 06:26:44',
                'updated_at' => '2025-03-05 06:36:26',
            ),
            5 => 
            array (
                'category_id' => 17,
                'category_name' => '15-18 years',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-03-05 06:36:45',
                'updated_at' => '2025-03-05 06:36:55',
            ),
            6 => 
            array (
                'category_id' => 18,
                'category_name' => '15 -18 year',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-03-06 05:34:58',
                'updated_at' => '2025-03-06 05:38:59',
            ),
        ));
        
        
    }
}