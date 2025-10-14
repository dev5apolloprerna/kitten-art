<?php
namespace App\Repositories\Inquiry;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class InquiryRepository.
 */
use App\Models\Inquiry;

class InquiryRepository implements InquiryRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return Inquiry::find($id)->toArray();
    }

    public function all()
    {
        return Inquiry::get()->toArray();
    }

    public function createOrUpdate($request,$id=null)
    {
            $data = $request->all();

            if ($id) 
            {
                $Inquiry = Inquiry::find($id);
                if ($Inquiry) {
                    $Inquiry->update($data);
                                    
                } else {
                    throw new \Exception("Inquiry with ID {$id} not found.");
                }
            } else {
                $Inquiry = Inquiry::create($data); // Create a new record
            }

            return $Inquiry;

    }

    public function destroy($id)
    {
        Inquiry::where('inquiry_id',$id)->delete();
    }
}
