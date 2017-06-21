<?php

use App\Entities\Scientist;
use App\Entities\Theory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/add-scientish', function () {
    $scientist = new Scientist(
        'Albert', 
        'Einstein'
    );

    $scientist->addTheory(
        new Theory('Theory of relativity')
    );

    EntityManager::persist($scientist);
    EntityManager::flush();
});

Route::get('/scientish', function () {
    $scientist = EntityManager::find(Scientist::class, 1);
    dd($scientist);
});

Route::get('test-add', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $task = new \App\Entities\Task('Make test app', 'Create the test application for the Sitepoint article.');

    $em->persist($task);
    $em->flush();

    return 'added!';
});

Route::get('test-find', function (\Doctrine\ORM\EntityManagerInterface $em) {
    /* @var \App\Entities\Task $task */
    $task = $em->find(App\Entities\Task::class, 4);

    return $task->getName() . ' - ' . $task->getDescription();
});

Route::get('view-index', 'TaskController@getIndex');
Route::get('view-add', 'TaskController@getAdd');
Route::post('add', 'TaskController@postAdd');
Route::get('view-edit/{id}', 'TaskController@getEdit');
Route::post('edit/{id}', 'TaskController@postEdit');
Route::get('delete/{id}', 'TaskController@getDelete');
Route::get('toggle/{id}', 'TaskController@getToggle');

Route::get('test-rel', function(\Doctrine\ORM\EntityManagerInterface $em) {
    $user = new \App\Entities\User(
        'Francesco',
        'francescomalatesta@live.it'
    );

    $user->addTask(new \App\Entities\Task(
        'Buy milk',
        'Because it is healthy'
    ));

    $user->addTask(new \App\Entities\Task(
        'Buy chocolate',
        'Because it is good'
    ));

    $em->persist($user);
    $em->flush();

    return 'Done!';
});

Route::group(['middleware' => ['web']], function () {
    Route::get('test-user', function(\Doctrine\ORM\EntityManagerInterface $em) {
        $user = new \App\Entities\User('Francesco', 'francescomalatesta@live.it');
        $user->setPassword(bcrypt('123456'));

        $em->persist($user);
        $em->flush();
    });

    Route::get('login', function() {
        return view('login');
    });

    Route::post('login', function(\Illuminate\Http\Request $request) {
        if(\Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])) {
            return redirect('/view-index');
        }
            return redirect('login')->with('error_message', 'These credentials do not match our records!');
    });

    Route::get('logout', function() {
        \Auth::logout();
        return redirect('login');
    });

    Route::group(['middleware' => ['auth']], function () {
            return redirect('/view-index');
    });
});