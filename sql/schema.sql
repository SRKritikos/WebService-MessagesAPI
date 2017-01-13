/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  srostantkritikos06
 * Created: Jan 11, 2017
 */
DROP DATABASE IF EXISTS messages;
CREATE DATABASE messages;
USE messages;

CREATE TABLE messages
(	messageId INT PRIMARY KEY AUTO_INCREMENT,
    	messageData VARCHAR(256)
);



INSERT INTO messages VALUES(null, 'message1'),
                           (null, 'message2'),
                           (null, 'message3'),
                           (null, 'message4'),
                           (null, 'message5');