<?php

class DBFunctions {
    
    private $mysql;
    
    function __construct()
    {
        $Host="localhost";
        $UserName = "root";
        $Password = "mysql";
        $Database = "messages";
        $this->mysql = new mysqli($Host, $UserName, $Password,$Database); 
    }
    

    function getMessageById($id){
        $result;
        $stmt = $this->mysql->prepare("SELECT messageData FROM messages WHERE messageId-?");        
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        return json_encode($result);
    }

    function getAllMessages() {
        $result;
        $result = $this->mysql->query("SELECT messageData FROM messages");
        return json_encode($result);
    }

}