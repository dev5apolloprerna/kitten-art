<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Testimonial;

use App\Repositories\Testimonial\TestimonialRepositoryInterface;
use App\Repositories\Testimonial\TestimonialRepository;

class TestimonialController extends Controller
{
     protected $testimonial;

    public function __construct(TestimonialRepositoryInterface $testimonial)
    {
        $this->testimonial = $testimonial;
    }
    public function index(Request $request)
    {
        $Testimonial = Testimonial::orderBy('testimonial_id', 'desc')->paginate(10);

        return view('admin.testimonial.index', compact('Testimonial'));
    }

    public function create(Request $request)
    {
       return view('admin.testimonial.add');
     }
    public function store(Request $request)
    {
        try
         {
            $student_photo = "";
            $parent_photo = "";
            
            if ($request->hasFile('student_photo')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image1 = $request->file('student_photo');
                $student_photo = time() . '_' . uniqid() . '.' . $image1->getClientOriginalExtension();
                $destinationpath = $root . '/kitten_craft/Testimonial/';
                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $image1->move($destinationpath, $student_photo);
            }
            
            if ($request->hasFile('parent_photo')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image2 = $request->file('parent_photo');
                $parent_photo = time() . '_' . uniqid() . '.' . $image2->getClientOriginalExtension();
                $destinationpath1 = $root . '/kitten_craft/Testimonial/';
                if (!file_exists($destinationpath1)) {
                    mkdir($destinationpath1, 0755, true);
                }
                $image2->move($destinationpath1, $parent_photo);
            }
            
            $data = [
                'student_name' => $request->student_name,
                'parent_photo' => $parent_photo,
                'student_photo' => $student_photo,
                'parent_name' => $request->parent_name,
                'description' => $request->description,
            ];
            
            $this->testimonial->createOrUpdate($data);

                return redirect()->route('testimonial.index')->with('success', 'Testimonial saved successfully!');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }

    public function edit(Request $request, $id)
    {
        $data = $this->testimonial->find($id);

        return view('admin.testimonial.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        try{

                $student_photo = "";
                if ($request->hasFile('student_photo')) 
                {

                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('student_photo');
                    $student_photo = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $destinationpath = $root . '/kitten_craft/Testimonial/';
                    if (!file_exists($destinationpath)) {
                        mkdir($destinationpath, 0755, true);
                    }
                    $image->move($destinationpath, $student_photo);
                    $oldImg = $request->input('hiddenImage1') ? $request->input('hiddenImage1') : null;

                    if ($oldImg != null || $oldImg != "") {
                        if (file_exists($destinationpath . $oldImg)) {
                            unlink($destinationpath . $oldImg);
                        }
                    }
                } else {
                    $oldImg = $request->input('hiddenImage1');
                    $student_photo = $oldImg;
                }

                $parent_photo = "";
                if ($request->hasFile('parent_photo')) 
                {

                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('parent_photo');
                    $parent_photo = time() . '_' . uniqid() . '.' .  $image->getClientOriginalExtension();
                    $destinationpath1 = $root . '/kitten_craft/Testimonial/';
                    if (!file_exists($destinationpath1)) {
                        mkdir($destinationpath1, 0755, true);
                    }
                    $image->move($destinationpath1, $parent_photo);
                    $oldImg = $request->input('hiddenImage2') ? $request->input('hiddenImage2') : null;

                    if ($oldImg != null || $oldImg != "") {
                        if (file_exists($destinationpath1 . $oldImg)) {
                            unlink($destinationpath1 . $oldImg);
                        }
                    }
                } else {
                    $oldImg = $request->input('hiddenImage2');
                    $parent_photo = $oldImg;
                }
                    $data = [
                        'student_name' => $request->student_name,
                        'parent_photo' => $parent_photo,
                        'student_photo' => $student_photo,
                        'parent_name' => $request->parent_name,
                        'description' => $request->description,
                    ];


                // Pass $id for updating an existing record
                $this->testimonial->createOrUpdate($data, $id);



        return redirect()->route('testimonial.index')->with('success', 'Testimonial Updated Successfully.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
    public function updatestatus(Request $request)
    {
        try{

        $id = $request->testimonial_id;
        $status = $request->status; // Assuming the status comes from the request
        $this->testimonial->updateStatus(['status' => $status], $id);

        return redirect()->route('testimonial.index')->with('success', 'Testimonial Status Updated Successfully!');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }


    public function delete(Request $request)
    {
        try{

            $id=$request->testimonial_id;
            
            
             $delete = Testimonial::find($id);

            $root = $_SERVER['DOCUMENT_ROOT'];
            $destinationpath = $root . '/kitten_craft/Testimonial/';
            if ($delete->parent_photo && file_exists($destinationpath.'/'.$delete->parent_photo)) {
                unlink($destinationpath  . $delete->parent_photo);
            }
            if ($delete->student_photo && file_exists($destinationpath.'/'.$delete->student_photo)) {
                unlink($destinationpath  . $delete->student_photo);
            }
                    $this->testimonial->destroy($id);

        

            return back()->with('success', 'Testimonial Deleted Successfully!.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
}
