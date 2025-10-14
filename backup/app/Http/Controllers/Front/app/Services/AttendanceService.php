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

                $attendanceMaster = StudentAttendanceMaster::create($masterData);

                // Store attendance details
                $attendance = StudentAttendance::create([
                    'sattendanceid' => $attendanceMaster->sattendanceid,
                    'student_id' => $attendanceData['student_id'],
                    'batch_id' => $attendanceData['batch_id'],
                    'day' => $attendanceData['day'],
                    'attendance' => $attendanceData['attendance'],
                ]);
            if(!empty($ledgerData))
            {
                StudentLedger::create([
                    'attendence_id' => $attendanceMaster->sattendanceid,
                    'attendence_detail_id' => $attendance->attendence_id,
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