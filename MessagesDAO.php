<?php

class MessagesDAO {
    
    private $connection;
    
    function __construct($connection)
    {
        $this->connection = $connection; 
    }
    

    function getMessageById($id){
        $result;
        $stmt = $this->connection->prepare("SELECT messageData FROM messages WHERE messageId=?");        
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        return json_encode($result);
    }

    function getAllMessages() {
        $rows = array();
        if($result = $this->connection->query("SELECT messageData FROM messages")) {
          while($row = $result->fetch_assoc()){
            $rows[] = $row["messageData"];
          }
        }
        return json_encode($rows);
    }

}