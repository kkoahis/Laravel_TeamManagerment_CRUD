<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeamsExport implements FromCollection, WithHeadings
{
    protected $teams;

    public function __construct($teams)
    {
        $this->teams = $teams;
    }

    public function collection()
    {
        return $this->teams;
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Department ID',
            'Created At',
            'Updated At'
        ];
    }
}
