<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require 'db.php';

class UserController {
    private $conn;

    public $id;
    public $username;
    public $comment_text;
    public $created_at;
    public $users_id;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fetch all comments
    public function getComments() {
        $query = "SELECT * FROM comments";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //fetch 1 comment
    public function getSingleComment() {
        $query = "SELECT * FROM comments WHERE id = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row["id"];
        $this->username = $row["username"];
        $this->comment_text = $row["comment_text"];
        $this->created_at = $row["created_at"];
        $this->users_id = $row["users_id"];
    }

    //create a comment
    public function createComment(){
        //query
        $query  = "INSERT INTO comments(username,comment_text,users_id) VALUES(:username, :comment_text, :users_id)";

        //prepare
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->username = htmlspecialchars($this->username);
        $this->comment_text = htmlspecialchars($this->comment_text);
        $this->users_id = htmlspecialchars($this->users_id);

        //binding
        $stmt->bindParam(':username',$this->username);
        $stmt->bindParam(':comment_text', $this->comment_text);
        $stmt->bindParam(':users_id',$this->users_id);

        //execute
        if($stmt->execute()){
            return true;
        }
        //error
        printf("Error");
        return false;
    }

    //update a comment

    public function updateComment(){
        //query
        $query  = "UPDATE comments SET username = :username, comment_text = :comment_text, users_id = :users_id WHERE id = :id";

        //prepare
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->username = htmlspecialchars($this->username);
        $this->comment_text = htmlspecialchars($this->comment_text);
        $this->users_id = htmlspecialchars($this->users_id);
        $this->id = htmlspecialchars($this->id);

        //binding
        $stmt->bindParam(':username',$this->username);
        $stmt->bindParam(':comment_text', $this->comment_text);
        $stmt->bindParam(':users_id',$this->users_id);
        $stmt->bindParam(':id',$this->id);
        //execute
        if($stmt->execute()){
            return true;
        }
        //error
        printf("Error");
        return false;
    }

    //Delete

    public function deleteComment(){
        //query
        $query = "DELETE FROM comments WHERE id = :id";

        //prep
       $stmt =  $this->conn->prepare($query);

        //sanitiz
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind
        $stmt->bindParam(':id',$this->id);

        //excute
        if($stmt->execute()){
            return true;
        }
        //error
        printf("Error");
        return false;


    }
   
}
