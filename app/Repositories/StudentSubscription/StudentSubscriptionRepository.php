<?php

namespace App\Repositories\StudentSubscription;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\StudentSubscription;



class StudentSubscriptionRepository implements StudentSubscriptionRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

        return StudentSubscription::findOrFail($id)->toArray();

    }



    public function all()

    {

        return StudentSubscription::get()->toArray();

    }



    public function createOrUpdate($request,$id=null)

    {



        // If an ID is provided, update the existing record

        $subscription = $id ? StudentSubscription::find($id) : new StudentSubscription();



        if (!$subscription) {

            throw new \Exception('Student Subscription not found');

        }else{

            
        }
        $subscription->student_id = $request['student_id'] ?? 0;
        $subscription->plan_id = $request['plan_id'] ?? 0;
        $subscription->total_session = $request['total_session'] ?? 0;
        $subscription->batch_id = $request['batch_id'] ?? 0;
        $subscription->category_id = $request['category_id'] ?? 0;
        $subscription->amount = $request['amount'] ?? 0;
        $subscription->payment_date = $request['payment_date'] ?? 0;
        $subscription->payment_mode = $request['payment_mode'] ?? 0;
        $subscription->activate_date = $request['activate_date'] ?? 0;
        $subscription->expired_date = $request['expired_date'] ?? 0;
        $subscription->status = 1;
        $subscription->save();
        return $subscription;

    }

 public function changeStatus($request, $id)
    {

        $subscription = StudentSubscription::find($id);

        if (!$subscription) {
            throw new \Exception("Student with ID {$id} not found.");
        }
        $subscription->status = $request['status'] ?? $subscription->status;
        $subscription->save();

        return $subscription;
    }


    public function destroy($id)

    {

        StudentSubscription::where('subscription_id',$id)->delete();

    }

}

