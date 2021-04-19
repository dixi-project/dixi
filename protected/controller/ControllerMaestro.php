<?php
class ControllerMaestro extends Controller
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
        $dominio = "maestro"; 
        // --> Agregar registro 
        if(isset($cmdGuardar)){
            //$sql="INSERT INTO rol (id,rol) VALUE (0, '{$txtRol}')";
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"maestro",
                "txtmaestro"=>$txtMaestro,
                "txttelefono"=>$txtTelefono,
                "txtgrupo_id"=>$cars
            );
            indexModel::bd($this->conf)->updateDominio($arr);
        }

        // --> Para borrar registro
        if($Action=="delete"){
            //$sql="DELETE FROM {$Dominio} WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            indexModel::bd($this->conf)->deleteDominio("maestro",$idReg);
        }

        // --> Editar registro 
        if(isset($cmdEditar)){
            //$sql="UPDATE rol SET rol = '$txtRol' WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"maestro",
                "txtmaestro"=>$txtMaestro,
                "txttelefono"=>$txtTelefono,
                "txtgrupo_id"=>$cars
            );
            indexModel::bd($this->conf)->updateDominio($arr,$idReg);
        }

        $this->data["dominio"] = $dominio ;
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getDominio($dominio);
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM maestro");

        asort($this->data["datos"]);
        $this->view->show("maestro.twig", $this->data, $this->accion);
    }

}
