<?php
class controllerAgregardocente extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        var_dump($this->var);
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }
        $dominio = "docentes";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "Docente";
        $this->view->show("addDocente.twig", $this->data, $this->accion); 
    }
}
?>