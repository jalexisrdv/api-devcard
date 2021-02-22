<?php

class PersonalProjectValidator {

    public static function create(PersonalProjectDTO $dto) {
        if(empty($dto->getTitle())) {
            return 'title es requerido';
        }
        if(empty($dto->getType())) {
            return 'type es requerido';
        }
        if(empty($dto->getContent())) {
            return 'content es requerido';
        }
        return '';
    }

    public static function update(PersonalProjectDTO $dto) {
        if(empty($dto->getId())) {
            return 'id es requerido';
        }
        $boolean = empty($dto->getTitle()) && empty($dto->getType()) && empty($dto->getContent());
        if($boolean) {
            return 'Campo(s) que desea actualizar requerido(s)';
        }
        return '';
    }

}