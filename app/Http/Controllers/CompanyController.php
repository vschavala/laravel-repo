<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    /**
     * Display listing of company resource
     * @return \Illuminate\Http\Response
     */

     public function index(){

        $companyData = Company::all();

        return view('company.company',compact('companyData'));
     }

     /**
      * Creating company resource
      * 
      */

      public function create(){
         return view('company.create');
      }

      public function store(Request $request){

         $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $company = new Company; //object

        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;


        $company->save();

      return redirect()->route('companies.index')->with('status','Inserted successfully !');  
      }

      public function delete(Company $company){
         $company->delete();
         return redirect()->route('companies.index')->with('status','Deleted successfully !');

      }

      public function edit($id){
         $company = Company::findOrFail($id);
         return view('company.edit',['companyEdit'=>$company]);
      }

      public function update(Request $request, $id){
         $company = Company::findOrFail($id);
         $company->name = $request->name;
         $company->email = $request->email;
         $company->address = $request->address;
 
 
         $company->save();

         return redirect()->route('companies.index')->with('sucess','Updated  successfully !');
      }

     
}
