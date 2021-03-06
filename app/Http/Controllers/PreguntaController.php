<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pregunta;
use App\Encuesta;
use App\Respuesta;
use Illuminate\Support\Facades\Auth;

class PreguntaController extends Controller
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
    public function index()
    {
        echo "string";
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
        //dd($request->tiempo);
        $mensaje = "Error, no se pudo crear la pregunta";
        if($request->nombre){
            $pregunta = new Pregunta;
            $pregunta->descripcion = $request->nombre;
            $pregunta->encuesta_id = $request->idEncuesta;
            $pregunta->tiempo = $request->tiempo;
            $pregunta->save();
            $mensaje ="Pregunta creada satisfactoriamente";
            
        }
        $respuestas = Respuesta::all();
        $encuesta = Encuesta::find($request->idEncuesta);
        $preguntas = Encuesta::find($request->idEncuesta)->preguntas()->get();
        return redirect()->route('pregunta.show', $request->idEncuesta)->with('preguntas', 'mensaje','respuestas','encuesta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        
        $mensaje = "";
        $encuesta = Encuesta::find($id);
        
        $respuestas = Respuesta::all();
        
        /*if(count(Encuesta::find($id)->preguntas()->first()) == 0){
            $pregunta = new Pregunta;
            $pregunta->descripcion = "ingrese la 1ra pregunta";
            $pregunta->encuesta_id = $id;
            $pregunta->save();
            $pregunta->respuestas()->where('pregunta_repuesta', $problem->id)->first()->pivot->letra
           
        }*/
        
        $preguntas = Encuesta::find($id)->preguntas()->get();
       
        //$encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);
        //$preguntas = Pregunta::findOrFail($id);
        //$preguntas = []; //Pregunta::find($id);
        return view('pregunta.show',compact('preguntas', 'mensaje','respuestas','encuesta'))->with('i', ($request->input('page', 1) - 1) * 5);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id = null)
    {
        if($request->respuestasIds != null and $id != null  and $request->letra_select != null )
        {
            echo $pregunta   = Pregunta::find($id);
            $ids = explode(',',$request->respuestasIds);
            $a = $ids[0];
            $b = $ids[1];
            $c = $ids[2];
            $d = $ids[3];
            $repuestaA   = Respuesta::find($a);
            $repuestaB   = Respuesta::find($b);
            $repuestaC   = Respuesta::find($c);
            $repuestaD   = Respuesta::find($d);
                       
            $pregunta->respuestas()->detach();
            $pregunta->respuestas()->attach($repuestaA, ['letra' => 'A']);
            $pregunta->respuestas()->attach($repuestaB, ['letra' => 'B']);
            $pregunta->respuestas()->attach($repuestaC, ['letra' => 'C']);
            $pregunta->respuestas()->attach($repuestaD, ['letra' => 'D']);
            //$pregunta->respuestas()->attach([$repuestaA => ['letra' => 'A'], $repuestaB => ['letra' => 'B'],$repuestaC => ['letra' => 'C'], $repuestaD => ['letra' => 'D']]);

        }

        if($id and $request->idEncuesta != null)
        {
            $request->idEncuesta;
            
            $preguntas = Pregunta::where('encuesta_id',$request->idEncuesta)->where('id',"<>",$id)->get();
            echo 'preguntas'.count($preguntas);
            if(count($preguntas) > 1 )
            {
                foreach($preguntas as $pregunta)
                {
                    $pregunta->habilitada = 0;
                    $pregunta->save();
                }
            }
            $preguntaEncontrada = Pregunta::find($id);
            $preguntaEncontrada->habilitada = 1;
            $preguntaEncontrada->save();
        }
        
        //echo 'id-preungta'.$id;
        //id=elements_id&value=user_edited_content
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
        if($request->value != "")
        {
            $pregunta = Pregunta::find($request->id);
            $pregunta->descripcion = $request->value;
            $pregunta->save();
            //return response()->json($request->value)->header('Content-Type', 'application/json');
        }
        return $request->value;
         //return response()->json($request->value)->header('Content-Type', 'application/json');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pregunta = Pregunta::find($id);
        $mensaje = "La pregunta ".$pregunta->descripcion." fue eliminada";
        Pregunta::destroy($id);
        
        $respuestas = Respuesta::all();
        $encuesta   = Encuesta::find($request->idEncuesta);
        $preguntas  = Encuesta::find($request->idEncuesta)->preguntas()->get();

        return redirect()->route('encuestas.show', $request->idEncuesta)->with('preguntas', 'mensaje','respuestas','encuesta');
    }
}
