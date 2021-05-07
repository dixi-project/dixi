<?php
class controllerEditardocente extends Controller {
    function __construct($view, $conf, $var, $acc) {
        parent::__construct($view, $conf, $var, $acc);
    } 
    public function main() {
        //var_dump($this->var );
        foreach ($this->var as $key => $value) {
            $this->data[$key]=$value;
            $$key = $value;
        }
        $dominio = "docentes";
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL("SELECT * FROM docentes WHERE id = {$idReg}")[0];
        var_dump($this->data["datos"]);
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "Docente";
        $this->view->show("editDocente.twig", $this->data, $this->accion); 
    }
}
?>