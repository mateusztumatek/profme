<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Rate;
use App\User;
use Illuminate\Http\Request;
use App\Company;
class CompanyController extends Controller
{
    public function show(Company $company){
        $query= Employee::where('company_id', $company->id)->get();
        $employees = array();
        foreach ($query as $employee){
            array_push($employees, $employee);
        }
        return view('company/index', compact('company', 'employees'));
    }

    public function confirmEmployee(Employee $employee){
        $employee->active = 1;
        $employee->save();
        $employees = Employee::where('company_id', $employee->company_id)->get();
        return response()->view('company.employee_panel', compact('employees'));
    }
    public function rateDiligenceEmployee(Request $request, Employee $employee){
        Rate::create([
            'user_id' => $employee->user_id,
            'company_id' => $employee->company_id,
            'elem_id' => $employee->id,
            'elem_type' => $request->elem_type,
            'rate' => $request->rate,
        ]);

        $employees = Employee::where('company_id', $employee->company_id)->get();
        return response()->view('company.employee_panel', compact('employees'));

    }


    public function deleteRateDiligence(Rate $rate, Employee $employee){
        $rate->delete();
        $employees = Employee::where('company_id', $employee->company_id)->get();
        return response()->view('company.employee_panel', compact('employees'));
    }

    public function deleteEmployee(Employee $employee){
        $employee->deleteRates();
        Employee::findOrFail($employee->id)->delete();

        $employees = Employee::where('company_id', $employee->company_id)->get();

        return response()->view('company.employee_panel', compact('employees'));
    }

}
