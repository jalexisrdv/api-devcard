<?php

class WidgetValidator {

    public static function create(WidgetDTO $dto) {
        if(empty($dto->getTitle())) {
            return 'title es requerido';
        }
        if(empty($dto->getContent())) {
            return 'content es requerido';
        }
        return '';
    }

    public static function update(WidgetDTO $dto) {
        if(empty($dto->getId())) {
            return 'id es requerido';
        }
        $boolean = empty($dto->getTitle()) && empty($dto->getContent());
        if($boolean) {
            return 'Campo(s) que desea actualizar requerido(s)';
        }
        return '';
    }

}