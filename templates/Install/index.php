<?php

/**
 * @var array $requirements
 */


?>




<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-cakephpred">
                <div class="card-header bg-cakephpred text-white">
                    <h1 class="h4 mb-0">CakePHP CMS – Installation</h1>
                </div>

                <div class="card-body">

                    <!-- Requirements -->
                    <h5 class="text-cakephpblue mb-3">System Requirements</h5>
                    <ul class="list-group mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>PHP Version</span>
                            <strong><?= h($requirements['phpVersion']) ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>config/ writable</span>
                            <span class="<?= $requirements['configWritable'] ? 'text-success' : 'text-danger' ?>">
                                <?= $requirements['configWritable'] ? 'OK' : 'Not writable' ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>tmp/ writable</span>
                            <span class="<?= $requirements['tmpWritable'] ? 'text-success' : 'text-danger' ?>">
                                <?= $requirements['tmpWritable'] ? 'OK' : 'Not writable' ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>logs/ writable</span>
                            <span class="<?= $requirements['logsWritable'] ? 'text-success' : 'text-danger' ?>">
                                <?= $requirements['logsWritable'] ? 'OK' : 'Not writable' ?>
                            </span>
                        </li>
                    </ul>

                    <?= $this->Form->create(null, ['url' => ['action' => 'run']]) ?>

                    <!-- Database -->
                    <h5 class="text-cakephpblue mb-3">Database Configuration</h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <?= $this->Form->control('host', [
                                'label' => 'Database Host',
                                'class' => 'form-control',
                                'required' => true,
                                'value' => 'localhost',
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('database', [
                                'label' => 'Database Name',
                                'class' => 'form-control',
                                'required' => true,
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('username', [
                                'label' => 'Database Username',
                                'class' => 'form-control',
                                'required' => true,
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('password', [
                                'label' => 'Database Password',
                                'class' => 'form-control',
                                'type' => 'password',
                            ]) ?>
                        </div>
                    </div>

                    <!-- Admin -->
                    <h5 class="text-cakephpblue mb-3">Administrator Account (optional)</h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <?= $this->Form->control('admin_email', [
                                'label' => 'Admin Email',
                                'class' => 'form-control',
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('admin_password', [
                                'label' => 'Admin Password',
                                'class' => 'form-control',
                                'type' => 'password',
                            ]) ?>
                        </div>
                    </div>

                    <div class="d-grid">
                        <?= $this->Form->button('Install Application', [
                            'class' => 'btn btn-outline-cakephpred btn-lg',
                        ]) ?>
                    </div>

                    <?= $this->Form->end() ?>

                </div>
            </div>

            <p class="text-center text-muted mt-4">
                Powered by CakePHP
            </p>

        </div>
    </div>
</div>