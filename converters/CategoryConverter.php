<?php

class CategoryConverter {

    public static function fromRequestBody($requestBody) {
        $dto = new CategoryDTO();
        $dto->setId(isset($requestBody->id) ? $requestBody->id : '');
        $dto->setName(isset($requestBody->name) ? $requestBody->name : '');
        return $dto;
    }

}