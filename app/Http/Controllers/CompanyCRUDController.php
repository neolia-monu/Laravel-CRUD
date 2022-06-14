<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

class CompanyCRUDController extends Controller {

    public function index(){
        $data['companies'] = company::orderBy('id', 'desc')->paginate(5);
        return view('companies.index', $data);
    }

    public function create(){
        return view('companies.create');
    }

    public function store(Request $request){

        $request->validate([
           'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $company = new company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();

        return redirect()->route('companies.index')
            ->with('success', 'Company has been created successfully');
    }

    public function show(company $company) {
        return view('companies.show', compact('company'));
    }


    public function edit(company $company) {
        return view('companies.edit', compact('company'));
    }


    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $company = company::find($id);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;

        $company->save();

        return redirect()->route('companies.index')
            ->with('success', 'Company has been updated successfully');
    }


    public function destroy(company $company) {
        $company->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Company has been deleted successfully');
    }
}
