<?php

include_once(__DIR__ . '/ConnectionBase.php');

/**
 * Receives the database object (usualy the global $db) and provides a 'wrapper' class for manipulating the users table
 */
class UsersFacade extends ConnectionBase
{
    /////////////////////////////////////////////////////////////
    ////////// public 
    /////////////////////////////////////////////////////////////
    
    /**
     * @return true if user with $username and $password exists in database (can login)
     */
    public function checkValidUserLoginInfo($username, $password)
    {
        $column = $this->getUsernameRow($username);
        if($column == null)
            return false;
        
        $found_password = $column['password'];

        if($this->verifyPassword($password, $found_password))
            return true;
        else
            return false;
    }

    /**
     * @return true if user with username exists in database
     */
    public function checkUsernameExists($username) 
    {
        return $username != "" && $this->getUsernameRow($username) != null;
    }

    public function checkEmailExists($email) 
    {
        return $email != "" && $this->getEmailRow($email) != null;
    }

    /**
     * @return true if user is succesfully added to database, false if the username or email already exists or some other error happened
     */
    public function addUser($username, $password, $name, $email)
    {
        if($password == "" || $this->checkUsernameExists($username) || $this->checkEmailExists($email) )
            return false;
        
        list($name, $email) = $this->formatNullsForSQL([$name, $email]);

        $hashedPassword = $this->hashPassword($password);

        $stmt = $this->db->prepare(
            "INSERT INTO users (username, password, name, email)
            VALUES (?, ?, ?, ?)"
        );

        $stmt->execute(array($username, $hashedPassword, $name, $email));
        return true;
    }

    /**
     * Returns a map keyed by column name to their value.
     * Secondary Info is stuff like name, email, etc
     * See end of cuntion for column names returned
     */
    public function getSecondaryInfo($username)
    {
        $row = $this->getUsernameRow($username);
        if($row == null)
            return [];
        
        //string cast in case sql column is NULL, for empty string
        return [
            "name" => (string) $row["name"],
            "email" => (string) $row["email"]
        ];
    }

    /**
     * @param array $infoDict same format as returned by getSecondaryInfo()
     * 
     * @return true if sucessfuly updated account
     */
    public function updateSecondaryInfo($username, $infoDict)
    {
        if(! $this->checkUsernameExists($username) )
            return false;
        if($infoDict == null)
            return false;

        list($name, $email) = $this->makeUpdateRow($username, $infoDict);
        
        $stmt = $this->db->prepare(
            "UPDATE users 
            SET name = ?, email = ?
            WHERE username = ?"
        );

        $stmt->execute([$name, $email, $username]);
        return true;
    }

    public function updatePassword($username, $password)
    {
        if($password == "" || ! $this->checkUsernameExists($username) )
            return false;

        $hashedPass = $this->hashPassword($password);
        
        $stmt = $this->db->prepare(
            "UPDATE users 
            SET password = ?
            WHERE username = ?"
        );

        $stmt->execute([$hashedPass, $username]);
        return true;
    }


    /////////////////////////////////////////////////////////////
    ////////// non-public
    /////////////////////////////////////////////////////////////

    private function makeUpdateRow($username, $info)
    {
        $row = $this->getUsernameRow($username);
        $retList = [];

        $retList[0] = array_key_exists('name', $info) ? $info['name'] : $row['name'];
        $retList[1] = array_key_exists('email', $info) ? $info['email'] : $row['email'];

        $retList = $this->formatNullsForSQL($retList);
        return $retList;
    }

    private function formatNullsForSQL($attrList)
    {
        foreach($attrList as &$attr)
            if($attr === "")
                $attr = null; //will insert NULL into SQL database

        return $attrList;
    }

    /**
     * 
     */
    private function validateAndFormatUpdateInput(&$name, &$email)
    {
        $isEmailEmpty = $email == "";
        $isNameEmpty = $name == "";

        if($isEmailEmpty) 
            $email = null; //will insert NULL into SQL database
        if($isNameEmpty)
            $name = null;

        $isOneNotEmpty = ! ( $isEmailEmpty && $isNameEmpty );
        return $isOneNotEmpty;
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    /**
     * @return array containing the columns that correspond to the username, null is returned if username doesn't exist
     */
    private function getUsernameRow ($username)
    {
        $stmt = $this->db->prepare(
            "SELECT * 
            FROM users 
            WHERE users.username = ?"
        );
        
        $stmt->execute(array($username));

        return $stmt->fetch();
    }

    private function getEmailRow ($email)
    {
        $stmt = $this->db->prepare(
            "SELECT * 
            FROM users 
            WHERE users.email = ?"
        );
        
        $stmt->execute(array($email));

        return $stmt->fetch();
    }
}
?>