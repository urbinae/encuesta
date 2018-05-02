<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Encuesta;
use App\Participante;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $errorEncontrado = null;
        //$inputs=Input::all();
       // $escritor_id = $inputs['id'];
        $encuestas = Encuesta::orderBy('nombre','ASC')->paginate(5);
        /*$participanteEncontrado = Participante::where('ip_participante', '=', $this->getRealIP())->where('encuesta_id', '=', $id)->first();
        if($id == 'null')// or isNotNumber($id))
        {
            
            $errorEncontrado = "Ya respondió la pregunta"; 
            return view('home',['encuestas' => $encuestas, 'errorEncontrado' => $errorEncontrado]);      
        }
        if(count($participanteEncontrado))
        {
            $errorEncontrado = "Ya respondió la pregunta"; 
            $encuestas = array();     
            return view('home',['encuestas' => $encuestas, 'errorEncontrado' => $errorEncontrado]);      
        }*/

        
        return view('home',['encuestas' => $encuestas, 'errorEncontrado' => $errorEncontrado]);
    
    }

    /**
     * Muestra la encuesta al participante
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscarEncuesta(Request $request,$id)
    {

        $encuestas = Encuesta::all();
        $participanteEncontrado = 0;
        $participanteEncontrado = Participante::where('ip_participante', '=', $this->getRealIP())->where('encuesta_id', '=', $id)->first();
       // echo $participanteEncontrado; 
        
        //foreach($encuestas as $encuesta){
        //    $repuesta[]= array("nombre" => $encuesta->nombre);
        //}
        return response()->json(["encontrado" => count($participanteEncontrado), "mensaje" => "Ya sealizo la encuesta"])->header('Content-Type', 'application/json');
    }
    /**
     * Muestra la encuesta al participante
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function encuesta(Request $request,$id)
    {
        //$inputs=Input::all();
        //$escritor_id = $inputs['id'];
        $clientIps = array();
        echo $ip   = getenv("HTTP_X_FORWARDED_FOR"); 
        echo $this->getRealIP();
        echo $this->getIp();
        echo $this->getIpaddressofClient(); 
        echo $this->getUserIpAddress();
        $participanteEncontrado = Participante::where('ip_participante', '=', $this->getRealIP())->where('encuesta_id', '=', $id)->first();
        if(count($participanteEncontrado))
        {
            return redirect('/');
            return view('home',compact('encuestas'))->with('i', ($request->input('page', 1) - 1) * 5);
        }
        $participante = new Participante;
        $encuesta = Encuesta::find($id);
        $participante->encuesta_id = $id;
        $participante->on_line = true;
        $participante->ip_participante = $this->getRealIP(); //$request->name;

        $participante->save();

    }

    function getUserIpAddress() {

        foreach ( [ 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR' ] as $key ) {

            // Comprobamos si existe la clave solicitada en el array de la variable $_SERVER 
            if ( array_key_exists( $key, $_SERVER ) ) {

                // Eliminamos los espacios blancos del inicio y final para cada clave que existe en la variable $_SERVER 
                foreach ( array_map( 'trim', explode( ',', $_SERVER[ $key ] ) ) as $ip ) {

                    // Filtramos* la variable y retorna el primero que pase el filtro
                    if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== false ) {
                        return $ip;
                    }
                }
            }
        }

        return '?'; // Retornamos '?' si no hay ninguna IP o no pase el filtro
    } 

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    public function getIpaddressofClient()
    {
        // get clent ip address
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $keys)
        {
            // check for clent ip address
            if (array_key_exists($keys, $_SERVER) === true)
            {
                // get clent ip address 
                foreach (explode(',', $_SERVER[$keys]) as $ip_val)
                {
                    // get clent ip address
                    // just to be safe for ip address
                    $ip_val = trim($ip_val); 
                    if (filter_var($ip_val, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
                    {
                        // return ip address
                        return $ip_val;
                    }
                }
            }
        }
    }

    function getRealIP(){

        if (isset($_SERVER["HTTP_CLIENT_IP"])){

            return $_SERVER["HTTP_CLIENT_IP"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

            return $_SERVER["HTTP_X_FORWARDED"];

        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

            return $_SERVER["HTTP_FORWARDED_FOR"];

        }elseif (isset($_SERVER["HTTP_FORWARDED"])){

            return $_SERVER["HTTP_FORWARDED"];

        }else{

            return $_SERVER["REMOTE_ADDR"];

        }
    }   
}
