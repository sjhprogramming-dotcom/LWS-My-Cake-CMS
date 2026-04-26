<?php

declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Routing\Router;

class NavHelper extends Helper
{

    /**
     * Mark active if the current controller and optional action/prefix match.
     *
     * Usage:
     *   $this->Nav->isActive(['controller' => 'Articles'])
     *   $this->Nav->isActive(['controller' => 'Pages', 'action' => 'display'])
     *   $this->Nav->isActive(['prefix' => 'Admin', 'controller' => 'Dashboard', 'action' => 'index'])
     */
    public function isActive(array $expected): string
    {
        $req = $this->getView()->getRequest();

        $controller = $req->getParam('controller'); // e.g. 'Articles'
        $action     = $req->getParam('action');     // e.g. 'index', 'view'
        $prefix     = (string)($req->getParam('prefix') ?? ''); // '' or 'Admin'/'Members'

        // Case-sensitive compare (Cake uses StudlyCase for controller param)
        if (isset($expected['controller']) && $controller !== $expected['controller']) {
            return '';
        }
        if (isset($expected['action']) && $action !== $expected['action']) {
            return '';
        }
        if (isset($expected['prefix']) && (string)$expected['prefix'] !== $prefix) {
            return '';
        }

        return ' active';
    }

    /**
     * Mark active when only controller needs to match (convenience).
     */
    public function activeController(string $controller): string
    {
        return $this->getView()->getRequest()->getParam('controller') === $controller ? ' active' : '';
    }
}
