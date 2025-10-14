<?php

namespace App\Repositories\Banner;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\Banner;



class BannerRepository implements BannerRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

        return Banner::findOrFail($id)->toArray(); 

    }



    public function all()

    {

        return Banner::get()->toArray();

    }



    public function createOrUpdate($request,$id=null)
    {

            // If an ID is provided, update the existing record

        $banner = $id ? Banner::find($id) : new Banner();

        if (!$banner) {

            throw new \Exception('Banner not found');

        }



    // Set the plan fields
    $banner->image = $request['image'] ?? $banner->image;
    $banner->save();
    return $banner;
    }



    public function destroy($id)

    {

        Banner::where('bannerId',$id)->delete();

    }

}

