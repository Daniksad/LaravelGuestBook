<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $email
 * @property string $content
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Posts extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['email', 'content', 'status', 'created_at', 'updated_at'];

}
