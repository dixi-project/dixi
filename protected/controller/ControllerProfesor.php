<?php
class ControllerProfesor extends Controller
{
    function __construct($view, $conf, $var, $acc)
    {
        parent::__construct($view, $conf, $var, $acc);
    }
    public function main()
    {
        foreach ($this->var as $key => $value){
            
            $$key = $value;
        }
        $dominio = "profesor"; 
        // --> Agregar registro 
        if(isset($cmdGuardar)){
            //$sql="INSERT INTO rol (id,rol) VALUE (0, '{$txtRol}')";
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"profesor",
                "txtprofesor"=>$txtProfesor
            );
            indexModel::bd($this->conf)->updateDominio($arr);
        }

        // --> Para borrar registro
        if($Action=="delete"){
            //$sql="DELETE FROM {$Dominio} WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            indexModel::bd($this->conf)->deleteDominio("profesor",$idReg);
        }

        // --> Editar registro 
        if(isset($cmdEditar)){
            //$sql="UPDATE rol SET rol = '$txtRol' WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"profesor",
                "txtprofesor"=>$txtProfesor
            );
            indexModel::bd($this->conf)->updateDominio($arr,$idReg);
        }

        $this->data["dominio"] = $dominio ;
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getDominio($dominio);
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM profesor");

        asort($this->data["datos"]);
        $this->view->show("profesor.twig", $this->data, $this->accion);
    }

}
