<?php 
    session_start();
    require_once "control/services/viewAdminLogin.php";
    require_once "control/services/mysqlDB.php";
    // require_once "model/member.php";

    class adminLoginController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_adminLoginpage(){
            return View::createView('adminLogin.php', []);
        }

        // [ Function Uneditted]

        // public function klik_login(){
        //     $uname = $_POST['uname'];
        //     $upass = $_POST['upass'];

        //     if(isset($uname) && $uname!="" && isset($upass) && $uname!=""){
        //         $uname = $this->db->escapeString($uname);
        //         $upass = $this->db->escapeString($upass);
                
        //         $query = "SELECT p.pass
        //                   FROM member m INNER JOIN pengguna p
        //                   ON m.id_pengguna = p.id_pengguna
        //                   WHERE m.id_pengguna = (SELECT id_pengguna FROM pengguna WHERE nama_user = '$uname')
        //                  ";
        //         $pass_asli = $this->db->executeSelectQuery($query);

        //         //kalo username tdk tercantum di tabel MEMBER --> how biar ga redirect?
        //         if(empty($pass_asli)){
        //             $_SESSION['unameNotFound'] = 0;
        //             header('Location: userLogin');

        //         }else{
        //             //password benar
        //             if($upass == $pass_asli[0]['pass']){
        //                 $query = "SELECT email, kontak, alamat, saldo 
        //                           FROM member m INNER JOIN pengguna p
        //                           ON m.id_pengguna = p.id_pengguna
        //                           WHERE nama_user = '$uname' AND pass = '$upass'
        //                         ";
        //                 $resQuery = $this->db->executeSelectQuery($query);

        //                 $_SESSION['status'] = 1;
        //                 $_SESSION['uname'] = $uname;
        //                 $_SESSION['pass'] = $upass;
        //                 $_SESSION['email'] = $resQuery[0]['email'];
        //                 $_SESSION['phone'] = $resQuery[0]['kontak'];
        //                 $_SESSION['alamat'] = $resQuery[0]['alamat'];
        //                 if($resQuery[0]['saldo'] == '0.000'){
        //                     $_SESSION['saldo'] = 0;
        //                 }else{
        //                     $_SESSION['saldo'] = $resQuery[0]['saldo'];
        //                 }
        //                 header('Location: index?status=1');

        //             //password salah
        //             }else{
        //                 $_SESSION['unameNotFound'] = $uname;
        //                 header('Location: userLogin');
        //             }
        //         }
        //     }
        // }
    }
?>