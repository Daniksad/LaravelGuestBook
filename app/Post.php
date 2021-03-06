<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $email
 */
class Post extends Model
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
    protected $fillable = ['parent_id', 'name', 'content', 'status', 'created_at', 'updated_at', 'email'];

}
