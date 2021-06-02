<?php
class ControllerAgregarmaestro extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        var_dump($this->var);
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }
        $dominio = "maestro";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "Maestro";
        $this->data["grupos"] = indexModel::bd($this->conf)->getDominio("grupo");
        $this->view->show("addMaestro.twig", $this->data, $this->accion); 
    }
}
?>