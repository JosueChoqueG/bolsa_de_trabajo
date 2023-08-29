<?php

namespace App\Exports;
use App\Model\JobOffer;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class JobOffersExport implements FromView
{
     public function __construct($college_id, $type, $category, $status)
    {
        $this->college_id = $college_id;
        $this->type       = $type;
        $this->category   = $category;
        $this->status     = $status;
        return $this;
    }
    public function view(): View
    {
        $college_id =  $this->college_id;
        $job_offers = JobOffer::whereHas('college_careers',function ($query) use($college_id) {
            if ($college_id) 
            $query->where('college_career.id',$college_id);
        })
        ->type($this->type)
        ->category($this->category)
        ->status($this->status)
        ->withCount('postulations')
        ->orderBy('created_at', 'desc')
        ->orderBy('status', 'DESC')
        ->get();

      
        return view('admin.report.jobOffer.table_excel', compact('job_offers'));
    }
}
