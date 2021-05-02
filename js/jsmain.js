fn_combo();
function fn_login(){
    let usu=$( '#txt_usu' ).val();
    let pass=$( '#txt_pass' ).val();
    if( usu== '' ){ alert('Ingrese el usuario'); $( '#txt_usu' ).focus(); return; }
    if( pass== '' ){ alert('Ingrese la contraseña'); $( '#txt_pass' ).focus(); return; }
    let items={
        usu:usu,
        pass:pass,
    };
    let datos = 'html='+JSON.stringify( items );
    $.ajax({
        type: 'POST',
        url: 'ws/login.php',
        data: datos,
        success: function(msg){
            $('#div_ajax').html(msg);
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_agregar_usuario(){
    let usuid = 0;
    let usunom = $( "#inp_usunom" ).val();
    let usuape = $( "#inp_usuape" ).val();
    let usudni = $( "#inp_usudni" ).val();
    let usugen = $( "#sel_usugen" ).val();
    let usudis = $( "#sel_usudis" ).val();
    let usudir = $( "#inp_usudir" ).val();
    let usuemail = $("#inp_usuemail").val();
    let usutel = $("#inp_usutel").val();
    let usupw = $("#inp_usupw").val();
    let ususta = "ACT";
    let rolid = 1;
    if( usunom == "" || usuape == "" || usudni == "" || usugen == "" || usudis == "" || usudir == "" || usuemail == "" || usutel == "" || usupw == ""){
        alert("Todos los campos son obligatorios"); 
        return;
    }
    let modo = "INS"
    if(usuid > 0){
        modo = "UPD"
    }
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_usuarios.php?modo='+modo+'&usunom='+usunom+'&usuape='+usuape+'&usudni='+usudni+'&usugen='+usugen+'&usudis='+usudis+'&usudir='+usudir+'&usuemail='+usuemail+'&usutel='+usutel+'&usupw='+usupw+'&ususta='+ususta+'&rolid='+rolid,
        data: "",
        success: function(msg){
            $('#div_ajax').html(msg);
            msg = eval(msg);
            resul = msg.resultado;
            console.log(resul);

            if(resul == 1){
                alert('El DNI ya fue registrado anteriormente.');
                return;
            }else if(resul == 2){
                alert('El email ya fue registrado anteriormente.');
                return;
            }else if(resul == 3){
                alert('El teléfono ya fue registrado anteriormente.');
                return;
            }else if(resul == 4){
                alert('Registro exitoso. Por favor, inicie sesión.');
                window.location='login.php';
            }
            // if(msg[0].resultado)
            // alert(msg);
            // return;
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }    
    });
}
function fn_agregar_tpo(){
    //alert("AGREGANDO");
    let masctponom = $( "#txt_add_tpo" ).val();
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tpo_masc.php?modo=INS&masctponom='+masctponom,
        data: "",
        success: function(msg){
            $('#div_ajax').html(msg);
            fn_limpiar_combos();
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_agregar_raza(){
    //alert("AGREGANDO");
    let masctpoid = $( "#sel_tipo_raza" ).val();
    let raznom = $( "#txt_add_raza" ).val();
    $.ajax({
        type: 'GET',
        url: 'ws/ws_cat_raza_mascota.php?modo=INS&masctpoid='+masctpoid+'&raznom='+raznom,
        data: "",
        success: function(msg){
            $('#div_ajax').html(msg);
            fn_limpiar_combos();
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_nueva_mascota(){
    $( "#txt_id" ).val("0");
    $( "#txt_nom" ).val("");
    $( "#sel_gen" ).val("NA");
    $( "#txt_fec" ).val("");
    $( "#sel_tipo" ).val("NA");
    $( "#sel_raza" ).val("NA");
}
function fn_agregar_mascota(){
    let mascid = $( "#txt_id" ).val();
    let mascnom = $( "#txt_nom" ).val();
    let mascgen = $( "#sel_gen" ).val();
    let mascfec = $( "#txt_fec" ).val();
    let masctpoid = $( "#sel_tipo" ).val();
    let razid = $( "#sel_raza" ).val();
    if( mascnom == "" || mascgen == "NA" || masctpoid == "NA" || razid == "NA" || mascfec == "" ){ alert("Todos los campos son obligatorios"); return; }
    let modo = "INS"
    if( mascid > 0 ){
        modo = "UPD"
    }
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_mascotas.php?modo='+modo+'&mascnom='+mascnom+'&mascfec='+mascfec+'&masctpoid='+masctpoid+'&razid='+razid+'&mascgen='+mascgen+'&mascid='+mascid,
        data: "",
        success: function(msg){
            $('#div_ajax').html(msg);
            window.location='crud_mascota.php';
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_editar_mascota(id){
    //alert(id);return;
    
    fn_limpiar_combos();
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_mascotas.php?modo=LST&mascid='+id,
        data: "",
        success: function(msg){
            msg = eval( msg );
            $( "#txt_id" ).val(id);
            $( "#txt_nom" ).val(msg[0].mascnom);
            $( "#sel_gen" ).val(msg[0].mascgen);
            $( "#txt_fec" ).val(msg[0].mascfec);
            $( "#sel_tipo" ).val(msg[0].masctpoid);
            fn_combo2(msg[0].masctpoid,msg[0].razid);
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_eliminar_mascota(id){
    if(!confirm("Deseas eliminar la mascota "+id)){return;}
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_mascotas.php?modo=DEL&mascid='+id,
        data: "",
        success: function(msg){
            msg = eval( msg );
            window.location='crud_mascota.php';
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    }); 
}
function fn_limpiar_combos(){
    $('#sel_tipo option').remove();
    $('#sel_tipo_raza option').remove();
    $('#sel_raza option').remove();
    fn_combo();
}
function fn_combo(){
    let urla="ws/ws_tpo_masc.php?modo=LST";
    $.ajax({
      type:"GET",
      url:urla,
      data:"",
      success: function(msg){
        msg = eval( msg );
        $( "#sel_tipo" ).append("<option selected disabled value='NA'>-- Seleccionar --</option>");
        $( "#sel_tipo_raza" ).append("<option selected disabled value='NA'>-- Seleccionar --</option>");
        for( let i=0;i<msg.length;i++ ){
          $( "#sel_tipo" ).append("<option value=\'"+msg[i].masctpoid+"\'>"+msg[i].masctponom+"</option>");
          $( "#sel_tipo_raza" ).append("<option value=\'"+msg[i].masctpoid+"\'>"+msg[i].masctponom+"</option>");
        }
      },
      error: function(xml,msg){alert("Error al cargar tipos de mascotas")}
    });
} 
function fn_combo2(tpo,recu){
    $('#sel_raza option').remove();
    let urla="ws/ws_cat_raza_mascota.php?modo=LST&masctpoid="+tpo;
    $.ajax({
        type:"GET",
        url:urla,
        data:"",
        success: function(msg){
          msg = eval( msg );
          $( "#sel_raza" ).append("<option selected disabled value='NA'>-- Seleccionar --</option>");
          for( let i=0;i<msg.length;i++ ){
            
            $( "#sel_raza" ).append("<option value=\'"+msg[i].razid+"\'>"+msg[i].raznom+"</option>");
          }
          if( !recu == ""){
            $( "#sel_raza" ).val(recu);
          }
         
        },
        error: function(xml,msg){alert("Error al cargar razas")}
      });
}
function fn_nuevo_producto(){
    $( "#txt_id" ).val("0");
    $( "#txt_nombre" ).val("");
    $( "#txt_precio" ).val("");
    $( "#txt_stock" ).val("");
    $( "#sel_marca" ).val("NA");
    $( "#sel_prov" ).val("NA");
    $( "#txt_des" ).val("");
    $( "#txt_html" ).val("");
    $( "#img_bd" ).empty();
    $( "#img_bd2" ).empty();
    $( "#img_bd3" ).empty();
}
function fn_guardar_productos(){
    let mascprodid = $( "#txt_id" ).val();
    let mascprodnom = $( "#txt_nombre" ).val();
    let mascprodpre = $( "#txt_precio" ).val();
    let mascprodstoc = $( "#txt_stock" ).val();
    let marcprodid = $( "#sel_marca" ).val();
    let provprodid = $( "#sel_prov" ).val();
    let mascproddes = $( "#txt_des" ).val();
    let mascprodhtml = $( "#txt_html" ).val();
    let mascprodimg = "";
    let mascprodimg2 = "";
    let mascprodimg3 = "";
    let formData = new FormData();
    let file = $("#txt_img")[0].files[0];
    let file2 = $("#txt_img2")[0].files[0];
    let file3 = $("#txt_img3")[0].files[0];
    let cont = 0;
    if( !file == "" ){   
        formData.append("file"+cont,file);
        mascprodimg =  file.name  ;
        cont++;
    }if(!file2 == ""){
        formData.append("file"+cont,file2);
        mascprodimg2 = file2.name ;
        cont++;
    }if(!file3 == ""){
        formData.append("file"+cont,file3);
        mascprodimg3 = file3.name ;
    }
    let parrafo = document.getElementById('img_bd');
    let contenido = parrafo.innerHTML;
    let parrafo2 = document.getElementById('img_bd2');
    let contenido2 = parrafo2.innerHTML;
    let parrafo3 = document.getElementById('img_bd3');
    let contenido3 = parrafo3.innerHTML;
    if( mascprodimg == ""){
        mascprodimg = contenido;
    }if( mascprodimg2 == ""){
        mascprodimg2 = contenido2;
    }if( mascprodimg3 == ""){
        mascprodimg3 = contenido3;
    }
    $.ajax({
      type: "POST",
      url: "ws/upload.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function(msg){
        //msg = eval( msg );
        $("#div_ajax").html(msg);
      },
      error: function(xml,msg){ $("#img_visprev").html("<div>Error: Al subir la imagen</div>"); }	   
    });
    if( mascprodnom == "" || mascprodpre == "" || marcprodid == "NA" || provprodid == "NA" || mascproddes == "" || mascprodhtml == "" || mascprodstoc == "" || mascprodimg == "" || mascprodimg2 == "" || mascprodimg3 == "" ){ alert("Todos los campos son obligatorios"); return; }
    let modo = "INS"
    if( mascprodid > 0 ){
        modo = "UPD"
    }
    let urla ='ws/ws_tb_productos.php?modo='+modo+'&mascprodnom='+mascprodnom+'&mascprodstoc='+mascprodstoc+'&marcprodid='+marcprodid+'&provprodid='+provprodid+'&mascproddes='+mascproddes+'&mascprodhtml='+mascprodhtml+'&mascprodimg='+mascprodimg+'&mascprodimg2='+mascprodimg2+'&mascprodimg3='+mascprodimg3+'&mascprodpre='+mascprodpre+'&mascprodid='+mascprodid;
    //alert(urla);
    $.ajax({
        type: 'GET',
        url: urla,
        data: "",
        success: function(msg){
            $('#div_ajax').html(msg);
            window.location='crud_producto.php';
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde '+msg+' </div>'); }	   
    });
}
function fn_editar_producto(id){
    //alert(id);return;
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_productos.php?modo=LST&mascprodid='+id,
        data: "",
        success: function(msg){
            msg = eval( msg );
            //alert(msg);
            $( "#txt_id" ).val(id);
            $( "#txt_nombre" ).val(msg[0].mascprodnom);
            $( "#txt_precio" ).val(msg[0].mascprodpre);
            $( "#txt_stock" ).val(msg[0].mascprodstoc);
            $( "#sel_marca" ).val(msg[0].marcprodid);
            $( "#sel_prov" ).val(msg[0].provprodid);
            $( "#txt_des" ).val(msg[0].mascproddes);
            $( "#txt_html" ).val(msg[0].mascprodhtml);
            $( "#img_bd" ).append(msg[0].mascprodimg);
            $( "#img_bd2" ).append(msg[0].mascprodimg2);
            $( "#img_bd3" ).append(msg[0].mascprodimg3);
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_eliminar_producto(id){
    if(!confirm("Deseas eliminar en producto "+id)){return;}
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_productos.php?modo=DEL&mascprodid='+id,
        data: "",
        success: function(msg){
            msg = eval( msg );
            window.location='crud_producto.php';
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    }); 
}
function fn_nuevo_servicio(){
    $( "#txt_id" ).val("0");
    $( "#txt_nom" ).val("");
    $( "#txt_des" ).val("");
    $( "#txt_pre" ).val("");
    $( "#txt_fec" ).val("");
    $( "#sel_hor" ).val("NA");
    $( "#img_bd" ).empty();
}
function fn_guardar_sevicio(){
    let servmascid = $( "#txt_id" ).val();
    let servmascnom = $( "#txt_nom" ).val();
    let servmascdes = $( "#txt_des" ).val();
    let servmascpre = $( "#txt_pre" ).val();
    let servmascimg = "";
    let servmascfec = $( "#txt_fec" ).val();
    let servmaschor = $( "#sel_hor" ).val();
    let formData = new FormData();
    let file = $("#txt_img")[0].files[0];
    if( !file == "" ){   
        formData.append("file0",file);
        servmascimg =  file.name  ;
    }
    let parrafo = document.getElementById('img_bd');
    let contenido = parrafo.innerHTML;
    if( servmascimg == ""){
        servmascimg = contenido;
    }
    $.ajax({
        type: "POST",
        url: "ws/upload.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(msg){
          //msg = eval( msg );
          $("#div_ajax").html(msg);
        },
        error: function(xml,msg){ $("#img_visprev").html("<div>Error: Al subir la imagen</div>"); }	   
      });
    if( servmascnom == "" || servmascdes == "NA" || servmascimg == "NA" || servmascpre == "" || servmaschor == "" || servmascfec == ""){ alert("Todos los campos son obligatorios"); return; }
    let modo = "INS"
    if( servmascid > 0 ){
        modo = "UPD"
    }
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_servicios.php?modo='+modo+'&servmascnom='+servmascnom+'&servmascpre='+servmascpre+'&servmascimg='+servmascimg+'&servmascdes='+servmascdes+'&servmascid='+servmascid+'&servmaschor='+servmaschor+'&servmascfec='+servmascfec,
        data: "",
        success: function(msg){
            $('#div_ajax').html(msg);
            window.location='crud_servicio.php';
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_editar_servicio(id){
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_servicios.php?modo=LST&servmascid='+id,
        data: "",
        success: function(msg){
            msg = eval( msg );
            //alert(msg);
            $( "#txt_id" ).val(id);
            $( "#txt_nom" ).val(msg[0].servmascnom);
            $( "#txt_des" ).val(msg[0].servmascdes);
            $( "#txt_pre" ).val(msg[0].servmascpre);
            $( "#txt_fec" ).val(msg[0].servmascfec);
            $( "#sel_hor" ).val(msg[0].servmaschor);
            $( "#img_bd" ).append(msg[0].servmascimg);
            
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    });
}
function fn_eliminar_servicio(id){
    if(!confirm("Deseas eliminar en sevicio "+id)){return;}
    $.ajax({
        type: 'GET',
        url: 'ws/ws_tb_servicios.php?modo=DEL&servmascid='+id,
        data: "",
        success: function(msg){
            msg = eval( msg );
            window.location='crud_servicio.php';
        },
        error: function(xml,msg){ $('#div_ajax').html('<div align=\"center\" style=\"color:red;\">Error: El servidor no responde</div>'); }	   
    }); 
}