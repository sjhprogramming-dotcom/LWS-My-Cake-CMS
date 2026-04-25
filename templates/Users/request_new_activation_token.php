<div class="users form content">
    <?= $this->Flash->render() ?>
    <h3>Request New Activation Token</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <
    </fieldset>
    <?= $this->Form->button(__('Request Token')); ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("Back to Login", ['action' => 'login']) ?>
</div>