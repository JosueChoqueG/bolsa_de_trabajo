<?php

namespace App\Exports;
use App\Model\Employer;
use App\Model\Sector;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class EmployersExport implements FromView
{
     public function __construct($sector, $status)
    {
        $this->sector = $sector;
        $this->status = $status;
        return $this;
    }
    public function view(): View
    {
        $employers = Employer::with(['sector'])
                            ->status($this->status)
                            ->sector($this->sector)
                            ->orderBy('status','ASC')
                            ->get(); 


        
       return view('admin.report.employer.table_excel', compact( 'employers'));
    }
}
