<?php

/**
 * @var \Cake\View\View $this
 * @var array $stats
 */
$this->assign('title', 'Dashboard');
?>

<div class="d-flex align-items-center justify-content-between mt-3 mb-3">
    <div>
        <h1 class="h3 mb-1">Dashboard</h1>
        <div class="text-muted">Quick overview</div>
    </div>
    <div class="d-flex gap-2">
        <?= $this->Html->link('New article', ['prefix' => 'Admin', 'controller' => 'Articles', 'action' => 'add'], ['class' => 'btn btn-primary rounded-4']) ?>
        <?= $this->Html->link('New gallery', ['prefix' => 'Admin', 'controller' => 'Galleries', 'action' => 'add'], ['class' => 'btn btn-outline-secondary rounded-4']) ?>
    </div>
</div>

<div class="row g-3">
    <?php
    $cards = [
        ['label' => 'Articles',   'value' => (int)$stats['articles'],   'icon' => '📝'],
        ['label' => 'Categories', 'value' => (int)$stats['categories'], 'icon' => '🗂️'],
        ['label' => 'Tags',       'value' => (int)$stats['tags'],       'icon' => '🏷️'],
        ['label' => 'Galleries',  'value' => (int)$stats['galleries'],  'icon' => '🖼️'],
        ['label' => 'Users',      'value' => (int)$stats['users'],      'icon' => '👤'],
    ];
    ?>
    <?php foreach ($cards as $c): ?>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-start justify-content-between">
                    <div>
                        <div class="text-muted small"><?= h($c['label']) ?></div>
                        <div class="fs-3 fw-semibold"><?= h((string)$c['value']) ?></div>
                    </div>
                    <div class="fs-3"><?= $c['icon'] ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="row g-3 mt-1">
    <div class="col-12 col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="fw-semibold mb-2">Next steps</div>
                <ul class="mb-0">
                    <li>Add real stats from your tables (Articles, Users, etc.)</li>
                    <li>Drop in a table of recent Articles</li>
                    <li>Add a “Drafts” widget or moderation queue</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="card">
            <div class="card-body">
                <div class="fw-semibold mb-2">Shortcuts</div>
                <div class="d-grid gap-2">
                    <?= $this->Html->link('Manage articles', ['prefix' => 'Admin', 'controller' => 'Articles', 'action' => 'index'], ['class' => 'btn btn-light rounded-4']) ?>
                    <?= $this->Html->link('Manage categories', ['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'index'], ['class' => 'btn btn-light rounded-4']) ?>
                    <?= $this->Html->link('Manage tags', ['prefix' => 'Admin', 'controller' => 'Tags', 'action' => 'index'], ['class' => 'btn btn-light rounded-4']) ?>
                    <?= $this->Html->link('Manage galleries', ['prefix' => 'Admin', 'controller' => 'Galleries', 'action' => 'index'], ['class' => 'btn btn-light rounded-4']) ?>
                    <?= $this->Html->link('Manage users', ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-light rounded-4']) ?>
                </div>
            </div>
        </div>
    </div>
</div>