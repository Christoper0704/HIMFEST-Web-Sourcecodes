<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class MainController extends Controller
{
    function login(){
        return view('auth.login');
    }
    function registerteam(){
        return view('auth.register-team');
    }
    function registermember(){
        return view('auth.register-member');
    }
    function save(Request $request){
        
        //Validate requests
        $parameter = $request->submit;

        //Insert data into table Team
        if($parameter == "1")
        {
            $request->validate([
                'name'=>'required',
                'password'=>'required|min:6|max:12'
            ]);
            $team = new Team;
            $team->name = $request->name;
            $team->password = Hash::make($request->password);
            $team->category = $request->category;
            $save = $team->save();
            
            if($save){
                return back()->with('Success','New User has been successfuly added to database');
            }else{
                return back()->with('fail','Something went wrong, try again later');
            }
        };
        if($parameter == "2")
        {
            $request->validate([
                'name'=>'required',
                'email'=>'required|email',
                'phone'=>'required'
            ]);
            //Insert data into table Member
            $member = new Member;
            $member->name = $request->name;
            $member->email = $request->email;
            $member->lineid = $request->lineid;
            $member->phone = $request->phone;
            $member->studentcard = $request->studentcard;
            $save = $member->save();
            
            if($save){
                return back()->with('Success','New User has been successfuly added to database');
            }else{
                return back()->with('fail','Something went wrong, try again later');
            }
            };
    }

    function check(Request $request){
        //Validate requests
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ]);
        $userInfo = Team::where('name','=', $request->name)->first();

        if(!$userInfo){
            return back()->with('fail','We do not recognize your team name');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser',$userInfo->id);
                return redirect('admin/dashboard');
            }else{
                return back()->with('fail','Incorrect password');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }

    function dashboard(){
        $data = ['LoggedUserInfo' =>Team::where('id','=', session('LoggedUser'))->first()];
        return view('admin.dashboard', $data);
    }

    function settings(){
        $data = ['LoggedUserInfo' =>Team::where('id','=', session('LoggedUser'))->first()];
        return view('admin.settings', $data);
    }

    function profile(){
        $data = ['LoggedUserInfo' =>Team::where('id','=', session('LoggedUser'))->first()];
        return view('admin.profile', $data);
    }

    function staff(){
        $data = ['LoggedUserInfo' =>Team::where('id','=', session('LoggedUser'))->first()];
        return view('admin.staff', $data);
    }
}
