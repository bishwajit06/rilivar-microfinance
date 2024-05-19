<?php

namespace App\Imports;

use App\Models\Data;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    private $date;

    public function __construct($date) 
    {
        $this->date = $date;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $total_collection = $row['regular_receive'] + $row['dues_collection'] + $row['advance_collection'];
        $otr = ($row['regular_receive'] / $row['receivable'])*100;
        $new_due = $row['receivable'] - $row['regular_receive'];
        $inc_dic = $new_due - $row['dues_collection'];

        return new Data([
            'user_id'  => Auth::id(),
            'staff_id' => $row['staff_id'],
            'date' => $this->date,
            'disbursement' => $row['disbursement'],
            'receivable' => $row['receivable'],
            'regular_receive' => $row['regular_receive'],
            'dues_collection' => $row['dues_collection'],
            'advance_collection' => $row['advance_collection'],
            'total_collection' => $total_collection,
            'otr' => $otr,
            'new_due' => $new_due,
            'inc_dic' => $inc_dic,
        ]);
    }
}
