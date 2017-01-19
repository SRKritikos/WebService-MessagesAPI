<?php
include_once ('MessagesDAO.php');
class MessagesService {
    private $messagesDAO;
    function __construct($messagesDAO) {
        $this->messagesDAO = $messagesDAO;
    }
    
    function updateOrInsert($id, $message) {
        if ($this->messagesDAO->updateMessage($id, $message)) {
            return 200;
        } else {
            $this->messagesDAO->insertMessage($id, $message);
            return 203;
        }
    }
}
