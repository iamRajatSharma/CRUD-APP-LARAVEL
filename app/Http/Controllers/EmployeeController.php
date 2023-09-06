<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $title = "Employee Index";
        $employees = Employee::paginate(3);
        return view("employee.list", compact('employees', 'title'));
    }

    public function create()
    {
        $title = "Create New Employee";
        return view("employee.create", compact('title'));
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), 
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|numeric',
            'image' => 'required|image:gif,png,jpg,jpeg',
            'address' => 'required'
        ]);

        if ($request->image) {
            $ext = $request->image->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $request->image->move(public_path('/uploads/employees'), $filename);
        }

        $data = new Employee();
        $data->fill($request->all())->save();

        // $data = new Employee();
        // $data->name = $request->name;
        // $data->email = $request->email;
        // $data->mobile = $request->mobile;
        // $data->address = $request->address;
        // $data->image = $filename;
        // $data->name = $request->name;

        if ($data->save()) {
            return redirect('employee')->with(['type' => 'success', 'message' => 'Employee Saved Successfully']);
        } else {
            return redirect('employee/create')->with(['type' => 'danger', 'message' => 'Something Wrong']);
        }
    }

    public function edit($id)
    {
        $title = 'Edit Employee Details';
        $employee = Employee::findOrFail($id);
        return view("employee.edit", ['employee' => $employee, 'title' => $title]);
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|numeric',
            'image' => 'image:gif,png,jpg,jpeg',
            'address' => 'required'
        ]);

        if ($request->image) {
            $ext = $request->image->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $request->image->move(public_path('/uploads/employees'), $filename);
            $oldImage = $request->oldimage;
            File::delete(public_path() . '/uploads/employees' . $oldImage);
        } else {
            $filename = $request->oldimage;
        }

        $data = Employee::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->image = $filename;
        $data->name = $request->name;

        if ($data->save()) {
            return redirect('employee')->with(['type' => 'success', 'message' => 'Employee Detals Updated Successfully']);
        } else {
            return redirect()->back()->with(['type' => 'danger', 'message' => 'Something Wrong']);
        }
    }


    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        File::delete(public_path() . '/uploads/employees/' . $employee->image);
        if ($employee->delete()) {
            return redirect('employee')->with(['type' => 'success', 'message' => 'Employee Deleted Successfully']);
        } else {
            return redirect('employee')->with(['type' => 'danger', 'message' => 'Something Wrong']);
        }
    }
}
