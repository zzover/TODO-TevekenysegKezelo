<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

header("Content-Type: application/json;charset=utf-8");

$errors = array(
    "basic" => array(),
    "user" => array(),
    "lastname" => array(),
    "firstname" => array(),
    "address" => array(),
    "pass" => array(),
    "confirm" => array()
);

function signupSuccess($message = NULL)
{
    return printJson(array("signupStatus" => true, NULL, "msg" => $message));
}

function signupError($message = NULL)
{
    return printJson(array("signupStatus" => false, "userID" => NULL, "msg" => $message));
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $inputData = file_get_contents("php://input");
    $inputData = json_decode($inputData, true);

    if (is_null($inputData))
    {
        $errors["basic"][] = msgSignup[$_SESSION["Language"]]["JSONError"];
        exit(signupError($errors));
    }
    else
    {
        extract($inputData);
    }

    // Ha nincs megadva a Felhasználónév
    if (!isset($user) || empty($user))
    {
        $errors["user"][] = msgSignup[$_SESSION["Language"]]["notSetUser"];
    }
    else
    {
        // Ha meg van adva a Felhasználónév : ellenőrzöm a hosszát, formátumát
        $user = trim(htmlspecialchars($user));

        if(!(strlen($user) > 2 && strlen($user) < 33))
        {
            $errors["user"][] = msgSignup[$_SESSION["Language"]]["sizeUser"];
        }
        //if(!preg_match("/^[a-z0-9._@]+$/i", $user))
        if(!preg_match("/^[a-z0-9_]+$/i", $user))
        {
            $errors["user"][] = msgSignup[$_SESSION["Language"]]["wrongUsernameFormat"];
        }
    }

    // Ha nincs megadva a Vezetéknév
    if (!isset($lastname) || empty($lastname))
    {
        $errors["lastname"][] = msgSignup[$_SESSION["Language"]]["notSetLastname"];
    }
    else
    {
        // Ha meg van adva a Vezetéknév : ellenőrzöm a hosszát, formátumát
        $lastname = htmlspecialchars($lastname);
        
        if(!(strlen($lastname) > 2 && strlen($lastname) < 33))
        {
            $errors["lastname"][] = msgSignup[$_SESSION["Language"]]["sizeLastname"];
        }
        
        if(!preg_match("/^[\p{L}.\- ']+$/u", $lastname))
        {
            $errors["lastname"][] = msgSignup[$_SESSION["Language"]]["wrongLastnameFormat"];
        }
    }

    // Ha nincs megadva a Keresztnév
    if (!isset($firstname) || empty($firstname))
    {
        $errors["firstname"][] = msgSignup[$_SESSION["Language"]]["notSetFirstname"];
    }
    else
    {
        // Ha meg van adva a Keresztnév : ellenőrzöm a hosszát, formátumát
        $firstname = htmlspecialchars($firstname);
        
        if(!(strlen($firstname) > 2 && strlen($firstname) < 33))
        {
            $errors["firstname"][] = msgSignup[$_SESSION["Language"]]["sizeFirstname"];
        }
        
        if(!preg_match("/^[\p{L}.\- ']+$/u", $firstname))
        {
            $errors["firstname"][] = msgSignup[$_SESSION["Language"]]["wrongFirstnameFormat"];
        }
    }

    // Ha nincs megadva az E-mail cím
    if (!isset($address) || empty($address))
    {
        $errors["address"][] = msgSignup[$_SESSION["Language"]]["notSetAddress"];
    }
    else
    {
        // Ha meg van adva az E-mail cím : ellenőrzöm a hosszát, formátumát
        $address = trim(htmlspecialchars($address));
        $address = filter_var($address, FILTER_SANITIZE_EMAIL);

        if (!filter_var($address, FILTER_VALIDATE_EMAIL))
        {
            $errors["address"][] = msgSignup[$_SESSION["Language"]]["wrongAddressFormat"];
        }
    }

    // Ha nincs megadva a Jelszó
    if (!isset($pass) || empty($pass))
    {
        $errors["pass"][] = msgSignup[$_SESSION["Language"]]["notSetPass"];
    }
    else
    {
        // Ha meg van adva a Jelszó : ellenőrzöm a hosszát
        if (!(strlen($pass) > 7 && strlen($pass) < 33))
        {
            $errors["pass"][] = msgSignup[$_SESSION["Language"]]["sizePass"];
        }
    }

    // Ha nincs megadva a Jelszó megerősítés
    if (!isset($confirm) || empty($confirm))
    {
        $errors["confirm"][] = msgSignup[$_SESSION["Language"]]["notSetConfirm"];
    }
    else
    {
        // Ha meg van adva a Jelszó megerősítés : ellenőrzöm a hosszát és hogy ugyan az-e mint a Jelszó
        if (!($pass == $confirm))
        {
            $errors["confirm"][] = msgSignup[$_SESSION["Language"]]["passNotSame"];
        }
    }

    if (count($errors["user"]) === 0 && count($errors["lastname"]) === 0 && count($errors["firstname"]) === 0 && count($errors["address"]) === 0 && count($errors["pass"]) === 0 && count($errors["confirm"]) === 0)
    {
        // Ha a megadott adatokban nincs semmi hiba : Feldolgozás
        $db = new Database(DSN, dbUser, dbPass);
        $u = new User($db);
        $result_user = json_decode($u->isUser($user), true);
        $result_address = json_decode($u->isUser($address), true);

        if ($result_user["queryStatus"])
        {
            $errors["basic"][] = msgSignup[$_SESSION["Language"]]["userExists"];
        }
        if ($result_address["queryStatus"])
        {
            $errors["basic"][] = msgSignup[$_SESSION["Language"]]["addressExists"];
        }

        if (count($errors["basic"]) === 0)
        {
            $secret = password_hash($pass, PASSWORD_DEFAULT);

            $db = new Database(DSN, dbUser, dbPass);
            $u = new User($db);
            $result = json_decode($u->register($address, $user, $lastname, $firstname, $secret), true);

            if ($result["queryStatus"])
            {
                echo signupSuccess(msgSignup[$_SESSION["Language"]]["signupSuccess"]);

                $result_after = json_decode($u->getUser($user), true);
                
                if ($result_after["queryStatus"])
                {
                    $_SESSION["userID"] = $result_after["result"]["ID"];
                    $_SESSION["firstname"] = $result_after["result"]["firstname"];
                    $_SESSION["lastname"] = $result_after["result"]["lastname"];
                }
            }
            else
            {
                $errors["basic"][] = msgSignup[$_SESSION["Language"]]["signupError"];
                echo signupError($errors);
            }
        }
        else
        {
            echo signupError($errors);
        }
    }
    else
    {
        // Ha van hiba kiírom őket
        echo signupError($errors);
    }
}
else
{
    http_response_code(405);
}
?>