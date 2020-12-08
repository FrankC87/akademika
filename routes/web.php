<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Auth::routes();
Route::group([
    'middleware' => 'auth',
        ], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/maestro', [App\Http\Controllers\MaestroController::class, 'perfil'])->name('maestro');
    Route::get('/aprendiz', [App\Http\Controllers\AprendizController::class, 'perfil'])->name('aprendiz');
    Route::get('/maestro/tema/', [App\Http\Controllers\TemaController::class, 'create'])->name('tema_nuevo');
    Route::post('/maestro/tema/nuevo', [App\Http\Controllers\TemaController::class, 'store'])->name('tema_guardar');
    Route::get('/maestro/tema/{id}/', [App\Http\Controllers\TemaController::class, 'show'])->name('maestro_tema_ver');
    Route::get('/aprendiz/tema/{id}/', [App\Http\Controllers\TemaController::class, 'show_aprendiz'])->name('aprendiz_tema_ver');
    Route::post('/maestro/comentario/nuevo', [App\Http\Controllers\ComentarioController::class, 'store'])->name('comentario_guardar');
    Route::post('/aprendiz/comentario/nuevo', [App\Http\Controllers\ComentarioController::class, 'store_a'])->name('aprendiz_comentario_guardar');
    Route::get('/aprendiz/buscador/', [App\Http\Controllers\BusquedaController::class, 'create'])->name('buscador');
    Route::post('/aprendiz/busqueda/', [App\Http\Controllers\BusquedaController::class, 'store'])->name('buscador_resultado');
    Route::get('/maestro/coleccion/', [App\Http\Controllers\ColeccionController::class, 'create'])->name('coleccion_nueva');
    Route::post('/maestro/coleccion/nuevo', [App\Http\Controllers\ColeccionController::class, 'store'])->name('coleccion_guardar');
    Route::get('/maestro/coleccion/{id}/', [App\Http\Controllers\ColeccionController::class, 'show'])->name('maestro_coleccion_ver');
    Route::get('/aprendiz/coleccion/{id}/', [App\Http\Controllers\ColeccionController::class, 'show_aprendiz'])->name('aprendiz_coleccion_ver');
    Route::get('/maestro/lista/aprendices', [App\Http\Controllers\AprendizController::class, 'index_m'])->name('maestro_lista_aprendices');
    Route::get('/maestro/lista/maestros', [App\Http\Controllers\MaestroController::class, 'index_m'])->name('maestro_lista_maestros');
    Route::get('/aprendiz/lista/aprendices', [App\Http\Controllers\AprendizController::class, 'index_a'])->name('aprendiz_lista_aprendices');
    Route::get('/aprendiz/lista/maestros', [App\Http\Controllers\MaestroController::class, 'index_a'])->name('aprendiz_lista_maestros');
    Route::get('/aprendiz/seguir_maestro/{id}/', [App\Http\Controllers\AprendizController::class, 'follow'])->name('aprendiz_seguir');
    Route::get('/aprendiz/expulsar/{id}/', [App\Http\Controllers\AprendizController::class, 'unfollow'])->name('aprendiz_expulsar');
    Route::get('/maestro/expulsar/{id}/', [App\Http\Controllers\MaestroController::class, 'expel'])->name('maestro_expulsar');
    Route::get('/comentario/borrar/{id}/', [App\Http\Controllers\ComentarioController::class, 'destroy'])->name('comentario_borrar');
    Route::get('/comentario/editar/{id}/', [App\Http\Controllers\ComentarioController::class, 'edit'])->name('comentario_editar');
    Route::post('/comentario/actualizar/{id}', [App\Http\Controllers\ComentarioController::class, 'update'])->name('comentario_actualizar');
    Route::get('/tema/borrar/{id}/', [App\Http\Controllers\TemaController::class, 'destroy'])->name('tema_borrar');
    Route::get('/tema/editar/{id}/', [App\Http\Controllers\TemaController::class, 'edit'])->name('tema_editar');
    Route::post('/tema/actualizar/{id}', [App\Http\Controllers\TemaController::class, 'update'])->name('tema_actualizar');
    Route::get('/coleccion/borrar/{id}/', [App\Http\Controllers\ColeccionController::class, 'destroy'])->name('coleccion_borrar');
    Route::get('/coleccion/editar/{id}/', [App\Http\Controllers\ColeccionController::class, 'edit'])->name('coleccion_editar');
    Route::post('/coleccion/actualizar/{id}', [App\Http\Controllers\ColeccionController::class, 'update'])->name('coleccion_actualizar');
    Route::get('/coleccion/{id}/tema/nuevo', [App\Http\Controllers\ColeccionController::class, 'addTema'])->name('coleccion_tema_nuevo');
    Route::get('/maestro/editar/{id}/', [App\Http\Controllers\MaestroController::class, 'edit'])->name('maestro_editar');
    Route::post('/maestro/actualizar/{id}', [App\Http\Controllers\MaestroController::class, 'update'])->name('maestro_actualizar');
    Route::get('/aprendiz/editar/{id}/', [App\Http\Controllers\AprendizController::class, 'edit'])->name('aprendiz_editar');
    Route::post('/aprendiz/actualizar/{id}', [App\Http\Controllers\AprendizController::class, 'update'])->name('aprendiz_actualizar');
    Route::get('/maestro/{id}/temas', [App\Http\Controllers\TemaController::class, 'showAll'])->name('maestro_temas');
    Route::get('/maestro/{id}/colecciones', [App\Http\Controllers\ColeccionController::class, 'showAll'])->name('maestro_colecciones');
	Route::get('/aprendiz/favoritos', [App\Http\Controllers\AprendizController::class, 'favourite'])->name('aprendiz_favoritos');
	Route::get('/aprendiz/favoritos/{id}/añadir', [App\Http\Controllers\AprendizController::class, 'addFavourite'])->name('aprendiz_favoritos_añadir');
	Route::get('/aprendiz/favoritos/{id}/quitar', [App\Http\Controllers\AprendizController::class, 'removeFavourite'])->name('aprendiz_favoritos_quitar');

    /* RUTAS DE VISITAS */
    Route::get('/aprendiz/ver/aprendiz/{id}/', [App\Http\Controllers\AprendizController::class, 'show'])->name('aprendiz_ver_aprendiz');
    Route::get('/aprendiz/ver/maestro/{id}/', [App\Http\Controllers\MaestroController::class, 'show_a'])->name('aprendiz_ver_maestro');
	Route::get('/aprendiz/ver/maestro/{id}/temas/', [App\Http\Controllers\MaestroController::class, 'show_articles'])->name('aprendiz_ver_maestro_temas');
	Route::get('/aprendiz/ver/maestro/{id}/colecciones/', [App\Http\Controllers\MaestroController::class, 'show_collections'])->name('aprendiz_ver_maestro_colecciones');
    Route::get('/maestro/ver/aprendiz/{id}/', [App\Http\Controllers\AprendizController::class, 'show_m'])->name('maestro_ver_aprendiz');
    Route::get('/maestro/ver/maestro/{id}/', [App\Http\Controllers\MaestroController::class, 'show'])->name('maestro_ver_maestro');

    /* RUTAS CORREO */
    Route::get('/aprendiz/mensajes/', [App\Http\Controllers\MensajeController::class, 'index_a'])->name('aprendiz_mensajes');
    Route::get('/aprendiz/mensajes/nuevo/', [App\Http\Controllers\MensajeController::class, 'create_a'])->name('aprendiz_mensaje_nuevo');
    Route::get('/aprendiz/mensajes/leidos/', [App\Http\Controllers\MensajeController::class, 'listRead_a'])->name('aprendiz_mensajes_leidos');
    Route::get('/aprendiz/mensajes/enviados/', [App\Http\Controllers\MensajeController::class, 'listSend_a'])->name('aprendiz_mensajes_enviados');
    Route::get('/aprendiz/mensajes/ver/{id}/recibido/', [App\Http\Controllers\MensajeController::class, 'showReceived'])->name('aprendiz_ver_recibido');
    Route::get('/aprendiz/mensajes/ver/{id}/enviado/', [App\Http\Controllers\MensajeController::class, 'showSend'])->name('aprendiz_ver_enviado');
    Route::get('/aprendiz/mensajes/notificaciones/', [App\Http\Controllers\NotificacionController::class, 'index_a'])->name('aprendiz_notificaciones');
	Route::get('/aprendiz/mensajes/ver/{id}/notificacion/', [App\Http\Controllers\NotificacionController::class, 'show_a'])->name('aprendiz_ver_notificacion');

    Route::get('/maestro/mensajes/', [App\Http\Controllers\MensajeController::class, 'index_m'])->name('maestro_mensajes');
    Route::get('/maestro/mensajes/nuevo/', [App\Http\Controllers\MensajeController::class, 'create_m'])->name('maestro_mensaje_nuevo');
    Route::get('/maestro/mensajes/leidos/', [App\Http\Controllers\MensajeController::class, 'listRead_m'])->name('maestro_mensajes_leidos');
    Route::get('/maestro/mensajes/enviados/', [App\Http\Controllers\MensajeController::class, 'listSend_m'])->name('maestro_mensajes_enviados');
    Route::get('/maestro/mensajes/ver/{id}/recibido/', [App\Http\Controllers\MensajeController::class, 'showReceived'])->name('maestro_ver_recibido');
    Route::get('/maestro/mensajes/ver/{id}/enviado/', [App\Http\Controllers\MensajeController::class, 'showSend'])->name('maestro_ver_enviado');
    Route::get('/maestro/mensajes/notificaciones/', [App\Http\Controllers\NotificacionController::class, 'index_m'])->name('maestro_notificaciones');
	Route::get('/maestro/mensajes/ver/{id}/notificacion/', [App\Http\Controllers\NotificacionController::class, 'show_m'])->name('maestro_ver_notificacion');

    Route::post('/mensajes/guardar/', [App\Http\Controllers\MensajeController::class, 'store'])->name('mensaje_enviar');
    Route::get('/mensajes/borrar/{id}/enviado/', [App\Http\Controllers\MensajeController::class, 'destroySend'])->name('mensaje_borrar_enviado');
    Route::get('/mensajes/borrar/{id}/recibido/', [App\Http\Controllers\MensajeController::class, 'destroyReceived'])->name('mensaje_borrar_recibido');
	Route::get('/mensajes/borrar/{id}/notificacion/', [App\Http\Controllers\NotificacionController::class, 'destroy'])->name('mensaje_borrar_notificacion');
});


/* RUTAS AJAX */
Route::post('/comentario/like', [App\Http\Controllers\ComentarioController::class, 'like'])->name('comentario_like');
Route::post('/comentario/dislike', [App\Http\Controllers\ComentarioController::class, 'dislike'])->name('comentario_dislike');
Route::post('/tema/like', [App\Http\Controllers\TemaController::class, 'like'])->name('tema_like');
Route::post('/tema/dislike', [App\Http\Controllers\TemaController::class, 'dislike'])->name('tema_dislike');
Route::post('/coleccion/like', [App\Http\Controllers\ColeccionController::class, 'like'])->name('coleccion_like');
Route::post('/coleccion/dislike', [App\Http\Controllers\ColeccionController::class, 'dislike'])->name('coleccion_dislike');
Route::post('/aprendiz/busquedas', [App\Http\Controllers\BusquedaController::class, 'show'])->name('busquedas');
Route::post('/maestro/tendencias', [App\Http\Controllers\BusquedaController::class, 'show_all'])->name('busquedas_totales');
Route::post('/reportes/guardar/', [App\Http\Controllers\ReporteController::class, 'store'])->name('reporte_nuevo');

/* RUTAS JSON */
Route::get('/provincias', function() {
    return response()->file(resource_path('js\data\provincias.json'));
});
Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias');
Route::get('/aprendiz/recomendados', [App\Http\Controllers\BusquedaController::class, 'recomend'])->name('recomendados');

/* RUTAS ADMIN */
Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
        ], function () {
    Route::get('', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_principal');
    Route::get('/colecciones', [App\Http\Controllers\ColeccionController::class, 'index'])->name('colecciones');
    Route::get('/temas', [App\Http\Controllers\TemaController::class, 'index'])->name('temas');
    Route::get('/busquedas', [App\Http\Controllers\BusquedaController::class, 'index'])->name('busqueda');
    Route::get('/comentarios', [App\Http\Controllers\ComentarioController::class, 'index'])->name('comentarios');
});
