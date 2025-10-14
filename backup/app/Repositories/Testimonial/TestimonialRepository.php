<?php
namespace App\Repositories\Testimonial;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\Testimonial;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return Testimonial::find($id)->toArray();
    }

    public function all()
    {
        return Testimonial::get()->toArray();
    }

    public function createOrUpdate($request,$id=null)
    {

            // If an ID is provided, update the existing record
        $testimonial = $id ? Testimonial::find($id) : new Testimonial();
        if (!$testimonial) {
            throw new \Exception('Testimonial not found');
        }

    // Set the plan fields
    $testimonial->parent_name = $request['parent_name'] ?? ''; // Example field
    $testimonial->parent_photo = $request['parent_photo'] ?? ''; // Example field
    $testimonial->student_name = $request['student_name'] ?? ''; // Example field
    $testimonial->student_photo = $request['student_photo'] ?? ''; // Example field
    $testimonial->description = $request['description'] ?? ''; // Example field

    $testimonial->save();

    return $testimonial;

    }
  public function updateStatus(array $data, $id)
    {
        return Testimonial::where('testimonial_id', $id)->update($data);
    }

    public function destroy($id)
    {
        Testimonial::where('testimonial_id',$id)->delete();
    }
}
