<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentInquiry;
use App\Models\Plan;
use App\Models\Category;
use App\Models\Batch;
use Illuminate\Support\Facades\DB;

use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\Contact\ContactRepository;

use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Student\StudentRepository;

class StudentInquiryController extends Controller
{
       protected $student;
       protected $inquiry;

    public function __construct(ContactRepositoryInterface $inquiry ,StudentRepositoryInterface $student)
    {
        $this->inquiry = $inquiry;
        $this->student = $student;
    }

    public function index(Request $request)
    {
        try{

            $Student = StudentInquiry::select('student_inquiry_master.*',DB::raw('(select plan_name from plan_master where plan_master.planId = student_inquiry_master.plan_id limit 1) as planName')
            ,DB::raw('(select category_name from category_master where category_master.category_id = student_inquiry_master.category_id limit 1) as categoryName')
            ,DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_inquiry_master.batch_id limit 1) as batchName')


        )->when($request->search, fn ($query, $search) => $query->where('student_name', 'LIKE', "%{$search}%"))
            ->orderBy('student_inquiry_id','desc')->paginate(env('PER_PAGE_COUNT'));
            $search=$request->search;


        return view('admin.student_inquiry.index', compact('Student','search'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
     
    public function view($id)
    {
        $data=StudentInquiry::select('student_inquiry_master.*'
            ,DB::raw('(select category_name from category_master where category_master.category_id = student_inquiry_master.category_id limit 1) as categoryName')
            ,DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_inquiry_master.batch_id limit 1) as batchName')
            ,DB::raw('(select plan_name from plan_master where plan_master.planId = student_inquiry_master.plan_id limit 1) as planName')

        )->where(['student_inquiry_id'=>$id])->first();
         if(empty($Student))
        {
            return redirect()->route('studentinquiry.index')->with('error','No Data Found');
        }else{
        return view('admin.student_inquiry.show',compact('data'));
    }
    }
    public function edit($id)
    {
        try{

            $data = $this->inquiry->find($id);

            if (!$data) {  // More concise way to check if data is empty/null
                    return redirect()->back()->with('error', 'No Data Found');
                }

            $plans=Plan::all();
            $batches=Batch::all();
            $category=Category::all();

            if(!($data))
            {
                return redirect()->route('studentinquiry.index')->with('error','No Data Found');
            }else{

                return view('admin.student_inquiry.edit',compact('data','plans','category','batches'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
         }
    }

    public function update(Request $request, $id)
    {
        try
        {   
            $this->inquiry->createOrUpdate($request, $id);
            

            return redirect()->route('studentinquiry.index')->with('success','Student Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatestatus(Request $request)
    {
        try{

        $id=$request->student_inquiry_id;

        if($request->status == 2)
        {

            $studentinquiry=StudentInquiry::find($id);  
            $this->student->createOrUpdate($studentinquiry->toArray());

            $this->inquiry->destroy($id);
             return redirect()->back()->with('success','Student Inquiry Accepted');
        }else{
        
        $status = $request->status; // Assuming the status comes from the request
        $this->inquiry->updateStatus(['status' => $status], $id);
            
        return redirect()->back()->with('success','Student Inquiry Status Changes Successfully');

        }
         } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }


    public function delete(Request $request)
    {
        try{

            $id=$request->student_id;
            $this->inquiry->destroy($id);
        return redirect()->route('studentinquiry.index')->with('success', 'Deleted Successfully!.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
}
