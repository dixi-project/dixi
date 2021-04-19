<?php
class controllerAgregarprofesor extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }
        $dominio = "profesor";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "Profesor";
        $this->view->show("addProfesor.twig", $this->data, $this->accion); 
    }
}
?>