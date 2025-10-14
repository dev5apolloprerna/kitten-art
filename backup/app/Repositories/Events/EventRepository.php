<?php
namespace App\Repositories\Events;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\Events;

class EventRepository implements EventRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return Events::find($id)->toArray();
    }

    public function all()
    {
        return Events::get()->toArray();
    }

    public function createOrUpdate($request, $id = null)
    {
        // If an ID is provided, update the existing record
        $event = $id ? Events::find($id) : new Events();

        if (!$event) {
            throw new \Exception('Events not found');
        }

    // Set the event fields
    $event->event_name = $request['event_name']; // Example field
    $event->category_id = $request['category_id']; // Example field
    $event->image = $request['image'] ?? $event->image;
    $event->Instructors = $request['Instructors']; // Image field
    $event->discounts = $request['discounts']; // Image field
    $event->location = $request['location']; // Image field
    $event->detail_description = $request['detail_description']; // Image field
    $event->to_date = $request['to_date']; // Image field
    $event->from_date = $request['from_date']; // Image field
    $event->to_time = $request['to_time']; // Image field
    $event->from_time = $request['from_time']; // Image field
    $event->capacity = $request['capacity']; // Image field

    $event->save();

    return $event;
}

    public function destroy($id)
    {
        Events::where('event_id',$id)->delete();
    }
}
