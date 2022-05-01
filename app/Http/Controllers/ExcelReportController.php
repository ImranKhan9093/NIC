<?php

namespace App\Http\Controllers;

use App\Exports\AnandadharaExport;
use App\Exports\CMExport;
use App\Exports\KCCExport;
use App\Exports\KMExport;
use App\Exports\MGNREGSExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{   
    
    public function downloadCMSReport(Request $request){
       
    
        $excelData=DB::table('block_muni')
                ->select('block_muni.blockmuni', 
                        'kishan_credit_card.KCC_target', 
                        'kishan_credit_card.KCC_sponsored', 
                        'kishan_credit_card.KCC_sanctioned', 
                        'kishan_credit_card.Percentage_sponsored',
                        'kishan_mandi.KM_operational',
                        'mgnregs.tot_person_days_generate', 
                        'mgnregs.avg_persondays_per_household', 
                        'mgnregs.expenditure_made_under_mgnrega',
                        'mgnregs.percentage_of_labour_budget_achieved',
                        'anandadhara.tot_SHGs_formed', 
                        'anandadhara.tot_SHGs_credit_linkage')
                ->leftJoin('kishan_credit_card','block_muni.blockminicd','=','kishan_credit_card.blockminicd')
                ->leftJoin('kishan_mandi','block_muni.blockminicd','=','kishan_mandi.blockminicd')
                ->leftJoin('mgnregs','block_muni.blockminicd','=','mgnregs.blockminicd')
                ->leftJoin('anandadhara','block_muni.blockminicd','=','anandadhara.blockminicd')
                ->get();
      
        return Excel::download(new CMExport(excelData:$excelData),'cm.xlsx');
    }
    public function KCCExcelReport(){
        return Excel::download(new KCCExport,'kcc.xlsx');
    }

    public function KMExcelReport(){
        return Excel::download(new KMExport,'km.xlsx');
    }
    public function MGNREGSReport(){
        return Excel::download(new MGNREGSExport,'mgnregs.xlsx');
    }
    public function AnandharaReport(){
       return Excel::download(new AnandadharaExport,'anandadhara.xlsx');

    }
    
}
