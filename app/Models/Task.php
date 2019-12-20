<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Task extends Eloquent
{
	protected $fillable = ['name', 'email', 'text'];
	protected $hidden = [];
	
	
	
	
	
}
