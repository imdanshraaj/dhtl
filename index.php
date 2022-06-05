<?php

use app\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

require "bootstrap.php";
require_once "routes.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$route = new Route();

$route->route();

// Capsule::schema()->create('users', function ($table) {
//     $table->increments('id');
//     $table->string('name');
//     $table->string('email')->unique();
//     $table->string('password');
//     $table->boolean('status')->default(1);
//     $table->timestamps();
// });

// Capsule::schema()->create('customers', function ($table) {
//     $table->increments('id');
//     $table->string('name');
//     $table->string('email')->unique();
//     $table->string('address')->nullable();
//     $table->string('latitude')->nullable();
//     $table->string('longitude')->nullable();
//     $table->timestamps();
// });