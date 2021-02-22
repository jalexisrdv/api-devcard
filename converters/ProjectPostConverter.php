<?php

class ProjectPostConverter {

    public static function fromRequestBody($requestBody) {
        $dto = new ProjectPostDTO();
        $dto->setId(isset($requestBody->id) ? $requestBody->id : '');
        $dto->setTitle(isset($requestBody->title) ? $requestBody->title : '');
        $dto->setContent(isset($requestBody->content) ? $requestBody->content : '');
        $dto->setDate(isset($requestBody->date) ? $requestBody->date : '');
        $dto->setCategoryId(isset($requestBody->categoryId) ? $requestBody->categoryId : '');
        return $dto;
    }

}