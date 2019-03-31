<?php
include('connection.php');

if (isset($_POST['type']) == true){
	$type = $_POST['type'];
}else{
	$type = "user";
}
$data = array();

if ($type == "user"){

	$sql = $pdo->prepare("select * from user_data");
} else if ($type == "driver"){
	$sql = $pdo->prepare("select * from driver_data");
} else {
	$data['type'] = "Não especificado corretamente";
}
$g = 0;
if($sql-> execute()){
	while($row = $sql->fetch(PDO::FETCH_ASSOC)){
		foreach($row as $field => $value){
			$data[$g][$field] = $value;
		}
		$g = ($g + 1);
	}
}

if($data == []){
	$data["result"] = "error";
}else{
	$data["length"] = $sql->rowCount();
	$data["result"] = "ok";
}

echo json_encode($data);
?>