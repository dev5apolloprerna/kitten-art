<?php
namespace App\Repositories\Contact;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\StudentInquiry;
use Illuminate\Support\Facades\Hash;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return StudentInquiry::find($id)->toArray();
    }

    public function all()
    {
        return StudentInquiry::get()->toArray();
    }

    public function createOrUpdate($request,$id=null)
    {

            $data = $request->all();
            $data['password'] = Hash::make(123456);

            if ($id) 
            {
                $student = StudentInquiry::find($id);
                if ($student) {
                    $student->update($data);
                } else {
                    throw new \Exception("StudentInquiry with ID {$id} not found.");
                }
            } else {
                // Create a new student and get the ID
                $student = StudentInquiry::create($data);
                if ($student) {
                    // Update loginId with the student's ID
                    $student->update(['loginId' => 'Kac' . $student->student_inquiry_id]);
                }
            }
            return $student;
    }

    public function updateStatus(array $data, $id)
    {
        return StudentInquiry::where('student_inquiry_id', $id)->update($data);
    }

    public function destroy($id)
    {
        StudentInquiry::where('student_inquiry_id',$id)->delete();
    }
}
