<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
class SuperAdminController extends Controller
{
    //
    public function all_employee(){
        $e=Employee::all();
        return view('super_admin.listofemployee',compact('e'));
    }

   public function pending($id){
        echo $id;
        $e=Employee::where('id','=',$id)->first();
        $e->status=true;
        if($e->save()){
            return redirect()->back()->with('success','Successfully accept the user');
        }
   }
   public function createdepartmentform(){
    $e=Employee::all();
    return view('super_admin.createdepartmnet',compact('e'));
   }
   public function makedepartment(Request $r){
    $d=new Department();
    $d->name=$r->name;
    $d->aliase=$r->aliases;
    $d->admin=$r->admin;

    if($d->save()){
        return redirect()->back()->with('success','Successfully Create New Department');
    }else{
        return redirect()->back()->with('Error','Failed Create New Department');
    }
   }
   public function listdepartment(){
    $d=Department::all();
    return view('super_admin.listofdepartment',compact('d'));
   }
   public function editdepartmentform($id){
    $d=Department::where('id','=',$id)->first();
    $e=Employee::all();
    return view('super_admin.editdepartment',compact('d','e'));
   }
    public function updatedepartmentform(Request $r,$id){
     $d=Department::find($id);
     $d->name=$r->name;
     $d->aliase=$r->aliases;
     $d->admin=$r->admin;
     if($d->save()){
        return redirect()->back()->with('success','Successfully Edit Information');
     }else{
        return redirect()->back()->with('Error','Failed to Edit Information');
    }
    }
    public function deletedepartment($id){
             Department::find($id)->delete();
       
            return redirect()->back()->with('success','Delete one row');
        
    }
}
