<?php

namespace api\src\controller\close;

use api\src\setting\Connecting;
use api\src\setting\close;

class DELETEController 
{
    public function DELETE($id_file, $user_id)
    {
        $database = new Connecting();
        $db = $database->getConnection();

        $close = new Close($db);

        if ($close->delete($id_file, $user_id)) {
            http_response_code(200);
            $res = [
                "status" => true,
                "massage" => 'файл был обновлён.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            $res = [
                "status" => false,
                "massage" => 'Невозможно обновить файл.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);

        }
    }
}