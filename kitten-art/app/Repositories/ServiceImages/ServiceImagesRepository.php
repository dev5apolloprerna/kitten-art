<?php

namespace App\Repositories\ServiceImages;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\ServiceImages;   

use App\Models\Service;   



class ServiceImagesRepository implements ServiceImagesRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

        return ServiceImages::findOrFail($id)->toArray(); 

    }



    public function findByServiceId($serviceId)

    {

        return ServiceImages::where('service_id', $serviceId)->get()->toArray();

    }



    public function all()

    {

        return ServiceImages::get()->toArray();

    }



    public function createOrUpdate($request, $id = null)
{
    $service = $id ? Service::find($id) : null;

    if ($id && !$service) {
        throw new \Exception('Service not found for the provided ID: ' . $id);
    }

    if ($request->hasFile('image')) {
        $images = is_array($request->file('image')) ? $request->file('image') : [$request->file('image')];

        $destinationPath = public_path('/Service/service_images');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        foreach ($images as $image) {
            if ($image->isValid()) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $filename);

                ServiceImages::create([
                    'service_id' => $request->service_id,
                    'image' => $filename,
                ]);
            }
        }
    } else {
        throw new \Exception('Image field is missing from the request.');
    }

    return $service;
}
    public function destroy($id)

    {

        ServiceImages::where('service_image_id',$id)->delete();

    }

}

