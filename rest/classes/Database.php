<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

class Database extends PDO
{
    private $error = NULL;

    public function __construct($dsn, $dbUser = NULL, $dbPass = NULL, $options = [])
    {
        try
        {
            $default_options = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
    
            $options = array_merge($default_options, $options);
            parent::__construct($dsn, $dbUser, $dbPass, $options);
        }
        catch (PDOException $e)
        {
            switch ($e->getCode()) {
                case 1045: $msg = "Incorrect credentials";                  break;
                case 1049: $msg = "Database not exists on the server";      break;
                case 2002: $msg = "Cannot connect to the database server";  break;
                case 2019: $msg = "Wrong charset";                          break;
                default:   $msg = "Uncaught error message";                 break;
            }

            $this->error = $msg;

            //exit($e->getMessage() . $e->getCode());
            //exit("Database error: " . $msg);

            writeLog($msg, "Database error: ", "ERROR ");
            exit(require_once(root . jsonFolder . "databaseError.json"));
        }
        
    }

    public function do($SQL, $args = NULL)
    {
        // fetch, fetchColumn, fetchAll, rowCount
        if (!$args)
        {
            return $this->query($SQL);
        }
        else
        {
            $stmt = $this->prepare($SQL);
            $stmt->execute($args);

            return $stmt;
        }
    }

    public function isError()
    {
        if(is_null($this->error))
        {
            exit(require_once(root . jsonFolder . "databaseSuccess.json"));
        }
        else
        {
            // Korábban már megjelenítettem
            //exit(require_once(root . jsonFolder . "databaseError.json"));
        }
    }
}
?>