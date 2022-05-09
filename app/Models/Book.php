<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Book
 *
 * @property int $id
 * @property int $publisher_id
 * @property string $title
 * @property string|null $image
 * @property string|null $description
 * @property int $published
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BookFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePublisherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $favorites
 * @property-read int|null $favorites_count
 * @property-read mixed $image_url
 * @property-read \App\Models\Publisher|null $publisher
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $viewers
 * @property-read int|null $viewers_count
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = ['publisher_id', 'title', 'description', 'image', 'published', 'sort'];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_favorite');
    }

    public function viewers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user_viewer');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists("books/{$this->image}")) {
            return Storage::disk('public')->url("books/{$this->image}");
        }

        return null;
    }
}
