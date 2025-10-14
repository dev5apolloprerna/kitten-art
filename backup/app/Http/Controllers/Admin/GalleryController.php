<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

use App\Repositories\Gallery\GalleryRepositoryInterface;
use App\Repositories\Gallery\GalleryRepository;

class GalleryController extends Controller
{
    protected $gallery;

    public function __construct(GalleryRepositoryInterface $gallery)
    {
        $this->gallery = $gallery;
    }
   public function index(Request $request)
    {
         try{

        $gallery = Gallery::orderBy('gallery_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;


        return view('admin.gallery.index', compact('gallery','search'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
    public function create(Request $request)
    {
        $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();

        return view('admin.gallery.add',compact('category'));
    }
    public function store(Request $request)
    {
        try
        {

               $img = "";
                if ($request->hasFile('image')) 
                {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('image');
                    $img = time() . '.' . $image->getClientOriginalExtension();
                    $destinationpath = $root . '/kitten_craft/Gallery/';
                    if (!file_exists($destinationpath)) {
                        mkdir($destinationpath, 0755, true);
                    }
                    $image->move($destinationpath, $img);
                }

                $data = $request->all();
                $data['image'] = $img;

                // Pass $id as null for new creation
                $this->gallery->createOrUpdate($data);

                return redirect()->back()->with('success', 'Gallery saved successfully!');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
         try{

            $data = $this->gallery->find($id);

            echo json_encode($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }

    public function update(Request $request,$id)
    {
        try
        {
              $img = "";
                if ($request->hasFile('image')) 
                {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('image');
                    $img = time() . '.' . $image->getClientOriginalExtension();
                    $destinationpath = $root . '/kitten_craft/Gallery/';
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

                $this->gallery->createOrUpdate($data, $id);

                return redirect()->route('gallery.index')->with('success','Plan Updated Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function delete(Request $request)
    {     
        try
        {

            $id=$request->gallery_id;
            
            $delete = Gallery::find($id);

            $root = $_SERVER['DOCUMENT_ROOT'];
            $destinationpath = $root . '/kitten_craft/Gallery/';
            if ($delete->image && file_exists($destinationpath.'/'.$delete->image)) {
                unlink($destinationpath  . $delete->image);
            }
        
        
            $this->gallery->destroy($id);
            
            return back()->with('success','Gallery Deleted Successfully');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
}
