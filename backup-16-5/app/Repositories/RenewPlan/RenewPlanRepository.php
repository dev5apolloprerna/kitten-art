<?php

namespace App\Repositories\RenewPlan;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\Renewplan;

use Hash;



class RenewPlanRepository implements RenewPlanRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

            $renewplan = Renewplan::find($id);
            
            if (!$renewplan) {
                return null;
            }
            
            return $renewplan->toArray();
    }



    public function all()

    {

        return Renewplan::get()->toArray();

    }



    public function createOrUpdate($request,$id=null)

    {

            $data = $request->all();



            if ($id) 

            {

                $RenewPlan = Renewplan::find($id);

                if ($RenewPlan) {

                    $RenewPlan->update($data);

                                    

                } else {

                    throw new \Exception("RenewPlan with ID {$id} not found.");

                }

            } else {

                $RenewPlan = TrialClass::create($data); // Create a new record

            }

            return $RenewPlan;

    }

    public function updateStatus(array $data, $id)

    {

        return Renewplan::where('renewplan_id', $id)->update($data);

    }



    public function destroy($id)

    {

        Renewplan::where('renewplan_id',$id)->delete();

        

    }

}

