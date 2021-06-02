<?php
include 'configAjax.php';
foreach ($_REQUEST as $key => $value) {
    echo $key . "--".$value."<br>";
    $$key =  Security($value);
}

if(isset($acc) && $acc=="delete"){
    $query="DELETE FROM  desempeno WHERE id = ".$idRB;
    $sql = $db->prepare($query);
    $sql->execute();
}elseif(isset($des) && $des >= 0 && $des <=100 && isset($idm)){
    $query="INSERT INTO desempeno VALUES (0,{$idA},{$idm},{$des})";
    $sql = $db->prepare($query);
    $sql->execute();}


$sqlValidate2  ="SELECT m.materia,c.desempeno, c.id FROM desempeno as c LEFT JOIN materia as m ON m.id = c.materia_id WHERE c.maestros_id = ".$idA;
echo $sqlValidate2;
$recordset2 = $db->prepare($sqlValidate2);
$recordset2->execute();
$datos="";
while($row = $recordset2->fetch(PDO::FETCH_OBJ)){
    $datos .= '
            <tr>
                <td>'.$row->materia.'</td>
                <td>'.$row->desempeno.' %</td>
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
    <th>Desempeño</th>
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
            url: path + "includes/ajax/addDesempeno.php",
            type: "POST",
            data: data,
            async: false
        }).responseText;
        $("#capaResultado").html(html);
    });
</script>
