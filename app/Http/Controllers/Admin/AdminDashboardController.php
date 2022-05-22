<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvedUsers=User::where('is_approved','!=',0)
                             ->where('usertype','!=','admin')
                             ->get();
        $unapprovedUsers=User::where('is_approved','=',0)
                             ->get();
        if(session()->has('success')){
            Alert::success('Success!', session()->pull('success'));

        }
        if(session()->has('error')){
        Alert::warning('Warning!',session()->pull('error'));
        }                     
        return view('admin.dashboard',compact('approvedUsers','unapprovedUsers'));                                          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usermanagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usermanagement)
    {   $menus=DB::table('menu')
                 ->orderBy('menu')
                 ->pluck('menu','menu_cd');
        $rolesForUser= DB::table('user_permission')
                    ->distinct()
                    ->join('menu', 'menu.menu_cd', '=', 'user_permission.menu_cd')
                    ->where('user_permission.user_cd', '=', $usermanagement->id)
                    ->pluck('menu.menu');
                   
        
        return view('admin.edit_registered_user',compact('usermanagement','menus','rolesForUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $usermanagement)
    {
         
         $usermanagement->is_approved=true;
         $usermanagement->update();
        
         return redirect()->route('admin.usermanagement.index')->with('success','user approved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usermanagement)
    {
        //
    }
    public function updateRole(Request $request,User $user){

          $menuCd=$request->post('role');

          $submenusWithReceivedMenuCd=DB::table('submenu')
                                    ->where('menu_cd','=',$menuCd)
                                    ->first();
                        
           if($submenusWithReceivedMenuCd==null){
               return redirect()->route('admin.usermanagement.index')->with('error','No submenus for selected menu');
           }


            $roleAlreadyGiven= DB::table('user_permission')
                               ->where('user_permission.user_cd', '=', $user->id)
                               ->where('user_permission.menu_cd','=',$menuCd)
                               ->first();
                          
          if($roleAlreadyGiven){
            return redirect()->route('admin.usermanagement.index')->with('error','Selected role already exists for the user');
          }else{

            $submenusWithReceivedMenuCd=DB::table('submenu')
                                        ->where('menu_cd','=',$menuCd)
                                        ->pluck('submenu_cd');

            if($submenusWithReceivedMenuCd){

               $inserted=false; 
                 for($i=0;$i<count($submenusWithReceivedMenuCd);$i++){

                $inserted=DB::table('user_permission')
                       ->insert([
                                   'user_cd'=>$user->id,
                                   'menu_cd'=>$menuCd,
                                   'submenu_cd'=>$submenusWithReceivedMenuCd[$i],
                              ]);
            } 
            if($inserted){

                  return redirect()->route('admin.usermanagement.index')->with('success','Role updated');
            } 
            else{
                return redirect()->route('admin.usermanagement.index')->with('error','Failed to update role');
            }     
            }                       


          }   


         
       
              
    }
}
