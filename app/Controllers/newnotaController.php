<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Notas;
use Core\Request;
use Core\Session;

class NewNotaController extends Controller {

    private $session;

    public function __construct() {
        $this->session = Session::getInstance();
    }

    public function index(Request $request) {
        if($this->session->get('user')) {
            if ($request->isMethod('get')) {
                $this->view('newnota');
            } else {
                $notaname = $request->post('NotaName');
                $note = preg_replace("/\s+/", "", $request->post('note'));
                $text = $request->post('text');
                $user = $this->session->get('user');
                $data = [
                    'nota_name' =>$notaname,
                    'priority_note' => $note,
                    'note_text ' => $text,
                    'id_user' =>  $user['id_user'],
                ];
                $record = new Notas;
                $error = $record->record($data);
                if($error == true) {
                    $this->redirect('\inicial');
                } else {
                    $this->redirect('\inicial');
                }
            }
        } else {
            $this->redirect('/login');
        }
    }   
}        
