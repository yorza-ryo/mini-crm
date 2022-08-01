<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use Exception;
use Toastr;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'breadcrumb' => ['Employee' => '#'],
            'employees'  => Employee::orderBy('created_at')->get(),
        ];

        return view('employee.index', $data);
    }
    
    public function create()
    {
        $data = [
            'breadcrumb' => ['Employee' => route('employee.index'), 'Create Employee' => '#'],
            'companies'  => Company::orderBy('name')->get()
        ];

        return view('employee.create', $data);
    }
    
    public function store(EmployeeRequest $request)
    {
        try
        {
            Employee::create([
                'company_id' => $request->company_id,
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            Toastr::success('Success.');
            return redirect()->route('employee.index');
        }
        catch(Exception $e)
        {
            Log::error($e);
            Toastr::error('Failed.');
            return redirect()->route('employee.create')->withInput();
        }
    }
    
    public function edit(Employee $employee)
    {
        $data = [
            'breadcrumb' => ['Employee' => route('employee.index'), 'Update Employee' => '#'],
            'companies'  => Company::orderBy('name')->get(),
            'employee'   => $employee
        ];

        return view('employee.edit', $data);
    }
    
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try
        {
            $employee->update([
                'company_id' => $request->company_id,
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
            ]);
            
            Toastr::success('Success.');
            return redirect()->route('employee.index');
        }
        catch(Exception $e)
        {
            Log::error($e);
            Toastr::error('Failed.');
            return redirect()->route('employee.update', $employee->id)->withInput();
        }
    }
    
    public function destroy(Employee $employee)
    {
        $employee->delete();
    }
}
