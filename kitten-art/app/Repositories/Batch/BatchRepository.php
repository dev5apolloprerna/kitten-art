<?php

namespace App\Repositories\Batch;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class BatchRepository.

 */

use App\Models\Batch;



class BatchRepository implements BatchRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

        return Batch::findOrFail($id)->toArray(); 

    }



    public function all()

    {

        return Batch::get()->toArray();

    }



    public function createOrUpdate($request,$id=null)

    {

            $data = $request->all();



            if ($id) 

            {

                $batch = Batch::find($id);

                if ($batch) {

                    $batch->update($data);

                                    

                } else {

                    throw new \Exception("Batch with ID {$id} not found.");

                }

            } else {

                $batch = Batch::create($data); // Create a new record

            }



            return $batch;



    }



    public function destroy($id)

    {

        Batch::where('batch_id',$id)->delete();

    }

}

