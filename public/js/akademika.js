let controlPass;

$(() => {

    ajustaAlto();

    $('a.btn_like').click(likesComentarios);
    $('a.btn_dislike').click(dislikesComentarios);
    $('a.btn_like_tema').click(likesTemas);
    $('a.btn_dislike_tema').click(dislikesTemas);
	$('a.btn_like_coleccion').click(likesColeccion);
    $('a.btn_dislike_coleccion').click(dislikesColeccion);
    $('a.btn_delete').click(confirmarBorrado);
	$('a#vermas').click(mostrarPerfiles);
	$('a#vermenos').click(ocultarPerfiles);
    $('button#mensajeNuevoSubmit').click(validaReceptor);
	$('button#creaReporte').click(creaReporte);
	
    tablasBuscador();
    tablasConfiguracion();
    formularioInfo();
    formularioLocalizacion();
    cargaBusquedas();
	cargaTendencias();
	cargaPerfiles();
    buscadorCategorias();
    formularioValidacion();
	
    $('[data-toggle="tooltip"]').tooltip();
    
    $(".clickable_row").click(function () {
        window.location = $(this).data("href");
    });
    $(".clickable_row").keyup(function () {
        if (event.keyCode === 13) {
            window.location = $(this).data("href");
        } else {
            event.preventDefault();
        }
    });

});

function cargaPerfiles(){
	$('tbody#cuerpoPerfiles tr').each(function(i){
		if(i<3){
		$(this).removeClass('oculto');
		$(this).addClass('visible');
		}
	})
	if($('tbody#cuerpoPerfiles tr.oculto').length==0){
		$('a#vermas').removeClass('visible');
		$('a#vermas').addClass('oculto');
	}
}

function mostrarPerfiles(){
	$('tbody#cuerpoPerfiles tr.oculto').each(function(i){
		if(i<3){
		$(this).removeClass('oculto');
		$(this).addClass('visible');
		}
	})
	if($('tbody#cuerpoPerfiles tr.oculto').length==0){
		$(this).removeClass('visible');
		$(this).addClass('oculto');
	}
	if($('tbody#cuerpoPerfiles tr.visible').length>3){
		$('a#vermenos').removeClass('oculto');
		$('a#vermenos').addClass('visible');
	}
}

function ocultarPerfiles(){
	$('tbody#cuerpoPerfiles tr.visible').slice(-3).each(function(i){
		if(i<3 && $('tbody#cuerpoPerfiles tr.visible').length>3){
		$(this).removeClass('visible');
		$(this).addClass('oculto');
		}
	})
	if($('tbody#cuerpoPerfiles tr.oculto').length>0){
		$('a#vermas').removeClass('oculto');
		$('a#vermas').addClass('visible');
	}
	if($('tbody#cuerpoPerfiles tr.visible').length<=3){
		$(this).removeClass('visible');
		$(this).addClass('oculto');
	}
}

function tablasBuscador() {
    $("#buscador_tabla").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#body_tabla tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
}

function tablasConfiguracion() {
    $('#tablaMensajes').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        searching: false,
        bInfo: false,
        orderClasses: false,
        columnDefs: [{orderable: false, targets: [4]}],
    });

    $('#tablaPerfiles').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        order: [[2, "desc"]],
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        searching: false,
        bInfo: false,
        orderClasses: false,
    });
}

function creaReporte() {

	let motivo = $(this).siblings('textarea#motivo_reporte').val();
    let comentario_id = $(this).siblings('input#comentario_id_reporte').val();
	let maestro_id = $(this).siblings('input#maestro_id_reporte').val();
	let aprendiz_id = $(this).siblings('input#aprendiz_id_reporte').val();
	let tema_id = $(this).siblings('input#tema_id_reporte').val();
	let coleccion_id = $(this).siblings('input#coleccion_id_reporte').val();

    $.ajax({
        url: "/reportes/guardar/",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: {
			motivo: motivo,
            comentario_id: comentario_id,
			maestro_id: maestro_id,
			aprendiz_id: aprendiz_id,
			tema_id: tema_id,
			coleccion_id: coleccion_id,
        },
        success: function (data) {
			$('.reportModal').modal('hide');
            Swal.fire({
            title: 'Reporte creado',
            text: "Su reporte se ha creado satisfactoriamente, lo revisaremos lo antes posible",
        })
        }
    });
}



function likesComentarios() {

    let id_comentario = $(this).siblings('input.comentario_id').val();
	let id_maestro = $(this).siblings('input.maestro_id').val();
	let id_aprendiz = $(this).siblings('input.aprendiz_id').val();
    let objeto = $(this);



    $.ajax({
        url: "/comentario/like",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: {
            id: id_comentario,
			maestro: id_maestro,
			aprendiz: id_aprendiz,
        },
        success: function (data) {
            $(objeto).next("span").text(data.likes);
			$(objeto).off();
			$(objeto).siblings('a.btn_dislike').off();
        }
    });
}

function dislikesComentarios() {

    let id_comentario = $(this).siblings('input.comentario_id').val();
	let id_maestro = $(this).siblings('input.maestro_id').val();
	let id_aprendiz = $(this).siblings('input.aprendiz_id').val();
    let objeto = $(this);

    $.ajax({
        url: "/comentario/dislike",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: {
            id: id_comentario,
			maestro: id_maestro,
			aprendiz: id_aprendiz,
        },
        success: function (data) {
            $(objeto).next("span").text(data.dislikes);
			$(objeto).off();
			$(objeto).siblings('a.btn_like').off();
        }
    });
}

function likesTemas() {

    let id_tema = $(this).siblings('input.tema_id').val();
	let id_maestro = $(this).siblings('input.maestro_id').val();
	let id_aprendiz = $(this).siblings('input.aprendiz_id').val();
    let objeto = $(this);

    $.ajax({
        url: "/tema/like",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: {
            id: id_tema,
			maestro: id_maestro,
			aprendiz: id_aprendiz,
        },
        success: function (data) {
            $(objeto).next("span").text(data.likes);
			$(objeto).off();
			$(objeto).siblings('a.btn_dislike_tema').off();
        }
    });
}

function dislikesTemas() {

    let id_tema = $(this).siblings('input.tema_id').val();
	let id_maestro = $(this).siblings('input.maestro_id').val();
	let id_aprendiz = $(this).siblings('input.aprendiz_id').val();
    let objeto = $(this);

    $.ajax({
        url: "/tema/dislike",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: {
			id: id_tema,
			maestro: id_maestro,
			aprendiz: id_aprendiz,
        },
        success: function (data) {
            $(objeto).next("span").text(data.dislikes);
			$(objeto).off();
			$(objeto).siblings('a.btn_like_tema').off();
        }
    });
}

function likesColeccion() {

    
    let id_coleccion = $(this).siblings('input.coleccion_id').val();
	let id_maestro = $(this).siblings('input.maestro_id').val();
	let id_aprendiz = $(this).siblings('input.aprendiz_id').val();
    let objeto = $(this);

    $.ajax({
        url: "/coleccion/like",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: {
            id: id_coleccion,
			maestro: id_maestro,
			aprendiz: id_aprendiz,
        },
        success: function (data) {
            $(objeto).next("span").text(data.likes);
			$(objeto).off();
			$(objeto).siblings('a.btn_dislike_coleccion').off();
        }
    });
}

function dislikesColeccion() {

   let id_coleccion = $(this).siblings('input.coleccion_id').val();
	let id_maestro = $(this).siblings('input.maestro_id').val();
	let id_aprendiz = $(this).siblings('input.aprendiz_id').val();
    let objeto = $(this);

    $.ajax({
        url: "/coleccion/dislike",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        data: {
             id: id_coleccion,
			maestro: id_maestro,
			aprendiz: id_aprendiz,
        },
        success: function (data) {
            $(objeto).next("span").text(data.dislikes);
			$(objeto).off();
			$(objeto).siblings('a.btn_like_coleccion').off();
        }
    });
}

function ajustaAlto() {

    var height = $(window).height();
    $('#app').css('min-height', height);

}

function confirmarBorrado() {

    event.stopPropagation();
    event.preventDefault();

    Swal.fire({
        title: '¿Desea eliminar el contenido?',
        text: "¡¡No podra deshacer el cambio!!",
        showCancelButton: true,
        confirmButtonColor: 'rgba(127,219,51,1)',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = this.href;
        }
    });

}
/*Metodo para añadir las provincias al campo localizacion del formulario de registro*/
function formularioLocalizacion() {
    $.getJSON('/provincias', function (data) {

        for (var i = 0; i < data.length; i++) {
            $("select#localidad").append("<option value=" + data[i].nm + ">" + data[i].nm + "</option>");
        }

    });
}

/*Metodo para añadir las categorias al buscador del aprendiz*/
function buscadorCategorias() {
    $.getJSON('/categorias', function (data) {

        for (var i = 0; i < data.length; i++) {
            $("#search_categoria").append("<option value=" + data[i].id + ">" + data[i].nombre + "</option>");
        }

    });
}

function cargaBusquedas() {

    let id = $('tbody.cuerpoCategorias').attr('id');
    if (id != null) {
        let id_aprendiz = parseInt(id.substring(17, id.length));


        $.ajax({
            url: "/aprendiz/busquedas",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            data: {
                id: id_aprendiz
            },
            success: function (data) {
			 if(data.length!=0){
                let total = 0;
                for (var i = 0; i < data.length; i++) {
                    total += data[i].porcentaje;
                }
                for (var i = 0; i < data.length; i++) {
                    if (i < 3) {
                        $(".cuerpoCategorias").append("<tr class='clickable_row'><td class='col-sm-auto'><i class='fas fa-tags'></i></td><td class='font-weight-bold col-sm-auto'>" + data[i].nombre + "</td><td class='col-sm-auto'>" + parseInt(data[i].porcentaje * 100 / total) + "%</td><td class='col-sm-auto'><progress value='" + parseInt(data[i].porcentaje * 100 / total) + "' max='100'></progress></tr>");
                    }
                }

            }else{
				$(".cuerpoCategorias").append('<div class="card my-3 card_info"><div class="card-header font-weight-bold card_info_text">Aqui se mostraran sus categorias mas buscadas.</div><div class="card-body"><p class="card-text text-center ">Esta sección le permitira mantener un control de su actividad. </p></div><div class="card-footer card_info_text">Haga click sobre el boton "Busqueda&nbsp;<i class="fas fa-search"></i>" debajo de su avatar, para realizar alguna busqueda.</div></div>');
			}
			}
        });
    }
}

function cargaTendencias() {




        $.ajax({
            url: "/maestro/tendencias",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            data: {
            },
            success: function (data) {
                let total = 0;
                for (var i = 0; i < data.length; i++) {
                    total += data[i].porcentaje;
                }
                for (var i = 0; i < data.length; i++) {
                    if (i < 3) {
                        $(".cuerpoTendencias").append("<tr class='clickable_row'><td class='col-sm-auto'><i class='fas fa-tags'></i></td><td class='font-weight-bold col-sm-auto'>" + data[i].nombre + "</td><td class='col-sm-auto'>" + parseInt(data[i].porcentaje * 100 / total) + "%</td><td class='col-sm-auto'><progress value='" + parseInt(data[i].porcentaje * 100 / total) + "' max='100'></progress></tr>");
                    }
                }

            }
        });
    
}

/*Metodo para preparar los mensajes de informacion del formulario de registro*/
function formularioInfo() {
    $('.nombre_info').click(function () {
        Swal.fire({
            title: 'Nombre',
            text: "Este campo servira para identificar al usuario dentro de la plataforma, solo sera visible por el mismo y el administrador.",
        })

    });
    $('.correo_info').click(function () {
        Swal.fire({
            title: 'Correo electronico',
            text: "Direccion de correo electronico valida, que sera utilizada como herramienta de comunicacion entre la plataforma y el usuario.",
        })
    });
    $('.birthdate_info').click(function () {
        Swal.fire({
            title: 'Fecha de Nacimiento',
            text: "En caso de introducir la fecha de nacimiento, la edad del usuario le sera mostrada a todos aquellos que consulten cualquiera de sus perfiles.",
        })
    });
    $('.localidad_info').click(function () {
        Swal.fire({
            title: 'Localidad',
            text: "Al seleccionar una localizacion, cualquiera que acceda a alguno de los perfiles podra verla.",
        })
    });
    $('.sexo_info').click(function () {
        Swal.fire({
            title: 'Sexo',
            text: "Campo que en caso de ser seleccionado, indicara el genero del propietario cuando un visitante acceda a consultar un perfil",
        })
    });
    $('.nicka_info').click(function () {
        Swal.fire({
            title: 'Nick del Aprendiz',
            text: "Nombre que se utilizara para identificar el perfil Aprendiz del usuario, y que podra ver cualquiera que acceda al perfil.",
        })
    });
    $('.nickm_info').click(function () {
        Swal.fire({
            title: 'Nick del Maestro',
            text: "Nombre que se utilizara para identificar el perfil Maestro del usuario, y que podra ver cualquiera que acceda al perfil.",
        })
    });
    $('.descripciona_info').click(function () {
        Swal.fire({
            title: 'Descripcion del Aprendiz',
            text: "Informacion que se le mostrara a los visitantes que accedan al perfil de Aprendiz.",
        })
    });
    $('.descripcionm_info').click(function () {
        Swal.fire({
            title: 'Descripcion del Maestro',
            text: "Informacion que se le mostrara a los visitantes que accedan al perfil de Maestro.",
        })
    });
    $('.maestro_info').click(function () {
        Swal.fire({
            title: 'Perfil de Maestro',
            text: "El perfil de Maestro permite al usuario crear contenido en la plataforma en forma de articulos, estos estaran relacionados con temas a eleccion del maestro.",
        })
    });
    $('.aprendiz_info').click(function () {
        Swal.fire({
            title: 'Perfil de Aprendiz',
            text: "El perfil de Aprendiz permite al usuario buscar contenido en la plataforma en forma de articulos creados por los Maestros, ademas de interaccionar en los mismos con otro usuarios.",
        })
    });
}
/*Metodo para preparar el formulario registro antes de validar*/
function formularioValidacion() {

    $("#form_pass_error").hide();
    $("#form_conf_error").hide();
    $("#password").on("keyup", validaPass);
    $("#password-confirm").on("keyup", validaConfir);
    $("#btn_registro").on("click", validaFormulario);

}
/*Metodo para comprobar el registro antes de enviarlo*/
function validaFormulario() {
    //Comprobamos el campo password
    if (!validaPass()) {
        event.preventDefault();
        $("#form_pass_error").fadeIn(500);
    }
}

/*Metodo para comprobar que hay un receptor valido al enviar un mensaje*/
function validaReceptor() {

    if (!$("#receptor_m").val() && !$("#receptor_a").val()) {
        event.preventDefault();
        $("#receptorError").fadeIn(500);
    }
}

//Metodo para validar la contraseña
function validaPass() {


    let controlLong = false;
    let controlMay = false;
    let controlMin = false;
    let controlAlfa = false;
    //Guardamos la longitud actual de la cadena
    let longitudPass = $("#password").val().length;
    //Mostramos los requesitos
    $("#form_pass_error").fadeIn(500);

    //Comprobamos que cumpla la longitud minima
    if (longitudPass < 8) {
        $("#form_pass_error li:nth-child(1)").fadeIn(500);
    } else {
        $("#form_pass_error li:nth-child(1)").hide();
        controlLong = true;
    }

    //Recorremos la cadena introducida hasta el momento
    for (let i = 0; i < longitudPass; i++) {
        //Comprobamos que tenga una letra mayuscula
        if (
                $("#password").val().charCodeAt(i) > 64 &&
                $("#password").val().charCodeAt(i) < 91
                ) {
            controlMay = true;
        }
        //Comprobamos que tenga una letra minuscula
        if (
                $("#password").val().charCodeAt(i) > 96 &&
                $("#password").val().charCodeAt(i) < 122
                ) {
            controlMin = true;
        }
        //Comprobamos que tenga un caracter alfanumerico
        if (
                $("#password").val().charCodeAt(i) > 32 &&
                $("#password").val().charCodeAt(i) < 65
                ) {
            controlAlfa = true;
        }
    }
    //Si cumple o no los requisitos mostramos los mensajes correspondientes
    if (controlMay) {
        $("#form_pass_error li:nth-child(2)").hide();
    } else {
        $("#form_pass_error li:nth-child(2)").fadeIn(500);
    }
    if (controlMin) {
        $("#form_pass_error li:nth-child(3)").hide();
    } else {
        $("#form_pass_error li:nth-child(3)").fadeIn(500);
    }
    if (controlAlfa) {
        $("#form_pass_error li:nth-child(4)").hide();
    } else {
        $("#form_pass_error li:nth-child(4)").fadeIn(500);
    }

    //Si cumple todos los requisitos la password esta validada
    if (controlLong && controlAlfa && controlMay && controlMin) {
        return true;
    }

}

//Metodo para validar que las contraseñas coincidan


function validaConfir() {

    if ($("#password").val() !== $("#password-confirm").val()) {
        $("#form_conf_error").fadeIn(500);
        return false;
    } else {
        $("#form_conf_error").hide();
        return true;
    }
}





               
         

