<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Candidate;
use App\Model\CollegeCareer;
use App\Model\Employer;
use App\Model\Sector;
use App\Model\JobOffer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CandidatesExport;
use App\Exports\EmployersExport;
use App\Exports\JobOffersExport;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Session;
class ReportController extends Controller
{
    public function registeredUsers(Request $request)
    {
        
        $candidates = Candidate::whereHas('college_careers',function ($query) use($request) {
                                    if ($request->college_id) 
                                    $query->where('college_career.id',$request->college_id);
                                })
                                ->sex($request->sexo)
                                ->where('status',1)
                                ->orderBy('name','ASC')
                                ->paginate(15);

        $colleges = CollegeCareer::where('visibility','1')->get();

        $pagination = true;
        $type = 'vista';
        $college_career = null;
        $sexo = null;

        if ($request->ajax()) 
        {
            return response()->json(view('admin.report.candidate.partial', compact( 'candidates' ,'colleges','pagination', 'college_career','sexo','type'))->render()); 
        }
        else
        {
            return view('admin.report.candidate.index', compact( 'candidates','colleges' ,'pagination', 'college_career','sexo'))->render();
        }
    }

    public function candidateExcelDownload(Request $request)
    {
        $college_id = $request->college_id;
        $sex = $request->sexo;
        return Excel::download( new CandidatesExport($college_id, $sex), 'estudiantes_egresados.xlsx');
    }

    public function candidatePdfDownload(Request $request)
    {
        $candidates = Candidate::whereHas('college_careers',function ($query) use($request) {
            if ($request->college_id) 
            $query->where('college_career.id',$request->college_id);
        })
        ->sex($request->sexo)
        ->where('status',1)
        ->orderBy('name','ASC')
        ->get();

        $pagination = false;
        $type = 'pdf';

        if($request->college_id)
            $college_career = CollegeCareer:: where('id',$request->college_id)->first();
        else
            $college_career = null;

        if($request->sexo)
        {
            if($request->sexo == 'F')
            $sexo =  'Femenino';
            else
            $sexo = 'Masculino';
        }

        else
            $sexo = null;
        
        $pdf = PDF::loadView('admin.report.candidate.table_pdf', compact( 'candidates' ,'pagination', 'college_career','sexo','type'));
     return $pdf->download('estudiantes_egresados.pdf');
       //return $pdf->stream("estudiantes_egresados.pdf", array("Attachment" => false));
    }

   public function registeredEmployers(Request $request)
    {
        $employers = Employer::with(['sector'])
        ->status($request->status)
        ->sector($request->sector_id)
        ->orderBy('status','ASC')
        ->paginate(15); 
        $sectors = Sector::all();
        $pagination = true;
        $sector = $request->sector_id;
        $status = $request->status;
        
        if ($request->ajax()) 
        {
            return response()->json(view('admin.report.employer.partial', compact( 'employers' ,'sectors','pagination', 'status','sector'))->render()); 
        }
        else
        {
            return  view('admin.report.employer.index', compact( 'employers' ,'sectors','pagination','sector'));;
        }
        
    }
    public function employerExcelDownload(Request $request)
    {
        $sector = $request->sector_id;
        $status = $request->status;
        return Excel::download( new EmployersExport($sector, $status), 'empresas_entidades.xlsx');
    }

    public function employerPdfDownload(Request $request)
    {
        $employers = Employer::with(['sector'])
        ->status($request->status)
        ->sector($request->sector_id)
        ->orderBy('status','ASC')
        ->get(); 

        
        $pdf = PDF::loadView('admin.report.employer.table_pdf', compact( 'employers'));
        // return $pdf->download('empresas_entidades.pdf');
        return $pdf->stream("empresas_entidades.pdf", array("Attachment" => false));
    }
//job offer......................................................
    public function registeredJobOffers(Request $request)
    {
        $colleges   = CollegeCareer::where('visibility','1')->get();
        $job_offers = JobOffer::whereHas('college_careers',function ($query) use($request) {
                                        if ($request->college_id) 
                                        $query->where('college_career.id',$request->college_id);
                                    })
                                    ->type($request->type)
                                    ->category($request->category)
                                    ->status($request->status)
                                    ->withCount('postulations')
                                    ->orderBy('created_at', 'desc')
                                    ->orderBy('status', 'DESC')
                                    ->paginate(15);
       
        $pagination = true;
        $type = 'pdf';

        if ($request->ajax()) 
            return response()->json( view('admin.report.jobOffer.partial', compact( 'colleges','job_offers', 'pagination','type'))->render()); 


        else
            return  view('admin.report.jobOffer.index', compact( 'colleges','job_offers', 'pagination','type'));
        
        
    }

    public function jobOfferExcelDownload(Request $request)
    {
        $college_id = $request->college_id;
        $type       = $request->type;
        $category   = $request->category;
        $status     = $request->status;
        return Excel::download( new JobOffersExport($college_id, $type,$category,$status), 'OfertasLaborales.xlsx');
    }

    public function jobOfferPdfDownload(Request $request)
    {
        $job_offers = JobOffer::whereHas('college_careers',function ($query) use($request) {
                                        if ($request->college_id) 
                                        $query->where('college_career.id',$request->college_id);
                                    })
                                    ->type($request->type)
                                    ->category($request->category)
                                    ->status($request->status)
                                    ->withCount('postulations')
                                    ->orderBy('created_at', 'desc')
                                    ->orderBy('status', 'DESC')
                                    ->get();


        
        $pdf = PDF::loadView('admin.report.jobOffer.table_pdf', compact('job_offers'));
        // return $pdf->download('Ofertas_laborales.pdf');
        return $pdf->stream("Ofertas_laborales.pdf", array("Attachment" => false));

    }


}
