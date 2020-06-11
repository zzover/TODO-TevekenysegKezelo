<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

function generateKey($string)
{
    return hash("sha512", $string);
}

function isKey($key)
{
    $db = new Database(DSN, dbUser, dbPass);
    $a = new API_Keys($db);
    $result = $a->getKey($key);

    if ($result)
    {
        return true;
    }
    else
    {
        return false;
    }
}

var_dump(isKey("5ceef81b3ac8ab3be87eed159897724abc56dfc2c8b6a971f27b620d15bbdbd3b22c6cbd9d733b0f55b2f98a50c927e6248ee1a05bbfffdfd268c13939818222"));

class API_Keys
{
    private $db;
    private $data;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getKey($input)
    {
        $this->data = $this->db->do("SELECT `ID` FROM `apps` WHERE ? = `key`", [$input])->fetch();

        return $this->data;
    }
}
?>