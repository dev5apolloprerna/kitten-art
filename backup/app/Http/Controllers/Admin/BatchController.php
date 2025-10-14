<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Batch;
use App\Repositories\Batch\BatchRepositoryInterface;
use App\Repositories\Batch\BatchRepository;


class BatchController extends Controller
{
    protected $batch;

    public function __construct(BatchRepositoryInterface $batch)
    {
        $this->batch = $batch;
    }

   public function index(Request $request)
    {
         try
         {

        $batch = Batch::select('batch_master.*',DB::raw('(select category_name from category_master where category_master.category_id = batch_master.category_id limit 1) as categoryName')
            ,DB::raw('(select student_id from student_master where student_master.batch_id = batch_master.batch_id  and isPaid=1 limit 1) as student_batch_id')
            )->when($request->search, fn ($query, $search) => $query->where('batch_day', 'LIKE', "%{$search}%"))
            ->orderBy('batch_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;

            $category=Category::where(['isDelete'=>0,'iStatus'=>1])->get();

        return view('admin.batch.index', compact('batch','search','category'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }

    public function store(Request $request)
    {
        try
        {

        $batch_day=$request->batch_day;
        $batchdata = Batch::where(['batch_day'=>$batch_day,'batch_name'=>$request->batch_name])->get();
        if(sizeof($batchdata) == 0)
        {
                $batch = $this->batch->createOrUpdate($request);

                return redirect()->route('batch.index')->with('success','Batch Created Successfully');
        }else
        {
            return back()->with('error','Batch alredy exist!');
        }
        } catch (\Exception $e) 
        {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(category $category,$id)
    {
        try
        {
            $data = $this->batch->find($id);
            echo json_encode($data);
        } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    public function update(Request $request)
    {
            $id=$request->batch_id;


        try
        {

        $batch_day=$request->batch_day;
        $batchdata = Batch::where(['batch_day'=>$batch_day,'batch_name'=>$request->batch_name])->whereNotIn('batch_id', [$id])->first();

            if(empty($batchdata))
            {

                $this->batch->createOrUpdate($request,$id);
                return redirect()->route('batch.index')->with('success','Batch Updated Successfully');

            }else
            {
                return back()->with('error','Batch  alredy exist!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function destroy(Request $request)
    {     
    try{

        $id=$request->batch_id;
        $this->batch->destroy($id);
        
        return back()->with('success','Batch Deleted Successfully');
    } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
