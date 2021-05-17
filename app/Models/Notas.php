<?php 

namespace App\Models;

use Core\Database;
use Core\Session;

class Notas {
    private $table = "notes";
    public function record($data) {
        $db = Database::getInstance();

        if (!empty($data['nota_name']) and !empty($data['priority_note']) and !empty($data['note_text'])) {
            if (strlen($data['nota_name']) < 31 && strlen($data['priority_note']) < 3 && $data['priority_note'] < 11) {
                if ($data['priority_note'] > 0 && strlen($data['note_text']) > 4 && strlen($data['note_text']) < 501) {
                    $db->insert($this->table, $data);
                    return true;       
                }
            }
        }
        return false;
    }

    public function getAll() {
        $db = Database::getInstance();
        $session = Session::getInstance();
        $user = $session->get('user');
        return $db->getList($this->table, '*', ['id_user' => $user['id_user']]);
    }
    public function deleteNotes($value) {
        $db = Database::getInstance();
        return $db->delete($this->table, ['id_note' => $value]);
    }
    public function getEditNote($value) {
        $db = Database::getInstance();
        return $db->getList($this->table, '*', ['id_note' => $value]);
    }

    public function updateNotes($data) {
        $db = Database::getInstance();

        if(!empty($data['id_note']) && !empty($data['nota_name']) && !empty($data['priority_note']) && !empty($data['note_text']) && !empty($data['id_user'])) {
            if (strlen($data['nota_name']) < 31 && strlen($data['priority_note']) < 3 && $data['priority_note'] < 11) {
                if ($data['priority_note'] > 0 && strlen($data['note_text']) > 4 && strlen($data['note_text']) < 501) {
                    $db->update($this->table, $data, ['id_note' => $data['id_user']]);
                    return true;
                }
            }
        }

        return false;
    }
}
