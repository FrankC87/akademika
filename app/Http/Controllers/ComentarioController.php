<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Comentario;
use App\Models\Maestro;
use App\Models\Aprendiz;
use App\Models\Voto;
use App\Models\Tema;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        if (Auth::user()) {
            $comentarios = Comentario::all();
            return response()->json($comentarios);
        } else {
            return view('auth.login');
        }
    }

    /**
     * Store a newly created resource by a master.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $tema = Tema::find($request['tema_id']);
        $maestro = Maestro::find($request['autor_m']);

        $validator = Validator::make($request->all(), [
                    'comentario' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('maestro_tema_ver', ['id' => $tema->id])
                            ->withErrors($validator)
                            ->withInput();
        } else {

            $comentario = new Comentario();
            $comentario->contenido = $request['comentario'];
            $comentario->maestro()->associate($maestro);
            $comentario->tema()->associate($tema);
            $comentario->save();


            foreach ($maestro->aprendices as $aprendiz) {
                $notificacion = new Notificacion();
                $notificacion->asunto = 'Nuevo comentario del maestro ' . $maestro->nick_m;
                $notificacion->contenido = 'El maestro <span class=" font-weight-bold">' . $maestro->nick_m . '</span> ha comentado en el articulo titulado: <a href="' . route('aprendiz_tema_ver', $tema->id) . '"><span class=" font-weight-bold">' . $tema->titulo . '</span></a> ';
                $notificacion->receptor_a = $aprendiz->id;
                $notificacion->save();
            }


            return redirect()->route('maestro_tema_ver', ['id' => $tema->id]);
        }
    }

    /**
     * Store a newly created resource by aprentice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_a(Request $request) {
        //
        $tema = Tema::find($request['tema_id']);
        $aprendiz = Aprendiz::find($request['autor_a']);

        $validator = Validator::make($request->all(), [
                    'comentario' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('aprendiz_tema_ver', ['id' => $tema->id])
                            ->withErrors($validator)
                            ->withInput();
        } else {

            $comentario = new Comentario();
            $comentario->contenido = $request['comentario'];
            $comentario->aprendiz()->associate($aprendiz);
            $comentario->tema()->associate($tema);
            $comentario->save();

            $notificacion = new Notificacion();
            $notificacion->asunto = 'Nuevo comentario en ' . $tema->titulo;
            $notificacion->contenido = 'El aprendiz ' . $aprendiz->nick_a . ' ha comentado en su articulo ' . $tema->titulo;
            $notificacion->receptor_m = $tema->maestro->id;
            $notificacion->save();

            return redirect()->route('aprendiz_tema_ver', ['id' => $tema->id]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $comentario = Comentario::findOrFail($id);
        $tema = $comentario->tema;
        if ($comentario->maestro_id == null) {
            return view('perfils.aprendiz.aprendiz_comentario_editar', compact('comentario', 'tema'));
        } else {
            return view('perfils.maestro.maestro_comentario_editar', compact('comentario', 'tema'));
        }
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
        $comentario = Comentario::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'contenido' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $comentario->update($request->all());
            if ($comentario->maestro_id == null) {
                return redirect()->route('aprendiz_tema_ver', ['id' => $comentario->tema_id]);
            } else {
                return redirect()->route('maestro_tema_ver', ['id' => $comentario->tema_id]);
            }
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
        $comentario = Comentario::findOrFail($id);

        $comentario->votos()->delete();
        $comentario->delete();

        return back()->withMessage('¡Comentario Borrado!');
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

        $comentario = Comentario::findOrFail($id);
        $comentario->likes = $comentario->likes + 1;
        $comentario->update();

        $voto = new Voto();
        $voto->maestro_id = $request['maestro'];
        $voto->aprendiz_id = $request['aprendiz'];
        $voto->comentario_id = $comentario->id;
        $voto->like = true;
        $voto->save();

        return response()->json(array('likes' => $comentario->likes), 200);
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

        $comentario = Comentario::findOrFail($id);
        $comentario->dislikes = $comentario->dislikes + 1;
        $comentario->update();

        $voto = new Voto();
        $voto->maestro_id = $request['maestro'];
        $voto->aprendiz_id = $request['aprendiz'];
        $voto->comentario_id = $comentario->id;
        $voto->dislike = true;
        $voto->save();

        return response()->json(array('dislikes' => $comentario->dislikes), 200);
    }

}
