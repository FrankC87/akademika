<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller {

    /**
     * Display a listing of the resource for a aprentice.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_a() {
        //
        return view('perfils.aprendiz.aprendiz_mensajes_notificaciones');
    }

    /**
     * Display a listing of the resource for a master.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_m() {
        //
        return view('perfils.maestro.maestro_mensajes_notificaciones');
    }

    /**
     * Display the specified resource for a aprentice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_a($id) {
        //
        $notificacion = Notificacion::findOrFail($id);
        
        if ($notificacion->leido == false) {
            $notificacion->leido = true;
            $notificacion->update();
        }

        return view('perfils.aprendiz.aprendiz_mensajes_ver_notificacion', compact('notificacion'));
    }

    /**
     * Display the specified resource for a master.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_m($id) {
        //
        $notificacion = Notificacion::findOrFail($id);
        
        if ($notificacion->leido == false) {
            $notificacion->leido = true;
            $notificacion->update();
        }

        return view('perfils.maestro.maestro_mensajes_ver_notificacion', compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->delete();

        return redirect()->back();
    }

}
