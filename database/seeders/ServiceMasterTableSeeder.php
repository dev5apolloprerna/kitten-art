<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_master')->delete();
        
        \DB::table('service_master')->insert(array (
            0 => 
            array (
                'service_id' => 1,
                'service_name' => 'summer camp',
                'image' => '1736421513.jpg',
                'description' => '<p>Summer camp is a specially crafted program designed for children and teenagers during their summer vacation holidays as they come together and have fun while learning lifelong lessons. It generally involves various outdoor activities, games, sports, music, arts &amp; crafts, and educational programs among other activities that aim to impart new skills and foster personal growth in children. Summer camps are usually organised by schools, churches, community centers, and other organisations.<br />
&nbsp;</p>',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2024-12-30 09:00:16',
                'updated_at' => '2025-01-09 11:18:33',
            ),
        ));
        
        
    }
}