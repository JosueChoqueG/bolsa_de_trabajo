<?php

namespace App\Exports;
use App\Model\Candidate;
use App\Model\CollegeCareer;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class CandidatesExport implements FromView
{
     public function __construct($college_id, $sexo)
    {
        $this->college_id = $college_id;
        $this->sexo = $sexo;
        return $this;
    }
    public function view(): View
    {
        $college_id =  $this->college_id;
        $candidates =  Candidate::query()->whereHas('college_careers',function ($query) use($college_id){
                                                if ($college_id) 
                                                $query->where('college_career.id',$college_id);
                                            })
                                        ->sex($this->sexo)
                                        ->where('status',1)
                                        ->orderBy('name','ASC')
                                        ->get(); 

        return view('admin.report.candidate.table_excel', compact( 'candidates'));
    }
}
