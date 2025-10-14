<?php

namespace App\Repositories\Ledger;



use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model



/**

 * Class LedgerRepository.

 */

use App\Models\StudentLedger;

use Hash;



class LedgerRepository implements LedgerRepositoryInterface

{

    /**

     * @return string

     *  Return the model

     */

    public function find($id)

    {

        return StudentLedger::find($id)->toArray();

    }



    public function all()

    {

        return StudentLedger::get()->toArray();

    }



     public function createOrUpdate($request, $id = null)

    {

        // If an ID is provided, update the existing record

        $ledger = $id ? StudentLedger::find($id) : new StudentLedger();



        if (!$ledger) {

            throw new \Exception('Student Ledger not found');

        }



        // Set the plan fields

        $ledger->attendence_id = $request['attendence_id'] ?? 0; // Example field

        $ledger->attendence_detail_id = $request['attendence_detail_id'] ?? 0; // Example field

        $ledger->student_id = $request['student_id'] ;

        $ledger->subscription_id = $request['subscription_id'] ?? 0; // Image field

        $ledger->opening_balance = $request['opening_balance']; // Image field

        $ledger->credit_balance = $request['credit_balance']; // Image field

        $ledger->debit_balance = $request['debit_balance']; // Image field

        $ledger->closing_balance = $request['closing_balance']; // Image field



        $ledger->save();



        return $ledger;

    }

    public function destroy($id)

    {

        StudentLedger::where('ledger_id',$id)->delete();

        

    }

}

