<?php 
require ('php/conexion.php');
//intento de AJAX
$sTabla="contactos";

$aColumnas=array('id','nombre','apellido','direccion','email','telefono');

$sIndexColumn="id";
//paginacion
$sLimit="";
if (isset($_GET['iDisplayStart'])&&$_GET['iDisplayLength']!='-1') {
	$sLimit="LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
}
//ordenador
if (isset($_GET['iSortCol_0'])) {
	$sOrder="ORDER BY ";
	for ($i=0; $i<intval($_GET['iSortCols']) ; $i++) { 
		if ($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])]=="true") {
			$sOrder.=$aColumnas[intval($_GET['iSortCol_'.$i])]." ".$_GET['sSortDir_'.$i].", ";
		}
	}
	$sOrder=substr_replace($sOrder, "", -2);
	if ($sOrder=="ORDER BY") {
		$sOrder="";
	}
} 

//filtrado
$sWhere="";
if ($_GET['sSearch'] != "") {
	$sWhere="WHERE (";
	for ($i=0; $i<count($aColumnas) ; $i++) { 
		$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
	}
	$sWhere=substr_replace($sWhere, "", -3);
	$sWhere.=')';
}
//filtrado por columna individual
for ($i=0; $i < count($aColumnas) ; $i++) { 
	if ($_GET['bSearchable_'] == "true" && $_GET['sSearch'] != '') {
		if ($sWhere=="") {
			$sWhere="WHERE ";
		}else{
			$sWhere.=" AND ";
		}
		$sWhere.=$aColumnas['$i']." LIKE '%".$_GET['sSearch'.$i]."%' ";
	}
}
//obtener datos para mostrar SQL querys
$sQuery="
SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))."
FROM $sTabla
$sWhere
$sOrder
$sLimit
";
$sResult=$link->query($sSquery);
//data set length after filtering
$sQuery="SELECT FOUND_ROWS()";
$rResultFilterTotal=$link-query($sQuery);
$aResultFilterTotal=$rResultFilterTotal->fetch_array();
$iFilteredTotal=$aResultFilterTotal[0];
//total data ser length
$sQuery= "SELECT COUNT(".$sIndexColumn.") FROM $sTabla";
$rResultTotal=$link->query($sQuery);
$aResultTotal=$sResultTotal->fetch_array();
$iTotal=$aResultTotal[0];
//output
$output=array(
"sEcho"=>intval($_GET['sEcho']),
"iTotalRecords"=>$iTotal,
"iTotalDisplayRecords"=>$iFilteredTotal,
"aaData"=>array()
);

while ($aRow = $rResult->fetch_array()) {
	$row=array();
	for ($i=0; $i < count($aColumnas); $i++) { 
		if ($aColumnas[$i]=="version") {
			/*Special output formatting for 'version' column*/
			$row[]=($aRow[$aColumnas[$i]]=="0")?'-':$aRow[$aColumnas[$i]];
		}else if ($aColumnas[$i]!=' ') {
			/*General output*/
			$row[]=$aRow[$aColumnas[$i]];
		}
	}
	$row[]="<td><a href='modificar.php?id=".$aRow['id']."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
	$row[]="<td><a href='#' data-href='eliminar.php?id=".$aRow['id']."'data-toggle='modal' data-target='#confirm-delete'<span class='glyphicon glyphicon-trash'></span></td>";

	$output['aaData'][]=$row;
}

echo json_encode($output);

?>