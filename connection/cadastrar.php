<?php
include('connection.php');

if(count($_POST) > 0){
	$email = $_POST['email'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	$type = $_POST['type'];
} else {
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$email = $obj['email'];
	$name = $obj['name'];
	$password = $obj['password'];
	$type = $obj['type'];
}

$data = array();

if ($type == "user"){

	$sql = $pdo->prepare("insert into user_data (name, email, password, activated) value ('$name','$email', '$password',true)");

	if($sql->execute()){
		$data["result"] = "ok";
	}else{
		$data["result"] = "error";
	}

} else if ($type == "driver"){
	$sql = $pdo->prepare("insert into driver_data (name, email, password, enabled, activated) value ('$name','$email','$password', false,true)");

	if($sql->execute()){
		$data["result"] = "ok";
	}else{
		$data["result"] = "error";
	}
} else {
	$data['type'] = "Não especificado corretamente";
}


if($data == []){
	$data['field'] = $type . " - " . $email . " - " . $password;
	$data["result"] = "ERRO_004";
}else{
	$data["result"] = "ok";
}

echo json_encode($data);
?>