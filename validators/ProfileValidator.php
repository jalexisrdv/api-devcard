<?php

class ProfileValidator {

    public static function create(ProfileDTO $dto) {
        if(empty($dto->getFirstName())) {
            return 'firstName es requerido';
        }
        if(empty($dto->getSecondName())) {
            return 'secondName es requerido';
        }
        if(empty($dto->getFirstSurname())) {
            return 'firstSurname es requerido';
        }
        if(empty($dto->getSecondSurname())) {
            return 'secondSurname es requerido';
        }
        if(empty($dto->getDegree())) {
            return 'degree es requerido';
        }
        if(empty($dto->getPictureUrl())) {
            return 'pictureUrl es requerido';
        }
        if(empty($dto->getAbout())) {
            return 'about es requerido';
        }
        if(empty($dto->getPhoneNumber())) {
            return 'phoneNumber es requerido';
        }
        if(empty($dto->getEmail())) {
            return 'email es requerido';
        }
        if(empty($dto->getWebSite())) {
            return 'webSite es requerido';
        }
        if(empty($dto->getCity())) {
            return 'city es requerido';
        }
        return '';
    }

    public static function update(ProfileDTO $dto) {
        if(empty($dto->getId())) {
            return 'id es requerido';
        }
        $boolean = empty($dto->getFirstName()) && empty($dto->getSecondName()) 
        && empty($dto->getFirstSurname()) && empty($dto->getSecondSurname()) 
        && empty($dto->getDegree()) && empty($dto->getPictureUrl()) 
        && empty($dto->getAbout()) && empty($dto->getPhoneNumber()) 
        && empty($dto->getEmail()) && empty($dto->getWebSite()) 
        && empty($dto->getCity());
        if($boolean) {
            return 'Campo(s) que desea actualizar requerido(s)';
        }
        return '';
    }

}