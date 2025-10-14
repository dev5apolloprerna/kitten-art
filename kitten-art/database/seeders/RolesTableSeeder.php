<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2022-09-12 10:03:06',
                'updated_at' => '2022-09-12 10:03:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'User',
                'guard_name' => 'web',
                'created_at' => '2022-09-12 10:03:06',
                'updated_at' => '2022-09-12 10:03:06',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Reseller',
                'guard_name' => 'web',
                'created_at' => '2022-09-12 10:03:06',
                'updated_at' => '2022-09-12 10:03:06',
            ),
        ));
        
        
    }
}