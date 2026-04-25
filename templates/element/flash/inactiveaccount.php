<div class="message error">
    <?= h($message). ' '.   $this->Html->link(
            'Please request a new one.',
            ['controller' => 'Users', 'action' => 'requestNewActivationToken']
        ) ?>
    
</div>