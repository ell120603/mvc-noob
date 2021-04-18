<?php 

namespace App\Models;

use Core\Database;

include 'Usuario.php';

class UserDB {
    private $table = "users";

    public function getAll() {
        $db = Database::getInstance();
        return $db->getList($this->table, '*');
    }
    public function record($data) {
        $db = Database::getInstance();

        if (!empty($data['email_user']) and !empty($data['name_user']) and !empty($data['password_user'])) {
            if (filter_var($data['email_user'], FILTER_VALIDATE_EMAIL)) {
                $emailList = $db->getList($this->table, '*', ['email_user' => $data['email_user']]);
                foreach($emailList as $db) {
                    $email = $db['email_user'];
                }
                if ($data['email_user'] != $email) {
                    if (strlen($data['name_user']) < 60) {
                        if (strlen($data['name_user']) > 3) {
                            if (strlen($data['password_user']) > 7) {
                                if (strlen($data['password_user']) < 16) {
                                    $db->insert($this->table, $data);
                                    header('location: \exibir');
                                } else {
                                    header('location: \register');
                                }
                            } else {
                                header('location: \register');
                            }
                        } else {
                            header('location: \register');
                        }
                    } else {
                        header('location: \register');
                    }
                } else {
                    header('location: \register');
                }
            } else {
                header('location: \register');
            }
        } else {
            header('location: \register');
        }
    }
}




