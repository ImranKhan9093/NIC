<?php

namespace App\Http\Controllers;

use App\Exports\AnandadharaExport;
use App\Exports\CMExport;
use App\Exports\KCCExport;
use App\Exports\KMExport;
use App\Exports\MGNREGSExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{   
    
    public function downloadCMSReport(){
        return Excel::download(new CMExport,'cm.xlsx');
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
