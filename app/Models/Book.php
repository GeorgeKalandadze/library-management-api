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

    public function scopeStatus(Builder $query, int $status)
    {
        return $query->where('status', $status);
    }

    public function scopeBooked(Builder $query)
    {
        return $query->status(BookStatus::BOOKED->value);
    }

    public function scopeAvailable(Builder $query)
    {
        return $query->status(BookStatus::AVAILABLE->value);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
