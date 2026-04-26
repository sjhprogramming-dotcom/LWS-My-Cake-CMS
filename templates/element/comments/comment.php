<!-- Comment -->
<div class="d-flex">
    <div class="flex-shrink-0">
        <div class="rounded-circle bg-secondary text-white d-flex
                        align-items-center justify-content-center"
            style="width: 48px; height: 48px;">
            <?= h($comment->user->name) ?>
        </div>
    </div>

    <div class="flex-grow-1 ms-3">
        <div class="border rounded p-3 bg-light">
            <div class="d-flex justify-content-between">
                <strong><?= h($comment->user->email) ?></strong>
                <small class="text-muted">
                    <?= $comment->created?>
                </small>
            </div>

            <?php if (!empty($comment->title)): ?>
                <h6 class="mt-2"><?= h($comment->title) ?></h6>
            <?php endif; ?>

            <p class="mb-2"><?= nl2br(h($comment->body)) ?></p>

            <a href="#" class="small text-decoration-none">
                Reply
            </a>
        </div>
    </div>
</div>

<!-- Replies -->
<?php if (!empty($comment->child_comments)): ?>
    <div class="ms-5 mt-3 mb-5">
        <?php foreach ($comment->child_comments as $reply): ?>
            <?= $this->element('comments/comment', ['comment' => $reply]) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>