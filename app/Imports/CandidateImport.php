<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Model\Candidate;
use App\Model\CandidateCollege;
use DB;

class CandidateImport implements ToCollection,WithHeadingRow,WithChunkReading,WithBatchInserts,WithValidation
{
    
    public function collection(Collection $collection)
    {
            foreach ($collection as $key => $value) 
            { 
                $dni = trim((string)$value['dni']);
                $codigo = trim((string)$value['codigo']);
                if(strlen($dni) == 8 && strlen($codigo) == 6 )
                {
                    $candidate = Candidate::where('document',trim((string)$value['dni']))->first(); 
                    // if($candidate && $candidate->email == ''){
                    //     $candidate->email  = trim($value['email']);
                    //     $candidate->save();
                    // }
                    if($candidate)
                    {
                        //actualizamos
                        $candidate->name            = trim($value['nombres']);
                        $candidate->first_lastname  = trim($value['apellido_paterno']);
                        $candidate->second_lastname = trim($value['apellido_materno']);
                        $candidate->first_phone     = trim($value['telefono']);
                        $candidate->email           = trim($value['email']);
    
                        
                        if(! is_null($value['sexo']) || $value['sexo'] !=''){
                            $candidate->gender             = ($value['sexo']==1)?'M':'F';
                        }
                    
                        $candidate->save();
                        //datos academicos
                        $candidateCollege = CandidateCollege::where('candidate_id',$candidate->id)->where('code',trim($value['codigo']))->first();
                        
                        if($candidateCollege)
                        {
                            $candidateCollege->college_id = trim($value['id_carrera']);
                            $candidateCollege->save();
                        }
                        else{
                            $candidateCollege             = new CandidateCollege();
                            $candidateCollege->code       = trim($value['codigo']);
                            $candidateCollege->candidate_id = $candidate->id;
                            $candidateCollege->college_id = trim($value['id_carrera']);
                            $candidateCollege->save();
                        }
                    }
                    else
                    {
                        //insertamos
                        $candidate                  = new Candidate();
                        $candidate->document        = trim($value['dni']);
                        $candidate->name            = trim($value['nombres']);
                        $candidate->first_lastname  = trim($value['apellido_paterno']);
                        $candidate->second_lastname = trim($value['apellido_materno']);
                        $candidate->first_phone     = trim($value['telefono']);
                        $candidate->email           = trim($value['email']);
    
                        if(! is_null($value['sexo']) || $value['sexo'] !=''){
                            $candidate->gender             = ($value['sexo']==1)?'M':'F';
                        }
                        $candidate->save();
                        //datos academicos
                        $candidateCollege               = new CandidateCollege();
                        $candidateCollege->code         = trim($value['codigo']);
                        $candidateCollege->candidate_id = $candidate->id;
                        $candidateCollege->college_id   = trim($value['id_carrera']);
                        $candidateCollege->save();
                    }     
                }
               
            }
    }
    public function chunkSize(): int
    {
        return 500;
    }
    public function batchSize(): int
    {
        return 500;
    }
    public function rules(): array
    {
        return [
            'dni' => 'digits:8',
            'codigo'=> 'digits:6',
            'id_carrera' => 'exits:collge_career,id',
        ];
    }
}
