<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

header("Content-Type: application/json;charset=utf-8");

$errors = array(
    "basic" => array()
);

function actionSuccess($message = NULL)
{
    return printJson(array("actionStatus" => true, "msg" => $message));
}

function actionError($message = NULL)
{
    return printJson(array("actionStatus" => false, "userID" => NULL, "msg" => $message));
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_SESSION["userID"]))
    { } else { exit("No user set"); }

    $inputData = file_get_contents("php://input");
    $inputData = json_decode($inputData, true);

    if (is_null($inputData))
    {
        $errors["basic"][] = msgSignup[$_SESSION["Language"]]["JSONError"];
        exit(actionError($errors));
    }
    else
    {
        extract($inputData);
    }

    
    if (!isset($action) || empty($action))
    {
        $errors["basic"][] = "Action not set";
    }
    else
    {
        
    }

    if (count($errors["basic"]) === 0)
        {
            $db = new Database(DSN, dbUser, dbPass);
            $result = array();
            
            if ($action == "projects")
            {
                $pr = new Project($db);
                $result = json_decode($result = $pr->getProjects($_SESSION["userID"]), true);

                if ($result["queryStatus"])
                {
                    $data = array();
                    foreach ($result["result"] as $key => $value) {
                        //echo printJson($value["name"]);
                        $data[$key]["ID"] = $value["azonosito"];
                        $data[$key]["owner"] = $value["owner"];
                        $data[$key]["name"] = $value["name"];
                        $data[$key]["info"] = $value["info"];
                        $data[$key]["color"] = $value["color"];
                        $data[$key]["createtime"] = $value["createtime"];
                        $data[$key]["activity"] = $value["tevekenysegSzam"];
                        //$data[$key]["total"] = textHome[$_SESSION["Language"]]["total"];
                        //$data[$key]["item"] = textHome[$_SESSION["Language"]]["item"];
                    }

                    echo printJSON(array("actionStatus" => true, "data" => $data));
                }
                else
                {
                    echo printJSON(array("actionStatus" => false, "msg" => textHome[$_SESSION["Language"]]["noProjects"]));
                }
            }
            
            else if ($action == "latestProjects")
            {
                $pr = new Project($db);
                $result = json_decode($result = $pr->getLatestProjects($_SESSION["userID"]), true);

                if ($result["queryStatus"])
                {
                    $data = array();
                    foreach ($result["result"] as $key => $value) {
                        //echo printJson($value["name"]);
                        $data[$key]["ID"] = $value["azonosito"];
                        $data[$key]["owner"] = $value["owner"];
                        $data[$key]["name"] = $value["name"];
                        $data[$key]["info"] = $value["info"];
                        $data[$key]["color"] = $value["color"];
                        $data[$key]["createtime"] = $value["createtime"];
                        $data[$key]["activity"] = $value["tevekenysegSzam"];
                        //$data[$key]["total"] = textHome[$_SESSION["Language"]]["total"];
                        //$data[$key]["item"] = textHome[$_SESSION["Language"]]["item"];
                    }

                    echo printJSON(array("actionStatus" => true, "data" => $data));
                }
                else
                {
                    echo printJSON(array("actionStatus" => false, "msg" => textHome[$_SESSION["Language"]]["noProjects"]));
                }
            }

            else if ($action == "events")
            {
                $pr = new Project($db);
                $result = json_decode($result = $pr->getProjects($_SESSION["userID"]), true);

                if ($result["queryStatus"])
                {
                    $data = array();
                    $color = "";
                    $tcolor = "";
                    foreach ($result["result"] as $key => $value) {
                        //echo printJson($value["name"]);
                        //$data[$key]["ID"] = $value["ID"];
                        //$data[$key]["owner"] = $value["owner"];
                        $data[$key]["title"] = $value["name"];
                        //$data[$key]["info"] = $value["info"];
                        //$data[$key]["color"] = $value["color"];
                        $format = str_replace(' ', 'T', $value["createtime"]);
                        $data[$key]["start"] = $format;
                        

                        switch ($value['color']) {
                            case 'bg-primary text-white': $color = "#007bff"; $tcolor = "#ffffff"; break;
                            case 'bg-secondary text-white': $color = "#6c757d"; $tcolor = "#ffffff"; break;
                            case 'bg-success text-white': $color = "#28a745"; $tcolor = "#ffffff"; break;
                            case 'bg-danger text-white': $color = "#dc3545"; $tcolor = "#ffffff"; break;
                            case 'bg-warning text-dark': $color = "#ffc107"; $tcolor = "#5e6267"; break;
                            case 'bg-info text-white': $color = "#17a2b8"; $tcolor = "#ffffff"; break;
                            case 'bg-light text-dark': $color = "#f8f9fa"; $tcolor = "#5e6267"; break;
                            case 'bg-dark text-white': $color = "#343a40"; $tcolor = "#ffffff"; break;
                            case 'bg-white text-dark': $color = "#ffffff"; $tcolor = "#5e6267"; break;
                        }

                        $data[$key]["color"] = $color;
                        $data[$key]["textColor"] = $tcolor;

                    }

                    echo printJSON(array("actionStatus" => true, "events" => $data));
                }
                else
                {
                    echo printJSON(array("actionStatus" => false, "msg" => textHome[$_SESSION["Language"]]["noProjectsInCalendar"]));
                }
            }
            else if ($action == "search")
            {
                if (!isset($name) || empty($name))
                {
                    $errors["basic"][] = "name not set";
                }
                else
                {
                    $name = trim(htmlspecialchars($name));
                }

                if (count($errors["basic"]) === 0)
                {
                    //echo actionSuccess("paraméter oké");
                    $u = new User($db);
                    $result = json_decode($result = $u->searchUser($name), true);

                if ($result["queryStatus"])
                {
                    $data = array();
                    foreach ($result["result"] as $key => $value) {
                        //echo printJson($value["name"]);
                        $data[$key]["ID"] = $value["ID"];
                        $data[$key]["lastname"] = $value["lastname"];
                        $data[$key]["firstname"] = $value["firstname"];
                        $data[$key]["img"] = $value["img"];
                    }

                    echo printJSON(array("actionStatus" => true, "data" => $data));
                }
                else
                {
                    $errors["basic"][] = "Nincs találat";
                    //echo printJSON(array("actionStatus" => false));
                    echo actionError($errors);
                }
                }
                else
                {
                    echo actionError($errors);
                }
            }
            else if ($action == "request")
            {
                if (!isset($user_y) || empty($user_y))
                {
                    $errors["basic"][] = "user_y not set";
                }
                else
                {

                }

                if (count($errors["basic"]) === 0)
                {
                    //echo actionSuccess("paraméter oké");
                    $u = new User($db);
                    $result = json_decode($result = $u->addFriend($_SESSION["userID"], $user_y), true);

                if ($result["queryStatus"])
                {

                    echo printJSON(array("actionStatus" => true, "msg" => "Jelölve"));
                }
                else
                {
                    $errors["basic"][] = "Sikertelen művelet";
                    //echo printJSON(array("actionStatus" => false));
                    echo actionError($errors);
                }
                }
                else
                {
                    echo actionError($errors);
                }
            }

            else if ($action == "newProject")
            {
                if (!isset($projectName) || empty($projectName))
                {
                    $errors["basic"][] = "projectName not set";
                }
                else
                {
                    if (!(strlen($projectName) > 2 && strlen($projectName) < 33))
                    {
                        $errors["basic"][] = "projectname hossza nem megfelelő";
                    }
                    else
                    {
                        $projectName = trim(htmlspecialchars($projectName));
                    }
                }

                if (!isset($projectInfo))
                {
                    $errors["basic"][] = "projectInfo not set";
                }
                else
                {
                    $projectInfo = trim(htmlspecialchars($projectInfo));
                }

                if (!isset($projectColor))
                {
                    $errors["basic"][] = "projectColor not set";
                }
                else
                {
                    if (!(strlen($projectColor) < 33))
                    {
                        $errors["basic"][] = "projectColor hossza nem megfelelő";
                    }
                    else
                    {
                        //echo printJSON(array("actionStatus" => true, "msg" => "Paraméter oké"));
                        //echo actionSuccess("paraméter oké");
                    }
                }

                if (count($errors["basic"]) === 0)
                {
                    //echo actionSuccess("paraméter oké");
                    $pr = new Project($db);
                    $result = json_decode($result = $pr->createProject($_SESSION["userID"], $projectName, $projectInfo, $projectColor), true);

                if ($result["queryStatus"])
                {
                    
                    echo actionSuccess(msgActions[$_SESSION["Language"]]["newProjectSuccess"]);
                }
                else
                {
                    $errors["basic"][] = "Sikertelen rögzítés";
                    //echo printJSON(array("actionStatus" => false));
                    echo actionError($errors);
                }
                }
                else
                {
                    echo actionError($errors);
                }
            }

            else if ($action == "newActivity")
            {
                if (!isset($activityName) || empty($activityName))
                {
                    $errors["basic"][] = "activityName not set";
                }
                else
                {
                    if (!(strlen($activityName) > 2 && strlen($activityName) < 129))
                    {
                        $errors["basic"][] = "activityName hossza nem megfelelő";
                    }
                    else
                    {
                        $activityName = trim(htmlspecialchars($activityName));
                    }
                }

                if (!isset($projectID))
                {
                    $errors["basic"][] = "projectID not set";
                }
                else
                {
                    
                }
                if (!isset($start))
                {
                    $errors["basic"][] = "start not set";
                }
                else
                {
                    
                }
                if (!isset($deadline))
                {
                    $errors["basic"][] = "deadline not set";
                }
                else
                {
                    
                }

                if (count($errors["basic"]) === 0)
                {
                    //echo actionSuccess("paraméter oké");
                    $ac = new Activity($db);
                    $result = json_decode($result = $ac->createActivity($activityName, $start, $deadline, $projectID), true);

                if ($result["queryStatus"])
                {
                    echo actionSuccess("Sikeres rögzítés");
                }
                else
                {
                    $errors["basic"][] = "Sikertelen rögzítés";
                    //echo printJSON(array("actionStatus" => false));
                    echo actionError($errors);
                }
                }
                else
                {
                    echo actionError($errors);
                }
            }

            else if ($action == "getActivity")
            {
                if (!isset($projectID) || empty($projectID))
                {
                    $errors["basic"][] = "projectID not set";
                }
                else
                {
                    
                }

                if (count($errors["basic"]) === 0)
                {
                    //echo actionSuccess("paraméter oké");
                    $ac = new Activity($db);
                    $result = json_decode($result = $ac->getActivity($projectID), true);

                    if ($result["queryStatus"])
                    {
                        $data = array();
                        foreach ($result["result"] as $key => $value) {
                            //echo printJson($value["name"]); `name`, `start`, `deadline`, `priority`, `complete`
                            $data[$key]["ID"] = $value["ID"];
                            $data[$key]["name"] = $value["name"];
                            $data[$key]["start"] = $value["start"];
                            $data[$key]["deadline"] = $value["deadline"];
                            $data[$key]["priority"] = $value["priority"];
                            $data[$key]["complete"] = $value["complete"];
                        }
                        echo printJSON(array("actionStatus" => true, "data" => $data));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false, "msg" => textHome[$_SESSION["Language"]]["noActivity"]));
                    }
                }
                else
                {
                    echo actionError($errors);
                }
            }

            else if ($action == "completeActivity")
            {
                if (!isset($activityID) || empty($activityID))
                {
                    $errors["basic"][] = "activityID not set";
                }
                else
                {
                    
                }

                if (count($errors["basic"]) === 0)
                {
                    $ac = new Activity($db);
                    $result = json_decode($result = $ac->completeActivity($activityID), true);

                    if ($result["queryStatus"])
                    {
                        echo printJSON(array("actionStatus" => true, "msg" => "Sikeres módosítás"));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false, "msg" => "Sikertelen módosítás"));
                    }
                }
                else
                {
                    echo actionError($errors);
                }
            }
            else if ($action == "confirmRequest")
            {
                if (!isset($fsID) || empty($fsID))
                {
                    $errors["basic"][] = "fsID not set";
                }
                else
                {
                    
                }

                if (count($errors["basic"]) === 0)
                {
                    $u = new User($db);
                    $result = json_decode($result = $u->confirmRequest($fsID), true);

                    if ($result["queryStatus"])
                    {
                        echo printJSON(array("actionStatus" => true, "msg" => "Elfogadva"));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false, "msg" => "Sikertelen művelet"));
                    }
                }
                else
                {
                    echo actionError($errors);
                }
            }
            else if ($action == "deleteRequest")
            {
                if (!isset($fsID) || empty($fsID))
                {
                    $errors["basic"][] = "fsID not set";
                }
                else
                {
                    
                }

                if (count($errors["basic"]) === 0)
                {
                    $u = new User($db);
                    $result = json_decode($result = $u->deleteRequest($fsID), true);

                    if ($result["queryStatus"])
                    {
                        echo printJSON(array("actionStatus" => true, "msg" => "Sikeres törlés"));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false, "msg" => "Sikertelen törlés"));
                    }
                }
                else
                {
                    echo actionError($errors);
                }
            }
            else if ($action == "togglePriority")
            {
                if (!isset($activityID) || empty($activityID))
                {
                    $errors["basic"][] = "activityID not set";
                }
                else
                {
                    
                }

                if (count($errors["basic"]) === 0)
                {
                    $ac = new Activity($db);
                    $result = json_decode($result = $ac->togglePriority($activityID), true);

                    if ($result["queryStatus"])
                    {
                        echo printJSON(array("actionStatus" => true, "msg" => "Sikeres módosítás"));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false, "msg" => "Sikertelen módosítás"));
                    }
                }
                else
                {
                    echo actionError($errors);
                }
            }
            else if ($action == "incomingRequest")
            {
                    $u = new User($db);
                    $result = json_decode($result = $u->getIncomingRequests($_SESSION["userID"]), true);

                    if ($result["queryStatus"])
                    {
                        $data = array();
                        foreach ($result["result"] as $key => $value) {
                            $data[$key]["ID"] = $value["ID"];
                            $data[$key]["user_x"] = $value["user_x"];
                            $data[$key]["name"] = $value["name"];
                        }
                        echo printJSON(array("actionStatus" => true, "data" => $data));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false));
                    }
            }

            else if ($action == "getFriends")
            {
                    $u = new User($db);
                    $result = json_decode($result = $u->getFriends($_SESSION["userID"]), true);

                    if ($result["queryStatus"])
                    {
                        $data = array();
                        foreach ($result["result"] as $key => $value) {

                            if ($value["user_x"] == $_SESSION["userID"])
                            {
                                $data[$key]["ID"] = $value["ID"];
                                $data[$key]["user"] = $value["user_y"];
                                $data[$key]["start"] = $value["start"];
                            }
                            else
                            {
                                $data[$key]["ID"] = $value["ID"];
                                $data[$key]["user"] = $value["user_x"];
                                $data[$key]["start"] = $value["start"];
                            }

                        }
                        echo printJSON(array("actionStatus" => true, "data" => $data));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false));
                    }
            }
            else if ($action == "outgoingRequest")
            {
                    $u = new User($db);
                    $result = json_decode($result = $u->getOutgoingRequests($_SESSION["userID"]), true);

                    if ($result["queryStatus"])
                    {
                        $data = array();
                        foreach ($result["result"] as $key => $value) {
                            $data[$key]["ID"] = $value["ID"];
                            $data[$key]["user_y"] = $value["user_y"];
                            $data[$key]["name"] = $value["name"];
                        }
                        echo printJSON(array("actionStatus" => true, "data" => $data));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false));
                    }
            }

            else if ($action == "removeActivity")
            {
                if (!isset($activityID) || empty($activityID))
                {
                    $errors["basic"][] = "activityID not set";
                }
                else
                {
                    
                }

                if (count($errors["basic"]) === 0)
                {
                    $ac = new Activity($db);
                    $result = json_decode($result = $ac->removeActivity($activityID), true);

                    if ($result["queryStatus"])
                    {
                        echo printJSON(array("actionStatus" => true, "msg" => "Sikeres törlés"));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false, "msg" => "Sikertelen törlés"));
                    }
                }
                else
                {
                    echo actionError($errors);
                }
            }
            else if ($action == "editProjectInfo")
            {
                if (!isset($projectID) || empty($projectID))
                {
                    $errors["basic"][] = "projectID not set";
                }
                else
                {
                    
                }

                if (!isset($projectInfo) || empty($projectInfo))
                {
                    //$errors["basic"][] = "projectInfo not set";
                    $projectInfo = "";
                }
                else
                {
                    $projectInfo = trim(htmlspecialchars($projectInfo));
                }

                if (count($errors["basic"]) === 0)
                {
                    //echo actionSuccess("paraméter oké");
                    $pr = new Project($db);
                    $result = json_decode($result = $pr->editProjectInfo($projectID, $projectInfo), true);

                    if ($result["queryStatus"])
                    {
                        
                        echo printJSON(array("actionStatus" => true, "msg" => "Sikeres módosítás"));
                    }
                    else
                    {
                        echo printJSON(array("actionStatus" => false, "msg" => "Sikertelen módosítás"));
                    }
                }
                else
                {
                    echo actionError($errors);
                }
            }

            else
            {
                $result = array("msg" => "Hibás paraméter");
                //echo printJSON(array("actionStatus" => false));
                echo actionError($errors);
                exit();
            }
        }
        else
        {
            echo actionError($errors);
        }
}
else
{
    http_response_code(405);
}
?>