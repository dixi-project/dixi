<?php
class controllerEditarProveedor extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        //var_dump($this->var );
        foreach ($this->var as $key => $value) {
            $this->data[$key]=$value;
            $$key = $value;
        }
        $dominio = "proveedor";
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL("SELECT * FROM proveedor WHERE id = {$idReg}")[0];
     //  var_dump  ($this->data["datos"]);
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "Proveedor";
        $this->view->show("editProveedor.twig", $this->data, $this->accion); 
    }
}
?>