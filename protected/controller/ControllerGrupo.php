<?php
class ControllerGrupo extends Controller
{
    function __construct($view, $conf, $var, $acc)
    {
        parent::__construct($view, $conf, $var, $acc);
    }
    public function main()

    
    //La parte foreach se utilia cuando declaramos en la consulta {$txtGrupo}
    //Tambien es un tema de seguridad foreach
    {
    

        foreach ($this->var as $key => $value){
            
            $$key = $value;
        }
        $dominio = "grupo"; 
        // --> Agregar registro 

        // Primera forma de guardar un registro
        if(isset($cmdGuardar)){
            //$sql="INSERT INTO grupo (id,grupo) VALUE (0, '{$txtGrupo}')";
            //indexModel::bd($this->conf)->getSQL($sql);
            //Segunda forma para guardar un registro
            $gru= array(
                "Dominio"=>"grupo", //Nombre de la tabla que se va actualizar
                "txtgrupo"=>$txtGrupo //Campo que se va actualizar
            );
            indexModel::bd($this->conf)->updateDominio($gru);

        }

        // --> Para borrar registro
        if($Action=="delete"){
            //$sql="DELETE FROM {$Dominio} WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);
            indexModel::bd($this->conf)->deleteDominio("grupo",$idReg);
        }

        // --> Editar registro 
        if(isset($cmdEditar)){
            //$sql="UPDATE rol SET rol = '$txtRol' WHERE id = ".$idReg;
            //indexModel::bd($this->conf)->getSQL($sql);

            $gru= array(
                "Dominio"=>"grupo", //Nombre de la tabla que se va actualizar
                "txtgrupo"=>$txtGrupo //Campo que se va actualizar
            );
            indexModel::bd($this->conf)->updateDominio($gru,$idReg);

        }

        $this->data["dominio"] = $dominio ;
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getDominio($dominio);
        // --> Extraer datos
        $this->data["datos"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM grupo");

        asort($this->data["datos"]);
        $this->view->show("grupo.twig", $this->data, $this->accion);
    }

}
