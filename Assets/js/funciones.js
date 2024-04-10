let tblUsuarios, tblClientes, tblMedidas, tblCategorias, tblProductos, t_historial_c;
//verificar si se cargo, codigo extraido de https://datatables.net/manual/ajax
document.addEventListener("DOMContentLoaded", function(){
    //para cargar el combobox con select2
    $('#cliente').select2();
    // para cargar la tabla de usuarios
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
        },
        {
            'data' : 'usuario',
        },
        {
            'data' : 'nombre',
        },
        {
            'data' : 'caja'
        },
        {
            'data' : 'estado'
        },
        {
            'data' : 'acciones'
        }    
        ],
        language: {
            "url": base_url + "Assets/json/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                    //Botón para Excel
                    extend: 'excelHtml5',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',
     
                    //Aquí es donde generas el botón personalizado
                    text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                },
                //Botón para PDF
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para copiar
                {
                    extend: 'copyHtml5',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para print
                {
                    extend: 'print',
                    footer: true,
                    filename: 'Export_File_print',
                    text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                },
                //Botón para cvs
                {
                    extend: 'csvHtml5',
                    footer: true,
                    filename: 'Export_File_csv',
                    text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                },
                {
                    extend: 'colvis',
                    text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                    postfixButtons: ['colvisRestore']
                }
        ]
    } );

    // para cargar la tabla de clientes
    tblClientes = $('#tblClientes').DataTable( {
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
        },
        {
            'data' : 'dni',
        },
        {
            'data' : 'nombre',
        },
        {
            'data' : 'telefono'
        },
        {
            'data' : 'direccion'
        },
        {
            'data' : 'estado'
        },
        {
            'data' : 'acciones'
        }      
        ],
        language: {
            "url": base_url + "Assets/json/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                    //Botón para Excel
                    extend: 'excelHtml5',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',
     
                    //Aquí es donde generas el botón personalizado
                    text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                },
                //Botón para PDF
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para copiar
                {
                    extend: 'copyHtml5',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para print
                {
                    extend: 'print',
                    footer: true,
                    filename: 'Export_File_print',
                    text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                },
                //Botón para cvs
                {
                    extend: 'csvHtml5',
                    footer: true,
                    filename: 'Export_File_csv',
                    text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                },
                {
                    extend: 'colvis',
                    text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                    postfixButtons: ['colvisRestore']
                }
        ]
    } );

    // para cargar la tabla de medidas
    tblMedidas = $('#tblMedidas').DataTable( {
        ajax: {
            url: base_url + "Medidas/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
        },
        {
            'data' : 'nombre',
        },
        {
            'data' : 'nombre_corto'
        },
        {
            'data' : 'estado'
        },
        {
            'data' : 'acciones'
        }      
        ],
        language: {
            "url": base_url + "Assets/json/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                    //Botón para Excel
                    extend: 'excelHtml5',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',
     
                    //Aquí es donde generas el botón personalizado
                    text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                },
                //Botón para PDF
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para copiar
                {
                    extend: 'copyHtml5',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para print
                {
                    extend: 'print',
                    footer: true,
                    filename: 'Export_File_print',
                    text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                },
                //Botón para cvs
                {
                    extend: 'csvHtml5',
                    footer: true,
                    filename: 'Export_File_csv',
                    text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                },
                {
                    extend: 'colvis',
                    text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                    postfixButtons: ['colvisRestore']
                }
        ]
    } );

    // para cargar la tabla de categorias
    tblCategorias = $('#tblCategorias').DataTable( {
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
        },
        {
            'data' : 'nombre',
        },
        {
            'data' : 'estado'
        },
        {
            'data' : 'acciones'
        }      
        ],
        language: {
            "url": base_url + "Assets/json/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                    //Botón para Excel
                    extend: 'excelHtml5',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',
     
                    //Aquí es donde generas el botón personalizado
                    text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                },
                //Botón para PDF
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para copiar
                {
                    extend: 'copyHtml5',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para print
                {
                    extend: 'print',
                    footer: true,
                    filename: 'Export_File_print',
                    text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                },
                //Botón para cvs
                {
                    extend: 'csvHtml5',
                    footer: true,
                    filename: 'Export_File_csv',
                    text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                },
                {
                    extend: 'colvis',
                    text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                    postfixButtons: ['colvisRestore']
                }
        ]
    } );

    // para cargar la tabla de productos
    tblProductos = $('#tblProductos').DataTable( {
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
        },
        {
            'data' : 'imagen',
        },
        {
            'data' : 'codigo',
        },
        {
            'data' : 'descripcion',
        },
        {
            'data' : 'precio_venta',
        },
        {
            'data' : 'cantidad'
        },
        {
            'data' : 'estado'
        },
        {
            'data' : 'acciones'
        }    
        ],
        language: {
            "url": base_url + "Assets/json/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                    //Botón para Excel
                    extend: 'excelHtml5',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',
     
                    //Aquí es donde generas el botón personalizado
                    text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                },
                //Botón para PDF
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para copiar
                {
                    extend: 'copyHtml5',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para print
                {
                    extend: 'print',
                    footer: true,
                    filename: 'Export_File_print',
                    text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                },
                //Botón para cvs
                {
                    extend: 'csvHtml5',
                    footer: true,
                    filename: 'Export_File_csv',
                    text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                },
                {
                    extend: 'colvis',
                    text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                    postfixButtons: ['colvisRestore']
                }
        ]
    } );

    // para cargar la tabla del historial de compras
    t_historial_c = $('#t_historial_c').DataTable( {
        ajax: {
            url: base_url + "Compras/listar_historial",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
        },
        {
            'data' : 'total',
        },
        {
            'data' : 'fecha'
        },
        {
            'data' : 'acciones'
        }      
        ],
        language: {
            "url": base_url + "Assets/json/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                    //Botón para Excel
                    extend: 'excelHtml5',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',
     
                    //Aquí es donde generas el botón personalizado
                    text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                },
                //Botón para PDF
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para copiar
                {
                    extend: 'copyHtml5',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para print
                {
                    extend: 'print',
                    footer: true,
                    filename: 'Export_File_print',
                    text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                },
                //Botón para cvs
                {
                    extend: 'csvHtml5',
                    footer: true,
                    filename: 'Export_File_csv',
                    text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                },
                {
                    extend: 'colvis',
                    text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                    postfixButtons: ['colvisRestore']
                }
        ]
    } );

    // para cargar la tabla del historial de ventas
    t_historial_c = $('#t_historial_v').DataTable( {
        ajax: {
            url: base_url + "Ventas/listar_historial_ventas",
            dataSrc: ''
        },
        columns: [{
            'data' : 'id'
        },
        {
            'data' : 'nombre'
        }, 
        {
            'data' : 'total',
        },       
        {
            'data' : 'fecha'
        },
        {
            'data' : 'acciones'
        }      
        ],
        language: {
            "url": base_url + "Assets/json/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                    //Botón para Excel
                    extend: 'excelHtml5',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Export_File',
     
                    //Aquí es donde generas el botón personalizado
                    text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
                },
                //Botón para PDF
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para copiar
                {
                    extend: 'copyHtml5',
                    footer: true,
                    title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                    text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                //Botón para print
                {
                    extend: 'print',
                    footer: true,
                    filename: 'Export_File_print',
                    text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
                },
                //Botón para cvs
                {
                    extend: 'csvHtml5',
                    footer: true,
                    filename: 'Export_File_csv',
                    text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
                },
                {
                    extend: 'colvis',
                    text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                    postfixButtons: ['colvisRestore']
                }
        ]
    } );
})


/*---------------------------------------------------------------- FUNCIONES USUARIOS -------------------------------- */

// funcion para mostrar el formulario de nuevo usuario
function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}

// funcion para registrar un usuario
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    // verificar si los campos estan vacios
    if (usuario.value == "" || nombre.value == "" || caja.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    } else {
        // peticion mediante ajax si los campos no estan vacios
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "Usuario registrado con éxito.",
                         showConfirmButton: false,
                         timer: 3000
                       });
                       tblUsuarios.ajax.reload();//recargar la tabla de usuarios
                       frm.reset();
                       $("#nuevo_usuario").modal("hide"); 
                }else if (res == "modificado") {// verificar si se modifico el usuario
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Usuario modificado con éxito.",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tblUsuarios.ajax.reload();//recargar la tabla de usuarios
                    $("#nuevo_usuario").modal("hide"); 
                }else{
                        Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        }
    }
}

// funcion para modificar el usuario registrado
function editarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    // peticion mediante ajax si los campos no estan vacios
    const url = base_url + "Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);            
            document.getElementById("id").value = res.id;// este id esta oculto en el formulario
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
    
}

// funcion para eliminar un usuario
function eliminarUser(id){
    Swal.fire({
        title: "Estas seguro?",
        text: "El Usuario no se eliminará de manera permanente, solo cambiará al estado de inactivo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a el usuario selecionado
            const url = base_url + "Usuarios/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Usuario eliminado con éxito!",
                        icon: "success"
                    });
                    tblUsuarios.ajax.reload();//recargar la tabla de usuarios
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

// funcion para reactivar un usuario
function reactivarUser(id){
    Swal.fire({
        title: "Estas seguro de reactivar el usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a el usuario selecionado
            const url = base_url + "Usuarios/reactivar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Usuario reactivado con éxito!",
                        icon: "success"
                    });
                    tblUsuarios.ajax.reload();//recargar la tabla de usuarios
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

/*---------------------------------------------------------------- FUNCIONES CLIENTES -------------------------------- */

// funcion para mostrar el formulario de nuevo Cliente
function frmCliente() {
    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCliente").reset();
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value = "";
}

// funcion para registrar un cliente
function registrarCliente(e) {
    e.preventDefault();
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    // verificar si los campos estan vacios
    if (dni.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    } else {
        // peticion mediante ajax si los campos no estan vacios
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "Cliente registrado con éxito.",
                         showConfirmButton: false,
                         timer: 3000
                       });
                       tblClientes.ajax.reload();//recargar la tabla de clientes
                       frm.reset();
                       $("#nuevo_cliente").modal("hide"); 
                }else if (res == "modificado") {// verificar si se modifico el cliente
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Cliente modificado con éxito.",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tblClientes.ajax.reload();//recargar la tabla de clentes
                    $("#nuevo_cliente").modal("hide"); 
                }else{
                        Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        }
    }
}

// funcion para modificar el cliente registrado
function editarCli(id) {
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    // peticion mediante ajax si los campos no estan vacios
    const url = base_url + "Clientes/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);            
            document.getElementById("id").value = res.id;// este id esta oculto en el formulario
            document.getElementById("dni").value = res.dni;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            $("#nuevo_cliente").modal("show");
        }
    }
    
}

// funcion para eliminar un cliente
function eliminarCli(id){
    Swal.fire({
        title: "Estas seguro?",
        text: "El Cliente no se eliminará de manera permanente, solo cambiará al estado de inactivo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a el cliente selecionado
            const url = base_url + "Clientes/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Cliente eliminado con éxito!",
                        icon: "success"
                    });
                    tblClientes.ajax.reload();//recargar la tabla de clientes
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

// funcion para reactivar un cliente
function reactivarCli(id){
    Swal.fire({
        title: "Estas seguro de reactivar el cliente?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a el cliente selecionado
            const url = base_url + "Clientes/reactivar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Cliente reactivado con éxito!",
                        icon: "success"
                    });
                    tblClientes.ajax.reload();//recargar la tabla de clientes
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

/*---------------------------------------------------------------- FUNCIONES MEDIDAS -------------------------------- */

// funcion para mostrar el formulario de nueva Medida
function frmMedida() {
    document.getElementById("title").innerHTML = "Nueva Medida";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmMedida").reset();
    $("#nueva_medida").modal("show");
    document.getElementById("id").value = "";
}

// funcion para registrar una medida
function registrarMedida(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const nombre_corto = document.getElementById("nombre_corto");
    // verificar si los campos estan vacios
    if (nombre.value == "" || nombre_corto.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    } else {
        // peticion mediante ajax si los campos no estan vacios
        const url = base_url + "Medidas/registrar";
        const frm = document.getElementById("frmMedida");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "Medida registrada con éxito.",
                         showConfirmButton: false,
                         timer: 3000
                       });
                       tblMedidas.ajax.reload();//recargar la tabla de medidas
                       frm.reset();
                       $("#nueva_medida").modal("hide"); 
                }else if (res == "modificado") {// verificar si se modifico la medida
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Medida modificada con éxito.",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tblMedidas.ajax.reload();//recargar la tabla de medidas
                    $("#nueva_medida").modal("hide"); 
                }else{
                        Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        }
    }
}

// funcion para modificar una medida registrada
function editarMed(id) {
    document.getElementById("title").innerHTML = "Actualizar Medida";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    // peticion mediante ajax si los campos no estan vacios
    const url = base_url + "Medidas/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);            
            document.getElementById("id").value = res.id;// este id esta oculto en el formulario
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("nombre_corto").value = res.nombre_corto;
            $("#nueva_medida").modal("show");
        }
    }
    
}

// funcion para eliminar una medida
function eliminarMed(id){
    Swal.fire({
        title: "Estas seguro?",
        text: "La Medida no se eliminará de manera permanente, solo cambiará al estado de inactivo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a la medida seleccionada
            const url = base_url + "Medidas/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Medida eliminada con éxito!",
                        icon: "success"
                    });
                    tblMedidas.ajax.reload();//recargar la tabla de medidas
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

// funcion para reactivar una medida
function reactivarMed(id){
    Swal.fire({
        title: "Estas seguro de reactivar la medida?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a el cliente selecionado
            const url = base_url + "Medidas/reactivar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Medida reactivada con éxito!",
                        icon: "success"
                    });
                    tblMedidas.ajax.reload();//recargar la tabla de medidas
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

/*---------------------------------------------------------------- FUNCIONES CATEGORIAS -------------------------------- */

// funcion para mostrar el formulario de nueva categoria
function frmCategoria() {
    document.getElementById("title").innerHTML = "Nueva Categoria";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCategoria").reset();
    $("#nueva_categoria").modal("show");
    document.getElementById("id").value = "";
}

// funcion para registrar una categoria
function registrarCategoria(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    // verificar si los campos estan vacios
    if (nombre.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    } else {
        // peticion mediante ajax si los campos no estan vacios
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategoria");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "Categoría registrada con éxito.",
                         showConfirmButton: false,
                         timer: 3000
                       });
                       tblCategorias.ajax.reload();//recargar la tabla de categorias
                       frm.reset();
                       $("#nueva_categoria").modal("hide"); 
                }else if (res == "modificado") {// verificar si se modifico la categoria
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Categoría modificada con éxito.",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tblCategorias.ajax.reload();//recargar la tabla de categorias
                    $("#nueva_categoria").modal("hide"); 
                }else{
                        Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        }
    }
}

// funcion para modificar una categoria registrada
function editarCat(id) {
    document.getElementById("title").innerHTML = "Actualizar Categoria";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    // peticion mediante ajax si los campos no estan vacios
    const url = base_url + "Categorias/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);            
            document.getElementById("id").value = res.id;// este id esta oculto en el formulario
            document.getElementById("nombre").value = res.nombre;
            $("#nueva_categoria").modal("show");
        }
    }
    
}

// funcion para eliminar una cat,egoria
function eliminarCat(id){
    Swal.fire({
        title: "Estas seguro?",
        text: "La Categoría no se eliminará de manera permanente, solo cambiará al estado de inactivo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a la categoria seleccionada
            const url = base_url + "Categorias/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Categoría eliminada con éxito!",
                        icon: "success"
                    });
                    tblCategorias.ajax.reload();//recargar la tabla de categorias
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

// funcion para reactivar una categoria
function reactivarCat(id){
    Swal.fire({
        title: "Estas seguro de reactivar la categoría?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a la categoria selecionada
            const url = base_url + "Categorias/reactivar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Categoría reactivada con éxito!",
                        icon: "success"
                    });
                    tblCategorias.ajax.reload();//recargar la tabla de categorias
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

/*---------------------------------------------------------------- FUNCIONES PRODUCTOS -------------------------------- */

// funcion para mostrar el formulario de nuevo producto
function frmProducto() {
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    //document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmProducto").reset();
    $("#nuevo_producto").modal("show");
    document.getElementById("id").value = "";
    deleteImg();
}

// funcion para registrar un producto
function registrarProducto(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const descripcion = document.getElementById("descripcion");
    const precio_compra = document.getElementById("precio_compra");
    const precio_venta = document.getElementById("precio_venta");
    const id_medida = document.getElementById("medida");
    const id_cat = document.getElementById("categoria");
    // verificar si los campos estan vacios
    if (codigo.value == "" || descripcion.value == "" || precio_compra.value == ""|| precio_venta.value == ""|| id_medida.value == ""|| id_cat.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    } else {
        // peticion mediante ajax si los campos no estan vacios
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                     Swal.fire({
                         position: "center",
                         icon: "success",
                         title: "Producto registrado con éxito.",
                         showConfirmButton: false,
                         timer: 3000
                       });
                       tblProductos.ajax.reload();//recargar la tabla de productos
                       frm.reset();
                       $("#nuevo_producto").modal("hide"); 
                }else if (res == "modificado") {// verificar si se modifico el producto
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Producto modificado con éxito.",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tblProductos.ajax.reload();//recargar la tabla de productos
                    $("#nuevo_producto").modal("hide"); 
                }else{
                        Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        }
    }
}

// funcion para modificar el producto registrado
function editarProd(id) {
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Actualizar";
    // peticion mediante ajax si los campos no estan vacios
    const url = base_url + "Productos/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);            
            document.getElementById("id").value = res.id;// este id esta oculto en el formulario
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("descripcion").value = res.descripcion;
            document.getElementById("precio_compra").value = res.precio_compra;
            document.getElementById("precio_venta").value = res.precio_venta;
            document.getElementById("medida").value = res.id_medida;
            document.getElementById("categoria").value = res.id_categoria;
            document.getElementById("img-preview").src = base_url + 'Assets/img/' + res.foto;
            document.getElementById("icon-cerrar").innerHTML = `<button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times"></i></button>${res.foto}`;//agrego un boton con codigo html  ------- poner este simbolo (acento grave) ` ` para agregar el codigo
            document.getElementById("icon-image").classList.add("d-none");
            // codigo para ver si se va a modofocar la foto del producto
            document.getElementById("foto_actual").value = res.foto;
            $("#nuevo_producto").modal("show");
        }
    }
    
}

// funcion para eliminar un usuario
function eliminarProd(id){
    Swal.fire({
        title: "Estas seguro?",
        text: "El Producto no se eliminará de manera permanente, solo cambiará al estado de inactivo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a el producto selecionado
            const url = base_url + "Productos/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    Swal.fire({
                        title: "Mensaje!",
                        text: "Producto eliminado con éxito!",
                        icon: "success"
                    });
                    tblProductos.ajax.reload();//recargar la tabla de productos
                }else{
                    Swal.fire({
                        title: "Mensaje!",
                        text: res,
                        icon: "error"
                    });
                }
            }
        }



          
        }
      });      
}

// funcion para reactivar un usuario
function reactivarProd(id){
    Swal.fire({
        title: "Estas seguro de reactivar el Producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            // aca se va a modificar el estado de inactivo a el producto selecionado
            const url = base_url + "Productos/reactivar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                // if que verifica si esta listo
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Producto reactivado con éxito!",
                            icon: "success"
                        });
                        tblProductos.ajax.reload();//recargar la tabla de usuarios
                    }else{
                        Swal.fire({
                            title: "Mensaje!",
                            text: res,
                            icon: "error"
                        });
                    }
                }
            }
        }
      });      
}

// funcion para mostrar la imagen seleccionada
function preview(e) {
    const url = e.target.files[0];
    const urlTemp = URL.createObjectURL(url);
    document.getElementById("img-preview").src = urlTemp;// agregar vista previa de la imagen
    document.getElementById("icon-image").classList.add("d-none");// 
    document.getElementById("icon-cerrar").innerHTML = `<button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times"></i></button>${url['name']}`;//agrego un boton con codigo html  ------- poner este simbolo (acento grave) ` ` para agregar el codigo
}

// funcion para eliminar la imagen seleccionada
function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';// quitar vista previa de la imagen
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
}

/*---------------------------------------------------------------- FUNCIONES COMPRAS -------------------------------- */

function buscarCodigo(e){
    const cod = document.getElementById("codigo").value;
    e.preventDefault();
    if (cod != '') {
        if (e.which == 13) {// pregunta si se presiono enter
            const url = base_url + "Compras/buscarCodigo/"+cod;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                // if que verifica si esta listo
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText); 
                    if (res) {
                        document.getElementById("nombre").value = res.descripcion;
                        document.getElementById("id").value = res.id;
                        document.getElementById("precio").value = res.precio_compra; 
                        document.getElementById("cantidad").removeAttribute('disabled');
                        document.getElementById("cantidad").focus();
                    } else {
                        alertas("El Producto no existe!", "warning");
                        document.getElementById("codigo").value = ''; 
                        document.getElementById("codigo").focus();
                    }        
                }
            }
        }
    } else{
        alertas("Ingrese el código", "warning");
    }
}

function calcularPrecio(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    document.getElementById("sub_total").value = cant * precio;
    if (e.which == 13) {//si se presiono la tecla enter
        if (cant > 0) {
            const url = base_url + "Compras/ingresar";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                // if que verifica si esta listo
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText); 
                    if (res == 'ok') {
                        frm.reset();
                        cargarDetalles(); // aca carga los detalles de la compra
                    } else if (res == 'modificado'){
                        frm.reset();
                        cargarDetalles(); // aca carga los detalles de la compra
                    }
                    document.getElementById('cantidad').setAttribute('disabled', 'disabled');
                    document.getElementById('codigo').focus();
                }
            }
        }
    }
}

if (document.getElementById("tblDetalles")) {//si existe va a cargar los detalles
    cargarDetalles(); // aca carga los detalles de la compra a cada rato
}

function cargarDetalles() {
    const url = base_url + "Compras/listarDetalles";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText); 
            let html = '';
            res['detalle'].forEach(row => {
                // abajo hago una concatenacion a la variable html
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']})"><i class="fa fa-trash-alt"></i></button>
                </td>
                </tr>`;
            });
            document.getElementById("tblDetalles").innerHTML = html;
            document.getElementById("total").value = res['total_pagar'].total;
        }
    }
}

function deleteDetalle(id){
    const url = base_url + "Compras/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText); 
            if (res == 'ok') {
                alertas("Producto eliminado","success");
                // Swal.fire({
                //     position: "center",
                //     icon: "success",
                //     title: "",
                //     showConfirmButton: false,
                //     timer: 3000
                // });
                cargarDetalles();
            }else{
                alertas("Error","error");
                // Swal.fire({
                //     position: "center",
                //     icon: "error",
                //     title: "Error",
                //     showConfirmButton: false,
                //     timer: 3000
                // });
            }
            
        }
    }
}

function generarCompra() {
    Swal.fire({
        title: "Estas seguro de generar la Compra?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/registrarCompra/";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                // if que verifica si esta listo
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.msg == "ok") {
                        alertas("Compra registrada con éxito!","success");
                        // Swal.fire({
                        //     title: "Mensaje!",
                        //     text: "",
                        //     icon: "success"
                        // });
                        /// Aqui se muestra el PDF de la compra cada vez que generamos una compra
                        const ruta = base_url + 'Compras/generarPdfCompra/' + res.id_compra;
                        window.open(ruta);
                        // recargar la pagina despues de 2 segundos
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    }else{
                        alertas(res,"error");
                        // Swal.fire({
                        //     title: "Mensaje!",
                        //     text: res,
                        //     icon: "error"
                        // });
                    }
                }
            }
        }
      });  
}

/*---------------------------------------------------------------- FUNCIONES EMPRESAS -------------------------------- */

function modificarEmpresa(){
    const frm = document.getElementById('frmEmpresa');
    const url = base_url + "Administracion/modificarDatosEmpresa";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == 'ok') {
                alertas("Datos modificados con éxito!","success");
                // Swal.fire({
                //     title: "Mensaje!",
                //     text: "Datos modificados con éxito!",
                //     icon: "success"
                // });
            }else{
                alertas(res,"error");
                // Swal.fire({
                //     title: "Mensaje!",
                //     text: res,
                //     icon: "error"
                // });
            }
        }
    }
}

/*---------------------------------------------------------------- FUNCIONES ALERTAS DE MENSAJES -------------------------------- */

function alertas(mensaje, icono) {
    Swal.fire({
        position: "center",
        icon: icono,
        text: mensaje,
        showConfirmButton: false,
        timer: 3000
      });
}

/*---------------------------------------------------------------- FUNCIONES VENTAS -------------------------------- */
function buscarCodigoVenta(e){
    const cod = document.getElementById("codigo").value;
    e.preventDefault();
    if (cod != '') {
        if (e.which == 13) {// pregunta si se presiono enter
            const url = base_url + "Ventas/buscarCodigo/"+cod;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                // if que verifica si esta listo
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText); 
                    if (res) {
                        document.getElementById("nombre").value = res.descripcion;
                        document.getElementById("id").value = res.id;
                        document.getElementById("precio").value = res.precio_venta; 
                        document.getElementById("cantidad").removeAttribute('disabled');
                        document.getElementById("cantidad").focus();
                    } else {
                        alertas("El Producto no existe!", "warning");
                        document.getElementById("codigo").value = ''; 
                        document.getElementById("codigo").focus();
                    }        
                }
            }
        }
    } else{
        alertas("Ingrese el código", "warning");
    }
}

function calcularPrecioVenta(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    document.getElementById("sub_total").value = cant * precio;
    if (e.which == 13) {//si se presiono la tecla enter
        if (cant > 0) {
            const url = base_url + "Ventas/ingresar";
            const frm = document.getElementById("frmVenta");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                // if que verifica si esta listo
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText); 
                    if (res == 'ok') {
                        frm.reset();
                        cargarDetallesVentas(); // aca carga los detalles de la compra
                    } else if (res == 'modificado'){
                        frm.reset();
                        cargarDetallesVentas(); // aca carga los detalles de la compra
                    }
                    document.getElementById('cantidad').setAttribute('disabled', 'disabled');
                    document.getElementById('codigo').focus();
                }
            }
        }
    }
}

if (document.getElementById("tblDetallesVentas")) {//si existe va a cargar los detalles
    cargarDetallesVentas(); // aca carga los detalles de la compra a cada rato
}

function cargarDetallesVentas() {
    const url = base_url + "Ventas/listarDetalles";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText); 
            let html = '';
            res['detalle'].forEach(row => {
                // abajo hago una concatenacion a la variable html
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button class="btn btn-danger" type="button" onclick="deleteDetalleVentas(${row['id']})"><i class="fa fa-trash-alt"></i></button>
                </td>
                </tr>`;
            });
            document.getElementById("tblDetallesVentas").innerHTML = html;
            document.getElementById("total").value = res['total_pagar'].total;
        }
    }
}

function deleteDetalleVentas(id){
    const url = base_url + "Ventas/delete/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        // if que verifica si esta listo
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText); 
            if (res == 'ok') {
                alertas("Producto eliminado","success");
                // Swal.fire({
                //     position: "center",
                //     icon: "success",
                //     title: "",
                //     showConfirmButton: false,
                //     timer: 3000
                // });
                cargarDetallesVentas();
            }else{
                alertas("Error","error");
                // Swal.fire({
                //     position: "center",
                //     icon: "error",
                //     title: "Error",
                //     showConfirmButton: false,
                //     timer: 3000
                // });
            }
            
        }
    }
}

function generarVenta() {
    Swal.fire({
        title: "Estas seguro de generar la Venta?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
            const id_cliente = document.getElementById('cliente').value;
            const url = base_url + "Ventas/registrarVenta/" + id_cliente;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                // if que verifica si esta listo
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.msg == "ok") {
                        alertas("Venta registrada con éxito!","success");
                        /// Aqui se muestra el PDF de la compra cada vez que generamos una compra
                        const ruta = base_url + 'Ventas/generarPdfVenta/' + res.id_venta;
                        window.open(ruta);
                        // recargar la pagina despues de 2 segundos
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    }else{
                        alertas(res,"error");
                    }
                }
            }
        }
      });  
}