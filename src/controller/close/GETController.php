<?php

namespace api\src\controller\close;

use api\src\setting\Connecting;
use api\src\setting\close;

class GETController 
{
    public function GET($id_file)
    {
        $database = new Connecting();
        $db = $database->getConnection();

        $close = new Close($db);

        $close->get($id_file);
    
    }
}