<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\notas;
use Core\Session;
use Core\Request;

class InicialController extends Controller {

    private $session;

    public function __construct() {
        $this->session = Session::getInstance();
    }

    public function index() {
        if($this->session->get('user')) {
            $getNotes = new Notas();
            $allNotes = $getNotes->getAll();

            $user = $this->session->get('user');
            
            $content = [
                'allNotes' => $allNotes,
                'user' => $user,
            ];
            
            $this->view('inicial', $content);
        } else {
            $this->redirect('/login');
        }
    }

    public function delete(Request $request) {
        $value = $request->post('btn2');

        $delete = new Notas();
        $delete->deleteNotes($value);

        $this->redirect('\inicial');
    }
}