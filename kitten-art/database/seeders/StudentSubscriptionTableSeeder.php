<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentSubscriptionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_subscription')->delete();
        
        \DB::table('student_subscription')->insert(array (
            0 => 
            array (
                'subscription_id' => 1,
                'student_id' => 2,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-01-16',
                'expired_date' => '2025-01-16',
                'created_at' => '2025-01-16 13:32:18',
                'updated_at' => '2025-01-16 13:32:18',
            ),
            1 => 
            array (
                'subscription_id' => 2,
                'student_id' => 5,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-01-20',
                'expired_date' => '2025-01-20',
                'created_at' => '2025-01-20 12:48:39',
                'updated_at' => '2025-01-20 12:48:39',
            ),
            2 => 
            array (
                'subscription_id' => 3,
                'student_id' => 9,
                'plan_id' => 14,
                'amount' => 250,
                'activate_date' => '2025-01-21',
                'expired_date' => '2025-01-21',
                'created_at' => '2025-01-21 15:33:53',
                'updated_at' => '2025-01-21 15:33:53',
            ),
            3 => 
            array (
                'subscription_id' => 4,
                'student_id' => 10,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-01-22',
                'expired_date' => '2025-01-22',
                'created_at' => '2025-01-22 04:51:41',
                'updated_at' => '2025-01-22 04:51:41',
            ),
            4 => 
            array (
                'subscription_id' => 5,
                'student_id' => 11,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-01-23',
                'expired_date' => '2025-01-23',
                'created_at' => '2025-01-23 10:40:24',
                'updated_at' => '2025-01-23 10:40:24',
            ),
            5 => 
            array (
                'subscription_id' => 6,
                'student_id' => 10,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-01-27',
                'expired_date' => '2025-01-27',
                'created_at' => '2025-01-27 10:42:37',
                'updated_at' => '2025-01-27 10:42:37',
            ),
            6 => 
            array (
                'subscription_id' => 7,
                'student_id' => 12,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-01-28',
                'expired_date' => '2025-01-28',
                'created_at' => '2025-01-28 06:01:44',
                'updated_at' => '2025-01-28 06:01:44',
            ),
            7 => 
            array (
                'subscription_id' => 8,
                'student_id' => 11,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-01-31',
                'expired_date' => '2025-01-31',
                'created_at' => '2025-01-31 09:42:41',
                'updated_at' => '2025-01-31 09:42:41',
            ),
            8 => 
            array (
                'subscription_id' => 9,
                'student_id' => 13,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-01-31',
                'expired_date' => '2025-02-01',
                'created_at' => '2025-02-01 16:12:03',
                'updated_at' => '2025-02-01 16:12:03',
            ),
            9 => 
            array (
                'subscription_id' => 10,
                'student_id' => 13,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-02-01',
                'expired_date' => '2025-02-01',
                'created_at' => '2025-02-01 16:24:41',
                'updated_at' => '2025-02-01 16:24:41',
            ),
            10 => 
            array (
                'subscription_id' => 11,
                'student_id' => 14,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-02-03',
                'expired_date' => '2025-02-03',
                'created_at' => '2025-02-03 06:55:56',
                'updated_at' => '2025-02-03 06:55:56',
            ),
            11 => 
            array (
                'subscription_id' => 12,
                'student_id' => 5,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-02-05',
                'expired_date' => '2025-02-05',
                'created_at' => '2025-02-05 09:44:00',
                'updated_at' => '2025-02-05 09:44:00',
            ),
            12 => 
            array (
                'subscription_id' => 13,
                'student_id' => 15,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-02-07',
                'expired_date' => '2025-02-07',
                'created_at' => '2025-02-07 00:59:48',
                'updated_at' => '2025-02-07 00:59:48',
            ),
            13 => 
            array (
                'subscription_id' => 14,
                'student_id' => 16,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-02-18',
                'expired_date' => '2025-02-18',
                'created_at' => '2025-02-18 04:30:27',
                'updated_at' => '2025-02-18 04:30:27',
            ),
            14 => 
            array (
                'subscription_id' => 15,
                'student_id' => 18,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-02-19',
                'expired_date' => '2025-02-19',
                'created_at' => '2025-02-19 09:50:56',
                'updated_at' => '2025-02-19 09:50:56',
            ),
            15 => 
            array (
                'subscription_id' => 16,
                'student_id' => 19,
                'plan_id' => 22,
                'amount' => 250,
                'activate_date' => '2025-02-19',
                'expired_date' => '2025-02-19',
                'created_at' => '2025-02-19 10:35:33',
                'updated_at' => '2025-02-19 10:35:33',
            ),
            16 => 
            array (
                'subscription_id' => 17,
                'student_id' => 20,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-02-20',
                'expired_date' => '2025-02-20',
                'created_at' => '2025-02-20 06:06:16',
                'updated_at' => '2025-02-20 06:06:16',
            ),
            17 => 
            array (
                'subscription_id' => 18,
                'student_id' => 23,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-02-24',
                'expired_date' => '2025-02-24',
                'created_at' => '2025-02-24 11:13:59',
                'updated_at' => '2025-02-24 11:13:59',
            ),
            18 => 
            array (
                'subscription_id' => 19,
                'student_id' => 23,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-02-24',
                'expired_date' => '2025-02-24',
                'created_at' => '2025-02-24 11:14:02',
                'updated_at' => '2025-02-24 11:14:02',
            ),
            19 => 
            array (
                'subscription_id' => 20,
                'student_id' => 23,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-02-24',
                'expired_date' => '2025-02-24',
                'created_at' => '2025-02-24 11:14:10',
                'updated_at' => '2025-02-24 11:14:10',
            ),
            20 => 
            array (
                'subscription_id' => 21,
                'student_id' => 25,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-02-26',
                'expired_date' => '2025-02-26',
                'created_at' => '2025-02-26 08:22:37',
                'updated_at' => '2025-02-26 08:22:37',
            ),
            21 => 
            array (
                'subscription_id' => 23,
                'student_id' => 26,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-02-26',
                'expired_date' => '2025-02-26',
                'created_at' => '2025-02-26 11:21:13',
                'updated_at' => '2025-02-26 11:21:13',
            ),
            22 => 
            array (
                'subscription_id' => 24,
                'student_id' => 27,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-02-27',
                'expired_date' => '2025-02-27',
                'created_at' => '2025-02-27 08:49:50',
                'updated_at' => '2025-02-27 08:49:50',
            ),
            23 => 
            array (
                'subscription_id' => 25,
                'student_id' => 28,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-02-28',
                'expired_date' => '2025-02-28',
                'created_at' => '2025-02-28 07:43:40',
                'updated_at' => '2025-02-28 07:43:40',
            ),
            24 => 
            array (
                'subscription_id' => 26,
                'student_id' => 24,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-02-28',
                'expired_date' => '2025-02-28',
                'created_at' => '2025-02-28 08:21:30',
                'updated_at' => '2025-02-28 08:21:30',
            ),
            25 => 
            array (
                'subscription_id' => 27,
                'student_id' => 29,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-02-28',
                'expired_date' => '2025-02-28',
                'created_at' => '2025-02-28 08:22:25',
                'updated_at' => '2025-02-28 08:22:25',
            ),
            26 => 
            array (
                'subscription_id' => 28,
                'student_id' => 30,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-02-28',
                'expired_date' => '2025-02-28',
                'created_at' => '2025-02-28 08:23:15',
                'updated_at' => '2025-02-28 08:23:15',
            ),
            27 => 
            array (
                'subscription_id' => 29,
                'student_id' => 10,
                'plan_id' => 16,
                'amount' => 80,
                'activate_date' => '2025-03-06',
                'expired_date' => '2025-03-06',
                'created_at' => '2025-03-06 03:38:53',
                'updated_at' => '2025-03-06 03:38:53',
            ),
            28 => 
            array (
                'subscription_id' => 30,
                'student_id' => 31,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-03-06',
                'expired_date' => '2025-03-06',
                'created_at' => '2025-03-06 06:36:19',
                'updated_at' => '2025-03-06 06:36:19',
            ),
            29 => 
            array (
                'subscription_id' => 31,
                'student_id' => 32,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-03-06',
                'expired_date' => '2025-03-06',
                'created_at' => '2025-03-06 07:12:29',
                'updated_at' => '2025-03-06 07:12:29',
            ),
            30 => 
            array (
                'subscription_id' => 32,
                'student_id' => 32,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-03-06',
                'expired_date' => '2025-03-06',
                'created_at' => '2025-03-06 07:12:36',
                'updated_at' => '2025-03-06 07:12:36',
            ),
            31 => 
            array (
                'subscription_id' => 33,
                'student_id' => 22,
                'plan_id' => 10,
                'amount' => 60,
                'activate_date' => '2025-03-06',
                'expired_date' => '2025-03-06',
                'created_at' => '2025-03-06 08:05:16',
                'updated_at' => '2025-03-06 08:05:16',
            ),
            32 => 
            array (
                'subscription_id' => 34,
                'student_id' => 33,
                'plan_id' => 19,
                'amount' => 500,
                'activate_date' => '2025-03-12',
                'expired_date' => '2025-03-12',
                'created_at' => '2025-03-12 09:37:56',
                'updated_at' => '2025-03-12 09:37:56',
            ),
            33 => 
            array (
                'subscription_id' => 35,
                'student_id' => 2,
                'plan_id' => 13,
                'amount' => 150,
                'activate_date' => '2025-03-13',
                'expired_date' => '2025-03-13',
                'created_at' => '2025-03-13 03:41:53',
                'updated_at' => '2025-03-13 03:41:53',
            ),
        ));
        
        
    }
}