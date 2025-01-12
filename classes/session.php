<?PHP
class Session {
    public static function ActiverSession(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function validateSession($id, $role) {
           Session::ActiverSession();
            $_SESSION['iduser']=$id;
            $_SESSION['role']=$role;
        

        if (!isset($_SESSION['iduser']) || !isset($_SESSION['role']) ) {
            throw new Exception("utilisateur no connecté");
        }

        return $_SESSION['iduser'];
    }

 public function destroySession(){
    session_unset();
    session_destroy();
 }
}