let tblUsuarios;
//verificar si se cargo, codigo extraido de https://datatables.net/manual/ajax
document.addEventListener("DOMContentLoaded", function(){
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
})

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
                         title: "Usurio registrado con éxito.",
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
                        title: "Usurio modificado con éxito.",
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