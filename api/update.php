<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization");

require '../userController.php';

$comment = new UserController();

//get raw data
$data = json_decode(file_get_contents("php://input"));

$comment->id = $data->id;
$comment->username = $data->username;
$comment->comment_text = $data->comment_text;
$comment->users_id = $data->users_id;

//create comment

if($comment->updateComment()){
    echo json_encode(array("message"=>"Post updated"));
}else{
    echo json_encode(array("message"=>"Post not updated"));
}