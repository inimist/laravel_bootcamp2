<?php

use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    ['prefix' => 'v1', 'namespace' => 'Api'],
    function (Router $router) {
        Route::get('/', function () {
            return "Did you forget where you placed your keys??";
        });
    }
);

Route::group([
    'prefix' => '/v1',
    'namespace' => 'api',
], function () {
    //ALL USERS WHO HAS VERIFIED THEIR EMAIL ACCOUNTS
    Route::middleware(['auth:api', 'verified'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        //Question Routes
        Route::post('/question/create', [App\Http\Controllers\API\QuestionController::class, 'store']);
        Route::get('/question', [App\Http\Controllers\API\QuestionController::class, 'index']); // all question 
        Route::get('/quiz-question/{quizid}', [App\Http\Controllers\API\QuestionController::class, 'quizQuestions']); // quiz question get 
        Route::get('/question/edit/{id}', [App\Http\Controllers\API\QuestionController::class, 'edit']);
        Route::put('/question/update/{id}', [App\Http\Controllers\API\QuestionController::class, 'update']);
        Route::delete('/question/delete/{question}', [App\Http\Controllers\API\QuestionController::class, 'destroy']);

        //QuestionAnswer Routes
        // Route::post('/question_answer/create', [App\Http\Controllers\API\QuestionAnswerController::class, 'store']);

        //Quiz Routes
        Route::post('/quiz/create', [App\Http\Controllers\API\QuizController::class, 'store']);
        Route::get('/quiz', [App\Http\Controllers\API\QuizController::class, 'index']);
        Route::get('/quiz/show/{id}', [App\Http\Controllers\API\QuizController::class, 'show']);
        Route::get('/quiz/edit/{id}', [App\Http\Controllers\API\QuizController::class, 'edit']);
        Route::put('/quiz/update/{id}', [App\Http\Controllers\API\QuizController::class, 'update']); // adding question to quiz all selected at once
        Route::delete('/quiz/delete/{quiz}', [App\Http\Controllers\API\QuizController::class, 'destroy']);
        Route::post('/quiz/quiz-question', [App\Http\Controllers\API\QuizController::class, 'quizQuestion']); // adding quesion to quiz single by single

        //Quiz_attempts Route
        Route::post('/quizAttempt/create', [App\Http\Controllers\API\QuizAttemptController::class, 'store']);
        Route::get('/quizAttempt/show/{id}', [App\Http\Controllers\API\QuizAttemptController::class, 'show']);

        //Question_attempts Route
        Route::post('/questionAttempt/create', [App\Http\Controllers\API\QuestionAttemptController::class, 'store']);
        Route::get('/questionAttempt/show/{id}', [App\Http\Controllers\API\QuestionAttemptController::class, 'show']);

        //QuizSlot here adding question to the quiz routes
        // Route::post('/quiz/question/add', [App\Http\Controllers\API\QuizController::class, 'quizSlot']);

        //QuestionType
        Route::get('questionType', [App\Http\Controllers\API\QuestionTypeController::class, 'index']);

        //To restore all deleted data
        Route::get('/question/restoreAll', [App\Http\Controllers\API\QuestionController::class, 'restoreAll']);

        Route::post('/user', [App\Http\Controllers\API\UserController::class, 'store']);
        Route::get('/user', [App\Http\Controllers\API\UserController::class, 'index']);
        Route::get('/user/{user}', [App\Http\Controllers\API\UserController::class, 'show']);
        Route::put('/user/{user}', [App\Http\Controllers\API\UserController::class, 'update']);
        Route::delete('/user/{user}', [App\Http\Controllers\API\UserController::class, 'delete']);
    });

    Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
    Route::post('/signup', [App\Http\Controllers\API\AuthController::class, 'signup']);
    Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'signup']);
});
