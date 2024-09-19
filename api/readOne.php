<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");




require '../userController.php';

$comment = new UserController();

$comment->id = isset($_GET["id"]) ? $_GET["id"] : die("Comment ID not provided");
$comment->getSingleComment();
$comment_item = array(
    'id' => $comment->id,
    'username' => $comment-> username,
    'comment_text' => $comment-> comment_text,
    'created_at' => $comment-> created_at,
    'users_id' => $comment-> users_id
);

print_r(json_encode($comment_item));