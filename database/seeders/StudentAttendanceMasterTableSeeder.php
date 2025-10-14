<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentAttendanceMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_attendance_master')->delete();
        
        \DB::table('student_attendance_master')->insert(array (
            0 => 
            array (
                'sattendanceid' => 1,
                'attendance_date' => '2025-01-16',
                'batch_id' => 11,
                'created_at' => '2025-01-16 13:34:01',
                'updated_at' => '2025-01-16 13:34:01',
            ),
            1 => 
            array (
                'sattendanceid' => 5,
                'attendance_date' => '2025-01-17',
                'batch_id' => 11,
                'created_at' => '2025-01-17 17:36:24',
                'updated_at' => '2025-01-17 17:36:24',
            ),
            2 => 
            array (
                'sattendanceid' => 6,
                'attendance_date' => '2025-01-17',
                'batch_id' => 11,
                'created_at' => '2025-01-17 17:40:58',
                'updated_at' => '2025-01-17 17:40:58',
            ),
            3 => 
            array (
                'sattendanceid' => 7,
                'attendance_date' => '2025-01-20',
                'batch_id' => 11,
                'created_at' => '2025-01-20 12:21:21',
                'updated_at' => '2025-01-20 12:21:21',
            ),
            4 => 
            array (
                'sattendanceid' => 8,
                'attendance_date' => '2025-01-20',
                'batch_id' => 11,
                'created_at' => '2025-01-20 12:22:10',
                'updated_at' => '2025-01-20 12:22:10',
            ),
            5 => 
            array (
                'sattendanceid' => 9,
                'attendance_date' => '2025-01-22',
                'batch_id' => 11,
                'created_at' => '2025-01-22 04:52:23',
                'updated_at' => '2025-01-22 04:52:23',
            ),
            6 => 
            array (
                'sattendanceid' => 10,
                'attendance_date' => '2025-01-22',
                'batch_id' => 11,
                'created_at' => '2025-01-22 04:52:23',
                'updated_at' => '2025-01-22 04:52:23',
            ),
            7 => 
            array (
                'sattendanceid' => 11,
                'attendance_date' => '2025-01-22',
                'batch_id' => 11,
                'created_at' => '2025-01-22 04:54:20',
                'updated_at' => '2025-01-22 04:54:20',
            ),
            8 => 
            array (
                'sattendanceid' => 12,
                'attendance_date' => '2025-01-22',
                'batch_id' => 15,
                'created_at' => '2025-01-22 10:40:51',
                'updated_at' => '2025-01-23 10:40:51',
            ),
            9 => 
            array (
                'sattendanceid' => 13,
                'attendance_date' => '2025-01-23',
                'batch_id' => 15,
                'created_at' => '2025-01-23 10:40:59',
                'updated_at' => '2025-01-23 10:40:59',
            ),
            10 => 
            array (
                'sattendanceid' => 14,
                'attendance_date' => '2025-01-23',
                'batch_id' => 15,
                'created_at' => '2025-01-23 11:25:46',
                'updated_at' => '2025-01-23 11:25:46',
            ),
            11 => 
            array (
                'sattendanceid' => 15,
                'attendance_date' => '2025-01-25',
                'batch_id' => 15,
                'created_at' => '2025-01-25 09:29:34',
                'updated_at' => '2025-01-25 09:29:34',
            ),
            12 => 
            array (
                'sattendanceid' => 16,
                'attendance_date' => '2025-01-25',
                'batch_id' => 15,
                'created_at' => '2025-01-25 09:34:06',
                'updated_at' => '2025-01-25 09:34:06',
            ),
            13 => 
            array (
                'sattendanceid' => 18,
                'attendance_date' => '2025-01-27',
                'batch_id' => 11,
                'created_at' => '2025-01-27 09:53:18',
                'updated_at' => '2025-01-27 09:53:18',
            ),
            14 => 
            array (
                'sattendanceid' => 19,
                'attendance_date' => '2025-01-27',
                'batch_id' => 15,
                'created_at' => '2025-01-27 11:31:35',
                'updated_at' => '2025-01-27 11:31:35',
            ),
            15 => 
            array (
                'sattendanceid' => 20,
                'attendance_date' => '2025-01-27',
                'batch_id' => 11,
                'created_at' => '2025-01-27 11:32:11',
                'updated_at' => '2025-01-27 11:32:11',
            ),
            16 => 
            array (
                'sattendanceid' => 21,
                'attendance_date' => '2025-01-28',
                'batch_id' => 11,
                'created_at' => '2025-01-28 06:02:06',
                'updated_at' => '2025-01-28 06:02:06',
            ),
            17 => 
            array (
                'sattendanceid' => 22,
                'attendance_date' => '2025-01-28',
                'batch_id' => 11,
                'created_at' => '2025-01-28 06:03:28',
                'updated_at' => '2025-01-28 06:03:28',
            ),
            18 => 
            array (
                'sattendanceid' => 23,
                'attendance_date' => '2025-01-30',
                'batch_id' => 11,
                'created_at' => '2025-01-30 06:26:50',
                'updated_at' => '2025-01-30 06:26:50',
            ),
            19 => 
            array (
                'sattendanceid' => 24,
                'attendance_date' => '2025-01-31',
                'batch_id' => 15,
                'created_at' => '2025-01-31 09:12:23',
                'updated_at' => '2025-01-31 09:12:23',
            ),
            20 => 
            array (
                'sattendanceid' => 27,
                'attendance_date' => '2025-01-31',
                'batch_id' => 11,
                'created_at' => '2025-01-31 16:12:25',
                'updated_at' => '2025-02-01 16:12:25',
            ),
            21 => 
            array (
                'sattendanceid' => 28,
                'attendance_date' => '2025-02-01',
                'batch_id' => 11,
                'created_at' => '2025-02-01 16:21:44',
                'updated_at' => '2025-02-01 16:21:44',
            ),
            22 => 
            array (
                'sattendanceid' => 29,
                'attendance_date' => '2025-02-03',
                'batch_id' => 15,
                'created_at' => '2025-02-03 06:56:22',
                'updated_at' => '2025-02-03 06:56:22',
            ),
            23 => 
            array (
                'sattendanceid' => 30,
                'attendance_date' => '2025-02-04',
                'batch_id' => 15,
                'created_at' => '2025-02-04 05:34:08',
                'updated_at' => '2025-02-04 05:34:08',
            ),
            24 => 
            array (
                'sattendanceid' => 31,
                'attendance_date' => '2025-02-04',
                'batch_id' => 15,
                'created_at' => '2025-02-04 05:34:34',
                'updated_at' => '2025-02-04 05:34:34',
            ),
            25 => 
            array (
                'sattendanceid' => 32,
                'attendance_date' => '2025-02-04',
                'batch_id' => 11,
                'created_at' => '2025-02-04 11:46:43',
                'updated_at' => '2025-02-04 11:46:43',
            ),
            26 => 
            array (
                'sattendanceid' => 33,
                'attendance_date' => '2025-02-05',
                'batch_id' => 11,
                'created_at' => '2025-02-05 08:13:46',
                'updated_at' => '2025-02-05 08:13:46',
            ),
            27 => 
            array (
                'sattendanceid' => 34,
                'attendance_date' => '2025-02-05',
                'batch_id' => 15,
                'created_at' => '2025-02-05 09:42:37',
                'updated_at' => '2025-02-05 09:42:37',
            ),
            28 => 
            array (
                'sattendanceid' => 45,
                'attendance_date' => '2025-02-07',
                'batch_id' => 15,
                'created_at' => '2025-02-07 03:31:52',
                'updated_at' => '2025-02-07 03:31:52',
            ),
            29 => 
            array (
                'sattendanceid' => 36,
                'attendance_date' => '2025-02-06',
                'batch_id' => 11,
                'created_at' => '2025-02-06 07:45:39',
                'updated_at' => '2025-02-06 07:45:39',
            ),
            30 => 
            array (
                'sattendanceid' => 40,
                'attendance_date' => '2025-02-07',
                'batch_id' => 15,
                'created_at' => '2025-02-07 03:17:19',
                'updated_at' => '2025-02-07 03:17:19',
            ),
            31 => 
            array (
                'sattendanceid' => 38,
                'attendance_date' => '2025-02-06',
                'batch_id' => 11,
                'created_at' => '2025-02-06 07:46:20',
                'updated_at' => '2025-02-06 07:46:20',
            ),
            32 => 
            array (
                'sattendanceid' => 39,
                'attendance_date' => '2025-02-07',
                'batch_id' => 10,
                'created_at' => '2025-02-07 01:02:51',
                'updated_at' => '2025-02-07 01:02:51',
            ),
            33 => 
            array (
                'sattendanceid' => 46,
                'attendance_date' => '2025-02-18',
                'batch_id' => 15,
                'created_at' => '2025-02-18 04:34:51',
                'updated_at' => '2025-02-18 04:34:51',
            ),
            34 => 
            array (
                'sattendanceid' => 47,
                'attendance_date' => '2025-02-19',
                'batch_id' => 11,
                'created_at' => '2025-02-19 09:59:34',
                'updated_at' => '2025-02-19 09:59:34',
            ),
            35 => 
            array (
                'sattendanceid' => 48,
                'attendance_date' => '2025-02-26',
                'batch_id' => 11,
                'created_at' => '2025-02-26 08:27:48',
                'updated_at' => '2025-02-26 08:27:48',
            ),
            36 => 
            array (
                'sattendanceid' => 49,
                'attendance_date' => '2025-02-28',
                'batch_id' => 15,
                'created_at' => '2025-02-28 07:44:12',
                'updated_at' => '2025-02-28 07:44:12',
            ),
            37 => 
            array (
                'sattendanceid' => 51,
                'attendance_date' => '2025-03-06',
                'batch_id' => 15,
                'created_at' => '2025-03-06 07:20:54',
                'updated_at' => '2025-03-06 07:20:54',
            ),
            38 => 
            array (
                'sattendanceid' => 54,
                'attendance_date' => '2025-03-06',
                'batch_id' => 15,
                'created_at' => '2025-03-06 07:30:32',
                'updated_at' => '2025-03-06 07:30:32',
            ),
            39 => 
            array (
                'sattendanceid' => 66,
                'attendance_date' => '2025-03-25',
                'batch_id' => 11,
                'created_at' => '2025-03-25 08:32:22',
                'updated_at' => '2025-03-25 08:32:22',
            ),
        ));
        
        
    }
}