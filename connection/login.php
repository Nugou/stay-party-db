<?php
include('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];

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