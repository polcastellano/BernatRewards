<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@demo.com',
            'password' => bcrypt('12345678'),
            'puntos' => 10000,
            'experience' => 100000,
            'telephone' => 618849375,
            'birthday' => "2000/01/01",
            'address' =>" Carrer Ntra. Sra. de Lourdes, 34",
        ]);

        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $role3 = Role::create(['name' => 'teacher']);

        $permissions = [
            'recompensa-list',
            'user-edit',
        ];

        $permissions_teacher = [
            'role-list',
            'user-list',
            'student-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-all',
            'post-list',
            'post-create',
            'post-edit',
            'post-all',
            'post-delete',
            'exercise-list',
            'exercise-create',
            'exercise-edit',
            'exercise-all',
            'exercise-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'recompensa-list',
            'recompensa-create',
            'recompensa-edit',
            'recompensa-all',
            'recompensa-delete'
        ];

        $role2->syncPermissions($permissions);
        Category::create(['name' => 'Vue.js']);
        Category::create(['name' => 'Cat 2']);

        $role3->syncPermissions($permissions_teacher);


        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
