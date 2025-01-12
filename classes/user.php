<?php 
require_once 'db.php';
require_once 'session.php';
abstract class user{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;
    function __construct($nom,$prenom,$email,$role,$id=null,$password=null)
    {
        $this->id=$id;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->email=$email;
        $this->role=$role;
        $this->password=$password;
    }
    private function setPassword($password){
     $this->password=password_hash($password,PASSWORD_BCRYPT);
    }
    public function __get($attribut) {
        
        if (property_exists($this, $attribut)) {
            return $this->$attribut;
        } else {
           
            echo "L'attribut '$attribut' n'existe pas.";
        }
    }


    abstract static public function login($email, $password);

    private function  insertion(){
        $db=database::getInstance()->getConnection();
        try {
            // if($this->id){
            //   $stmt=$db->prepare("UPDATE user  set  ");
            // }else{
                $stmt=$db->prepare("INSERT INTO user(nom, prenom, email, password, role)
                                    Value(?,?,?,?,?)");
                $stmt->execute([$this->nom,$this->prenom,$this->email,$this->password,$this->role]);
                $this->id=$db->lastInsertId();
            // }


        } catch (PDOException $e) {
           $e->getMessage();
        }
       
    }

    public static function MailExist($email) {
        $db = database::getInstance()->getConnection();
        try {
            $stmt = $db->prepare("SELECT COUNT(*) as count FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetch();
            return $result['count'] > 0;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la vérification de l'email : " . $e->getMessage());
        }
    }

    public static function inscrire($nom,$prenom,$email,$role, $password){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);// suprimme les caractéres ilegale
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        htmlspecialchars(trim($nom));
        htmlspecialchars(trim($prenom));
        $user=new static($nom,$prenom,$email,$role,$password);
        $user->setPassword($password);
        $user->insertion();
        Session::ActiverSession();
        $_SESSION['success'] = "inscription avec success !"; 
        header('location: ../front/connexion.php'); 
        exit();

    }
}