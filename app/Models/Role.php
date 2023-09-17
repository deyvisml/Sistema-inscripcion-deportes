<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $fillable = [
        "name",
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * Determine if the role has the given permission.
     *
     * @param  mixed $permission
     * @return boolean
     */
    public function inRole($permission)
    {
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }
        return !!$permission->intersect($this->permissions)->count();
    }
}
