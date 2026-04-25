<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\ORM\Query\SelectQuery;

/**
 * Role policy
 */
class RolesTablePolicy
{
    /**
     * Apply user access controls to a query for index actions
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \Cake\ORM\Query\SelectQuery $query The query to apply authorization conditions to.
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function scopeIndex(IdentityInterface $user, SelectQuery $query): SelectQuery
    {
        // Example: Only allow users to see roles that are not marked as 'admin'
        if (isset($user->role) && $user->role->isAdmin) {
            return $query; // Admins can see all roles
        }

        return $query->where(['Roles.isAdmin' => false]);
    }
}
