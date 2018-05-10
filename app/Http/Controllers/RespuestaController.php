<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Respuesta;
use Illuminate\Support\Facades\Auth;

class RespuestaController extends Controller
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
    public function index(Request $request)
    {
        
        $mensaje = "";
        $respuestas = Respuesta::orderBy('nombre','ASC')->paginate(5);
        return view('respuesta.index',compact('respuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
    
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
    public function store(Request $request)
    {
        $mensaje = "";
        $id = Auth::id();
        //$encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);

        if($request->nombre != "" and $request->isMethod('post'))
        {
            $enc = Respuesta::where('nombre', '=', $request->nombre)->first();
            if($enc != null){
                $respuestas = Respuesta::orderBy('nombre','ASC')->paginate(5);
                $mensaje = "La respuesta ya se encuentra registrada";
                return view('respuesta.index',compact('respuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
            }
            $respuesta = new Respuesta;
            $respuesta->nombre = $request->nombre;
            //$respuesta->user_id = $id;
            $respuesta->save();
            $mensaje = "La Respuesta se creo satisfactoriamente";
            
            
        }
        $respuestas = Respuesta::orderBy('nombre','ASC')->paginate(5);
        return view('respuesta.index',compact('respuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
    
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
