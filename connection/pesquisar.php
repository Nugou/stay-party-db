<?php
include('connection.php');

$email = $_POST['email'];
$type = $_POST['type'];

$data = array();

if ($type == "user"){

	$sql = $pdo->prepare("select *
									from user_data
									where email = '$email'"
	);

	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			$data = array("email"=>$row->email, "password"=>$row->password, "name"=>$row->name, "type"=>$type);
		}
	}
} else if ($type == "driver"){
	$sql = $pdo->prepare("select *
									from driver_data
									where email = '$email'"
	);

	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			$data = array("email"=>$row->email, "password"=>$row->password, "name"=>$row->name, "type"=>$type);
		}
	}
} else {
	$data['type'] = "Não especificado corretamente";
}


if($data == []){
	$data['field'] = $type . " - " . $email . " - " . $password;
	$data["result"] = "error";
}else{
	$data["result"] = "ok";
}

echo json_encode($data);
?>