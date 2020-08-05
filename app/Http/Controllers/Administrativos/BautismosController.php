<?php

namespace App\Http\Controllers\Administrativos;

use App\Anotacione;
use App\Bautisado;
use App\CambiosSistema;
use App\CelebParroquia;
use App\Celebrante;
use App\Http\Controllers\Controller;
use App\Municipio;
use Illuminate\Http\Request;
use App\Http\Helpers\EnumsTrait;
use Validator;

class BautismosController extends Controller
{
    use EnumsTrait;
    public function index(Request $request)
    {
        $batuismos = Bautisado::buscar($request->name)->orderBy('id', 'DESC')->paginate(50);
        return view('administracion.bautismos.index')->with('bautizados', $batuismos);
    }
    public function getAll()
    {
        $batuismos = Bautisado::orderBy('id', 'DESC')->paginate(20);
        return response()->json(['data' => $batuismos]);
    }
    public function search($name)
    {
        $batuismos = Bautisado::buscar($name)->orderBy('id', 'DESC')->paginate(20);
        return response()->json(['data' => $batuismos]);
    }
    public function create()
    {
        $municipios = Municipio::with(['departamento'])->get();
        $celebrante = Celebrante::all();
        $generos = $this->getEnumValues('bautisados', 'genero');
        return view('administracion.bautismos.create')
        ->with('municipios', $municipios)
        ->with('celebrantes', $celebrante)
        ->with('generos', $generos);
    }
    public function edit(Request $request)
    {
        $municipios = Municipio::with(['departamento'])->get();
        $celebrante = Celebrante::all();
        $generos = $this->getEnumValues('bautisados', 'genero');
        return view('administracion.bautismos.editar')
        ->with('tipo', $request->tipoAnotacion)
        ->with('bautismo', $request->bautizado)
        ->with('municipios', $municipios)
        ->with('celebrantes', $celebrante)
        ->with('generos', $generos);
    }
    public function bautizadoById($id)
    {
    }
    public function bautizadoPorId(Request $request)
    {
        $datos = Bautisado::where('id', $request->id)
        ->with(['municipio.departamento', 'celebrante', 'celebranteParroquia'])
        ->first();
        $anotaciones = Anotacione::where('cod_bautisado', $request->id)->get();
        return response()->json([
            'bautizado' => $datos,
            'anotaciones' => $anotaciones,
        ]);
    }
    public function ejemplo()
    {
        $municipios = Municipio::with(['departamento'])->get();
        return response()->json($municipios);
    }
    public function celebrantesParroquia()
    {
        $celeb = CelebParroquia::with(['celebrante'])->where('estado', 'Activo')->get();
        return response()->json($celeb);
    }
    public function store(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre' => 'required',
                'fecha_nacimiento' => 'required',
                'cod_ciudad_nac_baut' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $bautizado = Bautisado::create($request->all());
            $bautizado = Bautisado::where('id', $bautizado->id)->first();
            for ($i = 0; $i < count($request->anotaciones); $i++) {
                $anotacion = [
                    'cod_bautisado' => $bautizado->id,
                    'parroco_firma' => $request->anotaciones[$i]['parroco']['id'],
                    'anotacion' => $request->anotaciones[$i]['anotacion']
                ];
                Anotacione::create($anotacion);
            }
            return response()->json([
                'estado' => 'saved',
                'message' => 'Bautizado creado con exito',
                'data' => $bautizado
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se presento un error en el servidor :' . $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre' => 'required',
                'fecha_nacimiento' => 'required',
                'cod_ciudad_nac_baut' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $bautizado = Bautisado::find($request->id);
            $bautizado->update($request->all());
            $bautizado = Bautisado::where('id', $bautizado->id)->first();
            for ($i = 0; $i < count($request->anotaciones); $i++) {
                if (is_null($request->anotaciones[$i]['id'])) {
                    $anotacion = [
                        'cod_bautisado' => $bautizado->id,
                        'parroco_firma' => $request->anotaciones[$i]['parroco']['id'],
                        'anotacion' => $request->anotaciones[$i]['anotacion']
                    ];
                    Anotacione::create($anotacion);
                } else {
                    $anotacion = Anotacione::find($request->anotaciones[$i]['id']);
                    $data = [
                        'cod_bautisado' => $bautizado->id,
                        'parroco_firma' => $request->anotaciones[$i]['parroco']['id'],
                        'anotacion' => $request->anotaciones[$i]['anotacion']
                    ];
                    $anotacion->update($data);
                }
            }
            return response()->json([
                'estado' => 'saved',
                'message' => 'Bautizado creado con exito',
                'data' => Bautisado::where('id', $bautizado->id)->first()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se presento un error en el servidor',
                'trace' => $e->getMessage()
            ], 500);
        }
    }
    public function guardar(Request $request)
    {
        try {
            $validador = Validator::make($request->all(), [
                'nombre' => 'required',
                'fechaNacimiento' => 'required',
                'ciudadNacimiento' => 'required',
            ]);
            if ($validador->fails()) {
                return response()->json([
                    'estado' => 'validador',
                    'errors' => $validador->errors(),
                ]);
            }
            $parroco = CelebParroquia::where('cargo', 'Parroco')->where('estado', 'Activo')->first();
            $bautismo = new Bautisado();
            $bautismo->nombre = $request->nombre;
            $bautismo->libro = $request->libro;
            $bautismo->folio = $request->folio;
            $bautismo->partida = $request->partida;
            $bautismo->nom_padre = $request->padre;
            $bautismo->nom_madre = $request->madre;
            $bautismo->abuelo_paterno = $request->abueloPaterno;
            $bautismo->abuela_paterna = $request->abuelaPaterna;
            $bautismo->abuelo_materno = $request->abueloMaterno;
            $bautismo->abuela_materna = $request->abuelaMaterna;
            $bautismo->nom_padrino = $request->padrino;
            $bautismo->nom_madrina = $request->madrina;
            $bautismo->genero = $request->genero;
            $bautismo->fecha_nacimiento = $request->fechaNacimiento;
            $bautismo->cod_ciudad_nac_baut = $request->ciudadNacimiento;
            $bautismo->fecha_bautismo = $request->fechaBautismo;
            $bautismo->cod_celebrante = $request->celebrante;
            $bautismo->parroco_firma = $parroco->celebrantes_id;
            $bautismo->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'save',
                'bautisado' => $bautismo->whereId($bautismo->id)->first(),
            ]);
        } catch (Exception $e) {
            return response()->json('Error');
        }
    }
    public function actualizarPorDecreto(Request $request)
    {
        try {
            $bautismo = Bautisado::find($request->id);
            $bautismo->nombre = $request->nombre;
            $bautismo->libro = $request->libro;
            $bautismo->folio = $request->folio;
            $bautismo->partida = $request->partida;
            $bautismo->nom_padre = $request->padre;
            $bautismo->nom_madre = $request->madre;
            $bautismo->abuelo_paterno = $request->abueloPaterno;
            $bautismo->abuela_paterna = $request->abuelaPaterna;
            $bautismo->abuelo_materno = $request->abueloMaterno;
            $bautismo->abuela_materna = $request->abuelaMaterna;
            $bautismo->nom_padrino = $request->padrino;
            $bautismo->nom_madrina = $request->madrina;
            $bautismo->genero = $request->genero;
            $bautismo->fecha_nacimiento = $request->fechaNacimiento;
            $bautismo->cod_ciudad_nac_baut = $request->ciudadNacimiento;
            $bautismo->fecha_bautismo = $request->fechaBautismo;
            $bautismo->cod_celebrante = $request->celebrante;
            $bautismo->save();
            $cambioSistema = new CambiosSistema();
            $cambioSistema->cambio_id = $bautismo->id;
            $cambioSistema->tipo_cambio = 'Bautismos';
            $cambioSistema->usuario_id = \Auth::user()->id;
            $cambioSistema->descipcion_cambio = 'Actualizacion de registro de batuizado por decreto';
            $cambioSistema->save();
            $anotacion = new Anotacione();
            $anotacion->cod_bautisado = $bautismo->id;
            $anotacion->Anotacion = $request->anotacion;
            $anotacion->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'update',
                'bautisado' => $bautismo->whereId($bautismo->id)->first(),
            ]);
        } catch (Exception $e) {
            return response()->json('Error');
        }
    }
    public function actualizarPorSistema(Request $request)
    {
        try {
            $bautismo = Bautisado::find($request->id);
            $bautismo->nombre = $request->nombre;
            $bautismo->libro = $request->libro;
            $bautismo->folio = $request->folio;
            $bautismo->partida = $request->partida;
            $bautismo->nom_padre = $request->padre;
            $bautismo->nom_madre = $request->madre;
            $bautismo->abuelo_paterno = $request->abueloPaterno;
            $bautismo->abuela_paterna = $request->abuelaPaterna;
            $bautismo->abuelo_materno = $request->abueloMaterno;
            $bautismo->abuela_materna = $request->abuelaMaterna;
            $bautismo->nom_padrino = $request->padrino;
            $bautismo->nom_madrina = $request->madrina;
            $bautismo->genero = $request->genero;
            $bautismo->fecha_nacimiento = $request->fechaNacimiento;
            $bautismo->cod_ciudad_nac_baut = $request->ciudadNacimiento;
            $bautismo->fecha_bautismo = $request->fechaBautismo;
            $bautismo->cod_celebrante = $request->celebrante;
            $bautismo->save();
            $cambioSistema = new CambiosSistema();
            $cambioSistema->cambio_id = $bautismo->id;
            $cambioSistema->tipo_cambio = 'Bautismos';
            $cambioSistema->usuario_id = \Auth::user()->id;
            $cambioSistema->descipcion_cambio = 'Actualizacion de registro de batuizado por sistema';
            $cambioSistema->save();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'update',
                'bautisado' => $bautismo->whereId($bautismo->id)->first(),
            ]);
        } catch (Exception $e) {
            return response()->json('Error');
        }
    }
    public function eliminarAnotacion(Request $request)
    {
        try {
            $anotacion = Anotacione::find($request->id);
            $cambioSistema = new CambiosSistema();
            $cambioSistema->cambio_id = $anotacion->cod_bautisado;
            $cambioSistema->tipo_cambio = 'Bautismos';
            $cambioSistema->usuario_id = \Auth::user()->id;
            $cambioSistema->descipcion_cambio = 'Eliminacion de anotacion de bautizo. Anotacion eliminada:' . $anotacion->Anotacion;
            $cambioSistema->save();
            $anotacion->delete();
            return response()->json([
                'estado' => 'ok',
                'tipo' => 'delete'
            ]);
        } catch (Exception $e) {
            return response()->json('Error');
        }
    }
    public function reportePartida($id, $firma)
    {
        try {
            $datos = Bautisado::where('id', $id)
            ->with(['Municipio.Departamento', 'Celebrante', 'CelebranteParroquia'])
            ->first();
            $anotaciones = Anotacione::where('cod_bautisado', $id)->get();
            $quienFirma = CelebParroquia::with(['Celebrante'])->where('celebrantes_id', $firma)->first();
            if ($this->validarPartidaPDF($datos) == '') {
                $pdf = \PDF::loadView('administracion.reportes.partida', [
                    'datos' => $datos,
                    'anotacion' => $anotaciones,
                    'firma' => $quienFirma]);
            } else {
                $pdf = \PDF::loadView('administracion.reportes.error', ['mensaje' => $this->validarPartidaPDF($datos)]);
            }
            return $pdf->setPaper('legal', 'portrait')->stream('bautizo.pdf');
        } catch (Exception $e) {
            dd('Algo ha salido mal al generar el reporte pdf');
        }
    }
    public function reporteBorrador($id, $valor)
    {
        try {
            $datos = Bautisado::where('id', $id)->with(['Municipio.Departamento', 'Celebrante'])->first();
            $anotaciones = Anotacione::where('cod_bautisado', $id)->get();
            if ($this->validarBorradorPDF($datos) == '') {
                $pdf = \PDF::loadView('administracion.reportes.borrador', [
                    'datos' => $datos,
                    'anotacion' => $anotaciones,
                    'valor' => $valor]);
            } else {
                $pdf = \PDF::loadView('administracion.reportes.error', ['mensaje' => $this->validarPartidaPDF($datos)]);
            }
            return $pdf->setPaper('letter', 'portrait')->stream('borrador.pdf');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    protected function validarPartidaPDF($bautizado)
    {
        $mensaje = '';
        if ($bautizado->libro == null) {
            $mensaje = 'Libro';
            return $mensaje;
        }
        if ($bautizado->folio == null) {
            $mensaje = 'Folio';
            return $mensaje;
        }
        if ($bautizado->partida == null) {
            $mensaje = 'Partida';
            return $mensaje;
        }
        if ($bautizado->fecha_nacimiento == null) {
            $mensaje = 'Fecha de nacimiento';
            return $mensaje;
        }
        if ($bautizado->cod_ciudad_nac_baut == null) {
            $mensaje = 'Ciudad de nacimiento';
            return $mensaje;
        }
        if ($bautizado->fecha_bautismo == null) {
            $mensaje = 'Fecha de bautismo';
            return $mensaje;
        }
        if ($bautizado->cod_celebrante == null) {
            $mensaje = 'Celebrante';
            return $mensaje;
        }
        if ($bautizado->parroco_firma == null) {
            $mensaje = 'Parroco';
            return $mensaje;
        }
        return $mensaje;
    }
    protected function validarBorradorPDF($bautizado)
    {
        $mensaje = '';
        if ($bautizado->fecha_nacimiento == null) {
            $mensaje = 'Fecha de nacimiento';
            return $mensaje;
        }
        if ($bautizado->cod_ciudad_nac_baut == null) {
            $mensaje = 'Ciudad de nacimiento';
            return $mensaje;
        }
        if ($bautizado->fecha_bautismo == null) {
            $mensaje = 'Fecha de bautismo';
            return $mensaje;
        }
        if ($bautizado->cod_celebrante == null) {
            $mensaje = 'Celebrante';
            return $mensaje;
        }
        if ($bautizado->parroco_firma == null) {
            $mensaje = 'Parroco';
            return $mensaje;
        }
        return $mensaje;
    }
}
