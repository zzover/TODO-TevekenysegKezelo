<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

class Activity
{
    private $db;
    private $data;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getActivity($input)
    {
        $this->data = $this->db->do("SELECT `ID`, `name`, `start`, `deadline`, `priority`, `complete` FROM `activity` WHERE `project` = ?", [$input])->fetchAll();

        return $this->formatResult();
    }

    public function createActivity($activityName, $start, $deadline, $projectID)
    {
        $this->data = $this->db->do("INSERT INTO `activity`(`name`, `start`, `deadline`, `project`) VALUES (?, ?, ?, ?)", [$activityName, $start, $deadline, $projectID])->rowCount();
        
        return $this->formatResult();
    }

    public function completeActivity($activityID)
    {
        $this->data = $this->db->do("UPDATE `activity` SET`complete` = 1 WHERE `ID` = ?", [$activityID])->rowCount();
        
        return $this->formatResult();
    }

    public function togglePriority($activityID)
    {
        $this->data = $this->db->do("UPDATE `activity` SET`priority` = 1 - `priority` WHERE `ID` = ?", [$activityID])->rowCount();
        
        return $this->formatResult();
    }

    public function removeActivity($activityID)
    {
        $this->data = $this->db->do("DELETE FROM `activity` WHERE `ID` = ?", [$activityID])->rowCount();
        
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