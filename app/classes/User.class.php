<?php

include_once("Db.class.php");
class User
{
    private $m_sUserName;
    private $m_sName;
    private $m_sLastName;
    private $m_sPassword;
    private $m_sEmail;
    private $m_sGender;
    private $m_sCity;
    private $m_sID;


    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty)
        {
            case "UserName":
                $this->m_sUserName = $p_vValue;
                break;
            case "Name":
                $this->m_sName = $p_vValue;
                break;
            case "LastName":
                $this->m_sLastName = $p_vValue;
                break;
            case "Password":
                $this->m_sPassword = $p_vValue;
                break;
            case "Email":
                $this->m_sEmail = $p_vValue;
            case "Gender":
                $this->m_sGender = $p_vValue;
            case "City":
                $this->m_sCity = $p_vValue;
                break;
            case "ID":
                $this->m_sID = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch($p_sProperty)
        {
            case "UserName":
                return $this->m_sUserName;
                break;
                case "Name":
                return $this->m_sName;
                break;
            case "LastName":
                return $this->m_sLastName;
                break;
            case "Password":
                return $this->m_sPassword;
                break;
            case "Email":
                return $this->m_sEmail;
                break;
              case "Gender":
                return $this->m_sGender;
            case "City":
                return $this->m_sCity;
                break;
            case "ID":
                return $this->m_sID;
                break;
        }

    }


    /*je kan zowel met email als met username inloggen fetch_ASSOC vind wat bij mekaar hoort*/
    public function canLogin() {
        if(!empty($this->m_sUserName) && !empty($this->m_sPassword)){
            $PDO = Db::getInstance();
            $stmt = $PDO->prepare("SELECT * FROM account WHERE gebruikersnaam = :username");
            $stmt->bindValue(":username", $this->m_sUserName, PDO::PARAM_STR );
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $password = $this->m_sPassword;
                $hash = $result['paswoord'];

                if(password_verify($password, $hash)){
                    $this->createSession($result['ID']);
                    return true;
                }
                else{
                    return false;
                }
            }
            else {
                return false;
            }
        }
    }

    public function UsernameAvailable()
    {
        $PDO = Db::getInstance();

        $stm = $PDO->prepare('SELECT * FROM account WHERE gebruikersnaam = :username');
                $stm->bindValue(':username', $this->m_sUserName, $PDO::PARAM_STR);
                $stm->execute();

                if($stm->rowCount() > 0) {
                    return false;
         } else {
                    return true;
         }
 	}
    
    
    public function Edit() {
        $PDO = Db::getInstance();
        $options = ['cost' => 12];
        $protectedPW = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
        /*$sql = "UPDATE users SET 
                    username = :username, 
                    password = :password, 
                    email = :email,  
                    Avatar = :Avatar,  
                    prive = :prive  
                WHERE ID = :ID";*/
        $sql = "UPDATE account SET ";
        
        if (!empty($this->m_sUserName)) {
            $sql .= "username = :username, ";
        }
        
        if (!empty($this->m_sPassword)) {
            $sql .= "paswoord = :password, ";
        }
        
        if (!empty($this->m_sEmail)) {
            $sql .= "email = :email, ";
        }
        
        
        $sql .= "WHERE ID = :ID";
        
        $statement = $PDO->prepare($sql);
        if (!empty($this->m_sUserName)) {
            $statement->bindValue(':username', $this->m_sUserName, PDO::PARAM_STR);
        }
        
        if (!empty($this->m_sPassword)) {
            $statement->bindValue(':password', $protectedPW, PDO::PARAM_STR);
        }
 		
        if (!empty($this->m_sEmail)) {
            $statement->bindValue(':email', $this->m_sEmail, PDO::PARAM_STR);
        }
 		
        $statement->bindValue(':ID', $this->m_sID, PDO::PARAM_STR);
        
        if ($statement->execute()) {
            print_r("Profile Updated");
        } else {
            throw new exception("Could not update your account!");
        }
    }
    
	public function Create()
 	{
 		$PDO = Db::getInstance();
 		$stmt = $PDO->prepare("INSERT INTO account (gebruikersnaam, voornaam, achternaam, paswoord, email, geslacht, gemeente) VALUES (:username, :name, :lastname, :password, :email, :gender, :city);");
        $options = [ 'cost' => 12];
        $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
 		$stmt->bindValue(':username', $this->m_sUserName, PDO::PARAM_STR);
 		$stmt->bindValue(':name', $this->m_sName, PDO::PARAM_STR);
 		$stmt->bindValue(':lastname', $this->m_sLastName, PDO::PARAM_STR);
 		$stmt->bindValue(':password', $password, PDO::PARAM_STR);
 		$stmt->bindValue(':email', $this->m_sEmail, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $this->m_sGender, PDO::PARAM_STR);
        $stmt->bindValue(':city', $this->m_sCity, PDO::PARAM_STR);
        
 		if ($stmt->execute())
        {
            
            
            //query went OK!
            return(true);
           
 		}
		else
 		{
    			// er zijn geen query resultaten, dus query is gefaald
    			throw new Exception('Could not create your account!');
 		}
 	} 
    
    private function createSession($id) {
        session_start();
        $_SESSION["ID"] = $id;
    }
    

}
?>