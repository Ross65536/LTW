<?php

    namespace AjaxReply;

    function returnErrors($errorsArr)
    {
        echo json_encode($errorsArr);
        exit(0);
    }

    function returnNoErrors()
    {
        returnErrors([]);
    }

?>