<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respond extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'responds';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['id_post','id_us_res','respond'];
}
