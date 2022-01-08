<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repository\IEmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $employee;
    
    public function __construct(IEmployeeRepository $employee)
    {
        $this->employee = $employee;
    }

    public function index()
    {
        $data = $this->employee->getAll();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id=null)
    {
        $collection = $request->validate([
            'name'=> 'required|max:10|unique:employees',
            'salary' => 'required|max:7'

        ]);

        $response = $this->employee->createOrUpdate($id, $collection);
            return response()->json($response);

        // try {
            
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => 'error',
        //         'error' => $e->getMessage()
        //     ]);
        // }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
