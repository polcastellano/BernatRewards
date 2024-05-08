<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\api\RecompensaController;
use App\Http\Controllers\api\CategoriaController;
use App\Http\Controllers\api\NivelController;
use App\Http\Controllers\api\PedidoController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;

Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');

//Api Tareas
Route::get('tasks', [TaskController::class, 'index']);
Route::post('tasks/', [TaskController::class, 'store']);
Route::put('tasks/update/{id}', [TaskController::class, 'update']);
Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
Route::get('tasks/{id}', [TaskController::class, 'edit']);

//Api Recompensas
Route::get('recompensas', [RecompensaController::class, 'index']);
Route::post('recompensas/', [RecompensaController::class, 'store']);
Route::post('recompensas/update/{id}', [RecompensaController::class, 'update']);
Route::delete('recompensas/{recompensa}', [RecompensaController::class, 'destroy']);
Route::get('recompensas/{recompensa}', [RecompensaController::class, 'show']);
Route::get('get-recompensa-category/{id}', [RecompensaController::class, 'getRecompensaByCategory']);
Route::get('recompensas/getRecompensa/{recompensa}', [RecompensaController::class, 'getRecompensa']);


//Api Categorias
Route::get('categorias', [CategoriaController::class, 'index']);
Route::post('categorias/', [CategoriaController::class, 'store']);
Route::put('categorias/update/{id}', [CategoriaController::class, 'update']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);
Route::get('lista-categorias', [CategoriaController::class, 'getCategorias']);

//Api Pedidos
Route::get('pedidos', [PedidoController::class, 'index']);
Route::post('pedidos/', [PedidoController::class, 'store']);
Route::put('pedidos/update/{id}', [PedidoController::class, 'update']);
Route::delete('pedidos/{id}', [PedidoController::class, 'destroy']);
Route::get('getPedidosUser/{id}', [PedidoController::class, 'getPedidosUser']);


//Api Niveles
Route::get('niveles', [NivelController::class, 'index']);
Route::post('niveles/', [NivelController::class, 'store']);
Route::put('niveles/update/{id}', [NivelController::class, 'update']);
Route::delete('niveles/{id}', [NivelController::class, 'destroy']);

//Api User
Route::get('getUserLogeado/{id}', [UserController::class, 'getUserLogeado']);
Route::get('getUsuMedia/{id}', [UserController::class, 'getUsuMedia']);
Route::get('getStudents', [UserController::class, 'getStudents']);



Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('users', UserController::class);
    Route::post('users/update/{user}', [UserController::class, 'update']);
    Route::post('users/updatePts/{id}', [UserController::class, 'updatePts']);
    Route::post('users/removePts/{id}', [UserController::class, 'removePts']);

    Route::apiResource('posts', PostController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);
    //Route::apiResource('exercises', ExerciseController::class);
    Route::post('exercises/', [ExerciseController::class,'store']); //Guardar
    Route::get('exercises', [ExerciseController::class,'index']); //Listar
    Route::get('exercises/{exercise}', [ExerciseController::class,'show']); //Mostrar
    Route::post('exercises/update/{id}', [ExerciseController::class,'update']); //Editar

    Route::get('role-list', [RoleController::class, 'getList']);
    Route::get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    Route::put('/role-permissions', [PermissionController::class, 'updateRolePermissions']);
    Route::apiResource('permissions', PermissionController::class);
    Route::get('category-list', [CategoryController::class, 'getList']);
   // Route::apiResource('perfil', ProfileController::class);
   Route::get('perfil/{user}', [ProfileController::class, 'show']);
   Route::post('perfil/update/{user}', [ProfileController::class, 'update']);


    Route::get('/user', [ProfileController::class, 'user']);
    Route::put('/user', [ProfileController::class, 'update']);

    Route::get('abilities', function(Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});


Route::get('category-list', [CategoryController::class, 'getList']);
Route::get('get-posts', [PostController::class, 'getPosts']);
Route::get('get-category-posts/{id}', [PostController::class, 'getCategoryByPosts']);
Route::get('get-post/{id}', [PostController::class, 'getPost']);
