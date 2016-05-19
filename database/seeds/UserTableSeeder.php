<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // create admin
        $data = [
            'username'  => 'max',
            'email'     => 'max@gmx.de',
            'password'  => env('DEFAULT_PW', 'test24!'),
        ];

        $user = Sentry::register($data, true);

        $group = Sentry::findGroupByName('admin');
        $user->addGroup($group);

        // create organizer user
        $data = [
            'username'  => 'bonding',
            'email'     => 'info@bonding.de',
            'password'  => env('DEFAULT_PW', 'test24!'),
        ];

        $user = Sentry::register($data, true);

        $group = Sentry::findGroupByName('organizer');
        $user->addGroup($group);

        // create company user
        $data = [
            'username'  => 'adidas',
            'email' 	=> 'info@adidas.de',
            'password'  => env('DEFAULT_PW', 'test24!'),
        ];

        $user = Sentry::register($data, true);

        $group = Sentry::findGroupByName('company');
        $user->addGroup($group);

        // create company user
        $data = [
            'username'  => 'adidas2',
            'email' 	=> 'info@adidas2.de',
            'password'  => env('DEFAULT_PW', 'test24!'),
        ];

        $user = Sentry::register($data, true);

        $group = Sentry::findGroupByName('company');
        $user->addGroup($group);

        // create applicant
        $data = [
            'username'  => 'max.herttrich',
            'email' 	=> 'max.herttrich@gmx.de',
            'password'  => env('DEFAULT_PW', 'test24!'),
        ];

        $user = Sentry::register($data, true);

        $group = Sentry::findGroupByName('applicant');
        $user->addGroup($group);

        DB::insert("INSERT INTO applicants (user_id, name, created_at, updated_at) VALUES ($user->id, 'Max Herttrich', NOW(), NOW())");

    }
}