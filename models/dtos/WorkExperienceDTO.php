<?php

class WorkExperienceDTO {

    private $id;
    private $title;
    private $company;
    private $startYear;
    private $endYear;
    private $content;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getStartYear()
    {
        return $this->startYear;
    }

    public function setStartYear($startYear)
    {
        $this->startYear = $startYear;
    }

    public function getEndYear()
    {
        return $this->endYear;
    }

    public function setEndYear($endYear)
    {
        $this->endYear = $endYear;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

}