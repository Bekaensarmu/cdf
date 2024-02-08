<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the client can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list clients');
    }

    /**
     * Determine whether the client can view the model.
     */
    public function view(User $user, Client $model): bool
    {
        return $user->hasPermissionTo('view clients');
    }

    /**
     * Determine whether the client can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create clients');
    }

    /**
     * Determine whether the client can update the model.
     */
    public function update(User $user, Client $model): bool
    {
        return $user->hasPermissionTo('update clients');
    }

    /**
     * Determine whether the client can delete the model.
     */
    public function delete(User $user, Client $model): bool
    {
        return $user->hasPermissionTo('delete clients');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete clients');
    }

    /**
     * Determine whether the client can restore the model.
     */
    public function restore(User $user, Client $model): bool
    {
        return false;
    }

    /**
     * Determine whether the client can permanently delete the model.
     */
    public function forceDelete(User $user, Client $model): bool
    {
        return false;
    }
}
