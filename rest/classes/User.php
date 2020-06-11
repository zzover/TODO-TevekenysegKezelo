<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

class User
{
    private $db;
    private $data;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getUser($input)
    {
        $this->data = $this->db->do("SELECT `ID`, `lastname`, `firstname`, `pass` FROM `user` WHERE ? IN (username, address)", [$input])->fetch();

        return $this->formatResult();
    }

    public function isActiveUser($ID)
    {
        $this->data = $this->db->do("SELECT `active` FROM `user` WHERE `ID` = ?", [$ID])->fetchColumn();

        return $this->formatResult();
    }

    public function isUser($input)
    {
        $this->data = $this->db->do("SELECT `ID` FROM `user` WHERE ? IN (username, address)", [$input])->rowCount();

        return $this->formatResult();
    }

    public function register($address, $username, $lastname, $firstname, $pass)
    {
        $this->data = $this->db->do("INSERT INTO `user`(`username`, `lastname`, `firstname`, `address`, `pass`) VALUES (?, ?, ?, ?, ?)", [$username, $lastname, $firstname, $address, $pass])->rowCount();

        return $this->formatResult();
    }

    public function getName($ID)
    {
        $this->data = $this->db->do("SELECT `lastname`, `firstname` FROM `user` WHERE `ID` = ?", [$ID])->fetchAll();

        return $this->formatResult();
    }

    public function searchUser($name)
    {
        $this->data = $this->db->do("SELECT `ID`, `lastname`, `firstname`, `img` FROM `user` WHERE CONCAT(`lastname`, ' ', `firstname`) LIKE  ? LIMIT 10", ["%". $name ."%"])->fetchAll();

        return $this->formatResult();
    }

    public function getFriends($user)
    {
        $this->data = $this->db->do("SELECT `ID`, `user_x`, `user_y`, `start` FROM `friends` WHERE ? IN (`user_x`, `user_y`) AND `status` = 1", [$user])->fetchAll();

        return $this->formatResult();
    }

    public function addFriend($user_x, $user_y)
    {
        $areFriends = $this->db->do("SELECT `ID`, FROM `friends` WHERE `user_x` = ? AND `user_y` = ?", [$user_x, $user_y])->rowCount();
        
        if ($areFriends == 1)
        {
            $this->data = 0;
        }
        else
        {
            $this->data = $this->db->do("INSERT INTO `friends`(`user_x`, `user_y`) VALUES (?, ?)", [$user_x, $user_y])->rowCount();
        }
        return $this->formatResult();
    }

    public function getIncomingRequests($user)
    {
        $this->data = $this->db->do("SELECT `fr`.`ID`, `user_x`, CONCAT(`us`.`lastname`, ' ', `us`.`firstname`) as `name` FROM `friends` `fr` INNER JOIN `user` `us` ON `us`.`ID` = `user_x` WHERE `user_y` = ? AND `status` = 0", [$user])->fetchAll();

        return $this->formatResult();
    }

    public function getOutgoingRequests($user)
    {
        $this->data = $this->db->do("SELECT `fr`.`ID`, `user_y`, CONCAT(`us`.`lastname`, ' ', `us`.`firstname`) as `name` FROM `friends` `fr` INNER JOIN `user` `us` ON `us`.`ID` = `user_y` WHERE `user_x` = ? AND `status` = 0", [$user])->fetchAll();

        return $this->formatResult();
    }

    public function confirmRequest($friendship)
    {
        $this->data = $this->db->do("UPDATE `friends` SET `status`= 1 WHERE `ID` = ?", [$friendship])->rowCount();

        return $this->formatResult();
    }

    public function deleteRequest($friendship)
    {
        $this->data = $this->db->do("DELETE FROM `friends` WHERE `ID` = ?", [$friendship])->rowCount();

        return $this->formatResult();
    }

    private function formatResult()
    {
        if ($this->data)
        {
            $this->data = array_merge(array("queryStatus" => true), array("result" => $this->data));
            return printJson($this->data);
        }
        else
        {
            return printJson(array("queryStatus" => false, "result" => false));
        }
    }
}
?>