<?php
namespace App\Repositories\EBook;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BatchRepository.
 */
use App\Models\EBook;
use App\Models\EBookRegister;

class EBookRepository implements EBookRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return EBook::find($id)->toArray();
    }

    public function all()
    {
        return EBook::get()->toArray();
    }

    public function createOrUpdate($request,$id=null)
    {

            // If an ID is provided, update the existing record
        $ebook = $id ? EBook::find($id) : new EBook();
        if (!$ebook) {
            throw new \Exception('EBook not found');
        }

        // Set the plan fields
        $ebook->ebook_name = $request['ebook_name'] ?? ''; // Example field
        $ebook->ebook_pdf = $request['pdf'] ?? $ebook->ebook_pdf;
        $ebook->ebook_image = $request['image'] ?? $ebook->ebook_image;
        $ebook->save();

        return $ebook;
    }
     public function ebookRegister($request,$id=null)
    {
        $data = $request->all();

            if ($id) 
            {
                $registration = EBookRegister::find($id);
                if ($registration) {
                    $registration->update($data);
                                    
                } else {
                    throw new \Exception("EBookRegister with ID {$id} not found.");
                }
            } else {
                $registration = EBookRegister::create($data); // Create a new record
            }

            return $registration;
    }


    public function destroy($id)
    {
        EBook::where('ebook_id',$id)->delete();
    }
}
