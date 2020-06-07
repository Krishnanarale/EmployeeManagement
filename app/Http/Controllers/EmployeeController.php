<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all employees for listing
        $result = Employee::all();
        if ($result) {
            return response()->json(["status" => "success", "message" => "data found", "data" => $result ]);
        } else {
            return response()->json(["status" => "failed", "message" => "data not found", "data" => $result ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Loading a view
        return view('createEmployee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Storing a data in database
        $photo = $request->file('photo')->store('public');
        $data = array(
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'gender' => $request->gender,
            'dateOfBirth' => $request->dateOfBirth,
            'email' => $request->email,
            'phone' => $request->phone,
            'languages' => implode(", ",$request->languages),
            'photo' => explode("/",$photo)[1],
        );
        $result = Employee::create($data);
        if ($result) {
            return response()->json(["status" => "success", "message" => "data Added", "data" => "" ]);
        } else {
            return response()->json(["status" => "failed", "message" => "data Not Added", "data" => $result ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //Get singal employee for edit.
        $result = Employee::findOrFail($request->id);
        if ($result) {
            return response()->json(["status" => "success", "message" => "data found", "data" => $result ]);
        } else {
            return response()->json(["status" => "failed", "message" => "data Not found", "data" => $result ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Update singal employee
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('public');
            $data = array(
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'gender' => $request->gender,
                'dateOfBirth' => $request->dateOfBirth,
                'email' => $request->email,
                'phone' => $request->phone,
                'languages' => implode(", ",$request->languages),
                'photo' => explode("/",$photo)[1],
            );
        }else {
            $data = array(
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'gender' => $request->gender,
                'dateOfBirth' => $request->dateOfBirth,
                'email' => $request->email,
                'phone' => $request->phone,
                'languages' => implode(", ",$request->languages),
            );
        }
        $result = Employee::where('id', $request->id)
                            ->update($data);
        if ($result) {
            return response()->json(["status" => "success", "message" => "data updated", "data" => "" ]);
        } else {
            return response()->json(["status" => "failed", "message" => "data Not updated", "data" => $result ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Destroying employee from database
        $result = Employee::destroy($request->delId);
        if ($result) {
            return response()->json(["status" => "success", "message" => "data deleted", "data" => "" ]);
        } else {
            return response()->json(["status" => "failed", "message" => "data Not deleted", "data" => $result ]);
        }   
    }
}
