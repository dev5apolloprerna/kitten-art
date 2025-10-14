<?php
namespace App\Repositories\TrialClass;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\TrialClass;
use Hash;

class TrialClassRepository implements TrialClassRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return TrialClass::find($id)->toArray();
    }

    public function all()
    {
        return TrialClass::get()->toArray();
    }

    public function createOrUpdate($request,$id=null)
    {
            $data = $request->all();

            if ($id) 
            {
                $TrialClass = TrialClass::find($id);
                if ($TrialClass) {
                    $TrialClass->update($data);
                                    
                } else {
                    throw new \Exception("TrialClass with ID {$id} not found.");
                }
            } else {
                $TrialClass = TrialClass::create($data); // Create a new record
            }
            return $TrialClass;
    }
    public function updateStatus(array $data, $id)
    {
        return TrialClass::where('trialclass_student_id', $id)->update($data);
    }

    public function destroy($id)
    {
        TrialClass::where('trialclass_student_id',$id)->delete();
        
    }
}
