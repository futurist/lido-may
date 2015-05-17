<?php
mb_http_input("utf-8");
mb_http_output("utf-8");
date_default_timezone_set("PRC");
error_reporting(E_ERROR|E_WARNING);

$cfg_dbhost = "localhost";
$cfg_dbname = "lianya_lido";
$cfg_dbuser = "lianya_lido";
$cfg_dbpwd = "lido";

session_start();
$con=mysqli_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd,$cfg_dbname)  or die("Error " . mysqli_error($link));
mysqli_set_charset($con, "utf-8");
mysqli_query($con,"SET NAMES utf8");


$table = mysqli_real_escape_string($con, $_GET['table']);
$tableName = "";
if($table=="reg"){ $tableName="注册用户"; }
else if($table=="share"){ $tableName="转发情况"; }
else{ exit(); }

$date = date("Y-m-d H:i:s");


$query = sprintf("select * from $table order by id desc ");
$result = mysqli_query($con,$query);


$data = array();
while($row = mysqli_fetch_assoc($result))
{
	$data[] = $row;
}

$colNames = array_keys(reset($data));

function getTableComment($tableName){
	global $cfg_dbname,$con;
	$comments = mysqli_query($con,"SELECT table_comment FROM information_schema.tables WHERE table_schema =  '$cfg_dbname' AND table_name =  '{$tableName}'" );
	$row=mysqli_fetch_assoc($comments);
	return $row->table_comment?:$tableName;
}

function getColumnComment($tableName){
	global $cfg_dbname,$con;
	$ret = array();
	$comments = mysqli_query($con, "SELECT column_name, column_comment FROM information_schema.columns  WHERE table_schema ='$cfg_dbname' AND table_name = '{$tableName}'");
	while($row = mysqli_fetch_assoc($comments)){
		$ret[$row["column_name"]] = $row["column_comment"]?:$row["column_name"];
	}
	return $ret;
}

$colMark = getColumnComment($table);

?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
  <style>
	table{ border-collapse: collapse; }
	table td{ border:1px solid #ccc; }
  </style>
 </head>
 <body>

  <h2 align=center><?php echo $tableName; ?></h2>
 <table border="0" align=center>
 <tr>
    <?php
foreach($colNames as $colName)
{
	echo "<th style='font-size: 16px;
font-family: 微软雅黑;width: 150px;'>{$colMark[$colName]}</th>";
}
?>
 </tr>

    <?php
foreach($data as $row)
{
	echo "<tr style='font-family: 微软雅黑;'>";
	foreach($colNames as $colName)
	{
		echo "<td style='font-family: 微软雅黑;'>".$row[$colName]."</td>";
	}
	echo "</tr>";
}
?>
 </table>


</body>
</html>