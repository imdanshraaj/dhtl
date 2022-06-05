<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{
   protected $fillable = [
       'name', 'email', 'address', 'latitude', 'longitude'
   ];

 }