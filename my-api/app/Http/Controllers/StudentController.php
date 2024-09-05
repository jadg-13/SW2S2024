<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$students = Student::orderBy('first_name')->get();
        $students = Student::select('career as Carrera', 
        'first_name as Nombres', 'last_name as Apellidos',
        'email as Correo')
        ->orderBy('career')
        ->orderBy('last_name')->get();
        return response()->json(['status' => 'success', 
        'data' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $student = Student::create($request->all());
            return response()->json(['status' => 'success', 
            'message' => 'Estudiante creado exitosamente', 
            'data' => $student]);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
