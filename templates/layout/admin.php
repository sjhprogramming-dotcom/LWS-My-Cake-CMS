<?php

/**
 * @var \Cake\View\View $this
 * @var string $content
 */
$appName = 'Admin Panel';

// Current request info for active menu highlighting
$path = $this->getRequest()->getPath(); // e.g. /admin/articles/index
$isActive = function (string $startsWith) use ($path): string {
    return str_starts_with($path, $startsWith) ? 'active' : '';
};

// Central menu definition (so desktop + mobile share it)
$menu = [
    ['label' => 'Dashboard',  'icon' => '🏠', 'url' => ['prefix' => 'Admin', 'controller' => 'Dashboard',  'action' => 'index'], 'match' => '/admin'],
    ['label' => 'Articles',   'icon' => '📝', 'url' => ['prefix' => 'Admin', 'controller' => 'Articles',   'action' => 'index'], 'match' => '/admin/articles'],
    ['label' => 'Categories', 'icon' => '🗂️', 'url' => ['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'index'], 'match' => '/admin/categories'],
    ['label' => 'Tags',       'icon' => '🏷️', 'url' => ['prefix' => 'Admin', 'controller' => 'Tags',       'action' => 'index'], 'match' => '/admin/tags'],
    ['label' => 'Galleries',  'icon' => '🖼️', 'url' => ['prefix' => 'Admin', 'controller' => 'Galleries',  'action' => 'index'], 'match' => '/admin/galleries'],
    ['label' => 'Users',      'icon' => '👤', 'url' => ['prefix' => 'Admin', 'controller' => 'Users',      'action' => 'index'], 'match' => '/admin/users'],
];
?>
<!doctype html>
<html lang="en">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($appName) ?> · <?= h($this->fetch('title') ?: 'Dashboard') ?></title>

    <!-- Bootstrap 5.3 CSS -->
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') ?>
    <?= $this->fetch('css') ?>

    <style>
        :root {
            --sidebar-width: 280px;
        }

        body {
            background: #f6f7fb;
        }

        .admin-shell {
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: #111827;
        }

        .sidebar .brand {
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar a {
            color: rgba(255, 255, 255, .82);
            text-decoration: none;
        }

        .sidebar .nav-link {
            border-radius: .85rem;
            padding: .65rem .85rem;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .10);
        }

        .topbar {
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #e9ecef;
        }

        .content-wrap {
            flex: 1;
            min-width: 0;
        }

        .card {
            border: 0;
            border-radius: 1.25rem;
            box-shadow: 0 10px 30px rgba(17, 24, 39, .06);
        }
    </style>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <div class="d-flex admin-shell">

        <!-- Sidebar (desktop) -->
        <aside class="sidebar d-none d-lg-flex flex-column p-3">
            <div class="brand text-white fw-semibold fs-5">
                <?= h($appName) ?>
            </div>

            <nav class="mt-3">
                <ul class="nav nav-pills flex-column gap-1">
                    <?php foreach ($menu as $item): ?>
                        <li class="nav-item">
                            <?= $this->Html->link(
                                $item['icon'] . ' ' . $item['label'],
                                $item['url'],
                                ['class' => 'nav-link ' . $isActive($item['match']), 'escape' => false]
                            ) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <hr class="border-light opacity-10 my-3">

                <div class="small text-white-50 px-2">Quick actions</div>
                <div class="d-grid gap-2 mt-2">
                    <?= $this->Html->link(
                        'New article',
                        ['prefix' => 'Admin', 'controller' => 'Articles', 'action' => 'add'],
                        ['class' => 'btn btn-primary btn-sm rounded-4']
                    ) ?>
                    <?= $this->Html->link(
                        'New category',
                        ['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'add'],
                        ['class' => 'btn btn-outline-light btn-sm rounded-4']
                    ) ?>
                </div>
            </nav>
        </aside>

        <!-- Main -->
        <div class="content-wrap d-flex flex-column">

            <!-- Topbar -->
            <header class="topbar d-flex align-items-center px-3 px-lg-4">
                <button class="btn btn-outline-secondary d-lg-none me-2"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#adminSidebarMobile"
                    aria-controls="adminSidebarMobile">
                    ☰
                </button>

                <div class="fw-semibold">Admin</div>

                <div class="ms-auto d-flex align-items-center gap-2">
                    <form class="d-none d-md-block" role="search">
                        <input class="form-control form-control-sm rounded-4" type="search" placeholder="Search…" aria-label="Search">
                    </form>

                    <div class="dropdown">
                        <button class="btn btn-light btn-sm rounded-4 dropdown-toggle" data-bs-toggle="dropdown">
                            Account
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><?= $this->Html->link('Profile', ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'profile'], ['class' => 'dropdown-item']) ?></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><?= $this->Html->link('Logout', ['prefix' => false, 'controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']) ?></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Flash -->
            <div class="container-fluid px-3 px-lg-4 pt-3">
                <?= $this->Flash->render() ?>
            </div>

            <!-- Content -->
            <main class="container-fluid px-3 px-lg-4 pb-4">
                <?= $this->fetch('content') ?>
            </main>
        </div>
    </div>

    <!-- Sidebar (mobile offcanvas) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebarMobile" aria-labelledby="adminSidebarMobileLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="adminSidebarMobileLabel"><?= h($appName) ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group">
                <?php foreach ($menu as $item): ?>
                    <?= $this->Html->link(
                        $item['icon'] . ' ' . $item['label'],
                        $item['url'],
                        ['class' => 'list-group-item list-group-item-action', 'escape' => false]
                    ) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS bundle -->
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') ?>
</body>

</html>