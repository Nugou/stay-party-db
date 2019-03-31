<?php
include('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];
$type = $_POST['type'];

$data = array();

if ($type == 'user'){

	$sql = $pdo->prepare("select ud.email,
										   ud.name,
										   ua.password,
									from user_data
									inner join user_data ud
									inner join user_account ua on ud.id_user = ua.id_user
									where ud.email = '$email' and ua.password = '$password' and ud.activated = 1"
	);

	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			$data = array("email"=>$row->email, "password"=>$row->password, "name"=>$row->name);
		}
	}
} else if ($type == 'driver'){
	$sql = $pdo->prepare("select dd.email,
										   dd.name,
										   da.password
									from driver_data
												inner join driver_data dd
												inner join driver_account da on dd.id_driver = da.id_driver
									where dd.email = '$email' and da.password = '$password' and dd.activated = 1;"
	);

	if($sql->execute()){
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			$data = array("email"=>$row->email, "password"=>$row->password, "name"=>$row->name);
		}
	}
}


if($data == []){
    $data["result"] = "ERRO_004";
}else{
    $data["result"] = "OK";
}

echo json_encode($data);
?>