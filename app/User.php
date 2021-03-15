<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name','last_name','age', 'gender'];
	private $rules = array(
		'firstName' =>'required|min: 1|max:50',
		'lastName' => 'required|min: 1|max:50',
		'age' => 'required|min:2|max:2',
		'gender' => 'required');
}
