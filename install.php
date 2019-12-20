<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\User;

// Delete tables if exists
Capsule::schema()->dropIfExists('users');
Capsule::schema()->dropIfExists('tasks');

// Create tables for database

Capsule::schema()->create('users', function ($table) {
	$table->increments('id');
	$table->string('name');
	$table->string('email')->unique();
	$table->string('password');
	$table->boolean('admin')->default(false);
	$table->string('auth_key')->nullable()->unique();
	$table->timestamps();
});

Capsule::schema()->create('tasks', function ($table) {
	$table->increments('id');
	$table->string('name');
	$table->string('email')->index();
	$table->text('text');
	$table->boolean('status')->default(false);
	$table->timestamps();
});



// Create admin user
User::Create([
		'name' => 'admin', 
		'email' => 'admin@admin.com',
		'password' => password_hash('123', PASSWORD_BCRYPT),
		'admin' => 1, 
	]);

