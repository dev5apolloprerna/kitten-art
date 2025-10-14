<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_images')->delete();
        
        \DB::table('service_images')->insert(array (
            0 => 
            array (
                'service_image_id' => 6,
                'service_id' => 1,
                'image' => '1738310627_swee-768x493.png',
            ),
            1 => 
            array (
                'service_image_id' => 7,
                'service_id' => 1,
            'image' => '1738322837_images (12).jpeg',
            ),
            2 => 
            array (
                'service_image_id' => 8,
                'service_id' => 1,
                'image' => '1738322837_f05b43fbaae09fd8bfd7450f28fa8aff.jpg',
            ),
            3 => 
            array (
                'service_image_id' => 10,
                'service_id' => 1,
            'image' => '1738322837_images (11).jpeg',
            ),
            4 => 
            array (
                'service_image_id' => 11,
                'service_id' => 1,
            'image' => '1738322837_images (10).jpeg',
            ),
            5 => 
            array (
                'service_image_id' => 12,
                'service_id' => 1,
            'image' => '1738322837_images (9).jpeg',
            ),
            6 => 
            array (
                'service_image_id' => 13,
                'service_id' => 1,
                'image' => '1738322837_1736329356.jpeg',
            ),
        ));
        
        
    }
}