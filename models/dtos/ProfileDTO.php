<?php

class ProfileDTO
{

    private $id;
    private $firstName;
    private $secondName;
    private $firstSurname;
    private $secondSurname;
    private $degree;
    private $pictureUrl;
    private $about;
    private $phoneNumber;
    private $email;
    private $webSite;
    private $city;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getSecondName()
    {
        return $this->secondName;
    }

    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
    }

    public function getFirstSurname()
    {
        return $this->firstSurname;
    }

    public function setFirstSurname($firstSurname)
    {
        $this->firstSurname = $firstSurname;
    }

    public function getSecondSurname()
    {
        return $this->secondSurname;
    }

    public function setSecondSurname($secondSurname)
    {
        $this->secondSurname = $secondSurname;
    }

    public function getDegree()
    {
        return $this->degree;
    }

    public function setDegree($degree)
    {
        $this->degree = $degree;
    }

    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    public function getAbout()
    {
        return $this->about;
    }

    public function setAbout($about)
    {
        $this->about = $about;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getWebSite()
    {
        return $this->webSite;
    }

    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }
}
