<?php

class PersonalProjectConverter {

    public static function fromRequestBody($requestBody) {
        $dto = new PersonalProjectDTO();
        $dto->setId(isset($requestBody->id) ? $requestBody->id : '');
        $dto->setTitle(isset($requestBody->title) ? $requestBody->title : '');
        $dto->setType(isset($requestBody->type) ? $requestBody->type : '');
        $dto->setContent(isset($requestBody->content) ? $requestBody->content : '');
        return $dto;
    }

}