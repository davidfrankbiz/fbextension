<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    protected $table = 'facebooks';
    protected $fillable = ['facebook','res_j','ip_address'];
}
