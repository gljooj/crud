<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillabe = ['firstName','lastName','age', 'sex'];
	private $rules = array(
		'firstName' =>'required|min: 1|max:50',
		'lastName' => 'required|min: 1|max:50',
		'age' => 'required|min:2|max:2',
		'gender' => 'required');
}
