<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\Categoria;
use App\Models\Aprendiz;
use App\Models\Busqueda;
use App\Models\Tema;
use Illuminate\Http\Request;

class BusquedaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        if (Auth::user()) {
            $busquedas = Busqueda::all();
            return response()->json($busquedas);
        } else {
            return view('auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $busqueda = null;

        return view('perfils.aprendiz.aprendiz_busqueda', compact('busqueda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $busqueda = new Busqueda();

        $aprendiz = Aprendiz::where('user_id', '=', Auth::user()->id)->first();
        $categoria = Categoria::find($request['search_categoria']);

        $busqueda->aprendiz()->associate($aprendiz);
        $busqueda->categoria()->associate($categoria);

        $busqueda->save();

        return view('perfils.aprendiz.aprendiz_busqueda', compact('busqueda'));
    }

    /**
     * Display the number of resource for each category of an aprentice
     *
     * @param  int  $id
     * @return $consultas
     */
    public function show(request $request) {
        //                  
        $categorias = DB::table('categorias')
                ->select(DB::raw('*'));

        $consultas = DB::table('busquedas')
                ->select(DB::raw('count(*) as porcentaje,categorias.nombre'))
                ->where('busquedas.aprendiz_id', '=', $request->id)
                ->groupBy('categoria_id')
                ->orderBy('porcentaje','Desc')
                ->joinSub($categorias, 'categorias', function ($join) {
                    $join->on('busquedas.categoria_id', '=', 'categorias.id');
                })
                ->get();

        return response()->json($consultas);
    }
    /**
     * Display the number of resource for each category of all plaform
     *
     * @param  int  $id
     * @return $consultas
     */
    public function show_all(request $request) {
        //                  
        $categorias = DB::table('categorias')
                ->select(DB::raw('*'));

        $consultas = DB::table('busquedas')
                ->select(DB::raw('count(*) as porcentaje,categorias.nombre'))              
                ->groupBy('categoria_id')
                ->orderBy('porcentaje','Desc')
                ->joinSub($categorias, 'categorias', function ($join) {
                    $join->on('busquedas.categoria_id', '=', 'categorias.id');
                })
                ->get();

        return response()->json($consultas);
    }


}
