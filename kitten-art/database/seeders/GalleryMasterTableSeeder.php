<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GalleryMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('gallery_master')->delete();
        
        \DB::table('gallery_master')->insert(array (
            0 => 
            array (
                'gallery_id' => 2,
                'image' => '1736334382.png',
                'type' => 2,
                'comment' => '',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2024-12-24 08:19:20',
                'updated_at' => '2025-01-27 09:39:02',
            ),
            1 => 
            array (
                'gallery_id' => 3,
                'image' => '1736334369.jpg',
                'type' => 1,
                'comment' => 'Lorem Ipsum is simply dummy text of the printing a',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2024-12-24 08:51:15',
                'updated_at' => '2025-01-27 09:38:53',
            ),
            2 => 
            array (
                'gallery_id' => 6,
                'image' => '1736334397.jpg',
                'type' => 1,
                'comment' => '',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-08 11:06:37',
                'updated_at' => '2025-01-27 09:38:47',
            ),
            3 => 
            array (
                'gallery_id' => 7,
                'image' => '1736334407.jpg',
                'type' => 1,
                'comment' => '',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-08 11:06:47',
                'updated_at' => '2025-01-27 09:38:42',
            ),
            4 => 
            array (
                'gallery_id' => 14,
                'image' => '1737436106.jpeg',
                'type' => 2,
                'comment' => '',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-21 05:08:26',
                'updated_at' => '2025-01-27 09:37:41',
            ),
            5 => 
            array (
                'gallery_id' => 15,
                'image' => '1737436112.jpeg',
                'type' => 2,
                'comment' => '',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-21 05:08:32',
                'updated_at' => '2025-01-27 09:37:35',
            ),
            6 => 
            array (
                'gallery_id' => 13,
                'image' => '1737436096.jpeg',
                'type' => 2,
                'comment' => '',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-21 05:08:16',
                'updated_at' => '2025-01-27 09:38:37',
            ),
            7 => 
            array (
                'gallery_id' => 16,
                'image' => '1737436484.webp',
                'type' => 1,
                'comment' => '',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-21 05:14:44',
                'updated_at' => '2025-01-27 09:37:29',
            ),
            8 => 
            array (
                'gallery_id' => 21,
                'image' => '1741259661.jpg',
                'type' => 1,
                'comment' => 'test',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-03-06 06:14:21',
                'updated_at' => '2025-03-06 06:14:21',
            ),
        ));
        
        
    }
}