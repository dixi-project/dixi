<?php
class controllerAgregargrupo extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }
        $dominio = "grupo";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "Grupo";
        $this->view->show("addgrupo.twig", $this->data, $this->accion); 
    }
}
?>