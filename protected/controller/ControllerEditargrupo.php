<?php
class ControllerEditargrupo extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        foreach ($this->var as $key => $value) {
            $this->data[$key]=$value;
            $$key = $value;
        }
        $dominio = "grupo";
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL("SELECT * FROM grupo WHERE id = {$idReg}")[0];
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "Grupo";
        $this->view->show("editGrupo.twig", $this->data, $this->accion); 
    }
}
?>