<?php
namespace App\Repositories\Gallery;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\Gallery;

class GalleryRepository implements GalleryRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return Gallery::find($id)->toArray();
    }

    public function all()
    {
        return Gallery::get()->toArray();
    }

    public function createOrUpdate($request,$id=null)
    {

            // If an ID is provided, update the existing record
        $gallery = $id ? Gallery::find($id) : new Gallery();
        if (!$gallery) {
            throw new \Exception('Gallery not found');
        }

    // Set the plan fields
    $gallery->comment = $request['comment'] ?? ''; // Example field
    $gallery->image = $request['image'] ?? $gallery->image;
    $gallery->type = $request['type'] ?? $gallery->type;

    $gallery->save();

    return $gallery;


    }

    public function destroy($id)
    {
        Gallery::where('gallery_id',$id)->delete();
    }
}
