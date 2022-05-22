<?php

namespace App\Http\Controllers\KishanMandi;



use Illuminate\Http\Request;
use App\Classes\DropdownContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KishanMandiController extends Controller
{
     
  
     
    public function KM_entry_update()
    {

        $data=DropdownContent::getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        $years = $data['years'];
        return view('users.entry_updates.KM_entry_update', compact('districts', 'months','years'));
    }

    public function checkKishanMandiData(Request $request){


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
        $data=DB::table('kishan_mandi')
            ->where($conditions)
            ->first();


        if($data){
            return response()->json($data);
        }else{
            return;
        }
    }


    public function insertKishanMandi(Request $request)
    {

        $request->validate([
            'district' => 'exists:district,districtcd',
            'subdivision' => 'exists:subdivision,subdivisioncd',
            'month' => 'exists:month_tbl,month',
            'year' => 'exists:years,year',
            'municipality' => 'exists:block_muni,blockminicd',
            'KM_operational' => 'required',
            'KM_sanctioned' => ['required', 'integer', 'min:1'],
        ]);

        $conditions=[
            "districtcd" => $request->post('district'),
            "subdivisioncd" => $request->post('subdivision'),
            "blockminicd" => $request->post('municipality'),
            "reporting_month" => $request->post('month'),
            "reporting_year" => $request->post('year'),

        ];


        $inserted = DB::table('kishan_mandi')
            ->updateOrInsert( $conditions,[
                "districtcd" => $request->post('district'),
                "subdivisioncd" => $request->post('subdivision'),
                "blockminicd" => $request->post('municipality'),
                "reporting_month" => $request->post('month'),
                "reporting_year" => $request->post('year'),
                "KM_operational" => $request->post('KM_operational'),
                "KM_sanctioned" => $request->post('KM_sanctioned'),
                "user_code" => auth()->user()->id,
                "posted_date" => date("Y/m/d"),

            ]);

            if ($inserted) {
                return redirect()->back()->with('success', 'Data submitted successfully');
            } else {
                return redirect()->back()->with('fail', 'No changes to made to existing  data');
            }
    }
 

     
     
    public function KM_report()
    {
        $kmReport = DB::table('kishan_mandi')
                        ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_mandi.reporting_year', 'kishan_mandi.KM_operational', 'kishan_mandi.KM_sanctioned', 'kishan_mandi.posted_date', 'users.name')
                        ->join('users', 'users.id', '=', 'kishan_mandi.user_code')
                        ->join('district', 'district.districtcd', '=', 'kishan_mandi.districtcd')
                        ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_mandi.subdivisioncd')
                        ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_mandi.blockminicd')
                        ->join('month_tbl', 'month_tbl.month', '=', 'kishan_mandi.reporting_month')
                        //   ->where('reporting_month','=',$currentMonth)
                        ->where('user_code', '=', auth()->user()->id)
                        ->get();

        return view('users.reports.KM_report', compact('kmReport'));
    }


}
