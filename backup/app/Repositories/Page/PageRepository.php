<?php
namespace App\Repositories\Page;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class pageRepository.
 */
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return Page::find($id)->toArray();
    }

    public function all()
    {
        return Page::get()->toArray();
    }

    public function createOrUpdate($request,$id=null)
    {
            $data = $request->all();

            if ($id) 
            {
                $page = Page::find($id);
                if ($page) {
                    $page->update($data);
                                    
                } else {
                    throw new \Exception("page with ID {$id} not found.");
                }
            } else {
                $page = Page::create($data); // Create a new record
            }

            return $page;

    }
    public function destroy($id)
    {
        Page::where('id',$id)->delete();
    }
}
