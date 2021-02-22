<?php

class CategoryValidator {

    public static function create(CategoryDTO $dto) {
        if(empty($dto->getName())) {
            return 'name es requerido';
        }
        return '';
    }

    public static function update(CategoryDTO $dto) {
        if(empty($dto->getId())) {
            return 'id es requerido';
        }
        $boolean = empty($dto->getName());
        if($boolean) {
            return 'Campo(s) que desea actualizar requerido(s)';
        }
        return '';
    }

}