<?php

namespace App\Repositories\StudentAttendance;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\StudentAttendance;



class StudentAttendanceRepository implements StudentAttendanceRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

            $StudentAttendance = StudentAttendance::find($id);
            
            if (!$StudentAttendance) {
                return null;
            }
            
            return $StudentAttendance->toArray();

    }



    public function all()

    {

        return StudentAttendance::get()->toArray();

    }



   public function createOrUpdate($request, $id = null)

    {

        // If an ID is provided, update the existing record

        $attendence = $id ? StudentAttendance::find($id) : new StudentAttendance();



        if (!$attendence) {

            throw new \Exception('Student Attendance not found');

        }



        // Set the plan fields

        $attendence->sattendanceid = $request['sattendanceid']; // Example field

        $attendence->student_id = $request['student_id']; // Example field

        $attendence->attendance = $request['attendance']; // Example field

        $attendence->batch_id = $request['batch_id']; // Example field

        $attendence->day = $request['day']; // Example field

        $attendence->save();



        return $attendence;

    }

        public function destroy($id)

    {

        StudentAttendance::where('attendence_id',$id)->delete();

    }

}

