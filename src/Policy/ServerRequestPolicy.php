<?php

declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\Http\ServerRequest;

class ServerRequestPolicy
{
    public function canAccess(
        ?IdentityInterface $user,
        ServerRequest $request
    ): bool {


        if ($user === null) {
            return false;
        }

        // ✅ Non-admin routes are always allowed
        if (strtolower((string)$request->getParam('prefix')) !== 'admin') {
            return true;
        }

        // ✅ Admin routes require admin role
        $entity = $user->getOriginalData();
        return (bool)($entity->role?->isAdmin ?? false);
    }
}
