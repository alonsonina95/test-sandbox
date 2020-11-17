<?php

    function emptyTask() {
        $response = new stdClass();
        $response->statusCode = 400;
        $response->message = "Emtpy task entered";
        return json_encode($response);
    }
?>