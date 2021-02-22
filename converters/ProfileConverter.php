<?php

class ProfileConverter {

    public static function fromRequestBody($requestBody) {
        $dto = new ProfileDTO();
        $dto->setId(isset($requestBody->id) ? $requestBody->id : '');
        $dto->setFirstName(isset($requestBody->firstName) ? $requestBody->firstName : '');
        $dto->setSecondName(isset($requestBody->secondName) ? $requestBody->secondName : '');
        $dto->setFirstSurname(isset($requestBody->firstSurname) ? $requestBody->firstSurname : '');
        $dto->setSecondSurname(isset($requestBody->secondSurname) ? $requestBody->secondSurname : '');
        $dto->setDegree(isset($requestBody->degree) ? $requestBody->degree : '');
        $dto->setPictureUrl(isset($requestBody->pictureUrl) ? $requestBody->pictureUrl : '');
        $dto->setAbout(isset($requestBody->about) ? $requestBody->about : '');
        $dto->setPhoneNumber(isset($requestBody->phoneNumber) ? $requestBody->phoneNumber : '');
        $dto->setEmail(isset($requestBody->email) ? $requestBody->email : '');
        $dto->setWebSite(isset($requestBody->webSite) ? $requestBody->webSite : '');
        $dto->setCity(isset($requestBody->city) ? $requestBody->city : '');
        return $dto;
    }

}