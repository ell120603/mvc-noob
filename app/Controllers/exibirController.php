<?php

namespace App\Controllers;
use Core\Request;
use App\Models\UserDB;
use Core\Controller;

class ExibirController extends Controller {

    public function index() {
        $this->view('exibir');
    }
    public function exibir(){
        $getUsers = new UserDB;
        $allUsers = $getUsers->getAll();

        $content = [
            'allUsers' => $allUsers,
        ];
        $this->view('exibir',$content); 
       var_dump($content);
    }
}
