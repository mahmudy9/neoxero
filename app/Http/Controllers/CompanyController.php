<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('admin.company.index' , compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $company = new Company;
        $company->name = $request->name;
        if($request->has('email'))
        {
            $company->email = $request->email;
        }
        if($request->has('website'))
        {
            $company->website = $request->website;
        }
        if($request->hasFile('logo'))
        {
            $path = $request->file('logo')->store('public');
            $filename = pathinfo($path , PATHINFO_BASENAME);
            $company->logo = $filename;
        }
        $company->save();
        return redirect()->back()->with('info' , 'success, company created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Compnay::findOrFail($id);
        return view('admin.company.show' , compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit' , compact('company'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->name = $request->name;
        if($request->has('email'))
        {
            $company->email = $request->email;
        }
        if($request->has('website'))
        {
            $company->website = $request->website;
        }
        if($request->hasFile('logo'))
        {
            Storage::delete($company['logo']);
            $path = $request->file('logo')->store('public');
            $filename = pathinfo($path , PATHINFO_BASENAME);
            $company->logo = $filename;
        }
        $company->save();
        return redirect()->back()->with('info' , 'company updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        if($company->employees()->exists())
        {
            return redirect()->back()->with('error' , 'unable to delete company , it has employees');
        }
        Storage::delete($company['logo']);
        $company->delete();
        return redirect()->back()->with('info' , 'company deleted successfully');
    }
}
