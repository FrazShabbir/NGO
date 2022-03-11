<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(! User::find(1)){
            $user = new User();
            $user->name = 'John Doe';
            $user->password = bcrypt('admin');
            $user->email = 'admin@wisevision.ai';
            $user->email_verified_at = now();
            $user->is_admin = 1;
            $user->verified_by_admin = 1;
            $user->save();
        }
    }
}
