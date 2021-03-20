<?php

namespace AmpedWeb\LaravelBackpackMegaMenu\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MegaMenu extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['name', 'description', 'menu_json'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mega_menus';


    /**
     * @param $value
     *
     * @return Collection
     */
    public function getMenuAttribute(): Collection
    {
        return collect(json_decode($this->menu_json,true));
    }
}
