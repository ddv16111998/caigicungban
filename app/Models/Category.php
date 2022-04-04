<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'slug', 'parent_id', 'active'];

    CONST ACTIVE = 1;
    CONST INACTIVE = 0;

    const STATUS_LABELS = [
        self::ACTIVE => 'Hoạt động',
        self::INACTIVE => 'Không hoạt động'
    ];


    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->attributes['name']);
    }

    public function posts()
    {
        return $this->hasMany('Post', 'category_id');
    }

    public function searchableAs()
    {
        return 'categories_index';
    }


    public function toSearchableArray()
    {
//        $array = $this->toArray();

        // Customize the data array...

        Category::where('name', '1')->groupBy('name')->having();
        return $this->only('name');
    }

//    public function getScoutKey()
//    {
//        return $this->name;
//    }
//
//    public function getScoutKeyName()
//    {
//        return 'name';
//    }
}
