<?php
$homeUrl = ['controller' => 'Pages', 'action' => 'display', 'home'];
?>
<nav class="sticky-top navbar navbar-expand-lg bg-cakephpred navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?= $this->Html->link(
                        'Home',
                        ['controller' => 'Pages', 'action' => 'home'],
                        [
                            'class' => 'nav-link' . $this->Nav->isActive($homeUrl),
                            'aria-current' => 'page'
                        ]
                    ) ?>

                </li>
                <li class="nav-item">
                    <?= $this->Html->link(
                        'Articles',
                        ['controller' => 'Articles', 'action' => 'index'],
                        [
                            'class' => 'nav-link' . $this->Nav->isActive(['controller' => 'Articles'])
                        ]
                    ) ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-cakephpwhite" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-3 mb-2 mb-lg-0">
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= $this->request->getAttribute('identity')->get('email') ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>

                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <?= $this->Html->link('<i class="bi bi-box-arrow-in-left"></i> Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link' . $this->Nav->isActive(['controller' => 'Users', 'action' => 'login']), 'escape' => false]) ?>
                    </li>
                    <li>
                         <?= $this->Html->link('<i class="bi bi-person-fill-up"></i> Register', ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link' . $this->Nav->isActive(['controller' => 'Users', 'action' => 'add']), 'escape' => false]) ?>
                    </li>
                <?php endif; ?>
        </div>
    </div>
</nav>