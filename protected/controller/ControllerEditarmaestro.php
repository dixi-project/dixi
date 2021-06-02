<?php
class ControllerEditarmaestro extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        var_dump($this->var );
        foreach ($this->var as $key => $value) {
            $this->data[$key]=$value;
            $$key = $value;
        }
        $dominio = "maestro";
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL("SELECT * FROM maestros WHERE id = {$idReg}")[0];
        var_dump($this->data["datos"]);
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "Maestro";
        $this->data["grupos"] = indexModel::bd($this->conf)->getDominio("grupo");
        $this->view->show("editMaestro.twig", $this->data, $this->accion); 
    }
}
?>