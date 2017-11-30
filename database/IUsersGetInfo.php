<?php


interface IUsersGetInfo
{

    /**
     * Returns a map keyed by column name to their value.
     * Secondary Info is stuff like name, email, etc
     * See end of funtion for column names returned
     */
    public function getSecondaryInfo($username);
}

?>