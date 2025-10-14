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
        return ServiceImages::find($id)->toArray();
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
        if ($id && !$service) 
        {
            throw new \Exception('Service not found for the provided ID: ' . $id);
        }

    if (isset($request['image'])) 
    {
        $images = $request['image']; // Assume 'image' is an array of images

        foreach ($images as $image) 
        {
            $root = $_SERVER['DOCUMENT_ROOT'];
            
            // Define the destination path (without the base URL part)
            $destinationPath = $root . '/kitten_craft/Service/service_images';
            $filename = time() . '_' . $image->getClientOriginalName();

            // Move the image to the destination path
            $image->move($destinationPath, $filename);

            // Save only the image name in the database (not the full path)
            ServiceImages::create([
                'service_id' => $request->service_id,
                'image' => $filename,  // Store only the image filename in the database
            ]);
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
