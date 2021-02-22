<?php

class UserConverter {

    public static function fromRequestBody($requestBody) {
        $dto = new UserDTO();
        $dto->setId(isset($requestBody->id) ? $requestBody->id : '');
        $dto->setName(isset($requestBody->name) ? $requestBody->name : '');
        $dto->setPassword(isset($requestBody->password) ? $requestBody->password : '');
        return $dto;
    }

}