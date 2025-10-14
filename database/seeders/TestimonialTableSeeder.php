<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestimonialTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('testimonial')->delete();
        
        \DB::table('testimonial')->insert(array (
            0 => 
            array (
                'testimonial_id' => 1,
                'parent_name' => 'Mrs. Patel',
                'parent_photo' => '1737112866_678a3d22ca759.png',
                'student_name' => 'Bansari',
                'student_photo' => '1737112866_678a3d22ca563.png',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non ex sit amet quam maximus condimentum. Nam consectetur tortor in placerat efficitur. Vivamus aliquam lorem magna, vel volutpat metus blandit ac. Sed ac nisl egestas, tincidunt risus at, commodo lectus. Duis vel nisl a eros malesuada imperdiet aliquet tempus libero. Quisque mollis diam nec risus mollis, in cursus odio semper. Aliquam ultrices sit amet odio eu cursus. Quisque interdum est nisl, quis tempus orci finibus quis. Fusce sit amet metus ut lorem porta pretium quis sed risus. Phasellus tincidunt finibus nisl. Pellentesque a nibh ullamcorper eros ultricies pretium.</p>

<p>Aenean semper volutpat eros. Proin aliquet ipsum mattis leo ornare, quis commodo nisi pharetra. Vestibulum sagittis, tortor in maximus molestie, turpis diam convallis nulla, at pharetra arcu lectus a velit. Praesent et tortor tincidunt, placerat justo ac, egestas ex. Aenean eget sagittis erat, a porta tortor. Aliquam sit amet nunc eget nunc vulputate vehicula. Proin ut blandit tortor, luctus maximus mauris. Etiam non neque eget ante ornare maximus nec eget ante. Phasellus placerat lorem id elementum auctor. Curabitur eget elementum risus. Integer ut scelerisque turpis. Integer imperdiet nisi in augue eleifend ultricies. Fusce pulvinar egestas accumsan.</p>',
                'status' => 0,
            ),
            1 => 
            array (
                'testimonial_id' => 2,
                'parent_name' => 'Mrs. Prajapati',
                'parent_photo' => '1738220368_679b2350e8b6c.png',
                'student_name' => 'Nidhi',
                'student_photo' => '1738220368_679b2350e88a7.png',
                'description' => 'test test',
                'status' => 0,
            ),
        ));
        
        
    }
}