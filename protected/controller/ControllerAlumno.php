<?php
class ControllerAlumno extends Controller
{
    function __construct($view, $conf, $var, $acc)
    {
        parent::__construct($view, $conf, $var, $acc);
    }
    public function main()
    {
        //var_dump($this->var);
        foreach ($this->var as $key => $value){
            $this->data[$key] = $value;
            $$key = $value;
        }
        foreach ($_COOKIE as $key => $value) {
            $$key = $value;
        }
        $dominio = "alumno"; 
        // --> Agregar registro 
        if(isset($cmdGuardar) && $Action=="Agregar"){
            
            //$sql="INSERT INTO rol (id,rol) VALUE (0, '{$txtRol}')";
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"alumno",
                "txtalumno"=>$txtAlumno,
                "txttelefono"=>$txtTelefono,
                "txtgrupo_id"=>$txtGrupo
            );
           
           indexModel::bd($this->conf)->updateDominio($arr);
        }

        // --> Para borrar registro
        if($Action=="delete"){
            //$sql="DELETE FROM {$Dominio} WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            indexModel::bd($this->conf)->deleteDominio("alumno",$idReg);
        }

        // --> Editar registro 
        if(isset($cmdEditar)){
            //$sql="UPDATE rol SET rol = '$txtRol' WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            $arr= array(
                "Dominio"=>"alumno",
                "txtalumno"=>$txtAlumno,
                "txttelefono"=>$txtTelefono,
                "txtgrupo_id"=>$txtGrupo
            );
            indexModel::bd($this->conf)->updateDominio($arr,$idReg);
        }

        $this->data["dominio"] = $dominio ;
        // --> Extraer datos de materias 
        $this->data["materias"] = indexModel::bd($this->conf)->getDominio("materia");
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getSQL("SELECT a.*,g.grupo FROM alumno AS a INNER JOIN grupo AS g ON a.grupo_id=g.id");

        asort($this->data["datos"]);
        $this->view->show("alumno.twig", $this->data, $this->accion);
    }

}
