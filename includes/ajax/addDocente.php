<?php
include 'configAjax.php';
foreach ($_REQUEST as $key => $value) {
    //echo $key . "--".$value."<br>";
    $$key =  Security($value);
}

if(isset($acc) && $acc=="delete"){
    $query="DELETE FROM  calificaciones WHERE id = ".$idRB;
    $sql = $db->prepare($query);
    $sql->execute();
}elseif (isset($cal) && $cal > 0 && isset($idal)) {
    $query="INSERT INTO calificaciones VALUES (0,{$idal},{$cal},{$idPro})";
    $sql = $db->prepare($query);
    $sql->execute();
}


$sqlValidate2  ="SELECT a.alumno, c.calificacion, c.id FROM calificaciones as c LEFT JOIN alumno as a ON a.id = c.id_alumno WHERE c.id_profesor = ".$idPro;
$recordset2 = $db->prepare($sqlValidate2);
$recordset2->execute();
$datos="";
while($row = $recordset2->fetch(PDO::FETCH_OBJ)){
    $datos .= '
    <tr>
        <td>'.$row->alumno.'</td>
        <td>'.$row->calificacion.'</td>
        <td>
            <button class="btn btn-labeled btn-danger cmdborrarcal" type="button" idregB="'.$row->id.'">
                <span class="btn-label">
                    <i class="glyph-icon icon-times"></i>
                </span>
                    Eliminar
            </button>
        </td>
    </tr>';
}
echo'<table class="table">
<tr>
    <th>Alumno</th>
    <th>Calificación</th>
    <th>Action</th>
</tr>
'.$datos.'
</table>';
?>

<script>

$('.cmdborrarcal').click(function () {
        var idregB = $(this).attr("idregB");
        var path = $("#path").val();
        var data = "idRB="+idregB+"&acc=delete&idPro=<?php echo $idPro ?>";
        var html = $.ajax({
            url: path+"includes/ajax/addDocente.php",
            type: "POST",
            data: data,
            async: false
        }).responseText;
        $("#idResultado").html(html);
    });
</script>

