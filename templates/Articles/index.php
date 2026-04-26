<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Article> $articles
 */
?>

<div class="articles container content">
    <div class="row">
        <div class="col-md-12 mt-5 py-3 text-center">
            <h2><?= __('Our Articles') ?></h2>

        </div>
    </div>

    <div class="row mb-4 mt-3 py-3">
        <?php foreach ($articles as $article): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?= $this->Html->image('home/AdobeStock_153503397.png', ['class' => 'card-img-top', 'alt' => $article->title]) ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= h($article->title) ?></h5>
                        <p class="card-text">
                            <?= $this->Text->truncate($article->body, 100, [
                                'ellipsis' => '...',
                                'exact' => false,
                            ])?>
                        </p>
                        <?= $this->Html->link(__('Read More'), ['action' => 'view', $article->slug], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="paginator justify-content-center text-center mt-5">
        <hr>
        <ul class="pagination justify-content-center">

            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>


</div>