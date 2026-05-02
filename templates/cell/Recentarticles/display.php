<?php
/** 
* Element to show recent posts where required
* Created by Steven Houldey
*
*
* @var \App\View\AppView $this
* @var \App\Model\Entity\Article[] $articles
*/ 
?>

<h4 class="fst-italic">Recent posts</h4>
<ul class="list-unstyled">
    <?php foreach($articles as $article) : ?>

        <li> <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="<?=  $this->Url->build(['action' => 'view', $article->slug]) ?>"> <svg aria-hidden="true" class="bd-placeholder-img " height="96" preserveAspectRatio="xMidYMid slice" width="100%" xmlns="http://www.w3.org/2000/svg">
             <?=  $this->Html->image('home/AdobeStock_153503397.png', [
                'class' => 'img img-thumbnail',
                'style' => 'height:96px; width:auto;',
                'alt' => $article->title

             ]); ?>

        <rect width="100%" height="100%" fill="#777"></rect>
            </svg>
            <div class="col-lg-8">
                <h6 class="mb-0"><?=  $article->title ?></h6> <small class="text-body-secondary"><?=  $article->created ?></small>
            </div>
        </a> </li>


    <?php endforeach ?>
    
</ul>