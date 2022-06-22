<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'link',
        'description',
        'pubDate',
        'guid',
        'guid_isPermaLink',
        'dc:creator'
    ];


    public function categories(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function add_categories($categories) {
        foreach ($categories as $item_category) {
            $existed_category = Category::where('name', '=', $item_category)->first();
            if (!$existed_category) {
                $new_category = new Category([
                    'name' => $item_category
                ]);
                $new_category->save();

                $this->categories()->attach($new_category->id);
            } else {
                $this->categories()->attach($existed_category->id);
            }
        }
    }
}
