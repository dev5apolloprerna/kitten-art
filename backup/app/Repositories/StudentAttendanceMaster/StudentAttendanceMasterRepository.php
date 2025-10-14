<?php
namespace App\Repositories\StudentAttendanceMaster;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\StudentAttendanceMaster;

class StudentAttendanceMasterRepository implements StudentAttendanceMasterRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return StudentAttendanceMaster::find($id)->toArray();
    }

    public function all()
    {
        return StudentAttendanceMaster::get()->toArray();
    }

    public function createOrUpdate($request, $id = null)
    {
        // If an ID is provided, update the existing record
        $attendenceMaster = $id ? StudentAttendanceMaster::find($id) : new StudentAttendanceMaster();

        if (!$attendenceMaster) {
            throw new \Exception('Student Attendance Master not found');
        }

        // Set the plan fields
        $attendenceMaster->attendance_date = $request['attendance_date']; // Example field
        $attendenceMaster->batch_id = $request['batch_id']; // Example field
        $attendenceMaster->save();

        return $attendenceMaster;
    }
        public function destroy($id)
    {
        StudentAttendanceMaster::where('sattendanceid',$id)->delete();
    }
}
