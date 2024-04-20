<?php

class ResponseHelper
{
    public function Response($success, $message = '', $data = null)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
        //header('Content-Type: application/json');
        echo json_encode($response);
    }
}
