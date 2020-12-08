<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Aprendiz;
use App\Models\Maestro;
use App\Models\Categoria;
use App\Models\Busqueda;
use App\Models\Notificacion;
use App\Models\Tema;

class AprendizController extends Controller {

    /**
     * Display a listing of the resource to the master.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_m() {
        //
        if (Auth::user()) {
            $aprendices = Aprendiz::all();
            $maestros = null;
            return view('perfils.maestro.maestro_list', compact('aprendices', 'maestros'));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Display a listing of the resource to the aprentice.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_a() {
        //
        if (Auth::user()) {
            $aprendices = Aprendiz::all();
            $maestros = null;
            return view('perfils.aprendiz.aprendiz_list', compact('aprendices', 'maestros'));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Display principal view for a aprendiz
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil() {
        //
        if (Auth::user()) {
            $categorias = DB::table('categorias')
                    ->select(DB::raw('*'));

            $consultas = DB::table('busquedas')
                    ->select(DB::raw('count(*) as porcentaje,categorias.nombre,categorias.id'))
                    ->where('busquedas.aprendiz_id', '=', Auth::user()->aprendiz->id)
                    ->groupBy('categoria_id')
                    ->orderBy('porcentaje', 'Desc')
                    ->joinSub($categorias, 'categorias', function ($join) {
                        $join->on('busquedas.categoria_id', '=', 'categorias.id');
                    })
                    ->first();

            if ($consultas != null) {
                $temas = Tema::all()->where('categoria_id', $consultas->id)->sortBy('like');
            } else {
                $temas = Tema::all()->sortBy('like');
            }

            return view('perfils.aprendiz.aprendiz_principal', compact('temas'));
            
        } else {
            return view('auth.login');
        }
    }

    /**
     * Create a relationship between maestro & aprendiz
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function follow($id) {
        //
        $maestro = Maestro::find($id);
        $aprendiz = Aprendiz::find(Auth::user()->aprendiz->id);

        $aprendiz->maestros()->attach($maestro);

        $notificacion = new Notificacion();
        $notificacion->asunto = 'Nuevo seguidor';
        $notificacion->contenido = 'El aprendiz <a href="' . route('maestro_ver_aprendiz', $aprendiz->id) . '"><span class="font-weight-bold">' . $aprendiz->nick_a . '</span></a> es su nuevo seguidor';
        $notificacion->receptor_m = $maestro->id;
        $notificacion->save();

        return redirect()->back();
    }

    /**
     * destroy a relationship between maestro & aprendiz
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unfollow($id) {
        //
        $maestro = Maestro::find($id);
        $aprendiz = Aprendiz::find(Auth::user()->aprendiz->id);

        $aprendiz->maestros()->detach($maestro);

        return redirect()->back();
    }

    /**
     * Display the specified resource to a aprentice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $aprendiz = Aprendiz::findOrFail($id);
        return view('perfils.aprendiz.aprendiz_ver_aprendiz', compact('aprendiz'));
    }

    /**
     * Display the specified resource to a master.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_m($id) {
        //
        $aprendiz = Aprendiz::findOrFail($id);
        return view('perfils.maestro.maestro_ver_aprendiz', compact('aprendiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $aprendiz = Aprendiz::findOrFail($id);
        return view('perfils.aprendiz.aprendiz_editar', compact('aprendiz'));
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
        $aprendiz = Aprendiz::findOrFail($id);

        if ($request->has('deletea')) {
            unlink(public_path('storage/' . $aprendiz->avatar_a));
            $aprendiz->update(['avatar_a' => null]);
        } else if ($request['avatar_a'] != null) {
            $validator = $this->validate($request, [
                'avatar_a' => 'image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=250,max_height=250',
            ]);
            if ($aprendiz->avatar_a != null) {
                unlink(public_path('storage/' . $aprendiz->avatar_a));
            }
            $avatar = $request->file('avatar_a')->store('avatars', 'public');
            $aprendiz->update(['avatar_a' => $avatar]);
        }


        Auth::user()->update($request->all());

        $aprendiz->update([
            'nick_m' => $request['nick_m'],
            'descripcion_m' => $request['descripcion_m']
        ]);

        return redirect('/aprendiz');
    }

    /**
     * display a list of favourites article.
     *
     * @return \Illuminate\Http\Response
     */
    public function favourite() {
        //
        return view('perfils.aprendiz.aprendiz_favoritos');
    }

    /**
     * Add a article to fovourites.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addFavourite($id) {
        //
        $tema = Tema::find($id);
        $aprendiz = Aprendiz::find(Auth::user()->aprendiz->id);

        $aprendiz->favoritos()->attach($tema);

        $notificacion = new Notificacion();
        $notificacion->asunto = 'Nuevo favorito';
        $notificacion->contenido = 'El articulo <a href="' . route('aprendiz_tema_ver', $tema->id) . '"><span class="font-weight-bold">' . $tema->titulo . '</span></a> ha sido añadido a favoritos';
        $notificacion->receptor_a = $aprendiz->id;
        $notificacion->save();

        return redirect()->back();
    }

    /**
     * remove a article from fovourites.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeFavourite($id) {
        //
        $tema = Tema::find($id);
        $aprendiz = Aprendiz::find(Auth::user()->aprendiz->id);

        $aprendiz->favoritos()->detach($tema);

        $notificacion = new Notificacion();
        $notificacion->asunto = 'Eliminado de favoritos';
        $notificacion->contenido = 'El articulo <a href="' . route('aprendiz_tema_ver', $tema->id) . '"><span class="font-weight-bold">' . $tema->titulo . '</span></a> ha sido eliminado de favoritos';
        $notificacion->receptor_a = $aprendiz->id;
        $notificacion->save();

        return redirect()->back();
    }

}
