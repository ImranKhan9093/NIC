<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MenuController extends Controller
{

    public function getMenusAndSubmenus()
    {

        $userMenus = DB::table('user_permission')
                        ->select('menu.menu_cd', 'menu.menu')
                        ->distinct()
                        ->join('menu', 'menu.menu_cd', '=', 'user_permission.menu_cd')
                        ->where('user_permission.user_cd', '=', auth()->user()->id)
                        //  ->groupBy('menu_cd')
                        ->get();

        $submenus = array();
        foreach ($userMenus as $menu) {
            $submenus[$menu->menu_cd] = DB::table('user_permission')
                                            ->select('user_permission.submenu_cd', 'submenu.submenu', 'submenu.link')
                                            ->join('submenu', 'submenu.submenu_cd', '=', 'user_permission.submenu_cd')
                                            ->where('user_permission.menu_cd', '=', $menu->menu_cd)
                                            ->where('user_permission.user_cd', '=', auth()->user()->id)
                                            //    ->groupBy('submenu_cd')
                                            ->get();
        }
        return ['userMenus' => $userMenus, 'submenus' => $submenus];
    }
    
    public function getDropdownContent()
    {
        $districts = DB::table('district')
                        ->orderBy('district')
                        ->get();
        $months = DB::table('month_tbl')
                      ->get();

        return ['districts' => $districts, 'months' => $months];
    }



    public function show()
    {

        $data = $this->getMenusAndSubmenus();

        $userMenus = $data['userMenus'];
        $submenus = $data['submenus'];

        return view('users.userdashboard', compact('userMenus', 'submenus'));
    }


    public function KCC_entry_update()
    {

        $data = $this->getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        return view('users.entry_updates.Kcc_entry_update', compact('districts', 'months'));
    }



    //showing forms
    public function KM_entry_update()
    {

        $data = $this->getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        return view('users.entry_updates.KM_entry_update', compact('districts', 'months'));
    }


    public function MGNREGS_Entry_update()
    {
        $data = $this->getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        return view('users.entry_updates.MGNREGS_Entry_update', compact('districts', 'months'));
    }

    public function Anandadhara_Entry_Update()

    {
        $data = $this->getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        return view('users.entry_updates.Anandadhara_Entry_Update', compact('districts', 'months'));
    }

    //code for inserting data into tables
    public function insertToKccTable(Request $request)
    {
        //  dd($request->all());
     
        $request->validate([
            'district' => 'exists:district,districtcd',
            'subdivision' => 'exists:subdivision,subdivisioncd',
            'month' => 'exists:month_tbl,month',
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
            "reporting_year" => date("Y")
        ];
        

        
        $data=DB::table('kishan_credit_card')
              ->where($conditions)
              ->first();

        if($data){

        // session()->flash('exists','Data for the entered district subdivision block already exists for this month');
         return response()->json($data);

         
         $updated= DB::table('kishan_credit_card')
             ->where($conditions)
             ->update([
                "KCC_target" => $request->post('target'),
                "KCC_sponsored" => $request->post('kcc_sponsored'),
                "KCC_sanctioned" => $request->post('kcc_sanctioned'),
                "Percentage_sponsored" => $percentageSponsored,
                "posted_date" => date("Y/m/d"),
             ]);
           
            if($updated){

                return redirect()->back()->with('success', 'Data updated successfully');
            }


        }else{

 
            $percentageSponsored = number_format(($request->post('kcc_sponsored') * 100) / $request->post('target'), 2);

            $inserted = DB::table('kishan_credit_card')
                            ->insert([
                                "districtcd" => $request->post('district'),
                                "subdivisioncd" => $request->post('subdivision'),
                                "blockminicd" => $request->post('municipality'),
                                "reporting_month" => $request->post('month'),
                                "reporting_year" => date("Y"),
                                "KCC_target" => $request->post('target'),
                                "KCC_sponsored" => $request->post('kcc_sponsored'),
                                "KCC_sanctioned" => $request->post('kcc_sanctioned'),
                                "Percentage_sponsored" => $percentageSponsored,
                                "user_code" => auth()->user()->id,
                                "posted_date" => date("Y/m/d"),
    
                            ]);
    
            if ($inserted) {
                return redirect()->back()->with('success', 'Data inserted successfully');
            } else {
                return redirect()->back()->with('fail', 'Failed to insert data');
            }


        }        
       

   }

    public function insertKishanMandi(Request $request)
    {

        $request->validate([
                'district' => 'exists:district,districtcd',
                'subdivision' => 'exists:subdivision,subdivisioncd',
                'month' => 'exists:month_tbl,month',
                'municipality' => 'exists:block_muni,blockminicd',
                'KM_operational' => 'required',
                'KM_sanctioned' => ['required', 'integer', 'min:1'],
        ]);

        $inserted = DB::table('kishan_mandi')
                        ->insert([
                            "districtcd" => $request->post('district'),
                            "subdivisioncd" => $request->post('subdivision'),
                            "blockminicd" => $request->post('municipality'),
                            "reporting_month" => $request->post('month'),
                            "reporting_year" => date("Y"),
                            "KM_operational" => $request->post('KM_operational'),
                            "KM_sanctioned" => $request->post('KM_sanctioned'),
                            "user_code" => auth()->user()->id,
                            "posted_date" => date("Y/m/d"),

                        ]);

        if ($inserted) {
            return redirect()->back()->with('success', 'Data inserted successfully');
        } else {
            return redirect()->back()->with('fail', 'Failed to insert data');
        }
    }
    public function insertAnandhara(Request $request)
    {
        $request->validate([
                'district' => 'exists:district,districtcd',
                'subdivision' => 'exists:subdivision,subdivisioncd',
                'month' => 'exists:month_tbl,month',
                'municipality' => 'exists:block_muni,blockminicd',
                'tot_SHGs_formed' =>  ['required', 'integer', 'min:1'],
                'tot_SHGs_credit_linkage' => ['required', 'integer', 'min:1'],
        ]);

        $inserted = DB::table('anandadhara')
                        ->insert([
                            "districtcd" => $request->post('district'),
                            "subdivisioncd" => $request->post('subdivision'),
                            "blockminicd" => $request->post('municipality'),
                            "reporting_month" => $request->post('month'),
                            "reporting_year" => date("Y"),
                            "tot_SHGs_formed" => $request->post('tot_SHGs_formed'),
                            "tot_SHGs_credit_linkage" => $request->post('tot_SHGs_credit_linkage'),
                            "user_code" => auth()->user()->id,
                            "posted_date" => date("Y/m/d"),

                        ]);

        if ($inserted) {
            return redirect()->back()->with('success', 'Data inserted successfully');
        } else {
            return redirect()->back()->with('fail', 'Failed to insert data');
        }
    }
    public function insertMgnregs(Request $request)
    {


        $request->validate([
                'district' => 'exists:district,districtcd',
                'subdivision' => 'exists:subdivision,subdivisioncd',
                'month' => 'exists:month_tbl,month',
                'municipality' => 'exists:block_muni,blockminicd',
                'tot_person_days_generate' =>  ['required', 'integer', 'min:1'],
                'KCC_sponsored' => ['required', 'integer', 'min:1'],
            ]);


        $averageData = 2142.5;
        $percentageLabour = 69.69;
        $inserted = DB::table('mgnregs')
                        ->insert([
                            "districtcd" => $request->post('district'),
                            "subdivisioncd" => $request->post('subdivision'),
                            "blockminicd" => $request->post('municipality'),
                            "reporting_month" => $request->post('month'),
                            "reporting_year" => date("Y"),
                            "tot_person_days_generate" => $request->post('tot_person_days_generate'),
                            "KCC_sponsored" => $request->post('KCC_sponsored'),
                            "avg_persondays_per_household" => $averageData,
                            "percentage_of_labour_budget_achieved" => $percentageLabour,
                            "user_code" => auth()->user()->id,
                            "posted_date" => date("Y/m/d"),

                        ]);

        if ($inserted) {
            return redirect()->back()->with('success', 'Data inserted successfully');
        } else {
            return redirect()->back()->with('fail', 'Failed to insert data');
        }
    }

    //code for reports 
    public function KCC_Report()
    {

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




        //  dd($kccReport);
        return view('users.reports.KCC_Report', compact('kccReport'));
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
    public function MGNREGS_report()
    {
        $mgnregsReport = DB::table('mgnregs')
                            ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'mgnregs.reporting_year', 'mgnregs.tot_person_days_generate', 'mgnregs.KCC_sponsored', 'mgnregs.avg_persondays_per_household', 'mgnregs.percentage_of_labour_budget_achieved', 'mgnregs.posted_date', 'users.name')
                            ->join('users', 'users.id', '=', 'mgnregs.user_code')
                            ->join('district', 'district.districtcd', '=', 'mgnregs.districtcd')
                            ->join('subdivision', 'subdivision.subdivisioncd', '=', 'mgnregs.subdivisioncd')
                            ->join('block_muni', 'block_muni.blockminicd', '=', 'mgnregs.blockminicd')
                            ->join('month_tbl', 'month_tbl.month', '=', 'mgnregs.reporting_month')
                            //   ->where('reporting_month','=',$currentMonth)
                            ->where('user_code', '=', auth()->user()->id)
                            ->get();

        return view('users.reports.MGNREGS_report', compact('mgnregsReport'));
    }
    public function Anandadhara_report()
    {

        $anandadharaReport = DB::table('anandadhara')
                                ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'anandadhara.reporting_year', 'anandadhara.tot_SHGs_formed', 'anandadhara.tot_SHGs_credit_linkage', 'anandadhara.posted_date', 'users.name')
                                ->join('users', 'users.id', '=', 'anandadhara.user_code')
                                ->join('district', 'district.districtcd', '=', 'anandadhara.districtcd')
                                ->join('subdivision', 'subdivision.subdivisioncd', '=', 'anandadhara.subdivisioncd')
                                ->join('block_muni', 'block_muni.blockminicd', '=', 'anandadhara.blockminicd')
                                ->join('month_tbl', 'month_tbl.month', '=', 'anandadhara.reporting_month')
                                //   ->where('reporting_month','=',$currentMonth)
                                ->where('user_code', '=', auth()->user()->id)
                                ->get();
        return view('users.reports.Anandadhara_report', compact('anandadharaReport'));
    }
}
