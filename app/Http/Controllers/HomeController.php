<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\HorarioEucaristia;
use App\Feligre;
use Validator;
use App\Http\Controllers\Controller;
use App\MensajesSacerdote;
use App\AvisosParroquiale;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        return view('home');
    }

    public function horarioSemanal($dia)
    {
        try {
            $hoy=$dia;
            if (($dia+1)>7) {
                $manhiana=1;
            }else{
                $manhiana=$dia+1;
            }
            if (($dia+2)>7) {
                $pasadomanhiana=2;
            }else{
                $pasadomanhiana=$dia+2;
            }
            return response()->json([
                'dia1'=>HorarioEucaristia::where('dia_eucaristia_id',$hoy)->where('estado','Activo')->where('semanal','1')->with(['DiasEucaristia','LugarEucaristia'])->get(),
                'dia2'=>HorarioEucaristia::where('dia_eucaristia_id',$manhiana)->where('estado','Activo')->where('semanal','1')->with(['DiasEucaristia','LugarEucaristia'])->get(),
                'dia3'=>HorarioEucaristia::where('dia_eucaristia_id',$pasadomanhiana)->where('estado','Activo')->where('semanal','1')->with(['DiasEucaristia','LugarEucaristia'])->get()
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function avisosParroquiales()
    {
        try {
            return response()->json([
                'avisos'=>AvisosParroquiale::orderBy('updated_at','desc')->limit(3)->get()
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function allAvisosParroquiales()
    {
        try {
            return response()->json([
                'avisos'=>AvisosParroquiale::orderBy('updated_at','desc')->get()
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function allHorario()
    {
        try {
            $horarios = HorarioEucaristia::where('estado','Activo')->where('semanal','1')->groupBy('dia_eucaristia_id')->orderBy('dia_eucaristia_id','asc')->with(['DiasEucaristia','LugarEucaristia'])->get();
            $horarioFinal = [];
            foreach ($horarios as $hora) {
                $horarioFinal[] = [
                    'dia' => $hora->DiasEucaristia->dia_semana, 
                    'horario' => HorarioEucaristia::where('dia_eucaristia_id',$hora->dia_eucaristia_id)->where('estado','Activo')->where('semanal','1')->orderBy('hora_eucaristia','asc')->with(['DiasEucaristia','LugarEucaristia'])->get()
                ];
            }
            return response()->json([
                'horario'=>$horarioFinal
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function guardarFeligres(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre' => 'required',
                'apellido' => 'required',
                'fecha_nacimiento' => 'required',
                'recibir_notificacion' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $feligres = new Feligre();
            $feligres->nombre = $request->nombre;
            $feligres->apellido = $request->apellido;
            $feligres->fecha_nacimiento = $request->fecha_nacimiento;
            $feligres->email = $request->email;
            $feligres->telefono = $request->telefono;
            $feligres->recibir_notificacion = $request->recibir_notificacion;
            $feligres->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'save'
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function guardarMensajeFeligres(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre' => 'required',
                'mensaje' => 'required',
                'sacerdote' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $mensajeSacerdote = new MensajesSacerdote();
            $mensajeSacerdote->nombre_feligres = $request->nombre;
            $mensajeSacerdote->sacerdote = $request->sacerdote;
            $mensajeSacerdote->mensaje = $request->mensaje;
            $mensajeSacerdote->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'save'
            ]);
        } catch (Exception $e) {
         return response()->json($e->getMessage());   
        }
    }
    public function getClientes()
    {
        $clients = array(['nombre' => 'EFRAIN HERNANDEZ RAMIREZ','identificacion' => 9652855, 'phone' => 'hernandezyopal@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'LUIS CARRILLO','identificacion' => 9434429, 'phone' => 'luislac1986@hotmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'EIDER ALEXIS LEGUIZMON NIÑO','identificacion' => 9431333, 'phone' => 'eiderleni31@gmail.com', 'tipoDoc' => 'CC', 'state'=>1],
        ['nombre' => 'ALEXANDER VARGAS FARÍAS','identificacion' => 9397435, 'phone' => 'alexvargas11@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'RED SALUD CASANARE E.S.E','identificacion' => 854400042202,'phone' => 'edsaludcasanare.gov.co', 'tipoDoc' => 'NIT', 'state'=>2],
        ['nombre' => 'E.S.E HOSPITAL LOCAL DE TAURAMENA','identificacion' => 854100008001, 'phone' => 'pyptauramena@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'COOPERATIVA MEDICA DE SALUD DEL NORTE DE CASANARE','identificacion' => 852500006901, 'phone' => 'coomedicanips@gmail.com', 'tipoDoc' => 'CC', 'state'=>4],
        ['nombre' => 'ENTIDAD MEDICO INTEGRAL PARA LA SALUD SAS','identificacion' => 851390301601, 'phone' => 'njmorenoc@hotmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'HOSPITAL DE AGUAZUL JUAN HERNANDO URREGO EMPRESA SOCIAL DEL ESTADO','identificacion' => 850100019001, 'phone' => 'oorpyp@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'SALUD LLANOS IPS','identificacion' => 850010210101, 'phone' => 'saludllanosipstatiana@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'EMPRESA SOCIAL DEL ESTADO SALUD YOPAL','identificacion' => 850010014408, 'phone' => 'asanare.gov.co', 'tipoDoc' => 'CC', 'state'=>3],
        ['nombre' => 'SOCIEDAD CLINICA CASANARE LTDA','identificacion' => 850010009801, 'phone' => 'gestiondocumentalclicas@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'HOSPITAL REGIONAL DE LA ORINOQUIA','identificacion' => 850010000103, 'phone' => 'sisinfo45045hy@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'Capresoca IPS','identificacion' => 850010000001, 'phone' => 'saidapypcapresoca@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'HOSPITAL SAN JUAN DE DIOS DE RONDON','identificacion' => 815910020605, 'phone' => 'alejandra4505hsjd@gmail.com', 'tipoDoc' => 'CC', 'state'=>2],
        ['nombre' => 'JUAN CARLOS MENDOZA ALDANA','identificacion' => 80200198, 'phone' => 'asanare.gov.co', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'CARLOS CASAS','identificacion' => 79408871, 'phone' => 'carloshernancj@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'TRANSPORTES BLANCO','identificacion' => 787456353333, 'phone' => 'jeblancor30@hotmail.com', 'tipoDoc' => 'NIT', 'state'=>1],
        ['nombre' => 'Jaiber Gama Torres','identificacion' => 74859423, 'phone' => 'jaibergama@hotmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'JOSE URIBE TORRES FERNANDEZ','identificacion' => 74858680, 'phone' => 'uribetorres@hotmail.com', 'tipoDoc' => 'CC', 'state'=>3],
        ['nombre' => 'Alber Uriel Gallego Moreno','identificacion' => 74858598, 'phone' => 'asesorauditoriacapresoca@gmail.com', 'tipoDoc' => 'CC', 'state'=>0],
        ['nombre' => 'FRANKY EDILBERTO RIAÑO VARGAS','identificacion' => 74814497, 'phone' => 'ferv07@gmail.com', 'tipoDoc' => 'NIT', 'state'=>0],
        ['nombre' => 'FRANK RENED QUINTERO FLÓREZ','identificacion' => 74811902, 'phone' => 'franko76_2@hotmail.com', 'tipoDoc' => 'CC', 'state'=>4],
        ['nombre' => 'CESAR HUMBERTO ALFONSO CHACON','identificacion' => 74081355, 'phone' => 'cesalf01@gmail.com', 'tipoDoc' => 'CC', 'state'=>0]);
        return response()->json(['clients' => $clients]);
    }
}
