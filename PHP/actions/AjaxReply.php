<?php

    namespace AjaxReply;

    function returnErrors($errorsArr)
    {
        echo json_encode($errorsArr);
        exit(0);
    }

    function returnError($error)
    {
        returnErrors([$error]);
    }

    function returnNoErrors()
    {
        returnErrors([]);
    }

?>
