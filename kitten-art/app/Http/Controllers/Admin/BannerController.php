<?php

namespace App\Http\Controllers\admin;



use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Banner;


use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\Banner\BannerRepository;



class BannerController extends Controller

{

    protected $banner;

    public function __construct(BannerRepositoryInterface $banner)

    {

        $this->banner = $banner;

    }

   public function index(Request $request)

    {

         try{



        $banner = Banner::orderBy('bannerId','desc')->paginate(env('PER_PAGE_COUNT'));

            $search=$request->search;





        return view('admin.banner.index', compact('banner','search'));

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }

    public function store(Request $request)

    {

        $request->validate([
            'image' => 'required'
        ]);


        try

        {



               $img = "";

                if ($request->hasFile('image')) 

                {

                    $root = $_SERVER['DOCUMENT_ROOT'];

                    $image = $request->file('image');

                    $img = time() . '.' . $image->getClientOriginalExtension();

                    $destinationpath = public_path('Banner');

                    if (!file_exists($destinationpath)) {

                        mkdir($destinationpath, 0755, true);

                    }

                    $image->move($destinationpath, $img);

                }



                $data = $request->all();

                $data['image'] = $img;



                // Pass $id as null for new creation

                $this->banner->createOrUpdate($data);



                return redirect()->back()->with('success', 'Banner saved successfully!');

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }



    public function edit($id)

    {

         try{



            $data = $this->banner->find($id);



            echo json_encode($data);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }



    public function update(Request $request)

    {
       
        try

        {

                $id=$request->bannerId;
                $img = "";

                if ($request->hasFile('image')) 

                {

                    $root = $_SERVER['DOCUMENT_ROOT'];

                    $image = $request->file('image');

                    $img = time() . '.' . $image->getClientOriginalExtension();

                    $destinationpath = public_path('Banner');

                    if (!file_exists($destinationpath)) {

                        mkdir($destinationpath, 0755, true);

                    }

                    $image->move($destinationpath, $img);

                    $oldImg = $request->input('hiddenImage') ? $request->input('hiddenImage') : null;



                    if ($oldImg != null || $oldImg != "") {

                        if (file_exists($destinationpath . $oldImg)) {

                            unlink($destinationpath . $oldImg);

                        }

                    }

                } else {

                    $oldImg = $request->input('hiddenImage');

                    $img = $oldImg;

                }

                $data = $request->all();

                $data['image'] = $img;



                $this->banner->createOrUpdate($data, $id);



                return redirect()->route('banner.index')->with('success','Banner Updated Successfully');



        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

    public function delete(Request $request)

    {     

        try

        {



            $id=$request->bannerId;
        
            $delete = Banner::find($id);

            if ($delete) {
                $imagePath = public_path('Banner/' . $delete->image);

                if ($delete->image && file_exists($imagePath)) {
                    unlink($imagePath);
                }

                //$delete->delete(); // Delete DB record if needed
            }
        

            $this->banner->destroy($id);

            

            return back()->with('success','Banner Deleted Successfully');

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

        }

       
}

