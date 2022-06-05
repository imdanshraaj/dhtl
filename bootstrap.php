<?php

require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
   "driver" => "mysql",
   "host" =>"localhost",
   "database" => "dhtl",
   "username" => "root",
   "password" => "password"
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();