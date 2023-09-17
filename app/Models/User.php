<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user',
        'password',
        'name',
        'ap_paterno',
        'ap_materno',
        'escuela_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, "role_user");
    }

    public function assignRole(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains("name", $role);
        }
        return !!$role->intersect($this->roles)->count();
    }

    /**
     * Deterimne is the current user has the given permission (very usefull)
     *
     * @param Permission $permission
     * @param User $user
     * @return boolean
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }

    public function permissions()
    {
        $roles = $this->roles;


        $permissions = collect();
        foreach ($roles as $role) {
            $permissions = $permissions->merge($role->permissions);
        }

        //return $permissions;
        return $permissions->unique('id');
    }


    public function escuela()
    {
        return $this->belongsTo(School::class);
    }
}
