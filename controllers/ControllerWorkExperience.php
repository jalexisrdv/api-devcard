<?php

require_once ROOT_PATH . '/utilities/headers.php';
require_once ROOT_PATH . '/utilities/ResponseCode.php';
require_once ROOT_PATH . '/utilities/ResponseWrapper.php';
require_once ROOT_PATH . '/utilities/ExceptionResponse.php';
require_once ROOT_PATH . '/utilities/Query.php';
require_once ROOT_PATH . '/models/daos/WorkExperienceDAO.php';
require_once ROOT_PATH . '/models/dtos/WorkExperienceDTO.php';
require_once ROOT_PATH . '/validators/WorkExperienceValidator.php';
require_once ROOT_PATH . '/converters/WorkExperienceConverter.php';

class ControllerWorkExperience
{

    public static function create()
    {
        try {
            $requestBody = json_decode(file_get_contents("php://input"));
            $dto = WorkExperienceConverter::fromRequestBody($requestBody);
            $validator = WorkExperienceValidator::create($dto);
            if (empty($validator)) {
                $dao = new WorkExperienceDAO();
                $dao->create($dto);
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('La experiencía de trabajo fue creada', true);
                echo $response;
            } else {
                http_response_code(ResponseCode::BAD_REQUEST);
                $response = WrapperResponse::createResponse($validator, false);
                echo $response;
            }
        } catch (PDOException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER_ERROR);
            $message = ExceptionResponse::getMessage($e->getMessage());
            $response = WrapperResponse::createResponse($message, false);
            echo $response;
        }
    }

    public static function read()
    {
        try {
            $dao = new WorkExperienceDAO();
            $responseBody = $dao->read();
            if (sizeof($responseBody) > 0) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('Success', true, $responseBody);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No se encontraron experiencias de trabajo', false, null);
                echo $response;
            }
        } catch (PDOException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER_ERROR);
            $message = ExceptionResponse::getMessage($e->getMessage());
            $response = WrapperResponse::createResponse($message, false);
            echo $response;
        }
    }

    public static function readById($id)
    {
        try {
            $dao = new WorkExperienceDAO();
            $responseBody = $dao->readById($id);
            if (sizeof($responseBody) > 0) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('Success', true, $responseBody);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No se encontro experiencia de trabajo con id => ' . $id, false, null);
                echo $response;
            }
        } catch (PDOException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER_ERROR);
            $message = ExceptionResponse::getMessage($e->getMessage());
            $response = WrapperResponse::createResponse($message, false);
            echo $response;
        }
    }

    public static function update()
    {
        try {
            $requestBody = json_decode(file_get_contents("php://input"));
            $dto = WorkExperienceConverter::fromRequestBody($requestBody);
            $validator = WorkExperienceValidator::update($dto);
            if (empty($validator)) {
                $dao = new WorkExperienceDAO();
                if($dao->update($dto)) {
                    http_response_code(ResponseCode::OK);
                    $response = WrapperResponse::createResponse('La experiencía de trabajo fue actualizada', true);
                    echo $response;
                }else {
                    http_response_code(ResponseCode::NOT_FOUND);
                    $response = WrapperResponse::createResponse('No existe experiencía de trabajo con id => ' . $dto->getId(), false);
                    echo $response;
                }
            } else {
                http_response_code(ResponseCode::BAD_REQUEST);
                $response = WrapperResponse::createResponse($validator, false);
                echo $response;
            }
        } catch (PDOException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER_ERROR);
            $message = ExceptionResponse::getMessage($e->getMessage());
            $response = WrapperResponse::createResponse($message, false);
            echo $response;
        }
    }

    public static function delete($id)
    {
        try {
            $dao = new WorkExperienceDAO();
            if ($dao->delete($id)) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('La experiencía de trabajo fue eliminada', true);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No existe experiencía de trabajo con id => ' . $id, false);
                echo $response;
            }
        } catch (PDOException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER_ERROR);
            $message = ExceptionResponse::getMessage($e->getMessage());
            $response = WrapperResponse::createResponse($message, false);
            echo $response;
        }
    }
}
