<?php
include 'configAjax.php';
foreach ($_REQUEST as $key => $value) {
   // echo $key . "--".$value."<br>";
    $$key =  Security($value);
}

if(isset($acc) && $acc=="delete"){
    $query="DELETE FROM clase WHERE id=".$idRB;
    $sql = $db->prepare($query);
    $sql->execute();


}elseif(isset($dia) && $dia!=null && isset($grupo) && isset($idm)){
 $query="INSERT INTO clase VALUES (0,'{$dia}',{$grupo},{$idm},{$idp})";
 $sql = $db->prepare($query);
 $sql->execute();
} 

$sqlValidate2  ="SELECT m.materia,g.grupo,c.dia, c.id FROM clase AS c LEFT JOIN materia AS m ON m.id=c.materia_id
 LEFT JOIN grupo AS g ON g.id=c.grupo_id  WHERE c.profesor_id=".$idp;
$recordset2 = $db->prepare($sqlValidate2);
$recordset2->execute();
$datos="";

while($row = $recordset2->fetch(PDO::FETCH_OBJ)){
    $datos .= '
            <tr>
                <td>'.$row->materia.'</td>
                <td>'.$row->dia.'</td>
                <td>'.$row->grupo.'</td>
                <td>
                <button class="btn btn-labeled btn-danger cmdborrarcla" type="button" idregB="'.$row->id.'">
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
    <th>Dia</th>
    <th>Grupo</th>
    <th>Accion</th>
</tr>
'.$datos.'
</table>';


?>
<script>
	$('.cmdborrarcla').click(function () {
        var idregB = $(this).attr("idregB");
        var path = $("#path").val();
        var data = "idRB="+idregB+"&acc=delete&idp=<?php echo $idp ?>";
        var html = $.ajax({
            url: path + "includes/ajax/addClase.php",
            type: "POST",
            data: data,
            async: false
        }).responseText;
        $("#capaResultado").html(html);
    });
    </script>