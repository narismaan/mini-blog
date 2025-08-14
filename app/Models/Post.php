<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'user_id',
        'published',
        'published_at'
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Relationship: Post belongs to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Auto-generate unique slug from title.
     * If same slug exists, append -1, -2, ...
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $base = Str::slug($value);
        $slug = $base;

        // count similar slugs to generate a unique suffix
        $count = static::where('slug', 'like', $base . '%')->count();

        if ($count > 0) {
            $slug = $base . '-' . $count;
        }

        $this->attributes['slug'] = $slug;
    }

    // Excerpt accessor: if excerpt column empty, generate from content
    public function getExcerptAttribute($value)
    {
        return $value ?: Str::limit(strip_tags($this->content), 150);
    }
}
