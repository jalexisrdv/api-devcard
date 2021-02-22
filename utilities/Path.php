<?php

class Path {

    public static function getRootPath() {
        return realpath($_SERVER["DOCUMENT_ROOT"]) . '/api_devcard';
    }

}