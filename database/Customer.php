<?php
require "../bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('customers', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->string('email')->unique();
    $table->string('address')->nullable();
    $table->string('latitude')->nullable();
    $table->string('longitude')->nullable();
    $table->timestamps();
});