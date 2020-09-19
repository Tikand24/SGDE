<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\DefaultsTrait;
use App\Models\Sacramentos\Bautismo\AnotacionesBautismos;
use App\Models\Sacramentos\Bautismo\Bautisados;
use App\Models\Sistema\Estado;
use Illuminate\Support\Facades\Validator;

class BautismosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($numberItems = 5)
    {
        $batuismos = Bautisados::where('estados_id', DefaultsTrait::getEstadoActivo())
            ->orderBy('id', 'DESC')
            ->paginate($numberItems);
        return response()->json(['data' => $batuismos]);
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
            $bautizado = Bautisados::create($request->all());
            $bautizado = Bautisados::where('id', $bautizado->id)->first();
            for ($i = 0; $i < count($request->anotaciones); $i++) {
                $anotacion = [
                    'cod_bautisado' => $bautizado->id,
                    'parroco_firma' => $request->anotaciones[$i]['parroco']['id'],
                    'anotacion' => $request->anotaciones[$i]['anotacion']
                ];
                AnotacionesBautismos::create($anotacion);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bautizado = Bautisados::where('id', $id)
            ->with(['municipio.departamento', 'celebrante.celebrante', 'celebranteParroquia.celebrante'])
            ->first();
        $anotaciones = AnotacionesBautismos::where('cod_bautisado', $id)
            ->with(['parroco.celebrante'])
            ->get();
        return response()->json([
            'bautizado' => $bautizado,
            'anotaciones' => $anotaciones,
        ]);
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
            $bautizado = Bautisados::find($request->id);
            $bautizado->update($request->all());
            $bautizado = Bautisados::where('id', $bautizado->id)->first();
            for ($i = 0; $i < count($request->anotaciones); $i++) {
                if (is_null($request->anotaciones[$i]['id'])) {
                    $anotacion = [
                        'cod_bautisado' => $bautizado->id,
                        'parroco_firma' => $request->anotaciones[$i]['parroco']['id'],
                        'anotacion' => $request->anotaciones[$i]['anotacion']
                    ];
                    AnotacionesBautismos::create($anotacion);
                } else {
                    $anotacion = AnotacionesBautismos::find($request->anotaciones[$i]['id']);
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
                'data' => Bautisados::where('id', $bautizado->id)->first()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Se presento un error en el servidor',
                'trace' => $e->getMessage()
            ], 500);
        }
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

    public function search($name, $numberItems = 5)
    {
        $batuismos = Bautisados::buscar($name)
            ->where('estados_id', DefaultsTrait::getEstadoActivo())
            ->orderBy('id', 'DESC')
            ->paginate($numberItems);
        return response()->json(['data' => $batuismos]);
    }
}
