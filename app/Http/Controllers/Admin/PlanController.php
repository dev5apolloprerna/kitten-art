<?php

namespace App\Http\Controllers\admin;



use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Plan;



use App\Repositories\Category\CategoryRepositoryInterface;

use App\Repositories\Category\CategoryRepository;



use App\Repositories\Plan\PlanRepositoryInterface;

use App\Repositories\Plan\PlanRepository;

use Illuminate\Validation\Rule;



class PlanController extends Controller

{

    protected $category;

    protected $plan;



    public function __construct(CategoryRepositoryInterface $category,PlanRepositoryInterface $plan)

    {

        $this->plan = $plan;

        $this->category = $category;

    }

   public function index(Request $request)

    {

         try

        {

            $plan = Plan::select('plan_master.*',DB::raw('(select category_name from category_master where category_master.category_id = plan_master.category_id  limit 1) as categoryName'),DB::raw('(select student_id from student_master where student_master.plan_id = plan_master.planId and isPaid=1 limit 1) as student_plan_id'))->when($request->search, fn ($query, $search) => $query->where('plan_name', 'LIKE', "%{$search}%"))
                ->where(['isDelete'=>0])
            ->orderBy('planId','desc')->paginate(env('PER_PAGE_COUNT'));

            $search=$request->search;





        return view('admin.plan.index', compact('plan','search'));

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }

    public function create(Request $request)

    {

        $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();



        return view('admin.plan.add',compact('category'));

    }

    public function store(Request $request)
    {
            $validated = $request->validate([

                'plan_name' => [
                    'required',
                    Rule::unique('plan_master', 'plan_name')
                        ->where('category_id', $request->input('category_id')) // Unique per category
                        ->where('isDelete', 0), // Unique per category
                ],

                'category_id' => 'required|exists:category_master,category_id', // Ensure category exists
                'plan_description' => 'required', // Ensure description is provided
                'plan_session' => 'required', // Ensure description is provided
                'plan_amount' => 'required', // Ensure description is provided
                'plan_image' => 'required', // Ensure description is provided
                'detail_description' => 'required', // Ensure description is provided
            ]);


        try

        {

            



               $img = "";

                if ($request->hasFile('plan_image')) {

                    $root = $_SERVER['DOCUMENT_ROOT'];

                    $image = $request->file('plan_image');

                    $img = time() . '.' . $image->getClientOriginalExtension();

                    $destinationpath = public_path('plan_image');

                    if (!file_exists($destinationpath)) {

                        mkdir($destinationpath, 0755, true);

                    }

                    $image->move($destinationpath, $img);

                }



                $data = $request->all();

                $data['plan_image'] = $img;



                // Pass $id as null for new creation

                $this->plan->createOrUpdate($data);



                return redirect()->route('plan.index')->with('success', 'Plan saved successfully!');



            

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }



    public function edit(plan $plan,$id)

    {

        try{



            $data = $this->plan->find($id);

            $category= $this->category->all();





        return view('admin.plan.edit',compact('data','category'));



        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

         }

    }



    public function update(Request $request, plan $plan,$id)

    {



         $request->validate([

            'plan_name' => [

                'required',

                Rule::unique('plan_master', 'plan_name')

                    ->where('category_id', $request->input('category_id'))
                    ->where('isDelete', 0)
                    ->ignore($id, 'planId'),

            ],

            'category_id' => 'required|exists:category_master,category_id', // Ensure category is valid
            'plan_description' => 'required', // Ensure description is provided
            'plan_session' => 'required', // Ensure description is provided
            'plan_amount' => 'required', // Ensure description is provided
            'detail_description' => 'required', // Ensure description is provided

        ]);



        try

        {

              $img = "";

                if ($request->hasFile('plan_image')) 

                {

                    $root = $_SERVER['DOCUMENT_ROOT'];

                    $image = $request->file('plan_image');

                    $img = time() . '.' . $image->getClientOriginalExtension();

                    $destinationpath =  public_path('plan_image');

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

            $data['plan_image'] = $img;



            // Pass $id for updating an existing record

            $this->plan->createOrUpdate($data, $id);







             return redirect()->route('plan.index')->with('success','Plan Updated Successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

    public function delete(Request $request)

    {     

         try

        {

            $id=$request->planId;

            

            $delete = Plan::find($id);

            $destinationPath = public_path('plan_image'); // Correct path

            if (!empty($delete->plan_image)) { // Ensure image name exists
                $imagePath = $destinationPath . '/' . $delete->plan_image; // Construct path

                if (file_exists($imagePath)) { // Check file existence
                    unlink($imagePath); // Delete file
                }
            }


        

            $data['isDelete']=1;
            $this->plan->changeStatus($data,$id);

            

            return back()->with('success','Plan Deleted Successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

}

