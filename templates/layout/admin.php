<?php

            /**
             * @var \App\View\AppView $this
             */
            ?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        $this->assign('title', 'Admin Dashboard'); ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= // $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) 
    $this->Html->css(['https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css'])

    ?>


    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v6.5.2/css/all.css">


    <?= $this->Html->css(['style', 'layouts', 'text']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <!-- Tagify CSS and JS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <?= $this->fetch('script') ?>


</head>



<div class="mb-4">
    <h1 class="h3 mb-1">Dashboard</h1>
    <p class="text-muted mb-0">
        Welcome back, <?= h($this->request->getAttribute('identity')?->get('name') ?? 'Admin') ?>
    </p>
</div>

<div class="row g-4">

    <!-- Users card -->
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Users</h6>
                        <div class="fs-4 fw-semibold">
                            <?= isset($userCount) ? number_format($userCount) : '—' ?>
                        </div>
                    </div>
                    <div class="text-primary fs-2">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Example stat -->
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">System Status</h6>
                        <div class="fw-semibold text-success">Online</div>
                    </div>
                    <div class="text-success fs-2">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<hr class="my-4">

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="card-title mb-3">Quick Actions</h5>

        <div class="d-flex flex-wrap gap-2">
            <?= $this->Html->link(
                'Manage Users',
                ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index'],
                ['class' => 'btn btn-primary']
            ) ?>

            <?= $this->Html->link(
                'Add User',
                ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'add'],
                ['class' => 'btn btn-outline-primary']
            ) ?>
        </div>
    </div>
</div>