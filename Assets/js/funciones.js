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
    $("#nuevo_usuario").modal("show");
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
    if (usuario.value == "" || nombre.value == "" || clave.value == "" || confirmar.value == "" || caja.value == "") {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Todos los campos son obligatorios",
            showConfirmButton: false,
            timer: 3000
          });
    }else if (clave.value != confirmar.value) {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Las contraseñas no coinciden",
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
                       frm.reset();
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