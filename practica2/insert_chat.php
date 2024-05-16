<?php

//insert_chat.php

require("abstract.databoundobject.php");
require("class.pdofactory.php");

class chatMessage extends DataBoundObject {

    public $to_user_id;
	public $from_user_id;
	public $chat_message;
	public $status;

    protected function DefineTableName() {
        return("chat_message");
    }

    protected function DefineRelationMap() {
        return(array(
            "to_user_id" => "to_user_id",
			"from_user_id" => "from_user_id",
			"chat_message" => "chat_message",
			"status" => "status"
            
        ));
    }

    protected function DefineAutoIncrementField() {
        return(null);
    }

}

include('database_connection.php');

session_start();

$data = array(
	':to_user_id'		=>	$_POST['to_user_id'],
	':from_user_id'		=>	$_SESSION['user_id'],
	':chat_message'		=>	$_POST['chat_message'],
	':status'			=>	'1'
);


$to_user_id = $data[':to_user_id'];
$from_user_id = $data[':from_user_id'];
$chat_message = $data[':chat_message'];
$status = $data[':status'];

$strDSN = "pgsql:dbname=chatpac2;host=localhost;port=5432";
				$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root", array());
				$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$datos = new chatMessage($objPDO);

				$datos->setto_user_id($to_user_id)->setfrom_user_id($from_user_id)->setchat_message($chat_message)->setstatus($status)->save();




?>