<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EBook;

use App\Repositories\EBook\EBookRepositoryInterface;
use App\Repositories\EBook\EBookRepository;

class EBookController extends Controller
{
    protected $EBook;

    public function __construct(EBookRepositoryInterface $EBook)
    {
        $this->EBook = $EBook;
    }
   public function index(Request $request)
    {
         try{

            $EBook = EBook::orderBy('ebook_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;


             return view('admin.ebook.index', compact('EBook','search'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
    public function create(Request $request)
    {

        return view('admin.ebook.add');
    }
    public function store(Request $request)
    {
        try
        {
                $pdfFile = "";
                if ($request->hasFile('ebook_pdf')) 
                {
                
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('ebook_pdf');
                    $pdfFile = time() . '.' . $image->getClientOriginalExtension();
                    $destinationpath = $root . '/kitten_craft/EBook/';
                    if (!file_exists($destinationpath)) {
                        mkdir($destinationpath, 0755, true);
                    }
                    $image->move($destinationpath, $pdfFile);
                }

                $img = "";
                if ($request->hasFile('ebook_image')) 
                {
                
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image11 = $request->file('ebook_image');
                    $img = time() . '.' . $image11->getClientOriginalExtension();
                    $destinationpathhh = $root . '/kitten_craft/EBook/img/';
                    if (!file_exists($destinationpathhh)) {
                        mkdir($destinationpathhh, 0755, true);
                    }
                    $image11->move($destinationpathhh, $img);
                }
                $data = $request->all();
                $data['pdf'] = $pdfFile;
                $data['image'] = $img;

                // Pass $id as null for new creation
                $this->EBook->createOrUpdate($data);

                return redirect()->back()->with('success', 'E-Book saved successfully!');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }

    public function edit($id)
    {
         try{

            $data = $this->EBook->find($id);

            echo json_encode($data);
       } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }

    public function update(Request $request,$id)
    {
       
        try
        {
                    
              $pdf = "";
                if ($request->hasFile('ebook_pdf')) 
                {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('ebook_pdf');
                    $pdf = time() . '.' . $image->getClientOriginalExtension();
                    $destinationpath = $root . '/kitten_craft/EBook/';
                    if (!file_exists($destinationpath)) {
                        mkdir($destinationpath, 0755, true);
                    }
                    $image->move($destinationpath, $pdf);
                    $oldImg = $request->input('hiddenebook_pdf') ? $request->input('hiddenebook_pdf') : null;

                    if ($oldImg != null || $oldImg != "") {
                        if (file_exists($destinationpath . $oldImg)) {
                            unlink($destinationpath . $oldImg);
                        }
                    }
                } else {
                    $oldImg = $request->input('hiddenebook_pdf');
                    $pdf = $oldImg;
                }
                $img = "";
                if ($request->hasFile('ebook_image')) 
                {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image1 = $request->file('ebook_image');
                    $img = time() . '.' . $image1->getClientOriginalExtension();
                    $destinationpath11 = $root . '/kitten_craft/EBook/img/';
                    if (!file_exists($destinationpath11)) {
                        mkdir($destinationpath11, 0755, true);
                    }
                    $image1->move($destinationpath11, $img);
                    $oldImg = $request->input('hiddenebook_image') ? $request->input('hiddenebook_image') : null;

                    if ($oldImg != null || $oldImg != "") {
                        if (file_exists($destinationpath11 . $oldImg)) {
                            unlink($destinationpath11 . $oldImg);
                        }
                    }
                } else {
                    $oldImg = $request->input('hiddenebook_image');
                    $img = $oldImg;
                }

                $data = $request->all();
                $data['pdf'] = $pdf;
                $data['image'] = $img;

                // Pass $id for updating an existing record
                $this->EBook->createOrUpdate($data, $id);


                    return redirect()->route('ebook.index')->with('success','E-Book Updated Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function delete(Request $request)
    {     
    try{

        $id=$request->ebook_id;
        $this->EBook->destroy($id);
        
        return back()->with('success','E-Book Deleted Successfully');
    } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
