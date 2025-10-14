<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'mobile_number' => '9028187696',
                'email_verified_at' => NULL,
                'password' => '$2y$10$sQ98BbFv7oQ5lwY5B08L3emU7rHN.oAG8i3S9mnj6A3HetOdkve/C',
                'role_id' => 1,
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2022-09-12 10:03:06',
                'updated_at' => '2025-03-04 11:24:02',
            ),
        ));
        
        
    }
}