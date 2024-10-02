<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /* Codigos de respuesta
    200: OK. La solicitud ha tenido éxito.
    201: Creado. La solicitud ha tenido éxito y se ha creado un nuevo recurso como resultado de ella.
    204: Sin contenido. La solicitud se ha completado con éxito pero su respuesta no tiene ningún contenido.
    400: Solicitud incorrecta. La solicitud no se pudo procesar porque la sintaxis de la solicitud es incorrecta.
    401: No autorizado. La solicitud no se pudo procesar porque no tiene credenciales válidas.
    403: Prohibido. La solicitud no se pudo procesar porque no tiene permiso para acceder al recurso solicitado.
    404: No encontrado. El servidor no pudo encontrar el recurso solicitado.
    405: Método no permitido. El método de solicitud no es válido para el recurso solicitado.
    500: Error interno del servidor. El servidor encontró una situación inesperada que le impidió completar la solicitud.
    */


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$students = Student::orderBy('first_name')->get();
        $students = Student::select(
            'career as Carrera',
            'first_name as Nombres',
            'last_name as Apellidos',
            'email as Correo'
        )
            ->orderBy('career')
            ->orderBy('last_name')->get();
        return response()->json([
            'status' => 'success',
            'data' => $students
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $student = Student::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Estudiante creado exitosamente',
                'data' => $student
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $value)
    {
        //
        try {
            $student = Student::where('id', $value)
                ->orWhere('first_name', $value)
                ->orWhere('cif', $value)
                ->firstOrFail();
            return response()->json([
                'status' => 'success',
                'data' => $student

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $student = Student::findOrFail($id);
            $student->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Estudiante actualizado exitosamente',
                'data' => $student
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Estudiante eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
