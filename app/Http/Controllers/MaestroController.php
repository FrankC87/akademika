<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\Maestro;
use App\Models\Aprendiz;
use Illuminate\Support\Facades\Validator;

class MaestroController extends Controller {

    /**
     * Display a listing of the resource to the master.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_m() {
        //
        if (Auth::user()) {
            $maestros = Maestro::all();
            $aprendices = null;
            return view('perfils.maestro.maestro_list', compact('maestros', 'aprendices'));
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
            $maestros = Maestro::all();
            $aprendices = null;
            return view('perfils.aprendiz.aprendiz_list', compact('maestros', 'aprendices'));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil() {
        //
        if (Auth::user()) {
            return view('perfils.maestro.maestro_principal');
        } else {
            return view('auth.login');
        }
    }

    /**
     * destroy a relationship between maestro & aprendiz
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function expel($id) {
        //
        $maestro = Maestro::find(Auth::user()->maestro->id);
        $aprendiz = Aprendiz::find($id);

        $maestro->aprendices()->detach($aprendiz);

        return redirect('/maestro/lista/aprendices');
    }

    /**
     * Display the specified resource to a master.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $maestro = Maestro::findOrFail($id);
        return view('perfils.maestro.maestro_ver_maestro', compact('maestro'));
    }

    /**
     * Display the specified resource to a aprentice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_a($id) {
        //
        $maestro = Maestro::findOrFail($id);
        return view('perfils.aprendiz.aprendiz_ver_maestro', compact('maestro'));
    }
    
    /**
     * Display the articles of a specified resource to a aprentice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_articles($id) {
        //
        $maestro = Maestro::findOrFail($id);
        return view('perfils.aprendiz.aprendiz_ver_maestro_temas', compact('maestro'));
    }
    /**
     * Display the collections of a specified resource to a aprentice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_collections($id) {
        //
        $maestro = Maestro::findOrFail($id);
        return view('perfils.aprendiz.aprendiz_ver_maestro_colecciones', compact('maestro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $maestro = Maestro::findOrFail($id);
        return view('perfils.maestro.maestro_editar', compact('maestro'));
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
        $maestro = Maestro::findOrFail($id);

        if ($request->has('deletea')) {

            unlink(public_path('storage/' . $maestro->avatar_m));
            $maestro->update(['avatar_m' => null]);
        } else if ($request['avatar_m'] != null) {

            $validator = $this->validate($request, [
                'avatar_m' => 'image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=250,max_height=250',
            ]);

            if ($maestro->avatar_m != null) {
                unlink(public_path('storage/' . $maestro->avatar_m));
            }
            $avatar = $request->file('avatar_m')->store('avatars', 'public');
            $maestro->update(['avatar_m' => $avatar]);
        }


        Auth::user()->update($request->all());

        $maestro->update([
            'nick_m' => $request['nick_m'],
            'descripcion_m' => $request['descripcion_m']
        ]);

        return redirect('/maestro');
    }

}
