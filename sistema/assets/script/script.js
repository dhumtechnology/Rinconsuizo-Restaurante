/*
Author: Ing. Ruben D. Chirinos R.
URL: http://asesoramientopc.hol.es/
*/

function set_salas_mesas(element) {
    $.get('funciones.php', {'salas_mesas': true})
        .done(function(response) {
            $(element).html(response);
        })
}

jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z????????????,. ]+$/i.test(value);
});

/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/
$('document').ready(function() {

    /*set_salas_mesas($('#salas-mesas'));
    setTimeout(function run() {
        set_salas_mesas($('#salas-mesas'));
        setTimeout(run, 2000);
    }, 2000);*/
						   
	 $("#loginform").validate({
      rules:
	  {
			usuario: { required: true, },
			password: { required: true, },
	   },
       messages:
	   {
		    usuario:{  required: "Ingrese Usuario de Acceso" },
			password:{  required: "Ingrese Clave de Acceso" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#loginform").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'index.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(response)
			   {						
					if(response=="ok"){
									
						$("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
						setTimeout(' window.location.href = "panel.php"; ',4000);
					}
					else{
				
				$("#error").fadeIn(1000, function(){	
				$("#error").html('<center> '+response+' </center>');
				setTimeout(function() { $("#error").html(""); }, 5000);
				$("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});




/* FUNCION JQUERY PARA VALIDAR DESBLOQUEAR CUENTA DE ACCESO*/
$('document').ready(function()
{ 
						   
	 $("#lockscreen").validate({
      rules:
	  {
			usuario: { required: true, },
			password: { required: true, },
	   },
       messages:
	   {
		    usuario:{  required: "Ingrese Usuario de Acceso" },
			password:{  required: "Ingrese Clave de Acceso" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#lockscreen").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : 'lockscreen.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(response)
			   {						
					if(response=="ok"){
									
						$("#btn-login").html('<i class="fa"></i> Acceder');
						setTimeout(' window.location.href = "panel"; ',4000);
					}
					else{
				
				$("#error").fadeIn(1000, function(){	
				$("#error").html('<center> '+response+' </center>');
				setTimeout(function() { $("#error").html(""); }, 5000);
				$("#btn-login").html('<i class="fa fa-sign-in"></i> Acceder');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});















/* FUNCION JQUERY PARA RECUPERAR CONTRASE?A DE USUARIOS */	 
	 
$('document').ready(function()
{ 
								
     /* validation */
	$("#recuperarpassword").validate({
      rules:
	  {
			email: { required: true,  email: true  },
	   },
       messages:
 	   {
			email:{  required: "Ingrese su Correo Electronico", email: "Ingrese un Correo Electronico Valido" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	    /* form submit */
	  function submitForm()
	   {		
				var data = $("#recuperarpassword").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'index.php',
				data : data,
				beforeSend: function()
				{	
					$("#errorr").fadeOut();
					$("#btn-recuperar").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error2").fadeIn(1000, function(){
											
											
	$("#errorr").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
											$("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar Clave');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#errorr").fadeIn(1000, function(){
											
											
	$("#errorr").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> EL CORREO INGRESADO NO FUE ENCONTRADO ACTUALMENTE !</div></center>');
												
											$("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar Clave');
										
									});
								}
								else{
										
									$("#errorr").fadeIn(1000, function(){
											
						$("#errorr").html('<center> '+data+' </center>');
						$("#recuperarpassword")[0].reset();
						setTimeout(function() { $("#errorr").html(""); }, 5000);	
						$('#btn-recuperar').attr("disabled", true);
						$("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar Clave');
										
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
   
	   
});

/*  FIN DE FUNCION PARA RECUPERAR CONTRASE?A DE USUARIOS */




/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASE?A */	 
	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#updatepassword").validate({
      rules:
	  {
			usuario: {required: true },
			password: {required: true, minlength: 8},  
            password2:   {required: true, minlength: 8, equalTo: "#password"}, 
	   },
       messages:
	   {
            usuario:{  required: "Ingrese Usuario de Acceso" },
            password:{ required: "Ingrese su Nuevo Password", minlength: "Ingrese 8 caracteres como m&iacute;nimo" },
		    password2:{ required: "Repita su Nuevo Password", minlength: "Ingrese 8 caracteres como m&iacute;nimo", equalTo: "Este Password no coincide" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatepassword").serialize();
				var id= $("#updatepassword").attr("data-id");
		        var codigo = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'password.php?codigo='+codigo,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
											$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#updatepassword")[0].reset();
						setTimeout(function() { $("#error").html(""); }, 5000);
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});

 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASE?A */
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 












 
 
 



/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */	 
	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#configuracion").validate({

      rules:
	  {
			rifempresa: { required: true },
			nomempresa: { required: true, lettersonly: true },
			direcempresa: { required: true},
			tlfempresa: { required: true },
			correoempresa: { required: true,  email : true },
			cedresponsable: { required: true, },
			nomresponsable: { required: true, lettersonly: true},
			correoresponsable: { required: true,  email : true },
			tlfresponsable: { required: true },
			ivac: { required: true,  number : true },
			ivav: { required: true,  number : true },
			simbolo: { required: true, },
			cierresesion: { required: true, digits : true },
	   },
       messages:
	   {
            rifempresa:{ required: "Ingrese Nit de Empresa" },
			nomempresa:{ required: "Ingrese Nombre de Empresa", lettersonly: "Ingrese solo letras" },
			direcempresa:{ required: "Ingrese Direcci&oacute;n de Empresa" },
			tlfempresa: { required: "Ingrese N&deg; de Telefono de Empresa" },
			correoempresa: { required: "Ingrese Correo de Empresa", email: "Ingrese un correo valido" },
			cedresponsable:{ required: "Ingrese Nit de Responsable", digits: "Ingrese solo digitos para C&eacute;dula" },
			nomresponsable:{ required: "Ingrese Nombre de Responsable", lettersonly: "Ingrese solo letras para Nombre de Responsable" },
			correoresponsable: { required: "Ingrese Correo de Responsable", email: "Ingrese un correo valido" },
			tlfresponsable: { required: "Ingrese N&deg; de Telefono de Responsable" },
			ivac:{ required: "Ingrese IGV para Compras", number: "Ingrese solo numeros con dos decimales para IGV de Compras" },
			ivav:{ required: "Ingrese IGV para Ventas", number: "Ingrese solo numeros con dos decimales para IGV de Ventas" },
			simbolo: { required: "Ingrese Simbolo de Moneda", },
			cierresesion:{ required: "Ingrese Tiempo de Cierre de Sesi&oacute;n", digits: "Ingrese solo numeros Tiempo de Cierre de Sesi&oacute;n" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#configuracion").serialize();
				var id= $("#configuracion").attr("data-id");
		        var id = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'configuracion.php?id='+id,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
											$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
									
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						setTimeout(function() { $("#error").html(""); }, 5000);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');				
						
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
	   
	   
});

 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */
 
 






















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE USUARIOS */	 
	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#usuario").validate({
      rules:
	  {
			cedula: { required: true,  digits : true, minlength: 7 },
			nombres: { required: true, lettersonly: true },
			nrotelefono: { required: true, },
			cargo: { required: true, },
			email: { required: true, email: true },
			usuario: { required: true, },
			password: {required: true, minlength: 8},  
            password2:   {required: true, minlength: 8, equalTo: "#password"}, 
			nivel: { required: true, },
			status: { required: true, },
	   },
       messages:
	   {
            cedula:{ required: "Ingrese Nit de Usuario", digits: "Ingrese solo digitos para Nit", minlength: "Ingrese 7 digitos como minimo" },
			nombres:{ required: "Ingrese Nombre Completo de Usuario", lettersonly: "Ingrese solo letras para Nombre de Usuario" },
            nrotelefono:{ required: "Ingrese N&deg; de Telefono de Usuario" },
			cargo: { required: "Ingrese Cargo de Usuario" },
			email:{  required: "Ingrese Email de Usuario", email: "Ingrese un Email Valido" },
			usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Password de Acceso", minlength: "Ingrese 8 caracteres como minimo" },
		    password2:{ required: "Repita Password de Acceso", minlength: "Ingrese 8 caracteres como minimo", equalTo: "Este Password no coincide" },
			nivel:{ required: "Seleccione Nivel de Acceso" },
			status:{ required: "Seleccione Status de Usuario" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#usuario").serialize();
				var formData = new FormData($("#usuario")[0]);
				
				$.ajax({
				type : 'POST',
				url  : 'forusuario.php',
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}  
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN USUARIO CON ESTE NUMERO DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='3'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE CORREO ELECTRONICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='4')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE USUARIO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#usuario")[0].reset();		
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
   
	   
});

/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE USUARIOS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE USUARIOS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updateusuario").validate({
      rules:
	  {
			cedula: { required: true,  digits : true, minlength: 7 },
			nombres: { required: true, lettersonly: true },
			nrotelefono: { required: true, },
			cargo: { required: true, },
			email: { required: true, email: true },
			usuario: { required: true, },
			password: {required: true, minlength: 8},  
            password2:   {required: true, minlength: 8, equalTo: "#password"}, 
			nivel: { required: true, },
			status: { required: true, },
	   },
       messages:
	   {
            cedula:{ required: "Ingrese Nit de Usuario", digits: "Ingrese solo digitos para Nit", minlength: "Ingrese 7 digitos como minimo" },
			nombres:{ required: "Ingrese Nombre Completo de Usuario", lettersonly: "Ingrese solo letras para Nombre de Usuario" },
            nrotelefono:{ required: "Ingrese N&deg; de Telefono de Usuario" },
			cargo: { required: "Ingrese Cargo de Usuario" },
			email:{  required: "Ingrese Email de Usuario", email: "Ingrese un Email Valido" },
			usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Password de Acceso", minlength: "Ingrese 8 caracteres como minimo" },
		    password2:{ required: "Repita Password de Acceso", minlength: "Ingrese 8 caracteres como minimo", equalTo: "Este Password no coincide" },
			nivel:{ required: "Seleccione Nivel de Acceso" },
			status:{ required: "Seleccione Status de Usuario" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateusuario").serialize();
				var formData = new FormData($("#updateusuario")[0]);
				var id= $("#updateusuario").attr("data-id");
		        var codigo = id;
				
				$.ajax({
				type : 'POST',
				url  : 'forusuario.php?codigo='+codigo,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}  
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN USUARIO CON ESTE NUMERO DE C&Eacute;DULA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='3'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE CORREO ELECTRONICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='4')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE USUARIO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="icon-edit"></span> Actualizar');
					    setTimeout("location.href='usuarios'", 5000);
				
						
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
	   
});

 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE USUARIOS */


































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE SALAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#salas").validate({
      rules:
	  {
			nombresala: { required: true, },
	   },
       messages:
	   {
			nombresala:{ required: "Ingrese Nombre de Sala" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#salas").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forsala.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE SALA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#salas")[0].reset();		
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE SALAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE SALAS */	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#updatesalas").validate({
      rules:
	  {
			nombresala: { required: true, },
	   },
       messages:
	   {
			nombresala:{ required: "Ingrese Nombre de Sala" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatesalas").serialize();
				var id= $("#updatesalas").attr("data-id");
		        var codsala = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forsala.php?codsala='+codsala,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE SALA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='salas'", 5000);
				
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE SALAS */
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 /* FUNCION JQUERY PARA VALIDAR REGISTRO DE MESAS EN MESAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#mesas").validate({
      rules:
	  {
			codsala: { required: true, },
			nombremesa: { required: true, },
	   },
       messages:
	   {
			codsala:{ required: "Seleccione Sala para Mesa" },
			nombremesa:{ required: "Ingrese Nombre de Mesa" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#mesas").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'formesa.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE MESA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#mesas")[0].reset();		
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE MESAS EN MESAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MESAS EN MESAS */	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#updatemesas").validate({
      rules:
	  {
			codsala: { required: true, },
			nombremesa: { required: true, },
			statusmesa: { required: true, },
	   },
       messages:
	   {
			codsala:{ required: "Seleccione Sala para Mesa" },
			nombremesa:{ required: "Ingrese Nombre de Mesa" },
			statusmesa:{ required: "Seleccione Status de Mesa" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatemesas").serialize();
				var id= $("#updatemesas").attr("data-id");
		        var codmesa = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'formesa.php?codmesa='+codmesa,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE MESA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='mesas'", 5000);
				
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MESAS EN MESAS */
 






































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE MEDIOS DE PAGOS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#mediopago").validate({
      rules:
	  {
			mediopago: { required: true, },
	   },
       messages:
	   {
			mediopago:{ required: "Ingrese Medio de Pago" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#mediopago").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'formediopago.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE MEDIO DE PAGO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#mediopago")[0].reset();		
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE MEDIOS DE PAGOS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MEDIOS DE PAGOS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatemediopago").validate({
      rules:
	  {
			mediopago: { required: true, },
	   },
       messages:
	   {
			mediopago:{ required: "Ingrese Medio de Pago" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatemediopago").serialize();
				var id= $("#updatemediopago").attr("data-id");
		        var codmediopago = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'formediopago.php?codmediopago='+codmediopago,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE MEDIO DE PAGO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='mediospagos'", 5000);
				
						
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MEDIOS DE PAGOS */

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CATEGORIAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#categorias").validate({
      rules:
	  {
			nomcategoria: { required: true, },
	   },
       messages:
	   {
			nomcategoria:{ required: "Ingrese Nombre de Categoria" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#categorias").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcategoria.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE CATEGORIA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#categorias")[0].reset();		
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CATEGORIAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CATEGORIAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatecategoria").validate({
      rules:
	  {
			codcategoria: { required: true, },
			nomcategoria: { required: true, },
	   },
       messages:
	   {
            codcategoria:{ required: "Ingrese C&oacute;digo de Categoria" },
			nomcategoria:{ required: "Ingrese Nombre de Categoria" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatecategoria").serialize();
				var id= $("#updatecategoria").attr("data-id");
		        var codcategoria = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcategoria.php?codcategoria='+codcategoria,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE CATEGORIA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='categorias'", 5000);
				
						
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CATEGORIAS */


































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CAJAS DE VENTAS */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#cajas").validate({
      rules:
	  {
			nrocaja: { required: true, },
			nombrecaja: { required: true, },
			codigo: { required: false, },
	   },
       messages:
	   {
            nrocaja:{  required: "Ingrese Numero de Caja" },
			nombrecaja:{ required: "Ingrese Nombre de Caja" },
			codigo:{ required: "Seleccione Responsable de Caja" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#cajas").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcaja.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE CAJA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else if(data=='3')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE USUARIO YA TIENE UNA CAJA DE VENTAS ASIGNADA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
						            $("#error").html('<center> '+data+' </center>');
						            $("#cajas")[0].reset();			
						            setTimeout(function() { $("#error").html(""); }, 5000);
								    $("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CAJAS DE VENTAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CAJA DE VENTAS */	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updatecajas").validate({
       rules:
	  {
			nrocaja: { required: true, },
			nombrecaja: { required: true, },
			codigo: { required: false, },
	   },
       messages:
	   {
            nrocaja:{  required: "Ingrese Numero de Caja" },
			nombrecaja:{ required: "Ingrese Nombre de Caja" },
			codigo:{ required: "Seleccione Responsable de Caja" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatecajas").serialize();
				var id= $("#updatecajas").attr("data-id");
		        var codcaja = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcaja.php?codcaja='+codcaja,
				data : data,

				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE NOMBRE DE CAJA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else if(data=='3')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE USUARIO YA TIENE UNA CAJA DE VENTAS ASIGNADA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
					   $("#btn-update").html('<i class="fa fa-refresh"></i> Actualizar');
					   setTimeout("location.href='cajas'", 5000);
				
				});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CAJAS DE VENTAS */
 
 



































 
 
 
 
 
 
 
 
 
 
 
 
 
  
  
  
/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CLIENTES */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#clientes").validate({
      rules:
	  {
			cedcliente: { required: true, digits : true },
			nomcliente: { required: true, lettersonly: true, },
			direccliente: { required: true, },
			tlfcliente: { required: false, digits : false  },
			emailcliente: { required: false, email: true },
	   },
       messages:
	   {
            cedcliente:{ required: "Ingrese Nit de Cliente", digits: "Ingrese solo digitos para Nit"},
			nomcliente:{ required: "Ingrese Nombre de Cliente", lettersonly: "Ingrese solo letras para Nombres" },
            direccliente:{ required: "Ingrese Direcci&oacute;n de Cliente" },
			tlfcliente: { required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos" },
			emailcliente:{  required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#clientes").serialize();
				$.ajax({
				type : 'POST',
				url  : 'clientes.php',
				data : data,
				beforeSend: function()
				{	
					$("#read").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#read").fadeIn(1000, function(){
											
											
	$("#read").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
								else if(data=='2')
								{
									
					$("#read").fadeIn(1000, function(){
											
											
	$("#read").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE CLIENTE YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
								else{
										
									$("#read").fadeIn(1000, function(){
						            $("#read").html('<center> '+data+' </center>');
						            $("#clientes")[0].reset();
					            	setTimeout(function() { $("#read").html(""); }, 5000); 					
								    $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CLIENTES */



/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CLIENTES */	 	 
    $('document').ready(function()
{ 
     /* validation */
	 $("#updateclientes").validate({
       rules:
	  {
			cedcliente: { required: true, digits : true },
			nomcliente: { required: true, lettersonly: true, },
			direccliente: { required: true, },
			tlfcliente: { required: false, digits : false  },
			emailcliente: { required: false, email: true },
	   },
       messages:
	   {
            cedcliente:{ required: "Ingrese Nit de Cliente", digits: "Ingrese solo digitos para Nit"},
			nomcliente:{ required: "Ingrese Nombre de Cliente", lettersonly: "Ingrese solo letras para Nombres" },
            direccliente:{ required: "Ingrese Direcci&oacute;n de Cliente" },
			tlfcliente: { required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos" },
			emailcliente:{  required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateclientes").serialize();
		        var codcliente = $('input#codcliente').val();
		        var busqueda = $('input#busqueda').val();
				
				$.ajax({
				type : 'POST',
				url  : 'clientes.php?codcliente='+codcliente,
				data : data,
				beforeSend: function()
				{	
					$("#update").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#update").fadeIn(1000, function(){
											
											
	$("#update").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
							 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');

									});
																				
								}
								else if(data=='2')
								{
									
					$("#update").fadeIn(1000, function(){
											
											
	$("#update").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE CLIENTE YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
									$("#update").fadeIn(1000, function(){
											
						$("#update").html('<center> '+data+' </center>');
$("#resultadocliente").load("funciones.php?BusquedaClientes=si&buscacliente="+busqueda);
					    $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout(function() { $("#update").html(""); }, 5000);
				
				});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CLIENTES */


















 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PROVEEDORES */	  
$('document').ready(function()
{ 
     /* validation */
	 $("#proveedores").validate({
      rules:
	  {
			ritproveedor: { required: true, },
			nomproveedor: { required: true, },
			direcproveedor: { required: true, },
			tlfproveedor: { required: true, digits : false  },
			emailproveedor: { required: true, email: true },
			contactoproveedor: { required: true, lettersonly: true, },
	   },
       messages:
	   {
            ritproveedor:{ required: "Ingrese Nit de Proveedor" },
			nomproveedor:{ required: "Ingrese Nombre de Proveedor" },
            direcproveedor:{ required: "Ingrese Direcci&oacute;n de Proveedor" },
			tlfproveedor: { required: "Ingrese Telefono de Proveedor", digits: "Ingrese solo digitos" },
			emailproveedor:{  required: "Ingrese Email de Proveedor", email: "Ingrese un Email Valido" },
            contactoproveedor:{ required: "Ingrese Nombre de Contacto", lettersonly: "Ingrese solo letras para Persona de Contacto" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#proveedores").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forproveedor.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE PROVEEDOR YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						            $("#error").html('<center> '+data+' </center>');
						            $("#proveedores")[0].reset();
						            setTimeout(function() { $("#error").html(""); }, 5000);				
								    $("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PROVEEDORES */



/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PROVEEDORES */	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updateproveedores").validate({
       rules:
	  {
			ritproveedor: { required: true, },
			nomproveedor: { required: true, },
			direcproveedor: { required: true, },
			tlfproveedor: { required: true, digits : false  },
			emailproveedor: { required: true, email: true },
			contactoproveedor: { required: true, lettersonly: true, },
	   },
       messages:
	   {
            ritproveedor:{ required: "Ingrese Nit de Proveedor" },
			nomproveedor:{ required: "Ingrese Nombre de Proveedor" },
            direcproveedor:{ required: "Ingrese Direcci&oacute;n de Proveedor" },
			tlfproveedor: { required: "Ingrese Telefono de Proveedor", digits: "Ingrese solo digitos" },
			emailproveedor:{  required: "Ingrese Email de Proveedor", email: "Ingrese un Email Valido" },
            contactoproveedor:{ required: "Ingrese Nombre de Contacto", lettersonly: "Ingrese solo letras para Persona de Contacto" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateproveedores").serialize();
				var id= $("#updateproveedores").attr("data-id");
		        var codproveedor = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forproveedor.php?codproveedor='+codproveedor,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
							 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
		$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE PROVEEDOR YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
							 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
					    $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
   					   setTimeout("location.href='proveedores'", 5000);
				
				});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PROVEEDORES */
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 /* FUNCION JQUERY PARA CARGA MASIVA DE INGREDIENTES */	 
$('document').ready(function()
{ 							
     /* validation */
	 $("#cargaingredientes").validate({
      rules:
	  {
			sel_file: { required: true, },
	   },
       messages:
	   {
            sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#cargaingredientes").serialize();
				var formData = new FormData($("#cargaingredientes")[0]);
				
				$.ajax({
				type : 'POST',
				url  : 'cargamasiva.php',
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#erroringrediente").fadeOut();
					$("#btn-ingrediente").html('<i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros....');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#erroringrediente").fadeIn(1000, function(){
											
	$("#erroringrediente").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR !</div></center>');
											
									$("#btn-ingrediente").html('<span class="fa fa-cloud-upload"></span> Cargar Productos');
										
									});
																				
								}  
								else if(data=='2'){
									
									$("#erroringrediente").fadeIn(1000, function(){
											
	$("#erroringrediente").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE INGREDIENTES</div></center>');
											
									$("#btn-ingrediente").html('<span class="fa fa-cloud-upload"></span> Cargar Productos');
										
									});
								}
								else{
																					
						$("#erroringrediente").fadeIn(1000, function(){
											
						            $("#erroringrediente").html('<center> '+data+' </center>');
						            $("#cargaingredientes")[0].reset();
					            	setTimeout(function() { $("#erroringrediente").html(""); }, 5000); 					
								    $("#btn-ingrediente").html('<span class="fa fa-cloud-upload"></span> Cargar Productos');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA CARGA MASIVA DE INGREDIENTES */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE INGREDIENTES */	 
  $('document').ready(function()
{ 
     /* validation */
	 $("#ingredientes").validate({
      rules:
	  {
			nomingrediente: { required: true,},
			cantingrediente: { required: true, number : true},
			unidadingrediente: { required: true, },
			costoingrediente: { required: true, number : true},
			codproveedor: { required: true, },
			stockminimoingrediente: { required: false, number : true },
	   },
       messages:
	   {
			nomingrediente:{  required: "Ingrese Nombre de Ingrediente" },
			cantingrediente:{ required: "Ingrese Cantidad de Ingrediente", number: "Ingrese solo digitos y decimales" },
			unidadingrediente:{ required: "Seleccione Medida de Ingrediente" },
			costoingrediente:{ required: "Ingrese Costo de Ingrediente", number: "Ingrese solo digitos con 2 decimales" },
            codproveedor:{ required: "Seleccione Proveedor" },
            stockminimoingrediente:{ required: "Ingrese Stock Minimo", number: "Ingrese solo digitos con 2 decimales" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#ingredientes").serialize();
				var costo = $('#costoingrediente').val();
	
	       if (costo==0.00 || costo==0) {
	            
				$("#costoingrediente").focus();
				$('#costoingrediente').val("");
				$('#costoingrediente').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN COSTO VALIDO PARA INGREDIENTE');
         
        return false;
	 
	  } else {
				$.ajax({
				type : 'POST',
				url  : 'foringrediente.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}  
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN INGREDIENTE CON ESTE NOMBRE, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}  
								else if(data=='3'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN INGREDIENTE CON ESTE C&Oacute;DIGO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#ingredientes")[0].reset();	
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
						   }
				});
				return false;
	        }
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE INGREDIENTES */
 
 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE INGREDIENTES */ 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updateingredientes").validate({
        rules:
	  {
			nomingrediente: { required: true,},
			cantingrediente: { required: true, number : true},
			unidadingrediente: { required: true, },
			costoingrediente: { required: true, number : true},
			codproveedor: { required: true, },
			stockminimoingrediente: { required: false, number : true },
	   },
       messages:
	   {
			nomingrediente:{  required: "Ingrese Nombre de Ingrediente" },
			cantingrediente:{ required: "Ingrese Cantidad de Ingrediente", number: "Ingrese solo digitos y decimales" },
			unidadingrediente:{ required: "Seleccione Medida de Ingrediente" },
			costoingrediente:{ required: "Ingrese Costo de Ingrediente", number: "Ingrese solo digitos con 2 decimales" },
            codproveedor:{ required: "Seleccione Proveedor" },
            stockminimoingrediente:{ required: "Ingrese Stock Minimo", number: "Ingrese solo digitos con 2 decimales" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateingredientes").serialize();
				var id= $("#updateingredientes").attr("data-id");
		        var codingrediente = id;
				
	            var costo = $('#costoingrediente').val();
	
	       if (costo==0.00 || costo==0) {
	            
				$("#costoingrediente").focus();
				$('#costoingrediente').val("");
				$('#costoingrediente').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN COSTO VALIDO PARA INGREDIENTE');
         
        return false;
	 
	  } else {
				$.ajax({
				
				type : 'POST',
				url  : 'foringrediente.php?codingrediente='+codingrediente,
				data : data,

				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');

											
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}  
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN INGREDIENTE CON ESTE NOMBRE, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								} 
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
     					setTimeout("location.href='ingredientes'", 5000);
				
				});
											
								}
						   }
				});
				return false;
	        }
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE INGREDIENTES */
 
  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 /* FUNCION JQUERY PARA CARGA MASIVA DE PRODUCTOS */	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#cargaproductos").validate({
      rules:
	  {
			sel_file: { required: true, },
	   },
       messages:
	   {
            sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#cargaproductos").serialize();
				var formData = new FormData($("#cargaproductos")[0]);
				
				$.ajax({
				type : 'POST',
				url  : 'cargamasiva.php',
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#errorproduc").fadeOut();
					$("#btn-producto").html('<i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros....');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#errorproduc").fadeIn(1000, function(){
											
	$("#errorproduc").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR !</div></center>');
											
									$("#btn-producto").html('<span class="fa fa-cloud-upload"></span> Cargar Productos');
										
									});
																				
								}  
								else if(data=='2'){
									
									$("#errorproduc").fadeIn(1000, function(){
											
	$("#errorproduc").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE PRODUCTOS</div></center>');
											
									$("#btn-producto").html('<span class="fa fa-cloud-upload"></span> Cargar Productos');
										
									});
								}
								else{
																					
						$("#errorproduc").fadeIn(1000, function(){
											
						            $("#errorproduc").html('<center> '+data+' </center>');
						            $("#cargaproductos")[0].reset();
					            	setTimeout(function() { $("#errorproduc").html(""); }, 5000); 					
								    $("#btn-producto").html('<span class="fa fa-cloud-upload"></span> Cargar Productos');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA CARGA MASIVA DE PRODUCTOS */
  
  
/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PRODUCTOS */	 	 
$('document').ready(function()
{ 
     /* validation */
	 $("#productos").validate({
      rules:
	  {
			codproducto: { required: true, },
			producto: { required: true,},
			codcategoria: { required: true, },
			preciocompra: { required: true, number : true},
			precioventa: { required: true, number : true},
			existencia: { required: true, digits : true },
			stockminimo: { required: false, digits : true },
			ivaproducto: { required: true, },
			descproducto: { required: true, number : true },
			codproveedor: { required: false, },
			codigobarra: { required: false, },
			favorito: { required: true, },
			statusproducto: { required: true, },
	   },
       messages:
	   {
			codproducto: { required: "Ingrese C&oacute;digo de Producto" },
			producto:{  required: "Ingrese Nombre de Producto" },
			codcategoria:{ required: "Seleccione Categoria de Producto" },
			preciocompra:{ required: "Ingrese Precio de Compra de Producto", number: "Ingrese solo digitos con 2 decimales" },
			precioventa:{ required: "Ingrese Precio de Venta de Producto", number: "Ingrese solo digitos con 2 decimales" },
			existencia:{ required: "Ingrese Cantidad o Existencia de Producto", digits: "Ingrese solo digitos" },
            stockminimo:{ required: "Ingrese Stock Minimo", digits: "Ingrese solo digitos" },
			ivaproducto:{ required: "Seleccione IGV de Producto" },
			descproducto: { required: "Ingrese Descuento de Producto", number: "Ingrese solo digitos con 2 decimales" },
			codproveedor:{ required: "Seleccione Proveedor" },
			codigobarra: { required: "Ingrese C&oacute;digo de Barra" },
			favorito:{ required: "Seleccione Favorito de Producto" },
			statusproducto:{ required: "Seleccione Status de Producto" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#productos").serialize();
				var formData = new FormData($("#productos")[0]);
				var cant = $('#existencia').val();
				var compra = $('#preciocompra').val();
				var venta = $('#precioventa').val();
				cant    = parseInt(cant);
	
	       if (compra==0.00 || compra==0) {
	            
				$("#preciocompra").focus();
				$('#preciocompra').val("");
				$('#preciocompra').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN COSTO VALIDO PARA PRECIO COMPRA DE PRODUCTO');
         
        return false;
		
		   } else if (venta==0.00 || venta==0) {
	            
				$("#precioventa").focus();
				$('#precioventa').val("");
				$('#precioventa').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN PRECIO VALIDO PARA PRECIO VENTA DE PRODUCTO');
         
        return false;
		
			} else  if (cant==0) {
	            
				$("#existencia").focus();
				$('#existencia').val("");
				$('#existencia').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UNA CANTIDAD VALIDA PARA PRODUCTOS');
         
        return false;
	 
	  } else {
				$.ajax({
				type : 'POST',
				url  : 'forproducto.php',
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}  
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS INGREDIENTES ASOCIADOS NO PUEDEN REPETIRSE, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								} 
								else if(data=='3'){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN PRODUCTO CON ESTE C&Oacute;DIGO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#productos")[0].reset();
				$("#datatable-responsive tbody").html("<tr><td><input type='hidden' name='codingrediente[]' id='codingrediente'><input type='text' class='form-control' name='busqueda[]' id='busqueda' onKeyUp='this.value=this.value.toUpperCase(); autocompletar(this.name);' autocomplete='off' placeholder='Porcion de Ingrediente'></td><td><input type='text' class='form-control' name='cantidad[]' id='cantidad1' onKeyUp='this.value=this.value.toUpperCase();' autocomplete='off' placeholder='Cantidad Porcion'></td><td><input type='text' class='form-control' name='unidadingrediente[]' id='unidadingrediente' onKeyUp='this.value=this.value.toUpperCase();' autocomplete='off' placeholder='Medida' readonly='readonly'></td></tr>");
						$("#nroproducto").load("funciones.php?muestranroproducto=si");
						$("#codigoproducto").load("funciones.php?muestracodigoproducto=si");
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
											
								}
						   }
				});
				return false;
	        }
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PRODUCTOS */
 
 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PRODUCTOS */	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updateproducto").validate({
        rules:
	  {
			codproducto: { required: true, },
			producto: { required: true,},
			codcategoria: { required: true, },
			preciocompra: { required: true, number : true},
			precioventa: { required: true, number : true},
			existencia: { required: true, digits : true },
			stockminimo: { required: false, digits : true },
			ivaproducto: { required: true, },
			descproducto: { required: true, number : true },
			codproveedor: { required: false, },
			codigobarra: { required: false, },
			favorito: { required: true, },
			statusproducto: { required: true, },
	   },
       messages:
	   {
			codproducto: { required: "Ingrese C&oacute;digo de Producto" },
			producto:{  required: "Ingrese Nombre de Producto" },
			codcategoria:{ required: "Seleccione Categoria de Producto" },
			preciocompra:{ required: "Ingrese Precio de Compra de Producto", number: "Ingrese solo digitos con 2 decimales" },
			precioventa:{ required: "Ingrese Precio de Venta de Producto", number: "Ingrese solo digitos con 2 decimales" },
			existencia:{ required: "Ingrese Cantidad o Existencia de Producto", digits: "Ingrese solo digitos" },
            stockminimo:{ required: "Ingrese Stock Minimo", digits: "Ingrese solo digitos" },
			ivaproducto:{ required: "Seleccione IGV de Producto" },
			descproducto: { required: "Ingrese Descuento de Producto", number: "Ingrese solo digitos con 2 decimales" },
			codproveedor:{ required: "Seleccione Proveedor" },
			codigobarra: { required: "Ingrese C&oacute;digo de Barra" },
			favorito:{ required: "Seleccione Favorito de Producto" },
			statusproducto:{ required: "Seleccione Status de Producto" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updateproducto").serialize();
				var formData = new FormData($("#updateproducto")[0]);
				var id= $("#updateproducto").attr("data-id");
		        var codalmacen = id;
				
	            var cant = $('#existencia').val();
			    var compra = $('#preciocompra').val();
				var venta = $('#precioventa').val();
				cant    = parseInt(cant);
	
	       if (compra==0.00 || compra==0) {
	            
				$("#preciocompra").focus();
				$('#preciocompra').val("");
				$('#preciocompra').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN COSTO VALIDO PARA PRECIO COMPRA DE PRODUCTO');
         
        return false;
		
		   } else if (venta==0.00 || venta==0) {
	            
				$("#precioventa").focus();
				$('#precioventa').val("");
				$('#precioventa').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN PRECIO VALIDO PARA PRECIO VENTA DE PRODUCTO');
         
        return false;
		
			} else  if (cant==0) {
	            
				$("#existencia").focus();
				$('#existencia').val("");
				$('#existencia').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UNA CANTIDAD VALIDA PARA PRODUCTOS');
         
        return false;
	 
	  } else {
				$.ajax({
				type : 'POST',
				url  : 'forproducto.php?codalmacen='+codalmacen,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');

											
						  $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS INGREDIENTES ASOCIADOS NO PUEDEN REPETIRSE, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
     					setTimeout("location.href='productos'", 5000);
				
				});
											
								}
						   }
				});
				return false;
	        }
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PRODUCTOS */
 
 
 /* FUNCION JQUERY PARA VALIDAR AGREGAR INGREDIENTES A PRODUCTOS */	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#agregaingrediente").validate({
        rules:
	  {
			codproducto: { required: true, },
	   },
       messages:
	   {
			codproducto: { required: "Ingrese C&oacute;digo de Producto" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#agregaingrediente").serialize();
				var formData = new FormData($("#agregaingrediente")[0]);
				var id= $("#agregaingrediente").attr("data-id");
		        var codproducto = id;

				$.ajax({
				type : 'POST',
				url  : 'agregaingrediente.php?codproducto='+codproducto,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');

											
						  $("#btn-submit").html('<span class="fa fa-cart-arrow-down"></span> Agregar');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS INGREDIENTES ASOCIADOS NO PUEDEN REPETIRSE, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
						$("#btn-submit").html('<span class="fa fa-cart-arrow-down"></span> Agregar');
										
									});
								}
								else if(data=='3'){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO PUEDE AGREGAR INGREDIENTES YA EXISTENTES, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
						$("#btn-submit").html('<span class="fa fa-cart-arrow-down"></span> Agregar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
						
						$("#error").html('<center> '+data+' </center>');
						$("#datatable-responsive tbody").html("<tr><td><input type='hidden' name='codingrediente[]' id='codingrediente'><input type='text' class='form-control' name='busqueda[]' id='busqueda' onKeyUp='this.value=this.value.toUpperCase(); autocompletar(this.name);' autocomplete='off' placeholder='Porcion de Ingrediente'></td><td><input type='text' class='form-control' name='cantidad[]' id='cantidad1' onKeyUp='this.value=this.value.toUpperCase();' autocomplete='off' placeholder='Cantidad Porcion'></td><td><input type='text' class='form-control' name='unidadingrediente[]' id='unidadingrediente' onKeyUp='this.value=this.value.toUpperCase();' autocomplete='off' placeholder='Medida' readonly='readonly'></td></tr>");
						
						$("#cargaingredientes").load("funciones.php?BuscaNuevosIngredienteProductos=si&codproducto="+btoa(codproducto));
						//setTimeout(function() { $("#error").html(""); }, 5000);	
						$("#btn-submit").html('<span class="fa fa-cart-arrow-down"></span> Agregar');
				
				});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR AGREGAR INGREDIENTES A PRODUCTOS */
 
 

/* FUNCION JQUERY PARA CARGA MASIVA DE PRODUCTOS */	 
	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#cargarproductos").validate({
      rules:
	  {
			sel_file: { required: true, },
	   },
       messages:
	   {
            sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#cargarproductos").serialize();
				var formData = new FormData($("#cargarproductos")[0]);
				
				$.ajax({
				type : 'POST',
				url  : 'productos.php',
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-cargar").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR !</div></center>');
											
									$("#btn-cargar").html('<span class="fa fa-cloud-upload"></span> Cargar');
										
									});
																				
								}  
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE PRODUCTOS</div></center>');
											
									$("#btn-cargar").html('<span class="fa fa-cloud-upload"></span> Cargar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#cargarproductos")[0].reset();		 
						setTimeout(function() { 
						$("#error").html("");
						window.location.reload("productos"); 
						}, 5000);
						$("#btn-cargar").html('<span class="fa fa-cloud-upload"></span> Cargar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});

/*  FIN DE FUNCION PARA CARGA MASIVA DE PRODUCTOS */
 
  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 





/* FUNCION JQUERY PARA VALIDAR REGISTRO DE COMPRAS DE PRODUCTOS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#compras").validate({
      rules:
	  {
			codcompra: { required: true, },
			codseriec: { required: true, },
			codproveedor: { required: true, },
			tipocompra: { required: true, },
			formacompra: { required: true, },
			fechavencecredito: { required: true, },
			fechacompra: { required: true, },
			descuento: { required: true, },
	   },
       messages:
	   {
            codcompra:{  required: "Ingrese N&deg; de Compra" },
			codseriec:{  required: "Ingrese N&deg; de Serie" },
			codproveedor:{  required: "	Seleccione Proveedor" },
			tipocompra:{  required: "	Seleccione Tipo de Pago" },
			formacompra:{  required: "Seleccione seleccione Forma de Pago" },
			fechavencecredito:{  required: "Ingrese Fecha Vence Cr&eacute;dito" },
			fechacompra:{  required: "Ingrese Fecha de Compra" },
			descuento:{  required: "Ingrese Descuento para Compra" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#compras").serialize();
			    var nuevaFila ="<tr>"+"<td colspan=7><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>"+"</tr>";
				var total = $('#txtTotal').val();
	
	        if (total==0.00) {
	            
				$("#producto").focus();
				$('#producto').css('border-color','#01ba9a');
				alert('POR FAVOR DEBE DE AGREGAR PRODUCTOS AL CARRITO PARA CONTINUAR CON LA COMPRA');
         
        return false;
	 
	  } else {
				$.ajax({
				
				type : 'POST',
				url  : 'forcompras.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO HA INGRESADO PRODUCTOS PARA COMPRAS, VERIFIQUE DE NUEVO POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else if(data=='3')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE N&deg; DE COMPRA YA SE ENCUENTRA REGISTRADO, VERIFIQUE DE NUEVO POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else if(data=='4')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE N&deg; DE SERIE YA SE ENCUENTRA REGISTRADO, VERIFIQUE DE NUEVO POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#compras")[0].reset();	
					    $("#carrito tbody").html("");
						$("#lblsubtotal").text("0.00");
						$("#lblsubtotal2").text("0.00");
						$("#lbliva").text("0.00");
						$("#lbldescuento").text("0.00");
						$("#lbltotal").text("0.00");
						$("#txtsubtotal").val("0.00");
						$("#txtsubtotal2").val("0.00");
						$("#txtIva").val("0.00");
						$("#txtDescuento").val("0.00");
						$("#txtTotal").val("0.00");
						$(nuevaFila).appendTo("#carrito tbody");
						setTimeout(function() { $("#error").html(""); }, 15000);
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
						   }
				});
				return false;
		         }
		}
	   /* form submit */
});

/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE COMPRAS DE PRODUCTOS */

 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE COMPRAS DE PRODUCTOS */	 
	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updatedetalleecompra").validate({
        rules:
	  {
			codcompra: { required: true, },
			codproducto : { required: true, },
			producto: { required: true, },
			codcategoria: { required: true, },
			cantcompra: { required: true, number : true  },
			precio1: { required: true, number : true },
			lote: { required: true, },
	   },
       messages:
	   {
            codcompra:{ required: "Ingrese C&oacute;digo de Compra" },
			codproducto : { required : "Ingrese C&oacute;digo Producto"  },
			producto:{  required: "Ingrese Descripci&oacute;n Producto"  },
			codcategoria:{ required: "Seleccione Categoria de Producto" },
			cantcompra:{  required: "Ingrese Cantidad de Compra", number: "Ingrese solo digitos con 2 decimales"  },
			precio1:{ required: "Ingrese Precio de Compra", number: "Ingrese solo digitos con 2 decimales" },
			lote:{  required: "Ingrese N&deg; de Lote"  },

       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatedetalleecompra").serialize();
				var id= $("#updatedetalleecompra").attr("data-id");
		        var coddetallecompra = id;
								
			    var cant = $('#cantcompra').val();
			    var tipoentrada = $('#tipoentrada').val();
				var prec = $('#precio1').val();
				cant    = parseInt(cant);
	
	       if (prec==0.00 || prec==0) {
	            
				$("#precio1").focus();
				$('#precio1').val("");
				$('#precio1').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN PRECIO VALIDO PARA COMPRA DE PRODUCTOS');
         
        return false;
		
			} else  if (cant==0) {
	            
				$("#cantcompra").focus();
				$('#cantcompra').val("");
				$('#cantcompra').css('border-color','#2b4049');
				alert('POR FAVOR INGRESE UNA CANTIDAD VALIDA PARA COMPRA DE PRODUCTOS');
         
        return false;
	 
	  } else {
		        $.ajax({
				type : 'POST',
				url  : 'editdetallecompra.php?coddetallecompra='+coddetallecompra,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE DETALLE DE COMPRA NO PUEDE SER ACTUALIZADO, SE ENCUENTRA INACTIVO PARA ACTUALIZAR !</div></center>');
											
										$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
	$("#cargacomprainput").load("funciones.php?muestracantcompradb=si&coddetallecompra="+btoa(coddetallecompra)+'&tipoentrada='+tipoentrada);
    					setTimeout("location.href='detallescompras'", 5000);
				});
								}
						   }
				});
				return false;
	           }
		}
	   /* form submit */	   
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DETALLE DE COMPRAS DE PRODUCTOS */
 
  































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ARQUEO DE CAJA */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#arqueocaja").validate({
      rules:
	  {
			codcaja: { required: true, },
			montoinicial: { required: true, number : true},
			dineroefectivo: { required: true, number : true},
			comentarios: { required: true,},
	   },
       messages:
	   {
			codcaja: { required: "Seleccione Caja para Arqueo" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
			dineroefectivo:{ required: "Ingrese Monto en Efectivo", number: "Ingrese solo digitos con 2 decimales" },
			comentarios:{  required: "Ingrese Comentario de Cierre" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#arqueocaja").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'forarqueo.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN ARQUEO ABIERTO DE ESTA CAJA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#arqueocaja")[0].reset();		
						setTimeout(function() { $("#error").html(""); }, 5000);		
						$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE ARQUEO DE CAJA */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE ARQUEO DE CAJA */	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#updatearqueocaja").validate({
      rules:
	  {
			codcaja: { required: true, },
			montoinicial: { required: true, number : true},
			dineroefectivo: { required: true, number : true},
			comentarios: { required: true,},
	   },
       messages:
	   {
			codcaja: { required: "Seleccione Caja para Arqueo" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
			dineroefectivo:{ required: "Ingrese Monto en Efectivo", number: "Ingrese solo digitos con 2 decimales" },
			comentarios:{  required: "Ingrese Comentario de Cierre" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatearqueocaja").serialize();
				var id= $("#updatearqueocaja").attr("data-id");
		        var codarqueo = id;
				
				$.ajax({
				
				type : 'POST',
				url  : 'forarqueo.php?codarqueo='+codarqueo,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> YA EXISTE UN ARQUEO ABIERTO DE ESTA CAJA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center>'+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
					    setTimeout("location.href='arqueoscajas'", 5000);
				
									});
											
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE ARQUEO DE CAJA */



/* FUNCION JQUERY PARA VALIDAR CIERRE DE CAJA */	 
$('document').ready(function()
{ 
								
     /* validation */
	 $("#cierrecaja").validate({
      rules:
	  {
			codcaja: { required: true, },
			montoinicial: { required: true, number : true},
			dineroefectivo: { required: true, number : true},
			comentarios: { required: false,},
	   },
       messages:
	   {
			codcaja: { required: "Seleccione Caja para Arqueo" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
			dineroefectivo:{ required: "Ingrese Monto en Efectivo", number: "Ingrese solo digitos con 2 decimales" },
			comentarios:{  required: "Ingrese Comentario de Cierre" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#cierrecaja").serialize();
				var id= $("#cierrecaja").attr("data-id");
				var dineroefectivo = $('#dineroefectivo').val();
		        var codarqueo = id;
	
	       if (dineroefectivo==0.00 || dineroefectivo==0) {
	            
				$("#dineroefectivo").focus();
				$('#dineroefectivo').val("");
				$('#dineroefectivo').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN MONTO VALIDO PARA EFECTIVO DISPONIBLE');
         
        return false;
	 
	  } else {
				
				$.ajax({
				
				type : 'POST',
				url  : 'forcierrearqueo.php?codarqueo='+codarqueo,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Cerrar Caja');
										
									});
																				
								} 
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO PUEDE CERRAR CAJA CON VENTAS SIN CANCELAR, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Cerrar Caja');
										
									});
																				
								}
								else{
										
						$("#error").fadeIn(1000, function(){
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Cerrar Caja');
					    setTimeout("location.href='arqueoscajas'", 5000);
				
									});
											
								}
						   }
				});
				return false;
	  }
		}
	   /* form submit */
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR CIERRE DE CAJA */

















































 /* FUNCION JQUERY PARA VALIDAR REGISTRO DE MOVIMIENTOS EN CAJA */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#movimientocaja").validate({
      rules:
	  {
			tipomovimientocaja: { required: true, },
			montomovimientocaja: { required: true, number : true },
			mediopagomovimientocaja: { required: true, },
			codcaja: { required: true, },
			descripcionmovimientocaja: { required: true, },
	   },
       messages:
	   {
            tipomovimientocaja:{  required: "Seleccione Tipo de Movimiento" },
			montomovimientocaja:{ required: "Ingrese Monto de Movimiento", number: "Ingrese solo digitos con 2 decimales" },
			mediopagomovimientocaja:{ required: "Seleccione Medio de Pago" },
			codcaja:{ required: "Seleccione Caja" },
			descripcionmovimientocaja:{ required: "Ingrese Descripci&oacute;n de Movimiento" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#movimientocaja").serialize();
				var cant = $('#montomovimientocaja').val();
	
	        if (cant==0.00 || cant==0) {
	            
				$("#montomovimientocaja").focus();
				$('#montomovimientocaja').val("");
				$('#montomovimientocaja').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO EN CAJA');
         
        return false;
	 
	  } else {
		  
				$.ajax({
				
				type : 'POST',
				url  : 'formovimientocaja.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
		$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> DEBE DE REALIZAR EL ARQUEO DE CAJA PARA REGISTRAR MOVIMIENTOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else if(data=='3')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
		$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> EL MONTO A RETIRAR NO EXISTE EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}

								else if(data=='4')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
		$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO DE CAJA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						            $("#error").html('<center> '+data+' </center>');
						            $("#movimientocaja")[0].reset();
					                setTimeout(function() { $("#error").html(""); }, 5000);
								    $("#btn-submit").html('<span class="fa fa-save"></span> Registrar');
									});
								}
						   }
				});
				return false;
	         }
		}
	   /* form submit */
});
/* FIN DE FUNCION PARA VALIDAR REGISTRO DE MOVIMIENTOS EN CAJA */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MOVIMIENTOS EN CAJA */	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updatemovimientocaja").validate({
       rules:
	  {
			tipomovimientocaja: { required: true, },
			montomovimientocaja: { required: true, number : true },
			mediopagomovimientocaja: { required: true, },
			codcaja: { required: true, },
			descripcionmovimientocaja: { required: true, },
	   },
       messages:
	   {
            tipomovimientocaja:{  required: "Seleccione Tipo de Movimiento" },
			montomovimientocaja:{ required: "Ingrese Monto de Movimiento", number: "Ingrese solo digitos con 2 decimales" },
			mediopagomovimientocaja:{ required: "Seleccione Medio de Pago" },
			codcaja:{ required: "Seleccione Caja" },
			descripcionmovimientocaja:{ required: "Ingrese Descripci&oacute;n de Movimiento" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatemovimientocaja").serialize();
				var id= $("#updatemovimientocaja").attr("data-id");
		        var codmovimientocaja = id;
				var cant = $('#montomovimientocaja').val();
	
	        if (cant==0.00 || cant==0) {
	            
				$("#montomovimientocaja").focus();
				$('#montomovimientocaja').val("");
				$('#montomovimientocaja').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO EN CAJA');
         
        return false;
	 
	  } else {
				$.ajax({
				
				type : 'POST',
				url  : 'formovimientocaja.php?codmovimientocaja='+codmovimientocaja,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
		$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> EL MONTO A RETIRAR NO EXISTE EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}

								else if(data=='3')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
		$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO DE CAJA, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}
								else{
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$('#btn-update').attr("disabled", true);
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
$("#cargamovimientoinput").load("funciones.php?muestramovimeintodb=si&codmovimientocaja="+btoa(codmovimientocaja));
					    setTimeout("location.href='movimientoscajas'", 5000);
				});
								}
						   }
				});
				return false;
	         }
		}
	   /* form submit */
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE MOVIMIENTOS EN CAJA */
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 


























/* clase del boton */
$('.actualizar').click(function(){
	var data = new FormData();

	/* id del post */
	var other_data = $('#ventas').serializeArray();
	/* recojo todos los inputs */
	$.each(other_data,function(key, input) {
		data.append(input.name, input.value);
	});

alert('ESTE ES UN ALERT');


$.ajax({
				
				type : 'POST',
				url  : 'panel.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$(".actualizar").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
						$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
					$(".actualizar").html('<span class="fa fa-save"></span> Confirmar Pedido');
										
									});
																				
								}
								
								else{
										
									$("#error").fadeIn(1000, function(){
											
		$("#error").html('<center> '+data+' </center>');
	    $("#carrito tbody").html("");
		$("#recibemesa").load("funciones.php?BuscaMesaReservas=si&codmesa="+btoa(codmesa));
		$(".actualizar").html('<span class="fa fa-save"></span> Confirmar Pedido');
						
									});
								}
						   }
				});


    });

























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE NUEVOS CLIENTES EN DELIVERY */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#deliverclientes").validate({
      rules:
	  {
			cedcliente: { required: true, digits : true },
			nomcliente: { required: true, lettersonly: true, },
			direccliente: { required: true, },
			tlfcliente: { required: false, digits : false  },
			emailcliente: { required: false, email: true },
	   },
       messages:
	   {
            cedcliente:{ required: "Ingrese Nit de Cliente", digits: "Ingrese solo digitos para Nit"},
			nomcliente:{ required: "Ingrese Nombre de Cliente", lettersonly: "Ingrese solo letras para Nombres" },
            direccliente:{ required: "Ingrese Direcci&oacute;n de Cliente" },
			tlfcliente: { required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos" },
			emailcliente:{  required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#deliverclientes").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'delivery.php',
				data : data,
				beforeSend: function()
				{	
					$("#errorres").fadeOut();
					$("#btn-cliente").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#errores").fadeIn(1000, function(){
											
											
	$("#errores").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-cliente").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#errores").fadeIn(1000, function(){
											
											
	$("#errores").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE CLIENTE YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-cliente").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#errores").fadeIn(1000, function(){
											
						            $("#errores").html('<center> '+data+' </center>');
						            $("#deliverclientes")[0].reset();
					            	setTimeout(function() { $("#errores").html(""); }, 5000); 					
								    $("#btn-cliente").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE NUEVOS CLIENTES EN DELIVERY*/


/* FUNCION JQUERY PARA VALIDAR REGISTRO DE VENTAS DE DELIVERY */	 	 
$('document').ready(function()
{ 
     /* validation */
	 $("#deliver").validate({
     rules:
	  {
			tipopedido: { required: true, },
			repartidor: { required: true, },
			descuento: { required: true, },
			tipopagove: { required: true, },
			formapagove: { required: true, },
			fechavencecredito: { required: true, },
			montoabono: { required: true, },
			montopagado: { required: true, },
			montodevuelto: { required: true, },
			observaciones: { required: true, },
	   },
       messages:
	   {
			tipopedido:{  required: "Seleccione Tipo de Pedido" },
			repartidor:{  required: "Seleccione Repartidor" },
			descuento:{  required: "Ingrese Descuento para Venta" },
            tipopagove:{  required: "ingrese Tipo de Pago" },
			formapagove:{  required: "Seleccione Medio de Pago" },
			fechavencecredito:{  required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{  required: "Ingrese Monto de Abono" },
			montopagado:{  required: "Ingrese Monto Pagado" },
			montodevuelto:{  required: "Ingrese Monto Devuelto" },
			observaciones:{  required: "Ingrese Observaciones de Pedidos" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
			  var data = $("#deliver").serialize();
			  var nuevaFila ="<tr>"+"<td colspan=4><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>"+"</tr>";
			  var total = $('#txtTotal').val();
			  var cliente = $('#cliente').val();
			  var tipopedido = $('#tipopedido').val();
	
	     if (total==0.00) {
	            
				$("#producto").focus();
				$('#producto').css('border-color','#01ba9a');
				alert('NO HA AGREGADO PRODUCTOS PARA PEDIDOS EN DELIVERY, VERIFIQUE POR FAVOR');
         
        return false;
	 
	  } else if (tipopedido=="EXTERNO" && cliente=="") {
	            
				$("#producto").focus();
				$('#producto').css('border-color','#01ba9a');
				alert('DEBE DE AGREGAR CLIENTES PARA REGISTRAR PEDIDOS PARA DELIVERY, VERIFIQUE POR FAVOR');
         
        return false;
	 
	  } else {
				$.ajax({
				
				type : 'POST',
				url  : 'delivery.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-venta").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
						$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO HA AGREGADO PRODUCTOS PARA CONFIRMAR PEDIDO, VERIFIQUE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
										
									});
								}
								else if(data=='3')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO HA AGREGADO PRODUCTOS PARA CONFIRMAR PEDIDOS, VERIFIQUE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
										
									});
								}
								
								else if(data=='4')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LA CANTIDAD SOLICITADA DE PRODUCTOS NO PUEDE SER MAYOR QUE LA EXISTENCIA EN ALMACEN, VERIFIQUE DE NUEVO POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
										
									});
								}
								else if(data=='5')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> USTED NO DISPONE DE ARQUEO DE CAJAS PARA CIERRE DE MESA, VERIFIQUE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
										
									});
								}
								else if(data=='6')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR ASIGNE EL CLIENTE A ESTA VENTA DE CREDITO PARA PAGOS DEL MISMO !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
										
									});
								}
								else if(data=='7')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LA FECHA DE VENCE CREDITO NO PUEDE SER MENOR QUE LA ACTUAL,  VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
		$("#error").html('<center> '+data+' </center>');
		$("#deliver")[0].reset();
		$("#cliente").val("");
		//$('label[id*="cedcliente"]').text('SIN ASIGNAR');
		//$('label[id*="nomcliente"]').text('SIN ASIGNAR');
		//$('label[id*="direccliente"]').text('SIN ASIGNAR');
		//$("#buscaclientes")[0].reset();	
		$("#carrito tbody").html("");
		$("#lblsubtotal").text("0.00");
		$("#lblsubtotal2").text("0.00");
		$("#lbliva").text("0.00");
		$("#lbldescuento").text("0.00");
		$("#lbltotal").text("0.00");
		$("#txtsubtotal").val("0.00");
		$("#txtsubtotal2").val("0.00");
		$("#txtIva").val("0.00");
		$("#txtDescuento").val("0.00");
		$("#txtTotal").val("0.00");
		$("#txtTotalCompra").val("0.00");
        $('#montopagado').val("0.00");
		$(nuevaFila).appendTo("#carrito tbody");
	    // habilitamos
        $("#formapagove").attr('disabled', false);
        $('#montopagado').attr('disabled', false);
        $('#montodevuelto').attr('disabled', false);
        // deshabilitamos
        $("#repartidor").attr('disabled', true);
        $("#fechavencecredito").attr('disabled', true);
        $('#montoabono').attr('disabled', true);
	    $("#carga-productos").load("salas-mesas.php?prod_categorias=si");
	    $("#favoritos").load("salas-mesas.php?Muestra_Favoritos=si");
		setTimeout(function() { $("#error").html(""); }, 15000);
		$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
						
									});
								}
						   }
				}).fail(function() {
					$("#error").fadeIn(1000, function(){
						$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ERROR AL REGISTRAR EL PEDIDO. VERIFIQUE ARQUEO DE CAJA Y DATOS DEL FORMULARIO.</div></center>');
						$("#btn-venta").html('<span class="fa fa-save"></span> Registrar Pedido');
					});
				});
				return false;
		         }
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE VENTAS DE DELIVERY */






















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE NUEVOS CLIENTES EN VENTAS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#ventaclientes").validate({
      rules:
	  {
			cedcliente: { required: true, digits : true },
			nomcliente: { required: true, lettersonly: true, },
			direccliente: { required: true, },
			tlfcliente: { required: false, digits : false  },
			emailcliente: { required: false, email: true },
	   },
       messages:
	   {
            cedcliente:{ required: "Ingrese Nit de Cliente", digits: "Ingrese solo digitos para Nit"},
			nomcliente:{ required: "Ingrese Nombre de Cliente", lettersonly: "Ingrese solo letras para Nombres" },
            direccliente:{ required: "Ingrese Direcci&oacute;n de Cliente" },
			tlfcliente: { required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos" },
			emailcliente:{  required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
           
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#ventaclientes").serialize();
				
				$.ajax({
				
				type : 'POST',
				url  : 'panel.php',
				data : data,
				beforeSend: function()
				{	
					$("#errorres").fadeOut();
					$("#btn-cliente").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#errores").fadeIn(1000, function(){
											
											
	$("#errores").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-cliente").html('<span class="fa fa-save"></span> Registrar');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#errores").fadeIn(1000, function(){
											
											
	$("#errores").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTE CLIENTE YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
								    $("#btn-cliente").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
								else{
										
									$("#errores").fadeIn(1000, function(){
											
						            $("#errores").html('<center> '+data+' </center>');
						            $("#ventaclientes")[0].reset();
					            	setTimeout(function() { $("#errores").html(""); }, 5000); 					
								    $("#btn-cliente").html('<span class="fa fa-save"></span> Registrar');
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE NUEVOS CLIENTES EN VENTAS*/

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE VENTAS DE PRODUCTOS */	 	 
$('document').ready(function()
{ 
     /* validation */
	 $("#ventas").validate({
     rules:
	  {
			descuento: { required: true, },
			tipopagove: { required: true, },
			formapagove: { required: true, },
			fechavencecredito: { required: true, },
			montoabono: { required: true, },
			montopagado: { required: true, },
			montodevuelto: { required: true, },
			observaciones: {
				required: function() {
					return window.ventasAccionSubmit !== 'btn-cerrar';
				}
			},
	   },
       messages:
	   {
			descuento:{  required: "Ingrese Descuento para Venta" },
            tipopagove:{  required: "ingrese Tipo de Pago" },
			formapagove:{  required: "Seleccione Medio de Pago" },
			fechavencecredito:{  required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{  required: "Ingrese Monto de Abono" },
			montopagado:{  required: "Ingrese Monto Pagado" },
			montodevuelto:{  required: "Ingrese Monto Devuelto" },
			observaciones:{  required: "Ingrese Observaciones de Pedidos" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
			  if (window.mesaCargando) {
			      alert('Espere a que termine de cargar la mesa seleccionada.');
			      return false;
			  }
			  var accion = window.ventasAccionSubmit || 'btn-venta';
			  var esCerrarMesa = accion === 'btn-cerrar';
			  var codmesaForm = $('#recibemesa input[name="codmesa"]').val() || $('#codmesa').val() || '';
			  if (typeof normalizarCodmesaRef === 'function') {
			      codmesaForm = normalizarCodmesaRef(codmesaForm);
			  }
			  if (window.codmesaActiva && codmesaForm !== '') {
			      var mesaActiva = (typeof normalizarCodmesaRef === 'function')
			          ? normalizarCodmesaRef(window.codmesaActiva)
			          : String(window.codmesaActiva);
			      if (String(codmesaForm) !== String(mesaActiva)) {
			          alert('La mesa seleccionada no coincide con la orden en pantalla. Vuelva a abrir la mesa e intente de nuevo.');
			          return false;
			      }
			  }
			  var data = $("#ventas").serialize();
			  if (codmesaForm !== '') {
			      data = data.replace(/(^|&)codmesa=[^&]*/g, '').replace(/^&/, '');
			      data += (data ? '&' : '') + 'codmesa=' + encodeURIComponent(codmesaForm);
			  }
			  if (!esCerrarMesa && typeof buildCarritoFromDom === 'function') {
			      var carritoDom = buildCarritoFromDom();
			      if (!carritoDom.length) {
			          alert('NO HA AGREGADO PRODUCTOS PARA CONFIRMAR PEDIDO, VERIFIQUE POR FAVOR');
			          return false;
			      }
			      data += '&carrito_json=' + encodeURIComponent(JSON.stringify(carritoDom));
			  }
			  if (data.indexOf(accion + '=') === -1) {
			      data += (data ? '&' : '') + encodeURIComponent(accion) + '=1';
			  }
			  var nuevaFila ="<tr>"+"<td colspan=4><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>"+"</tr>";
			  var codmesa = $('#codmesa').val();
			  var total = $('#txtTotal').val();
			  var totalin = $('#txtTotall').val();
			  var cliente = $('#codcliente').val();
			  var texto = esCerrarMesa
			      ? totalin
			      : total;
	
	     if (esCerrarMesa && (texto == 0.00 || texto === '0' || texto === '' || texto === undefined)) {
				alert('NO HAY PEDIDO ACTIVO PARA CERRAR EN ESTA MESA, VERIFIQUE POR FAVOR');
				return false;
	     } else if (!esCerrarMesa && (texto==0.00 || texto === '0' || texto === '' || texto === undefined)) {
	            
				$("#producto").focus();
				$('#producto').css('border-color','#01ba9a');
				alert('NO HA AGREGADO PRODUCTOS PARA CONFIRMAR PEDIDO, VERIFIQUE POR FAVOR');
         
        return false;
	 
	  } else {
				$.ajax({
				
				type : 'POST',
				url  : 'panel.php',
				data : data,
				dataType: 'text',
				beforeSend: function()
				{	
					$("#error").fadeOut();
					if (esCerrarMesa) {
						$("#btn-cerrar").html('<i class="fa fa-refresh"></i> Verificando...');
					} else {
						$("#btn-venta").html('<i class="fa fa-refresh"></i> Verificando...');
						$("#btn-agregapedidos").html('<i class="fa fa-refresh"></i> Verificando...');
					}
				},
				success :  function(data)
						   {
								data = $.trim(data);
								if (data.indexOf('<!DOCTYPE') !== -1 || data.indexOf('<html') !== -1) {
									$("#error").fadeIn(1000, function() {
										$("#error").html('<center><div class="alert alert-danger"><span class="fa fa-info-circle"></span> No se pudo confirmar el pedido. Recargue la p?gina e intente de nuevo.</div></center>');
										$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
										$("#btn-agregapedidos").html('<span class="fa fa-save"></span> Confirmar Pedido');
									});
									return;
								}
								if(data=='1'){
									
						$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO HA AGREGADO PRODUCTOS PARA CONFIRMAR PEDIDO, VERIFIQUE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
										
									});
								}
								else if(data=='3')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> NO HA AGREGADO PRODUCTOS PARA CONFIRMAR PEDIDO, VERIFIQUE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
										
									});
								}
								
								else if(data=='4')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LA CANTIDAD SOLICITADA DE PRODUCTOS NO PUEDE SER MAYOR QUE LA EXISTENCIA EN ALMACEN, VERIFIQUE DE NUEVO POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
										
									});
								}
								else if(data=='8')
								{
					$("#error").fadeIn(1000, function(){
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> ESTA MESA YA TIENE UN PEDIDO ACTIVO. AGREGUE SOLO LOS PRODUCTOS NUEVOS Y USE EL BOT&Oacute;N CONFIRMAR PEDIDO (MODO ADICIONAL).</div></center>');
					$("#btn-venta").hide();
					$("#btn-agregapedidos").show();
					$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
									});
								}
								else if(data=='9')
								{
					$("#error").fadeIn(1000, function(){
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> EL PEDIDO NO CORRESPONDE A ESTA MESA. CIERRE Y VUELVA A SELECCIONAR LA MESA CORRECTA.</div></center>');
					$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
					$("#btn-agregapedidos").html('<span class="fa fa-save"></span> Confirmar Pedido');
									});
								}
								
								else if(data=='5')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> USTED NO DISPONE DE ARQUEO DE CAJAS PARA CIERRE DE MESA, VERIFIQUE POR FAVOR !</div></center>');
											
					$("#btn-venta").html('<span class="fa fa-save"></span> Cerrar Mesa');
										
									});
								}
								else if(data=='6')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR ASIGNE EL CLIENTE A ESTA VENTA DE CREDITO PARA PAGOS DEL MISMO !</div></center>');
											
					$("#btn-cerrar").html('<span class="fa fa-save"></span> Cerrar Mesa');
										
									});
								}
								else if(data=='7')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LA FECHA DE VENCE CREDITO NO PUEDE SER MENOR QUE LA ACTUAL,  VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
					$("#btn-cerrar").html('<span class="fa fa-save"></span> Cerrar Mesa');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
		$("#error").html(data);
	    $("#carrito tbody").html("");
		var $linkComanda = $('#error a[href*="reportepdf"]').first();
		if ($linkComanda.length) {
		    window.open($linkComanda.attr('href'), '_blank');
		}
		var opSeq = ++window.mesaOperacionSeq;
		var mesaRefAtConfirm = (typeof normalizarCodmesaRef === 'function')
		    ? normalizarCodmesaRef(window.codmesaActiva)
		    : String(window.codmesaActiva || '');
		if (esCerrarMesa && typeof mostrarVistaMesas === 'function') {
		    mostrarVistaMesas();
		} else if (typeof mostrarVistaProductos === 'function') {
		    mostrarVistaProductos();
		}
		if (typeof recargarMesasPanel === 'function') {
		    recargarMesasPanel();
		}
		if (mesaRefAtConfirm) {
		    var mesaRefEncoded = (typeof codmesaRefParaApi === 'function')
		        ? codmesaRefParaApi(mesaRefAtConfirm)
		        : btoa(String(mesaRefAtConfirm));
		    $("#recibemesa").load("funciones.php?BuscaMesaReservas=si&codmesa="+mesaRefEncoded, function() {
		        if (window.mesaOperacionSeq !== opSeq) {
		            return;
		        }
		        var mesaActual = (typeof normalizarCodmesaRef === 'function')
		            ? normalizarCodmesaRef(window.codmesaActiva)
		            : String(window.codmesaActiva || '');
		        if (mesaActual !== mesaRefAtConfirm) {
		            return;
		        }
		        if (typeof toggleAccionesPedido === 'function') {
		            toggleAccionesPedido();
		        }
		        if (typeof cargarCarritoMesa === 'function') {
		            cargarCarritoMesa(mesaRefAtConfirm);
		        }
		    });
		}
		setTimeout(function() { $("#error").html(""); }, 15000);
		$("#btn-venta").html('<span class="fa fa-save"></span> Confirmar Pedido');
		$("#btn-agregapedidos").html('<span class="fa fa-save"></span> Confirmar Pedido');
		$("#btn-cerrar").html('<span class="fa fa-save"></span> Cerrar Mesa');
						
									});
								}
						   }
				});
				return false;
		         }
		}
	   /* form submit */
});

/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE VENTAS DE PRODUCTOS */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE VENTAS DE PRODUCTOS */	 	 
     $('document').ready(function()
{ 
     /* validation */
	 $("#updatedetallesventas").validate({
        rules:
	  {
			codventa: { required: true, },
			codproducto : { required: true, },
			producto: { required: true, },
			codcategoria: { required: true, },
			cantventa: { required: true, number : true  },
			precioventa: { required: true, number : true },
	   },
       messages:
	   {
            codventa:{ required: "Ingrese C&oacute;digo de Venta" },
			codproducto : { required : "Ingrese C&oacute;digo Producto"  },
			producto:{  required: "Ingrese Descripci&oacute;n Producto"  },
			codcategoria:{ required: "Seleccione Categoria de Producto" },
			cantventa:{  required: "Ingrese Cantidad", number: "Ingrese solo digitos con 2 decimales"  },
			precioventa:{ required: "Ingrese Precio de Venta", number: "Ingrese solo digitos con 2 decimales" },

       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#updatedetallesventas").serialize();
		        var coddetalleventa = $('input#coddetalleventa').val();
		        var tipobusquedad = $('input#tipobusquedad2').val();
		        var codventa = $('input#codventa').val();
		        var codcaja = $('input#codcaja2').val();
		        var fecha = $('input#fecha2').val();
				
				var cant = $('#cantventa').val();
	            var exist = $('#existencia').val();
	            var producto = $('#producto').val();
				//cant    = parseInt(cant);
			    //exist    = parseInt(exist);
	
	          if (cant>exist) {	 
	            
	alert('LA CANTIDAD ' + cant + ' NO PUEDE SER MAYOR QUE LA EXISTENCIA ' + exist + ' DE PRODUCTOS : ' + producto);
         
        return false;
		
		} else  if (cant==0) {
	            
				$("#cantventa").focus();
				$('#cantventa').val("");
				$('#cantventa').css('border-color','#01ba9a');
				alert('POR FAVOR INGRESE UNA CANTIDAD VALIDA PARA VENTA DE PRODUCTOS');
         
        return false;
	 
	  } else { 
				$.ajax({
				
				type : 'POST',
				url  : 'detallesventas.php?coddetalleventa='+coddetalleventa,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando ...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else if(data=='2'){
									
									$("#error").fadeIn(1000, function(){
											
											
	("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LA CANTIDAD SOLICITADA DE PRODUCTOS, NO EXISTE EN ALMACEN, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
																				
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
	$("#cargainput").load("funciones.php?muestracantventadb=si&coddetalleventa="+btoa(coddetalleventa));
$("#muestradetallesventas").load("funciones.php?BuscarDetallesVentas=si&tipobusquedad="+tipobusquedad+'&codventa='+codventa+'&codcaja='+codcaja+'&fecha='+fecha);
						setTimeout(function() { $("#error").html(""); }, 15000);
				
				                     });
								}
						   }
				});
				return false;
	         }
		}
	   /* form submit */	   
});
 /* FIN DE FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE DETALLE DE VENTAS DE PRODUCTOS */ 
 







































/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ABONOS DE CREDITOS */	 
	 
$('document').ready(function()
{ 
     /* validation */
	 $("#abonoscreditos").validate({
     rules:
	  {
			montoabono: { required: true, },
	   },
       messages:
	   {
            montoabono:{  required: "Ingrese Monto de Abono" },
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* form submit */
	  function submitForm()
	   {		
				var data = $("#abonoscreditos").serialize();
				var totaldebe = $('#totaldebe').val();
				var montoabono = $('#montoabono').val();
				totaldebe1    = parseFloat(totaldebe);
			    montoabono1    = parseFloat(montoabono);
	
	        if (montoabono==0.00 || montoabono=="") {
	            
				$("#montoabono").focus();
				$('#montoabono').css('border-color','#2b4049');
				alert('POR FAVOR DEBE DE INGRESAR UN MONTO VALIDO PARA PAGAR CREDITO');
         
        return false;
	 
	  } else if (montoabono1 > totaldebe) {
	            
				$("#montoabono").focus();
				$("#montoabono").val("");
				$('#montoabono').css('border-color','#2b4049');
				alert('POR FAVOR EL MONTO A PAGAR ES MAYOR AL QUE DEBE \n EN ESTA FACTURA DE CREDITO, VERIFIQUE EL MONTO POR FAVOR');
         
        return false;
	 
	  } else {
				$.ajax({
				
				type : 'POST',
				url  : 'forcartera.php',
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
									$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> LOS CAMPOS NO PUEDEN IR VACIOS, VERIFIQUE NUEVAMENTE POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar Pago');
										
									});
																				
								}
								else if(data=='2')
								{
									
					$("#error").fadeIn(1000, function(){
											
											
	$("#error").html('<center><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR EL MONTO ABONADO ES MAYOR AL QUE DEBE EN ESTA FACTURA DE CREDITO, VERIFIQUE EL MONTO POR FAVOR !</div></center>');
											
										$("#btn-submit").html('<span class="fa fa-save"></span> Registrar Pago');
										
									});
								}
								else{
										
									$("#error").fadeIn(1000, function(){
											
						$("#error").html('<center> '+data+' </center>');
						$("#abonoscreditos")[0].reset();
		                $("#codcliente").val("");	
					    $("#muestraclientesabonos").html("");
						$("#muestraformularioabonos").html("");
						setTimeout(function() { $("#error").html(""); }, 80000);
						$("#btn-submit").html('<span class="fa fa-search"></span> Realizar Busqueda');
										
									});
								}
						   }
				});
				return false;
		         }
		}
	   /* form submit */
});

/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE ABONOS DE CREDITOS */