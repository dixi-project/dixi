<?php
class controllerEditarprofesor extends Controller {
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
        $this->data["datos"] = (object) indexModel::bd($this->conf)->getSQL("SELECT * FROM profesor WHERE id = {$idReg}")[0];
        $this->data["accion"] = "Editar";
        $this->data["dominio"] = "Profesor";
        $this->view->show("editProfesor.twig", $this->data, $this->accion); 
    }
}
?>