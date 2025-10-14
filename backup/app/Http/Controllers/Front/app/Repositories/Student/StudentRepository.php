<?php
namespace App\Repositories\Student;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\Student;
use Hash;

class StudentRepository implements StudentRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return Student::find($id)->toArray();
    }

    public function all()
    {
        return Student::get()->toArray();
    }

    /*public function createOrUpdate($request,$id=null)
    {

            $data = $request->all();
            $data['password'] = Hash::make(random_int(100000, 999999));

            if ($id) 
            {
                $student = Student::find($id);
                if ($student) {
                    $student->update($data);
                } else {
                    throw new \Exception("Student with ID {$id} not found.");
                }
            } else {
                // Create a new student and get the ID
                $student = Student::create($data);
                if ($student) {
                    // Update loginId with the student's ID
                    $student->update(['login_id' => 'Kac' . $student->student_id]);
                }
            }
            return $student;
    }*/
    public function createOrUpdate($request, $id = null)
    {
        // Check if $request is an instance of Request
        if ($request instanceof \Illuminate\Http\Request) {
            $data = $request->all();
        } elseif (is_array($request)) {
            $data = $request; // Assign directly if it's an array
        } else {
            throw new \InvalidArgumentException("The request must be an instance of Request or an array.");
        }

        // Add the generated password to the data
        $data['password'] = Hash::make(123456);

        if ($id) {
            // If ID is provided, update the existing student
            $student = Student::find($id);
            if ($student) {
                $student->update($data);
            } else {
                throw new \Exception("Student with ID {$id} not found.");
            }
        } else {
            // Create a new student and get the ID
            $student = Student::create($data);
            if ($student) {
                // Update loginId with the student's ID
                $student->update(['login_id' => 'Kac' . $student->student_id]);
            }
        }

        return $student;
    }

    public function changePassword($request, $id)
    {

        $student = Student::find($id);

        if (!$student) {
            throw new \Exception("Student with ID {$id} not found.");
        }

        // Update the password (hashed)
        $student->password = Hash::make($request->password);
        $student->save();

        return $student;
    }
    public function changeStatus($request, $id)
    {

        $student = Student::find($id);

        if (!$student) {
            throw new \Exception("Student with ID {$id} not found.");
        }
        $student->isWaiting = $request['isWaiting'] ?? 0;
        $student->isRegister = $request['isRegister'] ?? 0;
        $student->isPaid = $request['isPaid'] ?? 0;
        $student->iStatus = $request['iStatus'] ?? $student->iStatus;
        $student->save();

        return $student;
    }
    public function destroy($id)
    {
        Student::where('student_id',$id)->delete();
        
    }
}
