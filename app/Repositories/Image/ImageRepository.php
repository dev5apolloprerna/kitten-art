<?php

namespace App\Repositories\Image;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\Image;



class ImageRepository implements ImageRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

        return Image::findOrFail($id)->toArray(); 

    }



    public function all()

    {

        return Image::get()->toArray();

    }



    public function createOrUpdate($request,$id=null)

    {

            // If an ID is provided, update the existing record

        $Image = $id ? Image::find($id) : new Image();

        if (!$Image) {

            throw new \Exception('Image not found');

        }



    // Set the plan fields


    $Image->image = $request['image'] ?? $Image->image;

    $Image->save();



    return $Image;

    }



    public function destroy($id)

    {

        Image::where('image_id',$id)->delete();

    }

}

