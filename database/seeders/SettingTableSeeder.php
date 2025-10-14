<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('setting')->delete();
        
        \DB::table('setting')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sitename' => 'Kitten Art Class',
                'logo' => NULL,
                'email' => 'kittenart15@gmail.com',
                'api_key' => 'test',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2024-07-11 10:50:17',
                'updated_at' => NULL,
                'strIP' => '103.1.100.226',
            ),
        ));
        
        
    }
}