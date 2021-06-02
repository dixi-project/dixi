<?php
class ControllerEditarrol extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        //var_dump($this->var );
        foreach ($this->var as $key => $value) {
            $this->data[$key]=$value;
            $$key = $value;
        }
        $dominio = "rol";
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL("SELECT * FROM rol WHERE id = {$idReg}")[0];
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "Rol";
        $this->view->show("editRol.twig", $this->data, $this->accion); 
    }
}
?>