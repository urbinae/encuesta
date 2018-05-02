<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Encuesta;
use Illuminate\Support\Facades\Auth;

class EncuestaController extends Controller
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
    public function indexDataTable(Request $request)
    {
        $encuestas = Encuesta::all();
        foreach($encuestas as $encuesta){
            $repuesta[]= array("nombre" => $encuesta->nombre);
        }
        return response()->json($encuestas)->header('Content-Type', 'application/json');
        //print_r($encuestas);
        //return response($encuestas, 200)->header('Content-Type', 'text/plain');
        //return view('encuesta.index',compact('encuestas'));
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mensaje = "";
        $encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);
        return view('encuesta.index',compact('encuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
    
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
            $enc = Encuesta::where('nombre', '=', $request->nombre)->where('user_id', '=', $id)->first();
            if(count($enc) > 0){
                $encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);
                $mensaje = "La encuesta ya se encuentra registrada";
                return view('encuesta.index',compact('encuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
            }
            $encuesta = new Encuesta;
            $encuesta->nombre = $request->nombre;
            $encuesta->user_id = $id;
            $encuesta->save();
            $mensaje = "La encuesta se creo satisfactoriamente";
            
            
        }
        $encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);
        return view('encuesta.index',compact('encuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
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
        echo 'aki';
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
        echo 'ak123i';
        $encuesta = Encuesta::find($id);
        
        ///Encuesta::destroy($id);
        if($encuesta != "")
        {
            $encuesta->nombre = $request->nombre;           
            $encuesta->save();
            $mensaje = "La encuesta ".$encuesta->nombre." fue editada satisfactoriamente";
        }
        
        $encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);
        return view('encuesta.index',compact('encuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $encuesta = Encuesta::find($id);
        $mensaje = "La encuesta ".$encuesta->nombre." fue eliminada";
        Encuesta::destroy($id);
        $encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);
        return view('encuesta.index',compact('encuestas', 'mensaje'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
