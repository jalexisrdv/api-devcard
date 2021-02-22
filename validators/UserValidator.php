<?php

class UserValidator {

    public static function create(UserDTO $dto) {
        if(empty($dto->getName())) {
            return 'name es requerido';
        }
        if(empty($dto->getPassword())) {
            return 'password es requerido';
        }
        return '';
    }

    public static function update(UserDTO $dto) {
        if(empty($dto->getId())) {
            return 'id es requerido';
        }
        $boolean = empty($dto->getName()) && empty($dto->getPassword());
        if($boolean) {
            return 'Campo(s) que desea actualizar requerido(s)';
        }
        return '';
    }

    public static function login(UserDTO $dto) {
        return self::create($dto);
    }

}