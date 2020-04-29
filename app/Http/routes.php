<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::get('/hello', function () {
    $databaseName = Config::get('database.connections.'.Config::get('database.default'));

    // dd($databaseName['database']);
    //echo ($databaseName['host']);
    return view('cutpic',['host'=>$databaseName]);
});

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    /*
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });
    */
    Route::auth();
    Route::group(['middleware' => 'auth'], function () {
        // 後台相關的路由請設置在這裡，將包含權限驗證
        Route::get('/', ['as' => 'backend.index', 'uses' => 'IndexController@index']);
        // 登出
        Route::post('/logout', function () {
            Auth::logout();
            return redirect('/backend');
        });
    Route::get('/', function () {
        //return view('tasks');
        
        $tasks = Task::orderBy('created_at', 'asc')->get();
        
        return view('tasks', [
            'tasks' => $tasks
        ]);
        
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        //user_id
        $user = App\User::find(1);

        foreach ($user->tasks as $task) {
            echo $task->name;
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });
});

});
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
