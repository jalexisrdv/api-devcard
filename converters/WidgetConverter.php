<?php

class WidgetConverter {

    public static function fromRequestBody($requestBody) {
        $dto = new WidgetDTO();
        $dto->setId(isset($requestBody->id) ? $requestBody->id : '');
        $dto->setTitle(isset($requestBody->title) ? $requestBody->title : '');
        $dto->setContent(isset($requestBody->content) ? $requestBody->content : '');
        return $dto;
    }

}