<?php

declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\Http\ServerRequest;

class ServerRequestPolicy
{
    public function canAccess(
        IdentityInterface $user,
        ServerRequest $request
    ): bool {

        if ($request->getParam('prefix') !== 'Admin') {
            return true;
        }

        $entity = $user->getOriginalData();
        return (bool)($entity->role?->isAdmin ?? false);
    }
}
