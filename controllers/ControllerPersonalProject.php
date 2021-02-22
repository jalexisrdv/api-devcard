<?php

require_once ROOT_PATH . '/utilities/headers.php';
require_once ROOT_PATH . '/utilities/ResponseCode.php';
require_once ROOT_PATH . '/utilities/ResponseWrapper.php';
require_once ROOT_PATH . '/utilities/ExceptionResponse.php';
require_once ROOT_PATH . '/utilities/Query.php';
require_once ROOT_PATH . '/models/daos/PersonalProjectDAO.php';
require_once ROOT_PATH . '/models/dtos/PersonalProjectDTO.php';
require_once ROOT_PATH . '/validators/PersonalProjectValidator.php';
require_once ROOT_PATH . '/converters/PersonalProjectConverter.php';

class ControllerPersonalProject
{

    public static function create()
    {
        try {
            $requestBody = json_decode(file_get_contents("php://input"));
            $dto = PersonalProjectConverter::fromRequestBody($requestBody);
            $validator = PersonalProjectValidator::create($dto);
            if (empty($validator)) {
                $dao = new PersonalProjectDAO();
                $dao->create($dto);
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('El proyecto personal fue creado', true);
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
            $dao = new PersonalProjectDAO();
            $responseBody = $dao->read();
            if (sizeof($responseBody) > 0) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('Success', true, $responseBody);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No se encontraron proyectos personales', false, null);
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
            $dao = new PersonalProjectDAO();
            $responseBody = $dao->readById($id);
            if (sizeof($responseBody) > 0) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('Success', true, $responseBody);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No se encontro proyecto personal con id => ' . $id, false, null);
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
            $dto = PersonalProjectConverter::fromRequestBody($requestBody);
            $validator = PersonalProjectValidator::update($dto);
            if (empty($validator)) {
                $dao = new PersonalProjectDAO();
                if($dao->update($dto)) {
                    http_response_code(ResponseCode::OK);
                    $response = WrapperResponse::createResponse('El proyecto personal fue actualizado', true);
                    echo $response;
                }else {
                    http_response_code(ResponseCode::NOT_FOUND);
                    $response = WrapperResponse::createResponse('No existe proyecto personal con id => ' . $dto->getId(), false);
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
            $dao = new PersonalProjectDAO();
            if ($dao->delete($id)) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('El proyecto personal fue eliminado', true);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No existe proyecto personal con id => ' . $id, false);
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
