<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Mail;



class EmployeeController extends Controller
{
    //
    public function loginview()
    {
        return view('login');
    }
    public function login(Request $r)
    {
        if (($r->role) == "null") {
            return redirect()->back()->with('rolenull', 'Select role is must');
        } else {
            $email=$r->email;
            $pass=md5($r->pass);  
            $role=($r->role);
            $emp = Employee::where('email','=',$email)
                           ->where('pass','=',$pass)
                           ->where('role','=',$role)
                           ->first();
            if($emp){
                 if(($emp->verified) == 0){
                    return redirect()->back()->with('noverify',"user not verified");
                 }
                 else{
                    if($emp->role == 'chairman'){
                        Session::put('role',$emp->role);
                        Session::put('name',$emp->role);
                        
                       return redirect('admin/dashboard');                     
                    }
                    elseif($emp->role == 'department-admin'){
                        Session::put('role',$emp->role);
                        Session::put('name',$emp->role);
                        
                       return redirect('dapartment/dashboard');                     
                    }else{
                        Session::put('role',$emp->role);
                        Session::put('name',$emp->role);
                        
                       return redirect('teacher/dashboard');  
                    }
                 }
            }else{
                return redirect()->back()->with('nouser',"user not found");
            }
           
        }
    }
    public function registerview()
    {
        return view('register');
    }
    public function register(Request $r)
    {
        $err = [];
        if (($r->pass) != ($r->cpass)) {
            $err['pass'] = 'Password mismatch';
            //return redirect()->back()->with('passerror','Password mismatch');
        }
        if (($r->role) == "null") {
            $err['role'] = 'Select role is must';
            //return redirect()->back()->with('rolenull','Select role is must');
        }
        if (strlen($r->contact) != 11) {
            $err['contact'] = 'Contact no must be length of 11 digit';
            //return redirect()->back()->with('rolenull','Select role is must');
        }
        if (($r->name) == '' || ($r->address) == '') {
            $err['null'] = 'Must be fillup every field';
        }
        if (count($err) > 0) {
            return redirect()->back()->withErrors($err);
        } else {


            $emp_exist = Employee::where('email', '=', $r->email)->first();
            if ($emp_exist) {
                return redirect()->back()->with("userexit", "This email address already exists");
            }
          
                $emp = new Employee();
                $otp = random_int(100000, 999999);
                if (($r->role) == "chairman") {
                    $emp->status = true;
                }
                $emp->role = $r->role;
                $emp->name = $r->name;
                $emp->address = $r->address;
                $emp->email = $r->email;
                $emp->contact = $r->contact;
                $emp->pass = md5($r->pass);
                $emp->otp = $otp;
                $emp->verified = false;
    
                if ($emp->save()) {
                    $data = ['name' => $r->name, "otp" => $otp];
                    Mail::send('otp', $data, function ($msg) use ($r) {
                        $msg->to($r->email);
                        $msg->subject('Confirm Verification');
                    });
                    return redirect()->back()->with("regsuccess", "Your Registration is successful.Please check your mail OTP verification");
                } else {
                    return redirect()->back()->with("regfailed", "Your registration is failed . Please try again");
                }
             
        }
    }
    public function otpverifyview(){
        return view('otpverify');
    }
    public function verified(Request $r){
        $emp=Employee::where('otp','=',$r->otp)->first();
        if($emp){
            $emp->verified=true;
            $emp->save();
            return redirect('login');
        }else{
            return redirect()->back()->with('otpmismatch'.'Your otp matching failed');
        }
    }

    public function admindashboard(){
        return view('super_admin.dashboard');
    }
    public function departmentadminhome(){
        return view('department_admin.dashboard');
    }
    public function teacherdashboard(){
        return view('teachers.dashboard');
    }
    public function logout(Request $request){
        $request->session()->forget(['name', 'role']);
        return redirect('/');
    }
}
