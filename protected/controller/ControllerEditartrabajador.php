<?php
class ControllerEditartrabajador extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        //var_dump($this->var );
        foreach ($this->var as $key => $value) {
            $this->data[$key]=$value;
            $$key = $value;
        }
        $dominio = "profesor";
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL("SELECT * FROM trabajador WHERE id = {$idReg}")[0];
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "trabajador";
        $this->view->show("edittrabajador.twig", $this->data, $this->accion); 
    }
}
?>