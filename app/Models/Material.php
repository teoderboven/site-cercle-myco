<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Material
 *
 * Represents a material that can be associated with activities.
 *
 * @property int $id The unique identifier for the material.
 * @property string $name The name of the material.
 * @property string|null $icon The icon associated with the material.
 */
#[Fillable(['name', 'icon'])]
#[WithoutTimestamps]
class Material extends Model
{
    /**
     * The activities that belong to the material.
     */
    public function activities() : BelongsToMany
    {
        return $this->belongsToMany(Activity::class);
    }

}
