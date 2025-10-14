<?php

namespace App\Http\Controllers\admin;



use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Page;



use App\Repositories\Page\PageRepositoryInterface;

use App\Repositories\Page\PageRepository;



class PageController extends Controller

{

    protected $page;



    public function __construct(PageRepositoryInterface $page)

    {

        $this->page = $page;

    }

   public function index(Request $request)

    {

         try{



        $page = Page::orderBy('id','desc')->paginate(env('PER_PAGE_COUNT'));





        return view('admin.page.index', compact('page'));

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }

   

    public function edit($id)

    {

         try{



            $data = $this->page->find($id);
            if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');

            }else
            {  
                return view('admin.page.edit',compact('data'));
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }



    public function update(Request $request,$id)

    {
  $request->validate([
                'description' => 'required',        
            ], [
                'description.required' => 'description is required.',
            ]);
        try

        {

                $this->page->createOrUpdate($request, $id);



                return redirect()->route('page.index')->with('success','Data Updated Successfully');



        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

   

}

