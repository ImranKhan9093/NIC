<?php

namespace App\Http\Controllers\Kcc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KccController extends Controller
{


    //checking for available data 
    public function checkKccData(Request $request){
 

        $request->validate([
            'district' => 'exists:district,districtcd',
             'subdivision' => 'exists:subdivision,subdivisioncd',
             'municipality' => 'exists:block_muni,blockminicd',
             'month' => 'exists:month_tbl,month',
             'year' => 'exists:years,year',
            
        ]);


        $conditions=[ 
            "districtcd" => $request->post('district'),
            "subdivisioncd" => $request->post('subdivision'),
            "blockminicd" => $request->post('municipality'),
            "reporting_month" => $request->post('month'),
            "reporting_year" => $request->post('year'),
          
        ];
        $data=DB::table('kishan_credit_card')
            ->where($conditions)
            ->first();
         

        if($data){
            return response()->json($data);
        }else{
            return;
        }    
    }
  


     //code for inserting data into tables
     public function insertToKccTable(Request $request)
     {
         //  dd($request->all());
      
         $request->validate([
             'district' => 'exists:district,districtcd',
             'subdivision' => 'exists:subdivision,subdivisioncd',
             'month' => 'exists:month_tbl,month',
             'year' => 'exists:years,year',
             'municipality' => 'exists:block_muni,blockminicd',
             'target' => ['required', 'integer', 'min:1'],
             'kcc_sponsored' => ['required', 'integer', 'min:1'],
             'kcc_sanctioned' => ['required', 'integer', 'min:1'],
         ]);
 
         $percentageSponsored = number_format(($request->post('kcc_sponsored') * 100) / $request->post('target'), 2);
 
        
         
         $conditions=[ 
             "districtcd" => $request->post('district'),
             "subdivisioncd" => $request->post('subdivision'),
             "blockminicd" => $request->post('municipality'),
             "reporting_month" => $request->post('month'),
             "reporting_year" => $request->post('year'),
           
         ];
         
             $percentageSponsored = number_format(($request->post('kcc_sponsored') * 100) / $request->post('target'), 2);
 
             $inserted = DB::table('kishan_credit_card')
                             ->updateOrInsert([
                                 "districtcd" => $request->post('district'),
                                 "subdivisioncd" => $request->post('subdivision'),
                                 "blockminicd" => $request->post('municipality'),
                                 "reporting_month" => $request->post('month'),
                                 "reporting_year" => $request->post('year'),
                                 "KCC_target" => $request->post('target'),
                                 "KCC_sponsored" => $request->post('kcc_sponsored'),
                                 "KCC_sanctioned" => $request->post('kcc_sanctioned'),
                                 "Percentage_sponsored" => $percentageSponsored,
                                 "user_code" => auth()->user()->id,
                                 "posted_date" => date("Y/m/d"),
     
                             ]);
     
             if ($inserted) {
                 return redirect()->back()->with('success', 'Data submission successfully');
             } else {
                 return redirect()->back()->with('fail', 'Failed to insert data');
             }
 
 
         }        
        
}
