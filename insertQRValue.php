<?php
include('dbconnection.php');
$conn = db_connect();

$json       = file_get_contents("php://input");
$jsonDecode = json_decode($json, true);

//echo "<pre>"; print_r($jsonDecode);

$qrValue = $jsonDecode['value'];

$query = "insert into qr_code_value(value,created_by) values('".$qrValue."','admin')";
$insert = mysqli_query($conn,$query);
if($insert){
    $last_id = mysqli_insert_id($conn);
    echo json_encode(['status' => true,'lastInsertID' => $last_id]);
    exit();
}else{
    echo json_encode(['status' => false]);
    exit();
}
?>