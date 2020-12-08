<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Categoria;
use App\Models\Coleccion;
use App\Models\Tema;
use App\Models\Comentario;
use App\Models\Maestro;
use App\Models\Voto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColeccionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        if (Auth::user()) {
            $colecciones = Coleccion::all();
            return response()->json($colecciones);
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
        //
        $categorias = Categoria::all();
        return view('perfils.maestro.coleccion_nueva', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //      
        $maestro = Maestro::where('user_id', '=', Auth::user()->id)->first();

        $validator = Validator::make($request->all(), [
                    'titulo_coleccion' => 'required',
                    'descripcion_coleccion' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('coleccion_nueva')
                            ->withErrors($validator)
                            ->withInput();
        } else {

            $coleccion = Coleccion::create([
                        'titulo' => $request['titulo_coleccion'],
                        'descripcion' => $request['descripcion_coleccion'],
                        'maestro_id' => $maestro->id
            ]);

            return view('perfils.maestro.maestro_colecciones', compact('maestro'));
        }
    }

    /**
     * Display the specified resource for a master.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $coleccion = Coleccion::find($id);

        return view('perfils.maestro.maestro_coleccion_ver', compact('coleccion'));
    }

    /**
     * Display the specified resource for a aprentice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_aprendiz($id) {
        //
        $coleccion = Coleccion::find($id);

        return view('perfils.aprendiz.aprendiz_coleccion_ver', compact('coleccion'));
    }

    /**
     * Display all resources.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll($id) {
        $maestro = Maestro::findOrFail($id);
        return view('perfils.maestro.maestro_colecciones', compact('maestro'));
    }

    /**
     * Show the form for creating a new Tema for the Coleccion.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTema($id) {
        $categorias = Categoria::all();
        $coleccion = Coleccion::find($id);
        return view('perfils.maestro.coleccion_tema_nuevo', compact('categorias', 'coleccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $coleccion = Coleccion::findOrFail($id);

        return view('perfils.maestro.coleccion_editar', compact('coleccion'));
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
        $coleccion = Coleccion::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'titulo' => 'required',
                    'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('coleccion_editar', ['id' => $coleccion->id])
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $coleccion->update($request->all());
            return view('perfils.maestro.maestro_coleccion_ver', compact('coleccion'));
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
        $coleccion = Coleccion::findOrFail($id);
        $maestro = $coleccion->maestro;
        foreach($coleccion->temas as $tema){
             $tema->comentarios()->delete();
        }
        $coleccion->temas()->delete();
        $coleccion->delete();

        return view('perfils.maestro.maestro_colecciones', compact('maestro'));
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

        $coleccion = Coleccion::findOrFail($id);
        $coleccion->likes = $coleccion->likes + 1;
        $coleccion->update();
        
        $voto=new Voto();       
        $voto->maestro_id = $request['maestro'];
        $voto->aprendiz_id = $request['aprendiz'];
        $voto->coleccion_id =  $coleccion->id;    
        $voto->like = true;      
        $voto->save();

        return response()->json(array('likes' => $coleccion->likes), 200);
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

        $coleccion = Coleccion::findOrFail($id);
        $coleccion->dislikes = $coleccion->dislikes + 1;
        $coleccion->update();
        
        $voto=new Voto();       
        $voto->maestro_id = $request['maestro'];
        $voto->aprendiz_id = $request['aprendiz'];
        $voto->coleccion_id =  $coleccion->id;    
        $voto->dislike = true;      
        $voto->save();

        return response()->json(array('likes' => $coleccion->dislikes), 200);
    }

}
