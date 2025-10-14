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
        return StudentSubscription::find($id)->toArray();
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
        $subscription->amount = $request['amount'] ?? 0;
        $subscription->activate_date = $request['activate_date'] ?? 0;
        $subscription->expired_date = $request['expired_date'] ?? 0;
        $subscription->save();

        return $subscription;

    }

    public function destroy($id)
    {
        StudentSubscription::where('subscription_id',$id)->delete();
    }
}
