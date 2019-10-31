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

        public static function successResponseWithPageCount($records, $pages) {

            echo json_encode(array(
                'success' => true,
                'count' => count($records),
                'pages' => $pages,
                'records' => $records
            ));

        }

    }

?>