<?php
include 'configAjax.php';
foreach ($_REQUEST as $key => $value) {
    //echo $key . "--".$value."<br>";
    $$key =  Security($value);
}
if(isset($acc) && $acc=="delete"){
    $query="DELETE FROM  turno WHERE id = ".$idRB;
    $sql = $db->prepare($query);
    $sql->execute();
}elseif(isset($tur)  && isset($idg)){
    $query="INSERT INTO turno VALUES (0,{$idP},{$idg},$tur)";
    $sql = $db->prepare($query);
    $sql->execute();
}

$sqlValidate2  ="SELECT g.grupo,t2.turno, t.id FROM turno as t LEFT JOIN grupo as g ON g.id = t.id_grupo LEFT JOIN turno2 as t2 ON t2.id = t.id_turno WHERE t.id_profesor = ".$idP;
$recordset2 = $db->prepare($sqlValidate2);
$recordset2->execute();
$datos="";
while($row = $recordset2->fetch(PDO::FETCH_OBJ)){
    $datos .= '
            <tr>
                <td>'.$row->grupo.'</td>
                <td>'.$row->turno.'</td>
                <td>
                <button class="btn btn-labeled btn-danger cmdborrartur" type="button" idregB="'.$row->id.'">
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
    <th>Grupo</th>
    <th>Turno</th>
    <th>Action</th>
</tr>
'.$datos.'
</table>';
?>
<script>
	$('.cmdborrartur').click(function () {
        var idregB = $(this).attr("idregB");
        var path = $("#path").val();
        var data = "idRB="+idregB+"&acc=delete&idP=<?php echo $idP ?>";
        var html = $.ajax({
            url: path + "includes/ajax/addTurno.php",
            type: "POST",
            data: data,
            async: false
        }).responseText;
        $("#capaResultado").html(html);
    });
</script>
