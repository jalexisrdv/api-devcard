<?php

class WrapperResponse {

    public static function createResponse($message, $ok, $body = '') {
        $args = array(
            'message' => $message,
            'ok' => $ok,
        );
        if(!empty($body) || is_null($body)) {
            $args['body'] = $body;
            $response = json_encode($args);
            return $response;
        }
        $response = json_encode($args);
        return $response;
    }

}