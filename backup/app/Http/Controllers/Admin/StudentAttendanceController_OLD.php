<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentAttendanceMaster;
use App\Models\StudentLedger;
use App\Models\Batch;
use Illuminate\Support\Facades\DB;

use App\Services\AttendanceService;
use Illuminate\Support\Carbon;

class StudentAttendanceController extends Controller
{
     protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }
    public function index(Request $request)
    {
        try
        {
                $dayNumber = date('N');

                $Student = Student::select(
                    'student_master.*',
                    DB::raw('(select category_name from category_master where category_master.category_id = student_master.category_id limit 1) as categoryName'),
                    DB::raw('(select plan_name from plan_master where plan_master.planId = student_master.plan_id limit 1) as planName'),
                    DB::raw('(select plan_amount from plan_master where plan_master.planId = student_master.plan_id limit 1) as amount'),
                    DB::raw('(select batch_name from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchname'),
                    DB::raw('(select batch_day from batch_master where batch_master.batch_id = student_master.batch_id limit 1) as batchday')
                )
                ->when($request->search, function ($query, $search) {
                    return $query->where('student_name', 'LIKE', "%{$search}%");
                })
                ->when($request->batch, function ($query, $batchsearch) {
                    return $query->where('student_master.batch_id', $batchsearch);
                });

                if (empty($request->search) && empty($request->batch)) 
                {
                    $Student->leftJoin(DB::raw("(SELECT student_id, MAX(day) as latest_day, attendance 
                                                 FROM student_attendance 
                                                 GROUP BY student_id) as sa"), 
                                       'sa.student_id', '=', 'student_master.student_id')
                            ->where(function ($query) use ($dayNumber) {
                                $query->whereNull('sa.attendance')
                                      ->orWhere('sa.attendance', '!=', 'P')
                                      ->orWhere('sa.latest_day', '!=', $dayNumber);
                            });
                        $Student->where(['batch_master.batch_day'=>$dayNumber]);

                }

                $Student = $Student->where([
                    'isWaiting' => 0,
                    'isRegister' => 1,
                    'isPaid' => 1
                ])
                ->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')
                ->distinct()
                ->orderBy('student_id', 'desc')
                ->paginate(env('PER_PAGE_COUNT'));



            $search=$request->search;
            $batch=$request->batch;

            $batchdata=Batch::where(['iStatus'=>1,'isDelete'=>0])->get();


        return view('admin.student_attendance.index', compact('Student','search','batch','batchdata'));
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     
   public function markAttended(Request $request)
    {
        $studentIds = $request->input('student_ids');

        //$dayNumber = date('N');
        $batch = Student::whereIn('student_master.student_id',$studentIds)->join('batch_master', 'batch_master.batch_id', '=', 'student_master.batch_id')->first();

        /*if (!$batch) {
            return response()->json(['message' => 'No batch found for today!'], 404);
        }*/


        if (empty($studentIds)) {
            return response()->json(['message' => 'No students selected!'], 400);
        }

        $masterData = [
            'attendance_date' => date('Y-m-d'),
            'batch_id' => $batch->batch_id,
        ];

            $today = Carbon::today();

        $attendance = StudentAttendance::whereNotIn('student_id', $studentIds)->whereDate('created_at', '!=', $today)->get();
        
        if(sizeof($attendance) == 0)
        {
            foreach ($studentIds as $studentId) 
            {

                $session = Student::select('student_master.student_id', 'plan_master.plan_session')
                    ->where('student_master.student_id', $studentId)
                    ->join('plan_master', 'plan_master.planId', '=', 'student_master.plan_id')
                    ->first();

                if (!$session) 
                {
                    return response()->json(['message' => "Plan session not found for student ID: $studentId"], 404);
                }

                $attendanceData = [
                    'student_id' => $studentId,
                    'attendance' => 'P',
                    'batch_id' => $batch->batch_id,
                    'day' => $batch->batch_day,
                ];

                $ledger = StudentLedger::where('student_id', $studentId)->latest()->first();

                if ($ledger) 
                {
                    $used_session = 1;

                    $new_opening_balance = $ledger->closing_balance;
                    $new_credit_balance = $ledger->credit_balance - $used_session;
                    $new_debit_balance = $ledger->debit_balance + $used_session;
                    $new_closing_balance = $new_opening_balance - $used_session;

                    $ledgerData = [
                        'student_id' => $studentId,
                        'opening_balance' => $new_opening_balance,
                        'credit_balance' => $new_credit_balance,
                        'debit_balance' => $new_debit_balance,
                        'closing_balance' => $new_closing_balance,
                    ];
                }

                $this->attendanceService->storeAttendance($masterData, $attendanceData, $ledgerData);
            }
        return response()->json(['message' => 'Students marked as attended successfully!']);

        }else{
            return response()->json(['message' => 'Students already attended successfully!']);
    
        }

    }
    public function delete(Request $request)
    {
        try{

            $id=$request->student_id;
            $this->inquiry->destroy($id);
        return redirect()->route('attendance.index')->with('success', 'Attendance Deleted Successfully!.');
        } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
    }
}
