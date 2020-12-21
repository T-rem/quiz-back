<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function startQuiz() {
        //вернуть json без овтетов
        $res = [];
        $quiz_name = \request('name');
        $quiz = Quiz::where('name', $quiz_name)->first();
        $res['name'] = $quiz_name;

        $questions = Question::where('quiz_id', $quiz->id)->get();
        foreach ($questions as $k => $v) {
            $res += [$k => ['name'=>$v['name']]];
            $answers = Answers::where('question_id', $v['id'])->get();
            foreach ($answers as $ki => $vi) {
                $res[$k] += [$ki => $vi['name']];
            }
        }
        return $res;
    }

    public function getActiveQuizList() {
        $res = [];
        $activeQuizzes = Quiz::where('is_active', true)->get();

        foreach ($activeQuizzes as $k => $v){
            $res[] = [$k => ['id' => $v->id, 'name' =>$v->name, 'author' => $v->user_id, "date" => $v->created_at]];
        }

        return $res;
    }

    public function getQuizById($id) {
        $res = [];
        $activeQuiz = Quiz::where('id', $id)->first();

        $res[] = ['id' => $activeQuiz->id, 'name' =>$activeQuiz->name, 'author' => $activeQuiz->user_id, "date" => $activeQuiz->created_at];

        return $res;
    }

    public function getQuiz() {
        //вернуть json с ответами

        $res = [];
        $quiz_name = \request('name');
        $quiz = Quiz::where('name', $quiz_name)->first();
        $res['name'] = $quiz_name;

        $questions = Question::where('quiz_id', $quiz->id)->get();
        foreach ($questions as $k => $v) {
            $res += [$k => ['name'=>$v['name']]];
            $answers = Answers::where('question_id', $v['id'])->get();
            foreach ($answers as $ki => $vi) {
                $res[$k] += [$ki => ['answer' => $vi['name'], "isCorrect" => $vi['is_correct'] == 1]];
            }
        }
        return $res;
    }

    public function postQuiz() {
        $user = \request('author');
        $quiz_name = \request('name');
        $questions = \request('questions');

        $user_id = User::where('name', $user)->first();
        $quiz = Quiz::create([
            'user_id' => $user_id,
            'name' => $quiz_name,
            'is_active' => false
        ]);

        $quiz_id = $quiz->id;

        foreach ($questions as $question) {

            $quest = Question::create([
                'name' => $question['text'],
                'quiz_id' => $quiz_id
            ]);

            $question_id = $quest->id;

            foreach ($question['variants'] as $variant) {
                Answers::create([
                    'question_id' => $question_id,
                    'name' => $variant['text'],
                    'is_correct' => isset($variant['isTrue']),
                ]);
            }
        }

        return 'ok';
    }


    public function getQuizList() {
        $data = json_decode(file_get_contents('php://input'), true);
    }

    public function closeQuiz() {
        $data = json_decode(file_get_contents('php://input'), true);
    }

}
