<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfControlller extends Controller
{   

    private $pdf;
    public function __construct(DomPDFPDF $pdf)
    {
        $this->pdf=$pdf;
    }


    public function kccDownload()
    {
          
        // $kccReport = json_decode($kccReport);
        $kccReport = DB::table('kishan_credit_card')
                    ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_credit_card.reporting_year', 'kishan_credit_card.KCC_target', 'kishan_credit_card.KCC_sponsored', 'kishan_credit_card.KCC_sanctioned', 'kishan_credit_card.Percentage_sponsored', 'kishan_credit_card.posted_date', 'users.name')
                    ->join('users', 'users.id', '=', 'kishan_credit_card.user_code')
                    ->join('district', 'district.districtcd', '=', 'kishan_credit_card.districtcd')
                    ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_credit_card.subdivisioncd')
                    ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_credit_card.blockminicd')
                    ->join('month_tbl', 'month_tbl.month', '=', 'kishan_credit_card.reporting_month')
                    //   ->where('reporting_month','=',$currentMonth)
                    ->where('user_code', '=', auth()->user()->id)
                    ->get();
    
        $this->pdf->loadView('users.report_downloads.kcc_pdf', compact('kccReport'))
            ->setPaper('a4', 'landscape');

        return $this->pdf->stream('kccReport.pdf');
    }
    public function kmDownload($kmReport){
        //for Kishan  mandi pdf
        $kmReport=json_decode($kmReport);
        $this->pdf->loadView('report_downloads.km_pdf', compact('kmReport'))
                ->setPaper('a4', 'landscape');
        return $this->pdf->stream('kmReport.pdf');       
    }
    public function mgnregsDownload($mgnregsReport){
        //for mfnregs mandi pdf
        $mgnregsReport=json_decode($mgnregsReport);
        $pdf = PDF::loadView('users.report_downloads.mgnregs_pdf', compact('mgnregsReport'))
                ->setPaper('a4', 'landscape');
        return $pdf->stream('mgnregsReport.pdf');    
    }
    public function anandadharaDownload($anandadharaReport){
        //for Anandhara mandi pdf
        $anandadharaReport=json_decode($anandadharaReport);
        $pdf = PDF::loadView('users.report_downloads.anandadhara_pdf', compact('anandadharaReport'))
                ->setPaper('a4', 'landscape');
         return $pdf->stream('anandadharaReport.pdf');    
    }

    public function showExceldata(){
        

        $excelData=DB::table('block_muni')
                      ->select('block_muni.blockmuni', 
                                'kishan_credit_card.KCC_target', 
                                'kishan_credit_card.KCC_sponsored', 
                                'kishan_credit_card.KCC_sanctioned', 
                                'kishan_credit_card.Percentage_sponsored',
                                'block_muni.blockmuni', 
                                'kishan_credit_card.KCC_target', 
                                'kishan_credit_card.KCC_sponsored', 
                                'kishan_credit_card.KCC_sanctioned', 
                                'kishan_credit_card.Percentage_sponsored',
                                'kishan_mandi.KM_operational','mgnregs.tot_person_days_generate', 
                                'mgnregs.KCC_sponsored', 'mgnregs.avg_persondays_per_household', 
                                'mgnregs.percentage_of_labour_budget_achieved',
                                'anandadhara.tot_SHGs_formed', 
                                'anandadhara.tot_SHGs_credit_linkage',)
                      ->leftJoin('kishan_credit_card','block_muni.blockminicd','=','kishan_credit_card.blockminicd')
                      ->leftJoin('kishan_mandi','block_muni.blockminicd','=','kishan_mandi.blockminicd')
                      ->leftJoin('mgnregs','block_muni.blockminicd','=','mgnregs.blockminicd')
                      ->leftJoin('anandadhara','block_muni.blockminicd','=','anandadhara.blockminicd')
                      ->get();
        // dd($excelData);              
        // $kishanCreditCard=DB::table('block_muni')
        //                     ->select('block_muni.blockmuni', 'kishan_credit_card.KCC_target', 'kishan_credit_card.KCC_sponsored', 'kishan_credit_card.KCC_sanctioned', 'kishan_credit_card.Percentage_sponsored')
        //                     ->leftJoin('kishan_credit_card','block_muni.blockminicd','=','kishan_credit_card.blockminicd')
        //                     ->get();
            
        //  dd($kcc);
        // $kishanMandi=DB::table('block_muni')
        //                 ->select('kishan_mandi.KM_operational')
        //                 ->leftJoin('kishan_mandi','block_muni.blockminicd','=','kishan_mandi.blockminicd')
        //                 ->get();
        
        // dd($km);

        // $mgnregs=DB::table('block_muni')
        //             ->select( 'mgnregs.tot_person_days_generate', 'mgnregs.KCC_sponsored', 'mgnregs.avg_persondays_per_household', 'mgnregs.percentage_of_labour_budget_achieved')
        //             ->leftJoin('mgnregs','block_muni.blockminicd','=','mgnregs.blockminicd')
        //             ->get();
            
        // dd($mgnregs);
        // $anandadhara=DB::table('block_muni')
        //                 ->select('anandadhara.tot_SHGs_formed', 'anandadhara.tot_SHGs_credit_linkage')
        //                 ->leftJoin('anandadhara','block_muni.blockminicd','=','anandadhara.blockminicd')
        //                 ->get();
                
        // dd($anandadhara);
        // $data=['Kishan Credit Card'=>$kishanCreditCard,'Kishan Mandi'=>$kishanMandi,'mgnregs'=>$mgnregs,'anandadhara'=>$anandadhara];
        // foreach($data as $key=>$value){
        // $this->headings4[]=$key;
        // }
        // foreach($data as $key=>$value) {
        //   echo $key.'<br>';
        // }

        // dd('complete');
        return view('users.excel_downloads.cm_excel',compact('excelData'));
    }
}
