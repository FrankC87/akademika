<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Aprendiz;
use App\Models\Maestro;
use App\Models\Categoria;
use App\Models\Coleccion;
use App\Models\Tema;
use App\Models\Voto;
use App\Models\Notificacion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        if (Auth::user()) {
            $temas = Tema::all();
            return response()->json($temas);
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
        $categorias = Categoria::all();
        return view('perfils.maestro.tema_nuevo', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $validator = Validator::make($request->all(), [
                    'titulo' => 'required',
                    'contenido' => 'required',
        ]);

        if ($validator->fails() && $request->coleccion != null) {
            return redirect()->route('coleccion_tema_nuevo', ['id' => $request->coleccion])
                            ->withErrors($validator)
                            ->withInput();
        } else if ($validator->fails()) {
            return redirect()->route('tema_nuevo')
                            ->withErrors($validator)
                            ->withInput();
        } else {

            $tema = new Tema();

            $tema->titulo = $request['titulo'];
            $tema->contenido = $request['contenido'];

            $categoria = Categoria::find($request['categoria']);
            $maestro = Maestro::where('user_id', '=', Auth::user()->id)->first();

            $tema->categoria()->associate($categoria);
            $tema->maestro()->associate($maestro);
        
            foreach ($maestro->aprendices as $aprendiz) {
                $notificacion = new Notificacion();
                $notificacion->asunto='Nuevo articulo del maestro '.$maestro->nick_m;
                $notificacion->contenido = 'El maestro <span class=" font-weight-bold">'.$maestro->nick_m.'</span> ha publicado un nuevo articulo titulado: <span class=" font-weight-bold">' . $tema->titulo . '</span>  dentro de la categoria '.$categoria->nombre;
                $notificacion->receptor_a = $aprendiz->id;   
                $notificacion->save();
            }

            if ($request->coleccion == null) {

                $tema->save();
                return view('perfils.maestro.maestro_temas');
            } else {

                $coleccion = Coleccion::find($request->coleccion);
                $tema->coleccion()->associate($coleccion);
                $tema->save();

                return view('perfils.maestro.maestro_coleccion_ver', compact('coleccion'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $tema = Tema::find($id);

        return view('perfils.maestro.maestro_tema_ver', compact('tema'));
    }

    /**
     * Display all resources.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll($id) {
        $maestro = Maestro::findOrFail($id);
        return view('perfils.maestro.maestro_temas', compact('maestro'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_aprendiz($id) {
        $tema = Tema::find($id);

        return view('perfils.aprendiz.aprendiz_tema_ver', compact('tema'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $tema = Tema::findOrFail($id);

        $categorias = Categoria::all();

        return view('perfils.maestro.tema_editar', compact('tema', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $tema = Tema::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'titulo' => 'required',
                    'contenido' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tema_editar', ['id' => $tema->id])
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $tema->update($request->all());
            return view('perfils.maestro.maestro_tema_ver', compact('tema'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $tema = Tema::findOrFail($id);
        $coleccion = $tema->coleccion;
        $maestro = $tema->maestro;

        $tema->comentarios()->delete();

        $tema->delete();
        if ($coleccion == null) {
            return view('perfils.maestro.maestro_temas', compact('maestro'));
        } else {
            return view('perfils.maestro.maestro_colecciones', compact('maestro'));
        }
    }

    /**
     * Increment the likes field of the source
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return Json Response
     */
    public function like(Request $request) {
        //
        $id = $request->id;

        $tema = Tema::findOrFail($id);
        $tema->likes = $tema->likes + 1;
        $tema->update();

        $voto = new Voto();
        $voto->maestro_id = $request['maestro'];
        $voto->aprendiz_id = $request['aprendiz'];
        $voto->tema_id = $tema->id;
        $voto->like = true;
        $voto->save();

        return response()->json(array('likes' => $tema->likes), 200);
    }

    /**
     * Increment the dislikes field of the source
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return Json Response
     */
    public function dislike(Request $request) {
        //
        $id = $request->id;

        $tema = Tema::findOrFail($id);
        $tema->dislikes = $tema->dislikes + 1;
        $tema->update();

        $voto = new Voto();
        $voto->maestro_id = $request['maestro'];
        $voto->aprendiz_id = $request['aprendiz'];
        $voto->tema_id = $tema->id;
        $voto->dislike = true;
        $voto->save();

        return response()->json(array('dislikes' => $tema->dislikes), 200);
    }

}
