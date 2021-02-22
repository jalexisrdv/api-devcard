<?php

class WorkExperienceValidator {

    public static function create(WorkExperienceDTO $dto) {
        if(empty($dto->getTitle())) {
            return 'title es requerido';
        }
        if(empty($dto->getCompany())) {
            return 'company es requerido';
        }
        if(empty($dto->getStartYear())) {
            return 'startYear es requerido';
        }
        if(empty($dto->getEndYear())) {
            return 'endYear es requerido';
        }
        if(empty($dto->getContent())) {
            return 'content es requerido';
        }
        return '';
    }

    public static function update(WorkExperienceDTO $dto) {
        if(empty($dto->getId())) {
            return 'id es requerido';
        }
        $boolean = empty($dto->getTitle()) && empty($dto->getCompany()) 
        && empty($dto->getStartYear()) && empty($dto->getEndYear()) 
        && empty($dto->getContent());
        if($boolean) {
            return 'Campo(s) que desea actualizar requerido(s)';
        }
        return '';
    }

}