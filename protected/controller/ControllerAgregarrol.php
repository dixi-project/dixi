<?php
class ControllerAgregarmaestro extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }var_dump($this->var);
        $dominio = "rol";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "Rol";
        $this->view->show("addRol.twig", $this->data, $this->accion); 
    }
}
?>