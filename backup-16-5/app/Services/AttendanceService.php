<?php 

namespace App\Services;



use App\Repositories\StudentAttendanceMaster\StudentAttendanceMasterRepository;

use App\Repositories\StudentAttendance\StudentAttendanceRepository;

use App\Repositories\Ledger\LedgerRepository;

use Illuminate\Support\Facades\DB;



use App\Models\StudentAttendanceMaster;

use App\Models\StudentAttendance;

use App\Models\StudentLedger;



class AttendanceService

{

    protected $attendanceMasterRepo;

    protected $attendanceRepo;

    protected $ledgerRepo;



    public function __construct(
        StudentAttendanceMasterRepository $attendanceMasterRepo,
        StudentAttendanceRepository $attendanceRepo,
        LedgerRepository $ledgerRepo
    ) {
        $this->attendanceMasterRepo = $attendanceMasterRepo;
        $this->attendanceRepo = $attendanceRepo;
        $this->ledgerRepo = $ledgerRepo;
    }
   public function storeAttendance(array $masterData, array $attendanceData, array $ledgerData)
    {
        DB::beginTransaction();
        try {
            // Create or update the attendance master
            $attendanceMaster = StudentAttendanceMaster::updateOrCreate(
                ['sattendanceid' => $masterData['sattendanceid'] ?? null], // Check if the sattendanceid exists
                $masterData // If exists, update it, else create a new one
            );

            // Create or update the attendance record
            $attendance = StudentAttendance::updateOrCreate(
                ['attendence_id' => $attendanceData['attendence_id'] ?? null], // Check if the attendance record exists
                [
                    'sattendanceid' => $attendanceMaster->sattendanceid,
                    'student_id' => $attendanceData['student_id'],
                    'batch_id' => $attendanceData['batch_id'],
                    'plan_id' => $attendanceData['plan_id'],
                    'subscription_id' => $attendanceData['subscription_id'],
                    'day' => $attendanceData['day'],
                    'attendance' => $attendanceData['attendance'],
                ]
            );

            // Create or update ledger data if provided
            /*if (!empty($ledgerData)) 
            {
                // Assuming ledger_id exists, you can check and update or create ledger
                StudentLedger::updateOrCreate(
                    ['attendence_id' => $attendanceMaster->sattendanceid, 'attendence_detail_id' => $attendance->attendence_id],
                    [
                        'student_id' => $ledgerData['student_id'],
                        'opening_balance' => $ledgerData['opening_balance'],
                        'credit_balance' => $ledgerData['credit_balance'],
                        'debit_balance' => $ledgerData['debit_balance'],
                        'closing_balance' => $ledgerData['closing_balance'],
                    ]
                );
            }*/

            // Create or update ledger data if provided
            if (!empty($ledgerData)) 
            {
                // Always insert a new ledger row (no update)
                StudentLedger::create([
                    'attendence_id' => $attendanceMaster->sattendanceid,
                    'attendence_detail_id' => $attendance->attendence_id,
                    'subscription_id' => $ledgerData['subscription_id'],
                    'student_id' => $ledgerData['student_id'],
                    'opening_balance' => $ledgerData['opening_balance'],
                    'credit_balance' => $ledgerData['credit_balance'],
                    'debit_balance' => $ledgerData['debit_balance'],
                    'closing_balance' => $ledgerData['closing_balance'],
                ]);
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
?>