<?php

Class StatusCodes{

    static $codes = [
        200 => "OK",
        400 => "Bad Request",
        406 => "Not Acceptable",
        409 => "Conflict",
        401 => "Unauthorized",
        404 => "Not Found"
    ];

    static function getCode($code){
        return self::$codes[$code];
    }

}
