<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HomePageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('home_page')->delete();
        
        \DB::table('home_page')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'about us',
                'description' => 'Creating art can be beneficial throughout all stages of a kid’s life. Our goal is to help kids to develop regular creative habits with tips and techniques that will make their drawing skills stronger. Learn under the guidance of professional artists and bring your creativity to life with us.
',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Art Classes',
                'description' => 'Kitten art classes help kids to develop their motor skills, improve their confidence, develop more focus & improve memory. We have created weekly, unique art classes for kids ages 5-14 to keep your child entertained & creative. It will help them to keep away from screens. Kids will learn something new & innovative in our classes.

',
            ),
        ));
        
        
    }
}