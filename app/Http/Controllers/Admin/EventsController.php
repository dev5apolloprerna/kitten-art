<?php

namespace App\Http\Controllers\admin;



use Illuminate\Support\Facades\DB;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Events;

use App\Repositories\Events\EventRepositoryInterface;

use App\Repositories\Events\EventRepository;





class EventsController extends Controller

{

    protected $event;



    public function __construct(EventRepositoryInterface $event)

    {

        $this->event = $event;

    }



   public function index(Request $request)

    {

         try

         {



            $event = Events::select('event_master.*',DB::raw('(select category_name from category_master where category_master.category_id = event_master.category_id limit 1) as categoryName'))->when($request->search, fn ($query, $search) => $query->where('event_name', 'LIKE', "%{$search}%"))

            ->orderBy('event_id','desc')->paginate(env('PER_PAGE_COUNT'));

            $search=$request->search;



            $category=Category::where(['isDelete'=>0,'iStatus'=>1])->get();



        return view('admin.event.index', compact('event','search','category'));

        } catch (\Exception $e) {

                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

            }

    }

    public function create()

    {

        $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();



        return view('admin.event.add',compact('category'));



    }



    public function store(Request $request)

    {

        $request->validate([
                'category_id' => 'required', 
                'event_name' => 'required', 
                'location' => 'required', 
                'Instructors' => 'required', 
                'capacity' => 'required',        
                'discounts' => 'required',        
                'from_date' => 'required',        
                'to_date' => 'required',        
                'from_time' => 'required',        
                'to_time' => 'required',        
                'image' => 'required',        
                'detail_description' => 'required',        
            ], [
                'category_id.required' => 'Please select a category.',
                'event_name.required' => 'Please select a event name.',
                'location.required' => 'Please select a location.',
                'Instructors.required' => 'Instructors is required.',
                'capacity.required' => 'capacity is required.',
                'discounts.required' => 'discounts is required',
                'student_age.integer' => 'The age must be a number.',
                'from_date.required' => 'from date is required.',
                'to_date.required' => 'to date is required.',
                'from_time.required' => 'Please select a from time.',
                'to_time.required' => 'Please select a from time.',
                'image.required' => 'image is required.',
                'detail_description.required' => 'detail description is required.',
            ]);

        try

        {

            $to_date=$request->to_date;

            $eventdata = Events::where(['to_date'=>$to_date,'from_date'=>$request->from_date])->get();

            if(sizeof($eventdata) == 0)

            {

                if ($request->hasFile('image')) 

                {

                    $root = $_SERVER['DOCUMENT_ROOT'];

                    $image = $request->file('image');

                    $img = time() . '.' . $image->getClientOriginalExtension();

                    $destinationpath = public_path('Events');

                    if (!file_exists($destinationpath)) {

                        mkdir($destinationpath, 0755, true);

                    }

                    $image->move($destinationpath, $img);

                }



                $data = $request->all();

                $data['image'] = $img;



                // Pass $id as null for new creation

                $this->event->createOrUpdate($data);



                return redirect()->route('events.index')->with('success','Event Created Successfully');

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

            $data = $this->event->find($id);

            $category=Category::where(['iStatus'=>1,'isDelete'=>0])->get();

            if(!($data))
            {
                return redirect()->route('events.index')->with('error','No Data Found');
            }else
            {

                return view('admin.event.edit',compact('data','category'));
            }
        } catch (\Exception $e) {

        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

    }

    }



    public function update(Request $request)

    {

        $id=$request->event_id;

             $request->validate([
                'category_id' => 'required', 
                'event_name' => 'required', 
                'location' => 'required', 
                'Instructors' => 'required', 
                'capacity' => 'required',        
                'discounts' => 'required',        
                'from_date' => 'required',        
                'to_date' => 'required',        
                'from_time' => 'required',        
                'to_time' => 'required',        
                'detail_description' => 'required',        
            ], [
                'category_id.required' => 'Please select a category.',
                'event_name.required' => 'Please select a event name.',
                'location.required' => 'Please select a location.',
                'Instructors.required' => 'Instructors is required.',
                'capacity.required' => 'capacity is required.',
                'discounts.required' => 'discounts is required',
                'student_age.integer' => 'The age must be a number.',
                'from_date.required' => 'from date is required.',
                'to_date.required' => 'to date is required.',
                'from_time.required' => 'Please select a from time.',
                'to_time.required' => 'Please select a from time.',
                'image.required' => 'image is required.',
                'detail_description.required' => 'detail description is required.',
            ]);

        try

        {

            $eventdata = Events::where(['to_date'=>$request->to_date,'from_date'=>$request->from_date])->whereNotIn('event_id', [$id])->first();



            if(empty($eventdata))

            {



                $img = "";

                if ($request->hasFile('image')) 

                {

                    $root = $_SERVER['DOCUMENT_ROOT'];

                    $image = $request->file('image');

                    $img = time() . '.' . $image->getClientOriginalExtension();

                    $destinationpath = public_path('Events');

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

            $this->event->createOrUpdate($data, $id);





                    return redirect()->route('events.index')->with('success','Event Updated Successfully');



            }else

            {

                return back()->with('error','Event  alredy exist!');

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

    public function delete(Request $request)

    {     

        try{

            $id=$request->event_id;
            $delete = Events::find($id);

            if ($delete) {
                $imagePath = public_path('Events/' . $delete->image);

                if ($delete->image && file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $this->event->destroy($id);

        

        return back()->with('success','Event Deleted Successfully');

    } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());

        }

    }

}

