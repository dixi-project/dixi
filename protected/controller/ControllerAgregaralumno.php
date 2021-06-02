<?php
class ControllerAgregaralumno extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }


        $this->data["grupo"] = indexModel::bd($this->conf)->getSQL("SELECT * FROM grupo");
        $dominio = "alumno";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "Alumno";
        $this->view->show("addAlumno.twig", $this->data, $this->accion); 
    }
}

?>