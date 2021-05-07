<?php
class ControllerTrabajador extends Controller
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
        $dominio = "trabajador"; 
        // --> Agregar registro 
        if(isset($cmdGuardar)){
            //$sql="INSERT INTO rol (id,rol) VALUE (0, '{$txtRol}')";
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"trabajador",
                "txttrabajador"=>$txttrabajador,
                "txttelefono"=>$txttelefono
            );
            indexModel::bd($this->conf)->updateDominio($arr);
        }

        // --> Para borrar registro
        if($Action=="delete"){
            //$sql="DELETE FROM {$Dominio} WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            indexModel::bd($this->conf)->deleteDominio("trabajador",$idReg);
        }

        // --> Editar registro 
        if(isset($cmdEditar)){
            //$sql="UPDATE rol SET rol = '$txtRol' WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"trabajador",
                "txttrabajador"=>$txttrabajador,
                "txttelefono"=>$txttelefono
            );
            indexModel::bd($this->conf)->updateDominio($arr,$idReg);
        }

        $this->data["dominio"] = $dominio;
        // --> Extraer datos de salarios
        $this->data["areas"] = indexModel::bd($this->conf)->getDominio("area");
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM trabajador");

        asort($this->data["datos"]);
        $this->view->show("trabajador.twig", $this->data, $this->accion);
    }

}
