<?php

namespace App\Repositories\Category;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class CategoryRepository.

 */

use App\Models\Category;



class CategoryRepository implements CategoryRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {
    return Category::findOrFail($id)->toArray(); 

    }



    public function all()

    {

        return Category::get()->toArray();

    }



    public function createOrUpdate($request,$id=null){

        $data = $request->all();

        if ($id) 

        {

        $category = Category::find($id);

        if ($category) {

            $category->update($data);

        }

    } else {

        $category = Category::create($data);

    }

    }
    public function changeStatus($request, $id)
    {
        $category = Category::find($id);

        if (!$category) {

            throw new \Exception("category with ID {$id} not found.");

        }

        $category->isDelete = $request['isDelete'] ?? 0;
        $category->save();
        return $category;
    }



    public function destroy($id){

        Category::where('category_id',$id)->delete();

    }

}

