<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\notas;
use Core\Session;
use Core\Request;

class EditNotaController extends Controller {
    private $session;
    public function __construct() {
        $this->session = Session::getInstance();
    }
    public function index(Request $request) {
        if ($request->isMethod('get')) {
            $this->view('editNota');
        } else {
            $value = $request->post('btn1');
            $get = new Notas();
            $content = $get->getEditNote($value);
            if($content) {
                $this->session->set('noteData', $content);
                $this->view('editNota', ['content' => $content]);
            }
        }
    }
    public function update(Request $request) {
        if ($request->isMethod('get')) {
            $this->view('inicial');
        } else {
            $notaname = $request->post('notaname');
            $note = preg_replace("/\s+/", "", $request->post('note'));
            $text = $request->post('text');

            $user = $this->session->get('user');

            $idNote = $this->session->get('noteData');

            $data = [
                'id_note' => $idNote[0]['id_note'],
                'nota_name' => $notaname,
                'priority_note' => $note,
                'note_text ' =>  $text,
                'id_user' =>  $user['id_user'],
            ];
            $update = new Notas();
            $error = $update->updateNotes($data);

            if($error == true) {
                $this->redirect('\incial');
            } else {
                $this->redirect('\inicial');
            }
        }
    }
}