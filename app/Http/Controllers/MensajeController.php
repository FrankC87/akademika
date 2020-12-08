<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\MensajeEnviado;
use App\Models\MensajeRecibido;
use App\Models\Aprendiz;
use App\Models\Maestro;
use Illuminate\Http\Request;

class MensajeController extends Controller {

    /**
     * Display a listing of the resource for a aprentice.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_a() {
        //
        return view('perfils.aprendiz.aprendiz_mensajes_entrada');
    }

    /**
     * Display a listing of the resource for a master.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_m() {
        //
        return view('perfils.maestro.maestro_mensajes_entrada');
    }

    /**
     * Show the form for creating a new resource for aprentice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_a() {
        //
        $maestros = Maestro::all();
        $aprendices = Aprendiz::all();
        return view('perfils.aprendiz.aprendiz_mensaje_nuevo', compact('maestros', 'aprendices'));
    }

    /**
     * Show the form for creating a new resource for master.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_m() {
        //
        $maestros = Maestro::all();
        $aprendices = Aprendiz::all();
        return view('perfils.maestro.maestro_mensaje_nuevo', compact('maestros', 'aprendices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $enviado = MensajeEnviado::create([
                    'asunto' => $request['asunto'],
                    'contenido' => $request['contenido'],
                    'emisor_a' => $request['emisor_a'],
                    'emisor_m' => $request['emisor_m'],
                    'receptor_a' => $request['receptor_a'],
                    'receptor_m' => $request['receptor_m'],
        ]);

        $recibido = MensajeRecibido::create([
                    'asunto' => $request['asunto'],
                    'contenido' => $request['contenido'],
                    'leido' => false,
                    'emisor_a' => $request['emisor_a'],
                    'emisor_m' => $request['emisor_m'],
                    'receptor_a' => $request['receptor_a'],
                    'receptor_m' => $request['receptor_m'],
        ]);

        if ($request['emisor_a'] == null) {
            return redirect('/maestro/mensajes/');
        } else {
            return redirect('/aprendiz/mensajes/');
        }
    }

    /**
     * Display send resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSend($id) {
        //
        $mensaje = MensajeEnviado::findOrFail($id);
        $maestro = $mensaje->emisorMaestro;

        if ($maestro == null) {
            return view('perfils.aprendiz.aprendiz_mensajes_ver_enviado', compact('mensaje'));
        } else {
            return view('perfils.maestro.maestro_mensajes_ver_enviado', compact('mensaje'));
        }
    }

    /**
     * Display received resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showReceived($id) {
        //
        $mensaje = MensajeRecibido::findOrFail($id);
        $maestro = $mensaje->receptorMaestro;

        if ($mensaje->leido == false) {
            $mensaje->leido = true;
            $mensaje->update();
        }

        if ($maestro == null) {
            return view('perfils.aprendiz.aprendiz_mensajes_ver_recibido', compact('mensaje'));
        } else {
            return view('perfils.maestro.maestro_mensajes_ver_recibido', compact('mensaje'));
        }
    }

    /**
     * Display the view to see read resources for aprentice.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function listRead_a() {
        //
        return view('perfils.aprendiz.aprendiz_mensajes_leidos');
    }

    /**
     * Display the view to see read resources for master.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function listRead_m() {
        //
        return view('perfils.maestro.maestro_mensajes_leidos');
    }

    /**
     * Display the view to see send resources for aprentice.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function listSend_a() {
        //
        return view('perfils.aprendiz.aprendiz_mensajes_enviados');
    }

    /**
     * Display the view to see send resources for master.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function listSend_m() {
        //
        return view('perfils.maestro.maestro_mensajes_enviados');
    }

    /**
     * Remove send message.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroySend($id) {
        //
        $mensaje = MensajeEnviado::findOrFail($id);
        $maestro = $mensaje->emisorMaestro;
        $mensaje->delete();

        if ($maestro == null) {
            return redirect()->route('aprendiz_mensajes_enviados');
        } else {
            return redirect()->route('maestro_mensajes_enviados');
        }
    }

    /**
     * Remove received message.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyReceived($id) {
        //
        $mensaje = MensajeRecibido::findOrFail($id);
        $maestro = $mensaje->receptorMaestro;
        $mensaje->delete();

        if ($maestro == null) {
            return redirect()->route('aprendiz_mensajes');
        } else {
            return redirect()->route('maestro_mensajes');
        }
    }

}
