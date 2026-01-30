<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'color',
        'items',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /** @return array{bg: string, icon: string, dot: string} */
    public function colorClasses(): array
    {
        return match ($this->color) {
            'maroon' => ['bg' => 'bg-brand-maroon/10', 'icon' => 'text-brand-maroon', 'dot' => 'bg-brand-maroon'],
            'forest' => ['bg' => 'bg-brand-forest/10', 'icon' => 'text-brand-forest', 'dot' => 'bg-brand-forest'],
            'slate' => ['bg' => 'bg-brand-slate/10',  'icon' => 'text-brand-slate',  'dot' => 'bg-brand-slate'],
            default => ['bg' => 'bg-brand-blue/10',   'icon' => 'text-brand-blue',   'dot' => 'bg-brand-blue'],
        };
    }
}
