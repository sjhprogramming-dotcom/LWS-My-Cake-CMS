<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CakePHP: the rapid development PHP framework:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Learn with Steve | Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
            <?= $this->Html->link('Articles', ['controller' => 'Articles', 'action' => 'index']) ?>
            <?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index']) ?>
            <?= $this->Html->link('Tags', ['controller' => 'Tags', 'action' => 'index']) ?>
            <?php if ($isLoggedIn): ?>
                <?= $this->Html->link('Logged in as ' . $this->request->getAttribute('identity')->get('email'), ['controller' => 'Users', 'action' => 'logout']) ?>
            <?php else: ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?>
            <?php endif; ?>
            |
            <a target="_blank" rel="noopener" href="https://book.cakephp.org/5/">Documentation</a>
            <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
        </div>
    </nav>
    <header>
        <div class="container text-center">
            <a href="https://cakephp.org/" target="_blank" rel="noopener">
                <img alt="CakePHP" src="https://cakephp.org/v2/img/logos/CakePHP_Logo.svg" width="350" />
            </a>
            <h1>
                Welcome to CakePHP <?= h(Configure::version()) ?> Chiffon (🍰)

            </h1>
            <h2> Modified by Steve Houldey for training and education purposes.</h2>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="content">
                <h2>Getting Started</h2>
                <p>
                    This is the home page template for your CakePHP application. You can modify this page to suit your needs.
                </p>
                <p>
                    To get started, you can create new templates in the <code>templates/</code> directory and link to them from this page or other parts of your application.
                </p>
                <p>
                    For example, you could create a new template at <code>templates/Pages/about.php</code> and then link to it like this:
                </p>
                <pre><code>&lt;?= $this-&gt;Html-&gt;link('About Us', ['controller' =&gt; 'Pages', 'action' =&gt; 'display', 'about']) ?&gt;</code></pre>
                <p>
                    This would create a link to the "About Us" page, which would be rendered using the <code>about.php</code> template.
                </p>
            </div>
        </div>
    </main>
    <footer>
        <div class="container" style="margin-top: 4rem;">
            <p style="text-align: center;">Copyright &copy; <?= date('Y') ?>, Learn with Steve. All rights reserved.</p>
            <p style="text-align: center;">Powered by <?= $this->Html->link('CakePHP', 'https://cakephp.org') ?>.</p>
        </div>
    </footer>
</body>

</html>