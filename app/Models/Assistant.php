<?php
/**
 * Created by PhpStorm.
 * User: mshedid
 * Date: 3/28/19
 * Time: 12:48 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $table = 'users';
    protected $guarded = ['id'];

    /**
     * Get the parent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get all tickets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'assigned_user_id');
    }
}