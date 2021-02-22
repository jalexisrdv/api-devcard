<?php

require_once ROOT_PATH . '/utilities/headers.php';
require_once ROOT_PATH . '/utilities/ResponseCode.php';
require_once ROOT_PATH . '/utilities/ResponseWrapper.php';
require_once ROOT_PATH . '/utilities/ExceptionResponse.php';
require_once ROOT_PATH . '/utilities/Query.php';
require_once ROOT_PATH . '/models/daos/UserDAO.php';
require_once ROOT_PATH . '/models/dtos/UserDTO.php';
require_once ROOT_PATH . '/validators/UserValidator.php';
require_once ROOT_PATH . '/converters/UserConverter.php';

class ControllerUser
{

    const HASH = PASSWORD_DEFAULT;
    const COST = ['cost' => 14];

    public static function create()
    {
        try {
            $requestBody = json_decode(file_get_contents("php://input"));
            $dto = UserConverter::fromRequestBody($requestBody);
            $validator = UserValidator::create($dto);
            if (empty($validator)) {
                $passwordHash = self::getPasswordHash($dto->getPassword());
                $dto->setPassword($passwordHash);
                $dao = new UserDAO();
                $dao->create($dto);
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('El usuario fue creado', true);
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
            $dao = new UserDAO();
            $responseBody = $dao->read();
            if (sizeof($responseBody) > 0) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('Success', true, $responseBody);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No se encontraron usuarios', false, null);
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
            $dao = new UserDAO();
            $responseBody = $dao->readById($id);
            if (sizeof($responseBody) > 0) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('Success', true, $responseBody);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No se encontro usuario con id => ' . $id, false, null);
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
            $dto = UserConverter::fromRequestBody($requestBody);
            $validator = UserValidator::update($dto);
            if (empty($validator)) {
                $dao = new UserDAO();
                if($dao->update($dto)) {
                    http_response_code(ResponseCode::OK);
                    $response = WrapperResponse::createResponse('El usuario fue actualizado', true);
                    echo $response;
                }else {
                    http_response_code(ResponseCode::NOT_FOUND);
                    $response = WrapperResponse::createResponse('No existe usuario con id => ' . $dto->getId(), false);
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
            $dao = new UserDAO();
            if ($dao->delete($id)) {
                http_response_code(ResponseCode::OK);
                $response = WrapperResponse::createResponse('El usuario fue eliminado', true);
                echo $response;
            } else {
                http_response_code(ResponseCode::NOT_FOUND);
                $response = WrapperResponse::createResponse('No existe usuario con id => ' . $id, false);
                echo $response;
            }
        } catch (PDOException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER_ERROR);
            $message = ExceptionResponse::getMessage($e->getMessage());
            $response = WrapperResponse::createResponse($message, false);
            echo $response;
        }
    }

    public static function login()
    {
        try {
            $requestBody = json_decode(file_get_contents("php://input"));
            $dto = UserConverter::fromRequestBody($requestBody);
            $validator = UserValidator::login($dto);
            if (empty($validator)) {
                $dao = new UserDAO();
                $responseBody = $dao->readByName($dto->getName());
                //verifica si la contraseña es igual a la almacenada
                $passwordHash = isset($responseBody[0]['password']) ? $responseBody[0]['password'] : '';
                $validatedPassword = self::validatePassword($dto->getPassword(), $passwordHash);
                if(sizeof($responseBody) > 0 && $validatedPassword) {
                    if(self::passwordNeedsRehash($passwordHash)) {
                        $passwordHash = self::getPasswordHash($dto->getPassword());
                        $dto->setPassword($passwordHash);
                        $dao->update($dto);
                    }
                    unset($responseBody[0]['password']);//elimino campo de password
                    http_response_code(ResponseCode::OK);
                    $response = WrapperResponse::createResponse('Success', true, $responseBody);
                    echo $response;
                }else {
                    http_response_code(ResponseCode::NOT_FOUND);
                    $response = WrapperResponse::createResponse('Usuario o password incorrectos', false, null);
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

    private static function validatePassword($password, $passwordHash) {
        return password_verify($password, $passwordHash);
    }

    private static function getPasswordHash($password) {
        return password_hash($password, self::HASH, self::COST);
    }

    private static function passwordNeedsRehash($passwordHash) {
        return password_needs_rehash($passwordHash, self::HASH, self::COST);
    }

}
