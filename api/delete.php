<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization");

require '../userController.php';

$comment = new UserController();

//get raw data
$data = json_decode(file_get_contents("php://input"));

$comment->id = $data->id;


//delete comment

if($comment->deleteComment()){
    echo json_encode(array("message"=>"Post deleted"));
}else{
    echo json_encode(array("message"=>"Post not deleted"));
}