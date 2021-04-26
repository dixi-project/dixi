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
}elseif(isset($cal) && $cal > 0 && isset($idm)){
    $query="INSERT INTO calificaciones VALUES (0,{$idA},{$idm},{$cal})";
    $sql = $db->prepare($query);
    $sql->execute();
}

$sqlValidate2  ="SELECT m.materia,c.calificacion, c.id FROM calificaciones as c LEFT JOIN materia as m ON m.id = c.id_materia WHERE c.id_alumno = ".$idA;
$recordset2 = $db->prepare($sqlValidate2);
$recordset2->execute();
$datos="";
while($row = $recordset2->fetch(PDO::FETCH_OBJ)){
    $datos .= '
            <tr>
                <td>'.$row->materia.'</td>
                <td>'.$row->calificacion.'</td>
                <td>
                <button class="btn btn-labeled btn-danger cmdborrarcal" type="button" idregB="'.$row->id.'">
                <span class="btn-label">
                    <i class="glyph-icon icon-times"></i>
                </span>
                Eliminar
            </button>
                </td>
            </tr>
            ';
}
echo '<table class="table">
<tr>
    <th>Materia</th>
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
        var data = "idRB="+idregB+"&acc=delete&idA=<?php echo $idA ?>";
        var html = $.ajax({
            url: path + "includes/ajax/addCalificacion.php",
            type: "POST",
            data: data,
            async: false
        }).responseText;
        $("#capaResultado").html(html);
    });
</script>


