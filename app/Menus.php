<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var  array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var  array
     */
    protected $casts = [
        ''
    ];
} ?>