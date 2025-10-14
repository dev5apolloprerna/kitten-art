<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceImages;

use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Service\ServiceRepository;

use App\Repositories\ServiceImages\ServiceImagesRepositoryInterface;
use App\Repositories\ServiceImages\ServiceImagesRepository;

class ServiceController extends Controller
{
     protected $Service;

    public function __construct(ServiceRepositoryInterface $Service , ServiceImagesRepositoryInterface $ServiceImages)
    {
        $this->Service = $Service;
        $this->ServiceImages = $ServiceImages;
    }
    public function index(Request $request)
    {
        $Service = Service::orderBy('service_id', 'desc')->paginate(10);

        return view('admin.service.index', compact('Service'));
    }

    public function create(Request $request)
    {
       return view('admin.service.add');
     }
    public function store(Request $request)
    {
        $request->validate([
                'service_name' => 'required', 
                'image' => 'required', 
                'description' => 'required',        
            ], [
                'service_name.required' => 'service name is required.',
                'image.required' => 'image is required.',
                'description.required' => 'description is required.',
            ]);
        try
         {
               $image = "";
               $parent_photo = "";
                if ($request->hasFile('image')) 
                {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $imagess = $request->file('image');
                    $image = time() . '.' . $imagess->getClientOriginalExtension();
                    $destinationpath =  public_path('Service');
                    if (!file_exists($destinationpath)) {
                        mkdir($destinationpath, 0755, true);
                    }
                    $imagess->move($destinationpath, $image);
                }
                

                $data = $request->all();
                $data['image'] = $image;
                // Pass $id as null for new creation
                $this->Service->createOrUpdate($data);

                return redirect()->route('service.index')->with('success', 'Service saved successfully!');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }

    public function edit(Request $request, $id)
    {
         $data = $this->Service->find($id);

         if(!($data))
            {
                return redirect()->back()->with('error','No Data Found');
            }else
            {
                return view('admin.service.edit',compact('data'));
            }
    }

    public function update(Request $request,$id)
    {
        $request->validate([
                'service_name' => 'required', 
                'description' => 'required',        
            ], [
                'service_name.required' => 'service name is required.',
                'description.required' => 'description is required.',
            ]);
        try
        {

                $img = "";
                if ($request->hasFile('image')) 
                {

                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('image');
                    $img = time() . '.' . $image->getClientOriginalExtension();
                    $destinationpath = public_path('Service');
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
                
                // Pass $id for updating an existing record
                $this->Service->createOrUpdate($data, $id);
                return redirect()->route('service.index')->with('success', 'Service Updated Successfully.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
        public function delete(Request $request)
    {
        try
        {
            $id=$request->service_id;
            
            $delete = Service::find($id);

            if ($delete) {
                $imagePath = public_path('Service/' . $delete->image);

                if ($delete->image && file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            $this->Service->destroy($id);

            return back()->with('success', 'Service Deleted Successfully!.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        
    }


    public function images($serviceId)
    {
        try
        {

            $Images= $this->ServiceImages->findByServiceId($serviceId);
            /*if(!($Images))
            {
                return redirect()->back()->with('error','No Data Found');

            }else{*/  
                 return view('admin.service.images',compact('serviceId','Images'));
            /*}*/
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
    public function uploadimages(Request $request)
    {
        try
        {   
            $id=$request->service_id;

            $this->ServiceImages->createOrUpdate($request,$id);

            return redirect()->back()->with('success','Service and images uploaded successfully!');
        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
            
    }
     public function deleteImages(Request $request)
    {
        try
        {

            $id=$request->service_image_id;
            
            $delete = ServiceImages::find($id);


            if ($delete) {
                $imagePath = public_path('Service/service_images/' . $delete->image);

                if ($delete->image && file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }


            $this->ServiceImages->destroy($id);

            return back()->with('success', 'Service Image Deleted Successfully!.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
