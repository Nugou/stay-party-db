<?php
include('connection.php');

if(isset($_POST['type'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$type = $_POST['type'];	
}else{
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$email = $obj['email'];
	$password = $obj['password'];
	$type = $obj['type'];
}



$data = array();

if ($type == "user"){

	$sql = $pdo->prepare("select email,
										   name,
										   password
									from user_data
									where email = '$email' and password = '$password' and activated = 1"
	);

	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			$data = array("email"=>$row->email, "password"=>$row->password, "name"=>$row->name, "type"=>$type);
		}
	}
} else if ($type == "driver"){
	$sql = $pdo->prepare("select email,
										   name,
										   password
									from driver_data
									where email = '$email' and password = '$password' and activated = 1;"
	);

	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			$data = array("email"=>$row->email, "password"=>$row->password, "name"=>$row->name, "type"=>$type);
		}
	}
} else {
	$data['type'] = 'error';
}


if($data == []){
	$data['field'] = $type . " - " . $email . " - " . $password;
    $data["result"] = "dados não encontrado";
}else if($data['type'] == 'error'){
    $data["result"] = "tipo não especificado";
} else {
	$data["result"] = "ok";
}

echo json_encode($data);
?>