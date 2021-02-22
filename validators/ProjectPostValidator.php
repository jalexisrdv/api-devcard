<?php

class ProjectPostValidator {

    public static function create(ProjectPostDTO $dto) {
        if(empty($dto->getTitle())) {
            return 'title es requerido';
        }
        if(empty($dto->getContent())) {
            return 'content es requerido';
        }
        if(empty($dto->getDate())) {
            return 'date es requerido';
        }
        if(empty($dto->getCategoryId())) {
            return 'categoryId es requerido';
        }
        return '';
    }

    public static function update(ProjectPostDTO $dto) {
        if(empty($dto->getId())) {
            return 'id es requerido';
        }
        $boolean = empty($dto->getTitle()) && empty($dto->getContent()) 
        && empty($dto->getDate()) && empty($dto->getCategory());
        if($boolean) {
            return 'Campo(s) que desea actualizar requerido(s)';
        }
        return '';
    }

}