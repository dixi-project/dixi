<?php
include 'configAjax.php';
foreach ($_REQUEST as $key => $value) {
    //echo $key . "--".$value."<br>";
    $$key =  Security($value);
}
if(isset($acc) && $acc=="delete"){
    $query="DELETE FROM  salario WHERE id = ".$idRB;
    $sql = $db->prepare($query);
    $sql->execute();
}elseif(isset($Sal) && $Sal > 0 && isset($ida)){
    $query="INSERT INTO salario VALUES (0,{$idT},{$ida},{$Sal})";
    $sql = $db->prepare($query);
    $sql->execute();
}

$sqlValidate2  ="SELECT a.area,s.salario, s.id FROM salario as s LEFT JOIN area as a ON a.id = s.area_id WHERE s.trabajador_id = ".$idT;
$recordset2 = $db->prepare($sqlValidate2);
$recordset2->execute();
$datos="";
while($row = $recordset2->fetch(PDO::FETCH_OBJ)){
    $datos .= '
            <tr>
                <td>'.$row->area.'</td>
                <td>'.$row->salario.'</td>
                <td>
                <button class="btn btn-labeled btn-danger cmdborrarsal" type="button" idregB="'.$row->id.'">
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
    <th>Area</th>
    <th>Salario</th>
    <th>Action</th>
</tr>
'.$datos.'
</table>';
?>
<script>
	$('.cmdborrarsal').click(function () {
        var idregB = $(this).attr("idregB");
        var path = $("#path").val();
        var data = "idRB="+idregB+"&acc=delete&idT=<?php echo $idT ?>";
        var html = $.ajax({
            url: path + "includes/ajax/addSalario.php",
            type: "POST",
            data: data,
            async: false
        }).responseText;
        $("#capaResultado").html(html);
    });
    </script>