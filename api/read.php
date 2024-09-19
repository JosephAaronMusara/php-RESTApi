<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require '../userController.php';

$comment = new UserController();
$theResult = $comment->getComments();
$num = $theResult->rowCount();

if($num > 0){
    $comment_arr = array();
    $comment_arr["data"] = array();

    while($row = $theResult->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $commnent_item = array(
            'id' => $id,
            'username' => $username,
            'comment_text' => html_entity_decode($comment_text),
            'created_at' => $created_at,
            'users_id' => $users_id
        );
        array_push($comment_arr["data"],$commnent_item);
    }
    //convert to JSON and output
    echo json_encode($comment_arr);
}else{
    echo json_encode(array('message' => 'No comments found'));
}
