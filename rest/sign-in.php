<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

header("Content-Type: application/json;charset=utf-8");

$errors = array(
    "basic" => array(),
    "user" => array(),
    "pass" => array()
);

function isActive()
{
    $db = new Database(DSN, dbUser, dbPass);
    $u = new User($db);
    $isActive = json_decode($u->isActiveUser($_SESSION["userID"]), true);

    return $isActive["result"];
}

function isSession()
{
    if (isset($_SESSION["userID"]))
    {
        $db = new Database(DSN, dbUser, dbPass);
        $u = new User($db);
        $isActive = json_decode($u->isActiveUser($_SESSION["userID"]), true);
        
        return signinSuccess(msgSignin[$_SESSION["Language"]]["isSession"]);
    }
    else
    {
        $errors[] = msgSignin[$_SESSION["Language"]]["isNotSession"];
        return signinError($errors);
    }
}

function signinSuccess($message = NULL)
{
    return printJson(array("signinStatus" => true, "userID" => $_SESSION["userID"], "msg" => $message, "active" => isActive()));
}

function signinError($message = NULL)
{
    return printJson(array("signinStatus" => false, "userID" => NULL, "msg" => $message));
}

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    echo isSession();
}

else if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $status = json_decode(isSession(), true);

    if (!$status["signinStatus"])
    {
        $inputData = file_get_contents("php://input");
        $inputData = json_decode($inputData, true);

        if (is_null($inputData))
        {
            $errors["basic"][] = msgSignin[$_SESSION["Language"]]["JSONError"];
            exit(signinError($errors));
        }
        else
        {
            extract($inputData);
        }

        if (!isset($user) || empty($user))
        {
            $errors["user"][] = msgSignin[$_SESSION["Language"]]["notSetUser"];
        }
        else
        {
            $user = trim(htmlspecialchars($user));

            if(!(strlen($user) > 2 && strlen($user) < 33))
            {
                $errors["user"][] = msgSignin[$_SESSION["Language"]]["sizeUser"];
            }
            if(!preg_match("/^[a-z0-9._@]+$/i", $user))
            {
                $errors["user"][] = msgSignin[$_SESSION["Language"]]["wrongUsernameFormat"];
            }
        }

        if (!isset($pass) || empty($pass))
        {
            $errors["pass"][] = msgSignin[$_SESSION["Language"]]["notSetPass"];
        }
        else
        {
            if(!(strlen($pass) > 7 && strlen($pass) < 33))
            {
                $errors["pass"][] = msgSignin[$_SESSION["Language"]]["sizePass"];
            }
        }

        if (count($errors["user"]) === 0 && count($errors["pass"]) === 0)
        {
            $db = new Database(DSN, dbUser, dbPass);
            $u = new User($db);
            $result = json_decode($u->getUser($user), true);

            if ($result["queryStatus"])
            {
                $spass = $result["result"]["pass"];

                if (!password_verify($pass, $spass))
                {
                    $errors["basic"][] = msgSignin[$_SESSION["Language"]]["wrongPass"];
                }
            }
            else
            {
                $errors["basic"][] = msgSignin[$_SESSION["Language"]]["notUser"];
            }

            if (count($errors["basic"]) === 0)
            {
                $_SESSION["userID"] = $result["result"]["ID"];
                $_SESSION["firstname"] = $result["result"]["firstname"];
                $_SESSION["lastname"] = $result["result"]["lastname"];
                echo signinSuccess(msgSignin[$_SESSION["Language"]]["sessionSet"]);
            }
            else
            {
                echo signinError($errors);
            }
        }
        else
        {
            echo signinError($errors);
        }
    }
    else
    {
        echo isSession();
    }
}

else if ($_SERVER["REQUEST_METHOD"] == "DELETE")
{
    $lang = $_SESSION["Language"];

    $_SESSION["userID"] = NULL;
    session_unset();
    session_destroy();

    session_start();
    if (!isset($_SESSION["Language"]))
    {
        $_SESSION["Language"] = $lang;
    }

    echo printJson(array("signinStatus" => false, "userID" => NULL, "msg" => msgSignin[$_SESSION["Language"]]["sessionUnset"]));
}
else
{
    http_response_code(405);
}
?>