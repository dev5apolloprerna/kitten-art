<?php

namespace App\Repositories\Plan;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class CategoryRepository.

 */

use App\Models\Plan;



class PlanRepository implements PlanRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

        return Plan::findOrFail($id)->toArray(); 

    }



    public function all()

    {

        return Plan::get()->toArray();

    }



    public function createOrUpdate($request, $id = null)

    {

        // If an ID is provided, update the existing record

        $plan = $id ? Plan::find($id) : new Plan();



        if (!$plan) {

            throw new \Exception('Plan not found');

        }



    // Set the plan fields

    $plan->plan_name = $request['plan_name']; // Example field

    $plan->category_id = $request['category_id']; // Example field

    $plan->plan_image = $request['plan_image'] ?? $plan->plan_image;

    $plan->plan_amount = $request['plan_amount']; // Image field

    $plan->plan_session = $request['plan_session']; // Image field

    $plan->plan_description = $request['plan_description']; // Image field

    $plan->detail_description = $request['detail_description']; // Image field



    $plan->save();



    return $plan;

}


public function changeStatus($request, $id)
    {
        $plan = Plan::find($id);

        if (!$plan) {

            throw new \Exception("plan with ID {$id} not found.");

        }

        $plan->isDelete = $request['isDelete'] ?? 0;
        $plan->save();
        return $plan;
    }


    public function destroy($id){

        Plan::where('planId',$id)->delete();

    }

}

