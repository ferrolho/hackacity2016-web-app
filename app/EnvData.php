<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvData extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'envdata';

    /**
     * Disable Laravel's Eloquent timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timestamp',
        'coord_x',
        'coord_y',

        'co',
        'no2',
        'proc_no2',
        'o3',
        'proc_o3',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}
