<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EBookRegister;
use Illuminate\Support\Facades\DB;

use App\Repositories\Inquiry\InquiryRepositoryInterface;
use App\Repositories\Inquiry\InquiryRepository;

class InquiryController extends Controller
{
       protected $inquiry;

    public function __construct(InquiryRepositoryInterface $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function index()
    {
        try{

            $inquiries = EBookRegister::select('ebook_registration.*',DB::raw('(select ebook_name from ebook_master where ebook_registration.ebook_id = ebook_master.ebook_id  limit 1) as ebookName'))->orderBy('ebook_registration_id','desc')->paginate(10);
            return view('admin.inquiries.index', compact('inquiries'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
    public function view($id)
    {
        try{
                $inquiry = EBookRegister::find($id);
                return view('admin.inquiries.view', compact('inquiry'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
    public function delete(Request $request)
    {
        try
        {

            $id=$request->ebook_registration_id;
            
            EBookRegister::where('ebook_registration_id','=',$id)->delete();

            return redirect()->route('Inquiry.index')->with('success', 'Deleted Successfully!.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
}
