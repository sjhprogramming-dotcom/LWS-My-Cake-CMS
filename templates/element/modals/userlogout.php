<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-cakephpred text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirm logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Hey there! are you sure you want to log out?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

                <?php // Log out link with postLink to ensure it uses POST method and includes CSRF token
                ?>
                <?= $this->Form->postLink(
                    'Logout',
                    ['controller' => 'Users', 'action' => 'logout', 'prefix' => false],
                    [
                        'class' => 'btn btn-cakephpred',
                        'confirm' => false
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>