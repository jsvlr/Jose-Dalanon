<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\SkillTypeEnum;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    /** @use HasFactory<\Database\Factories\SkillFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'icon',
        'level'
    ];

    protected $casts = [
        'type' => SkillTypeEnum::class,
        'level' => 'double'
    ];

    public function projectSkills(): HasMany
    {
        return $this->hasMany(ProjectSkill::class);
    }
}
