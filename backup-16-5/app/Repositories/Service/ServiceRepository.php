<?php

namespace App\Repositories\Service;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\Service;



class ServiceRepository implements ServiceRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {
            $service = Service::find($id);
            
            if (!$service) {
                return null;
            }
            
            return $service->toArray();


    }



    public function all()

    {

        return Service::get()->toArray();

    }



   public function createOrUpdate($request, $id = null)

    {

        $service = $id ? Service::find($id) : null;



        if ($id && !$service) {

            throw new \Exception('Service not found for the provided ID: ' . $id);

        }



        $service = $service ?? new Service();

        $service->service_name = $request['service_name']; // Example field



        if (isset($request['image'])) {

            $service->image = $request['image'];

        } else {

            throw new \Exception('Image field is missing from the request.');

        }

        $service->description = $request['description']; // Example field

        $service->save();



        return $service;

    }





    public function destroy($id)

    {

        Service::where('service_id',$id)->delete();

    }

}

