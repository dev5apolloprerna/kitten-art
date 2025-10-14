<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentAttendanceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('student_attendance')->delete();
        
        \DB::table('student_attendance')->insert(array (
            0 => 
            array (
                'attendence_id' => 1,
                'sattendanceid' => 1,
                'student_id' => 2,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-16 13:34:01',
                'updated_at' => '2025-01-16 13:34:01',
            ),
            1 => 
            array (
                'attendence_id' => 5,
                'sattendanceid' => 5,
                'student_id' => 2,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-17 17:36:24',
                'updated_at' => '2025-01-17 17:36:24',
            ),
            2 => 
            array (
                'attendence_id' => 6,
                'sattendanceid' => 6,
                'student_id' => 2,
                'attendance' => 'A',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-17 17:40:58',
                'updated_at' => '2025-01-17 17:40:58',
            ),
            3 => 
            array (
                'attendence_id' => 7,
                'sattendanceid' => 7,
                'student_id' => 2,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-20 12:21:21',
                'updated_at' => '2025-01-20 12:21:21',
            ),
            4 => 
            array (
                'attendence_id' => 8,
                'sattendanceid' => 8,
                'student_id' => 2,
                'attendance' => 'A',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-20 12:22:10',
                'updated_at' => '2025-01-20 12:22:10',
            ),
            5 => 
            array (
                'attendence_id' => 9,
                'sattendanceid' => 9,
                'student_id' => 10,
                'attendance' => 'A',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-22 04:52:23',
                'updated_at' => '2025-01-22 04:52:23',
            ),
            6 => 
            array (
                'attendence_id' => 10,
                'sattendanceid' => 10,
                'student_id' => 5,
                'attendance' => 'A',
                'plan_id' => 13,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-22 04:52:23',
                'updated_at' => '2025-01-22 04:52:23',
            ),
            7 => 
            array (
                'attendence_id' => 11,
                'sattendanceid' => 11,
                'student_id' => 10,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-22 04:54:20',
                'updated_at' => '2025-01-22 04:54:20',
            ),
            8 => 
            array (
                'attendence_id' => 12,
                'sattendanceid' => 12,
                'student_id' => 11,
                'attendance' => 'P',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-01-22 10:40:51',
                'updated_at' => '2025-01-23 10:40:51',
            ),
            9 => 
            array (
                'attendence_id' => 13,
                'sattendanceid' => 13,
                'student_id' => 11,
                'attendance' => 'A',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-01-23 10:40:59',
                'updated_at' => '2025-01-23 10:40:59',
            ),
            10 => 
            array (
                'attendence_id' => 14,
                'sattendanceid' => 14,
                'student_id' => 11,
                'attendance' => 'P',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-01-23 11:25:46',
                'updated_at' => '2025-01-23 11:25:46',
            ),
            11 => 
            array (
                'attendence_id' => 15,
                'sattendanceid' => 15,
                'student_id' => 11,
                'attendance' => 'P',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-01-25 09:29:34',
                'updated_at' => '2025-01-25 09:29:34',
            ),
            12 => 
            array (
                'attendence_id' => 16,
                'sattendanceid' => 16,
                'student_id' => 11,
                'attendance' => 'A',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-01-25 09:34:06',
                'updated_at' => '2025-01-25 09:34:06',
            ),
            13 => 
            array (
                'attendence_id' => 18,
                'sattendanceid' => 18,
                'student_id' => 10,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-27 09:53:18',
                'updated_at' => '2025-01-27 09:53:18',
            ),
            14 => 
            array (
                'attendence_id' => 19,
                'sattendanceid' => 19,
                'student_id' => 11,
                'attendance' => 'P',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-01-27 11:31:35',
                'updated_at' => '2025-01-27 11:31:35',
            ),
            15 => 
            array (
                'attendence_id' => 20,
                'sattendanceid' => 20,
                'student_id' => 2,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-27 11:32:11',
                'updated_at' => '2025-01-27 11:32:11',
            ),
            16 => 
            array (
                'attendence_id' => 21,
                'sattendanceid' => 21,
                'student_id' => 12,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-28 06:02:06',
                'updated_at' => '2025-01-28 06:02:06',
            ),
            17 => 
            array (
                'attendence_id' => 22,
                'sattendanceid' => 22,
                'student_id' => 12,
                'attendance' => 'A',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-28 06:03:28',
                'updated_at' => '2025-01-28 06:03:28',
            ),
            18 => 
            array (
                'attendence_id' => 23,
                'sattendanceid' => 23,
                'student_id' => 12,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-30 06:26:50',
                'updated_at' => '2025-01-30 06:26:50',
            ),
            19 => 
            array (
                'attendence_id' => 24,
                'sattendanceid' => 24,
                'student_id' => 11,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-01-31 09:12:23',
                'updated_at' => '2025-01-31 09:12:23',
            ),
            20 => 
            array (
                'attendence_id' => 27,
                'sattendanceid' => 27,
                'student_id' => 13,
                'attendance' => 'P',
                'plan_id' => 13,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-01-31 16:12:25',
                'updated_at' => '2025-02-01 16:12:25',
            ),
            21 => 
            array (
                'attendence_id' => 28,
                'sattendanceid' => 28,
                'student_id' => 13,
                'attendance' => 'P',
                'plan_id' => 13,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-02-01 16:21:44',
                'updated_at' => '2025-02-01 16:21:44',
            ),
            22 => 
            array (
                'attendence_id' => 29,
                'sattendanceid' => 29,
                'student_id' => 14,
                'attendance' => 'A',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-03 06:56:22',
                'updated_at' => '2025-02-03 06:56:22',
            ),
            23 => 
            array (
                'attendence_id' => 30,
                'sattendanceid' => 30,
                'student_id' => 14,
                'attendance' => 'P',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-04 05:34:08',
                'updated_at' => '2025-02-04 05:34:08',
            ),
            24 => 
            array (
                'attendence_id' => 31,
                'sattendanceid' => 31,
                'student_id' => 14,
                'attendance' => 'A',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-04 05:34:34',
                'updated_at' => '2025-02-04 05:34:34',
            ),
            25 => 
            array (
                'attendence_id' => 32,
                'sattendanceid' => 32,
                'student_id' => 13,
                'attendance' => 'P',
                'plan_id' => 13,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-02-04 11:46:43',
                'updated_at' => '2025-02-04 11:46:43',
            ),
            26 => 
            array (
                'attendence_id' => 33,
                'sattendanceid' => 33,
                'student_id' => 13,
                'attendance' => 'P',
                'plan_id' => 13,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-02-05 08:13:46',
                'updated_at' => '2025-02-28 06:54:34',
            ),
            27 => 
            array (
                'attendence_id' => 34,
                'sattendanceid' => 34,
                'student_id' => 14,
                'attendance' => 'A',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-05 09:42:37',
                'updated_at' => '2025-02-05 09:42:37',
            ),
            28 => 
            array (
                'attendence_id' => 45,
                'sattendanceid' => 45,
                'student_id' => 14,
                'attendance' => 'A',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-07 03:31:52',
                'updated_at' => '2025-02-07 03:31:52',
            ),
            29 => 
            array (
                'attendence_id' => 36,
                'sattendanceid' => 36,
                'student_id' => 10,
                'attendance' => 'A',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-02-06 07:45:39',
                'updated_at' => '2025-02-06 07:45:39',
            ),
            30 => 
            array (
                'attendence_id' => 40,
                'sattendanceid' => 40,
                'student_id' => 14,
                'attendance' => 'P',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-07 03:17:19',
                'updated_at' => '2025-02-07 03:17:19',
            ),
            31 => 
            array (
                'attendence_id' => 38,
                'sattendanceid' => 38,
                'student_id' => 5,
                'attendance' => 'A',
                'plan_id' => 13,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-02-06 07:46:20',
                'updated_at' => '2025-02-06 07:46:20',
            ),
            32 => 
            array (
                'attendence_id' => 39,
                'sattendanceid' => 39,
                'student_id' => 15,
                'attendance' => 'A',
                'plan_id' => 10,
                'batch_id' => 10,
                'day' => '6',
                'created_at' => '2025-02-07 01:02:51',
                'updated_at' => '2025-02-07 01:02:51',
            ),
            33 => 
            array (
                'attendence_id' => 46,
                'sattendanceid' => 46,
                'student_id' => 16,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-18 04:34:51',
                'updated_at' => '2025-02-18 04:34:51',
            ),
            34 => 
            array (
                'attendence_id' => 47,
                'sattendanceid' => 47,
                'student_id' => 18,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-02-19 09:59:34',
                'updated_at' => '2025-02-19 09:59:34',
            ),
            35 => 
            array (
                'attendence_id' => 48,
                'sattendanceid' => 48,
                'student_id' => 25,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-02-26 08:27:48',
                'updated_at' => '2025-02-26 08:27:48',
            ),
            36 => 
            array (
                'attendence_id' => 49,
                'sattendanceid' => 49,
                'student_id' => 28,
                'attendance' => 'P',
                'plan_id' => 10,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-02-28 07:44:12',
                'updated_at' => '2025-02-28 07:48:00',
            ),
            37 => 
            array (
                'attendence_id' => 51,
                'sattendanceid' => 51,
                'student_id' => 14,
                'attendance' => 'A',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-03-06 07:20:54',
                'updated_at' => '2025-03-06 07:20:54',
            ),
            38 => 
            array (
                'attendence_id' => 54,
                'sattendanceid' => 54,
                'student_id' => 14,
                'attendance' => 'P',
                'plan_id' => 16,
                'batch_id' => 15,
                'day' => '3',
                'created_at' => '2025-03-06 07:30:32',
                'updated_at' => '2025-03-06 07:30:32',
            ),
            39 => 
            array (
                'attendence_id' => 66,
                'sattendanceid' => 66,
                'student_id' => 32,
                'attendance' => 'A',
                'plan_id' => 13,
                'batch_id' => 11,
                'day' => '2',
                'created_at' => '2025-03-25 08:32:22',
                'updated_at' => '2025-03-25 08:37:21',
            ),
        ));
        
        
    }
}