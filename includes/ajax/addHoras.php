<?php
include 'configAjax.php';
foreach ($_REQUEST as $key => $value) {
    //echo $key . "--".$value."<br>";
    $$key =  Security($value);
}
if(isset($acc) && $acc=="delete"){
    $query="DELETE FROM  hora WHERE id = ".$idRB;
    $sql = $db->prepare($query);
    $sql->execute();
}elseif(isset($hora) && $hora > 0 && isset($ids)){
    $query="INSERT INTO hora VALUES (0,{$idP},{$ids},{$hora})";
    $sql = $db->prepare($query);
    $sql->execute();
}

$sqlValidate2  ="SELECT s.salon,h.hora, h.id FROM hora as h LEFT JOIN salon as s ON s.id = h.salon_id WHERE h.profesor_id = ".$idP;
$recordset2 = $db->prepare($sqlValidate2);
$recordset2->execute();
$datos="";
while($row = $recordset2->fetch(PDO::FETCH_OBJ)){
    $datos .= '
            <tr>
                <td>'.$row->salon.'</td>
                <td>'.$row->hora.'</td>
                <td>
                <button class="btn btn-labeled btn-danger cmdborrarhora" type="button" idregB="'.$row->id.'">
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
    <th>Salón</th>
    <th>Horas</th>
    <th>Action</th>
</tr>
'.$datos.'
</table>';
?>
<script>
	$('.cmdborrarhora').click(function () {
        var idregB = $(this).attr("idregB");
        var path = $("#path").val();
        var data = "idRB="+idregB+"&acc=delete&idP=<?php echo $idP ?>";
        var html = $.ajax({
            url: path + "includes/ajax/addHoras.php",
            type: "POST",
            data: data,
            async: false
        }).responseText;
        $("#capaResultado").html(html);
    });
    </script>
