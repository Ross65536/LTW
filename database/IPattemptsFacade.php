<?php
include_once(__DIR__ . '/ConnectionBase.php');

class IPattemptsFacade extends ConnectionBase
{
    public function getNumAttempts($ip)
    {
        if(! $this->checkIPLogged($ip))
            throw new Exception("Invalid Use of method");

        $row = $this->getIPRow($ip);
        return $row["num_attempts"];
    }

    public function checkIPLogged($ip)
    {
        return $ip != "" && $this->getIPRow($ip) != null;
    } 

    public function tryAddingIP($ip)
    {
        if(! $this->checkIPLogged($ip))
        {
            $stmt = $this->db->prepare(
                "INSERT INTO IPattempts (ip) VALUES (?)"
            );
    
            $stmt->execute(array($ip));
            return true;
        }
        else 
            return false;
    }

    public function incrementNumAttempts($ip)
    {
        if(! $this->checkIPLogged($ip))
            throw new Exception("Invalid Use of method");

        $stmt = $this->db->prepare(
            "UPDATE IPattempts 
            SET num_attempts = num_attempts + 1
            WHERE ip = (?)"
        );

        $stmt->execute(array($ip));
    }

    public function resetNumAttempts($ip)
    {
        if(! $this->checkIPLogged($ip))
            throw new Exception("Invalid Use of method");

        $stmt = $this->db->prepare(
            "UPDATE IPattempts 
            SET num_attempts = 0
            WHERE ip = (?)"
        );

        $stmt->execute(array($ip));
    }

    private function getIPRow($ip)
    {
        $stmt = $this->db->prepare(
            "SELECT *
            FROM IPattempts
            WHERE IPattempts.ip = ?"
        );

        $stmt->execute(array($ip));

        return $stmt->fetch();
    }
}
?>
