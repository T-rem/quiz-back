<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function startQuiz() {
       dd(csrf_token());
    }

    public function finishQuiz() {
        $data = json_decode(file_get_contents('php://input'), true);

    }

    public function getQuiz() {

    }

    public function postQuiz() {
        $data = json_decode(file_get_contents('php://input'), true);
    }


    public function getQuizList() {
        $data = json_decode(file_get_contents('php://input'), true);
    }

    public function closeQuiz() {
        $data = json_decode(file_get_contents('php://input'), true);
    }

}
