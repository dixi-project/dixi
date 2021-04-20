<?php
class controllerEditaralumno extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        //var_dump($this->var );
        foreach ($this->var as $key => $value) {
            $this->data[$key]=$value;
            $$key = $value;
        }
        $this->data["grupo"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM grupo");
        $dominio = "alumno";
        $sql="SELECT a.*,g.grupo FROM alumno AS a INNER JOIN grupo AS g ON a.grupo_id=g.id WHERE a.id = {$idReg}";
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL($sql)[0];
        
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "Alumno";
        $this->view->show("editAlumno.twig", $this->data, $this->accion); 
    }
}
?>