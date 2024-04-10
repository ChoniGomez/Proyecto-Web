<?php
class AdministracionModel extends Query{

    private $cuit, $razonSocial, $direccion, $telefono, $correo, $localidad, $provincia, $cp, $mensaje, $id;

    public function __construct(){
        parent::__construct();
    }

  
    public function getEmpresa(){
        $sql = "SELECT * FROM configuraciones";
        $data = $this->select($sql);
        return $data;
    }


    public function modificarEmpresa(string $cuit, string $razonSocial, string $direccion, string $telefono, string $correo, string $localidad, string $provincia, string $cp, string $mensaje, int $id){
        $this->id = $id;
        $this->cuit = $cuit;
        $this->razonSocial = $razonSocial;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->cp = $cp;
        $this->mensaje = $mensaje;
        $sql = "UPDATE configuraciones SET cuit = ?, razon_social = ?, direccion = ?, telefono = ?, correo = ?, localidad = ?, provincia = ?, cp = ?, mensaje = ? WHERE id = ?";
        $datos = array($cuit, $razonSocial, $direccion, $telefono, $correo, $localidad, $provincia, $cp, $mensaje, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        }        
        return $res;
    }
}
?>