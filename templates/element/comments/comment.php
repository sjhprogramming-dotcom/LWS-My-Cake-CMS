<?php

/**
 * 
 *  @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \App\Model\Entity\Comment $replyComment
 * @var \App\Model\Entity\Comment $comment
 */
?>
<!-- Comment -->
<div class="d-flex mt-3">
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
                    <?= $comment->created ?>
                </small>
            </div>

            <?php if (!empty($comment->title)): ?>
                <h6 class="mt-2"><?= h($comment->title) ?></h6>
            <?php endif; ?>

            <p class="mb-2"><?= nl2br(h($comment->body)) ?></p>


            <a href="#"
                class="small text-decoration-none reply-toggle"
                data-comment-id="<?= $comment->id ?>">
                Reply
            </a>



            <!-- Hidden reply form -->
            <div class="reply-form mt-3 d-none" id="reply-form-<?= $comment->id ?>">
                <?= $this->Form->create($replyComment, [
                    'url' => ['controller' => 'Comments', 'action' => 'reply']
                ]) ?>

                <?= $this->Form->hidden('parent_id', ['value' => $comment->id]) ?>
                <?= $this->Form->hidden('article_id', ['value' => $comment->article_id]) ?>

                <?= $this->Form->control('body', [
                    'type' => 'textarea',
                    'class' => 'form-control',
                    'rows' => 3,
                    'label' => 'your reply',
                    'placeholder' => 'Write your reply…'
                ]) ?>

                <?= $this->Form->button('Post reply', ['class' => 'btn btn-sm mt-3 btn-outline-cakephpred']) ?>
                <?= $this->Form->end() ?>
            </div>


        </div>
    </div>
</div>

<!-- Replies -->
<?php if (!empty($comment->children)): ?>
    <div class="ms-5 mt-3 mb-5">
        <?php foreach ($comment->children as $reply): ?>
            <?= $this->element('comments/comment', ['comment' => $reply]) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


