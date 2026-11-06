<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'event_type',
        'business',
        'contact',
        'email',
        'phone',
        'locations',
        'message',
        'items',
        'page_url',
        'user_agent',
        'email_status',
        'email_sent_at',
        'email_error',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'items' => 'array',
        'is_read' => 'boolean',
        'email_sent_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    /**
     * Scope for unread leads.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for quotes vs inquiries.
     */
    public function scopeQuotes($query)
    {
        return $query->where('event_type', 'like', '%quote%');
    }
}
