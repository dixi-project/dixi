<?php
class controllerAgregarProveedor extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        foreach ($this->var as $key => $value) {
            $$key = $value;
        }
        $dominio = "proveedor";
        $this->data["accion"] = "Agregar";
        $this->data["dominio"] = "Proveedor";
        $this->view->show("addProveedor.twig", $this->data, $this->accion); 
       
    }
}
?>