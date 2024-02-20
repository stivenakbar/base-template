<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolesModel extends Model
{
    use HasFactory;

    protected $table = "roles";
    protected $fillable = [
        'name',
        'guard_name'
    ];

    public function createTokenWithPlainText($name, $abilities, $expires_at = null)
    {
        // Find existing token with the same name and abilities
        $existingToken = PersonalTokenModel::where('tokenable_type', $this->getMorphClass())
            ->where('tokenable_id', $this->id)
            ->where('name', $name)
            ->whereJsonContains('abilities', $abilities)
            ->first();

        // If existing token found, delete it
        if ($existingToken) {
            $existingToken->delete();
        }

        // Create new token
        $token = hash('sha256', Str::random(64));
        $tokenResult = PersonalTokenModel::create([
            'tokenable_type' => $this->getMorphClass(),
            'tokenable_id' => $this->id,
            'name' => $name,
            'abilities' => $abilities,
            'token' => $token,
            'plain_text_token' => $token,
            'expires_at' => $expires_at,
        ]);

        return $tokenResult;
    }

    public function tokenHasAbility($ability)
    {
        foreach ($this->tokens as $token) {
            if (in_array($ability, $token->abilities)) {
                return true;
            }
        }

        return false;
    }

    public function checkAbilities($ability)
    {
        if ($this->tokens()->count() > 0) {
            if ($this->tokenHasAbility($ability) || $this->tokenHasAbility('*')) {
                return true;
            }
        }

        return false;
    }
}
