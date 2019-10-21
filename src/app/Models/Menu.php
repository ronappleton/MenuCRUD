<?php

namespace Backpack\MenuCRUD\app\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Menu extends Model
{
    use CrudTrait;

    protected $table = 'menus';
    protected $fillable = ['name', 'slug', 'description'];
}
