<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;


class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }
   public function index(Request $request)
    {
         try{

        $category = Category::select('category_master.*',DB::raw('(select student_id from student_master where student_master.category_id = category_master.category_id and	isPaid=1 limit 1) as student_category_id'))
            ->when($request->search, fn ($query, $search) => $query->where('category_name', 'LIKE', "%{$search}%"))
            ->where(['isDelete'=>0])
            ->orderBy('category_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;


        return view('admin.category.index', compact('category','search'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }

    public function store(Request $request)
    {
            $request->validate([
                'category_name'=>'required'
            ]);
        try
        {

            $category_name=$request->category_name;
            $category = Category::where(['category_name'=>$category_name,'isDelete'=>0])->first();

        if(empty($category))
        {
               $category = $this->category->createOrUpdate($request);

                return redirect()->route('category.index')->with('success','category Created Successfully');
        }else
        {
            return back()->with('error','category Name alredy exist!');
        }
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(category $category,$id)
    {
        try
        {
            $data = $this->category->find($id);
                echo json_encode($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, category $category)
    {
            $id=$request->category_id;
            $request->validate([
                'category_name'=>'required'
            ]);
        try
        {
            
            $category_name=$request->category_name;
            $category = Category::where(['category_name'=>$category_name,'isDelete'=>0])->whereNotIn('category_id', [$id])->first();

            if(empty($category))
            {
                $this->category->createOrUpdate($request,$id);

                    return redirect()->route('category.index')->with('success','category Updated Successfully');

            }else
            {
                return back()->with('error','category Name alredy exist!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function delete(Request $request)
    {     
        try
        {
            $id=$request->category_id;

            $data['isDelete']=1;
            $this->category->changeStatus($data,$id);
        
        return back()->with('success','Category Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
