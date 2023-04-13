<?php

namespace App\Core;

class ResponseHandler {
    public static function respondWithError($message, $statusCode){
        http_response_code($statusCode);
        self::outputJSON(["error" => $message]);
        exit;
    }

    public static function respondWithSuccess($message, $data, $statusCode = 200){
        http_response_code($statusCode);

        if ($message && $data) {
            self::outputJSON(["success" => $message, "data" => $data]);
        } else if ($message) {
            self::outputJSON(["success" => $message]);
        } else if ($data) {
            self::outputJSON($data);
        } else {
            self::outputJSON(["success" => "OK"]);
        }

        exit;
    }

    public static function outputJSON(array $array) : void {
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}