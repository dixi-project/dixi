<?php
class controllerAgregartrabajador extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }
        $dominio = "trabajador";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "trabajador";
        $this->view->show("addtrabajador.twig", $this->data, $this->accion); 
    }
}
?>