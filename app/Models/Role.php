<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'title',
        'alias'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('App\Models\User','role_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms() {
        return $this->belongsToMany('App\Models\Permission','permission_role');
    }

    /**
     * @param $name
     * @param bool $require
     * @return bool
     */
    public function hasPermission($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->perms as $permission) {
                if ($permission->alias == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param $inputPermissions
     * @return bool
     */
    public function savePermissions($inputPermissions) {

        if(!empty($inputPermissions)) {
            $this->perms()->sync($inputPermissions);
        }
        else {
            $this->perms()->detach();
        }

        return TRUE;
    }
}
