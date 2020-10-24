<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int $no
 * @property string $original_filename
 * @property string $mimetype
 * @property string $extension
 * @property int $size
 * @property \Illuminate\Support\Carbon $published_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereMimetype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereOriginalFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'date',
    ];
}
