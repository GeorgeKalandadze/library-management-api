<?php

namespace App\Models;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_url',
        'description',
        'status',
        'publish_date'
    ];

    public function scopeStatus(Builder $query, int $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeBooked(Builder $query): Builder
    {
        return $query->status(BookStatus::BOOKED->value);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->status(BookStatus::AVAILABLE->value);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
