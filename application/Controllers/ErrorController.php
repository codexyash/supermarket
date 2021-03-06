<?php

namespace Application\Controllers;

class ErrorController {

    public function __construct() {
        
    }

    public function notFound() {
        $headers = \getallheaders();

        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');

        if (isset($headers['Accept']) && $headers['Accept'] == 'application/json') {
            json_response(['error' => true, 'message' => 'E_404_NOT_FOUND', 'data' => 'The requested URL can not be found.'], 404);
            return;
        }
        
        echo '<div style="height:auto; min-height:100%; ">     <div style="text-align: center; width:800px; margin-left: -400px; position:absolute; top: 30%; left:50%;">
                <h1 style="margin:0; font-size:150px; line-height:150px; font-weight:bold;">404</h1>
                <h2 style="margin-top:20px;font-size: 30px;">Not Found
                </h2>

                <p>The resource requested could not be found on this server!</p>
            </div></div>';
    }

}
