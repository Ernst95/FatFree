<?php

    class Response {

        public static function successResponse($records) {

            echo json_encode(array(
                'success' => true,
                'count' => count($records),
                'records' => $records
            ));

        }

        public static function successMessage($message){

            echo json_encode(array(
                'success' => true,
                'message' => $message,
            ));

        }

    }

?>