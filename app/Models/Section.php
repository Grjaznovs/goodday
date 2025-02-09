<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Section extends Model
{
    use SoftDeletes;
    use HasRoles;

    const BLOG = 'blog';
    const NEWS = 'news';
    const ROLE = 'role';
    const USER = 'user';

    protected $table = 'c_sections';
    protected $guard_name = ['web'];

    protected $fillable = [
        'name', 'code', 'order'
    ];

    protected $casts = [
        'order' => 'int'
    ];
}
