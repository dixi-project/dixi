<?php
class ControllerDocente extends Controller
{
    function __construct($view, $conf, $var, $acc)
    {
        parent::__construct($view, $conf, $var, $acc);
    }
    public function main()
    {
        var_dump ($this->var);
        foreach ($this->var as $key => $value){
            
            $$key = $value;
        }

        /* Inicio de visualización de la tabla docentes*/

        $dominio = "docentes"; //maestro
        // --> Agregar registro 
        if(isset($cmdGuardar)){
            //$sql="INSERT INTO rol (id,rol) VALUE (0, '{$txtRol}')";
            //indexModel::bd($this->conf)->getSQL($sql);
            $coman= array(
                "Dominio"=>"docentes",
                "txtdocentes"=>$txtDocentes,
                "txtcorreoelectronico"=>$txtCorreoelectronico,
                "txttelefono"=>$txtTelefono
            );
            indexModel::bd($this->conf)->updateDominio($coman);//arr
        }

        // --> Para borrar registro
        if($Action=="delete"){
            //$sql="DELETE FROM {$Dominio} WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            indexModel::bd($this->conf)->deleteDominio("docentes",$idReg);
        }

        // --> Editar registro 
        if(isset($cmdEditar)){
            //$sql="UPDATE rol SET rol = '$txtRol' WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            $coman= array(
                    "Dominio"=>"docentes",
                    "txtdocentes"=>$txtDocentes,
                    "txtcorreoelectronico"=>$txtCorreoelectronico,
                    "txttelefono"=>$txtTelefono
            );
            indexModel::bd($this->conf)->updateDominio($coman,$idReg);
        }

        $this->data["dominio"] = $dominio ;
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getDominio($dominio);
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM docentes");

        $this->data["alumno"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM alumno");

        asort($this->data["datos"]);
        $this->view->show("docente.twig", $this->data, $this->accion);
    }

}
