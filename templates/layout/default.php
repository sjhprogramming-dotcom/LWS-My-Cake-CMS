<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
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

<body class="d-flex flex-column min-vh-100">
    <?= $this->element('nav-bar/top-nav') ?>

    <!--  <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Learn with Steve | Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
            <?= $this->Html->link('Articles', ['controller' => 'Articles', 'action' => 'index']) ?>
            <?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index']) ?>
            <?= $this->Html->link('Tags', ['controller' => 'Tags', 'action' => 'index']) ?>
            <?= $this->Html->link('Roles', ['controller' => 'Roles', 'action' => 'index']) ?>
            <?php if ($isLoggedIn): ?>
                <?= $this->Html->link('Logged in as ' . $this->request->getAttribute('identity')->get('email'), [
                    'controller' => 'Users',
                    'action' => 'logout'
                ]); ?>
            <?php else: ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?>
            <?php endif; ?>
            |
            <a target="_blank" rel="noopener" href="https://book.cakephp.org/5/">Documentation</a>
            <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
        </div>
    </nav> -->
    <main class="flex-fill">

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>

    </main>

    <?= $this->element('footers/footer') ?>