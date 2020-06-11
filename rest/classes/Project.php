<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

class Project
{
    private $db;
    private $data;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getProjects($ID)
    {
        $this->data = $this->db->do("SELECT `ID` as `azonosito`, `owner`, `name`, `info`, `color`, `createtime`, (SELECT count(`ID`) FROM `activity` WHERE `project` = `azonosito`) as `tevekenysegSzam` FROM `project` WHERE `owner` = ?", [$ID])->fetchAll();

        return $this->formatResult();
    }

    public function getLatestProjects($ID)
    {
        $this->data = $this->db->do("SELECT `ID` as `azonosito`, `owner`, `name`, `info`, `color`, `createtime`, (SELECT count(`ID`) FROM `activity` WHERE `project` = `azonosito`) as `tevekenysegSzam` FROM `project` WHERE `owner` = ? ORDER BY `createtime` DESC LIMIT 3", [$ID])->fetchAll();

        return $this->formatResult();
    }

    public function createProject($owner, $projectName, $projectInfo, $projectColor)
    {
        $this->data = $this->db->do("INSERT INTO `project`(`owner`, `name`, `info`, `color`) VALUES (?, ?, ?, ?)", [$owner, $projectName, $projectInfo, $projectColor])->rowCount();
        
        return $this->formatResult();
    }

    public function editProjectInfo($ID, $info)
    {
        $this->data = $this->db->do("UPDATE `project` SET `info` = ? WHERE `ID` = ?", [$info, $ID])->rowCount();

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