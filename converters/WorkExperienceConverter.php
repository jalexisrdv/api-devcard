<?php

class WorkExperienceConverter {

    public static function fromRequestBody($requestBody) {
        $dto = new WorkExperienceDTO();
        $dto->setId(isset($requestBody->id) ? $requestBody->id : '');
        $dto->setTitle(isset($requestBody->title) ? $requestBody->title : '');
        $dto->setCompany(isset($requestBody->company) ? $requestBody->company : '');
        $dto->setStartYear(isset($requestBody->startYear) ? $requestBody->startYear : '');
        $dto->setEndYear(isset($requestBody->endYear) ? $requestBody->endYear : '');
        $dto->setContent(isset($requestBody->content) ? $requestBody->content : '');
        return $dto;
    }

}