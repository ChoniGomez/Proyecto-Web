let tblUsuarios, tblClientes, tblMedidas;
//verificar si se cargo, codigo extraido de https://datatables.net/manual/ajax
document.addEventListener("DOMContentLoaded", function(){
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
        ]
    } );
})


/*---------------------------------------------------------------- FUNCIONES USUARIOS -------------------------------- */

// funcion para loguear el usuario
function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    // verificar si los campos estan vacios
    if (usuario.value == "") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    }else if (clave.value == "") {
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    } else {
        // peticion mediante ajax si los campos no estan vacios
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            // if que verifica si esta listo
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    // enviar a la ventana principal del usuario
                    window.location = base_url + "Usuarios";                    
                }else{
                    //mostrar la alerta en el login
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
            }
        }
    }
}

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