<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function before(User $user, $ability)
    {
        // If the user is an Admin, they can perform any action
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    public function createMaster(User $user)
    {
        // Only Admin can create a Master
        return $user->hasRole('Admin');
    }

    public function createAgent(User $user)
    {
        // Only Admin and Master can create an Agent
        return $user->hasRole('Admin') || $user->hasRole('Master');
    }

    public function createUser(User $user)
    {
        // Only Admin, Master, and Agent can create a User
        return $user->hasRole('Admin') || $user->hasRole('Master') || $user->hasRole('Agent');
    }
    
    // ... other methods for update, view, delete, etc.
    // admin only view 
    public function viewAdminTransferLog(User $user)
    {
        return $user->hasRole('Admin');
    }
    // master only view
    public function viewMasterTransferLog(User $user)
    {
        return $user->hasRole('Master');
    }
    // agent only view
    public function viewAgentTransferLog(User $user)
    {
        return $user->hasRole('Agent');
    }
    // admin only update balance 
    public function updateAdminBalance(User $user)
    {
        return $user->hasRole('Admin');
    }
}