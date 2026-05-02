 <?php
    /** 
     * Cell to show Featured posts where required
     * Created by Steven Houldey
     *
     *
     * @var \App\View\AppView $this
     * @var \App\Model\Entity\Article $featuredArticles
     */
    ?>


 <?php foreach ($featuredArticles as $article): ?>
     <div class="col-md-6">
         <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
             <div class="col p-4 d-flex flex-column position-static">
                 <strong class="d-inline-block mb-2 text-primary">World</strong>
                 <h3 class="mb-0"><?= $article->title ?></h3>

                 <div class="mb-1 text-muted">written by <?= $article->user->email ?></div>
                 <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                 <a href="<?= $this->Url->build(['action' => 'view', $article->slug]) ?>" class="stretched-link">Continue reading</a>
             </div>
             <div class="col-auto d-none d-lg-block">
                 <?= $this->Html->image('home/AdobeStock_153503397.png', [
                        'class' => 'img',
                        'height' => '250',
                        'width' => '200',
                        'alt' => $article->title

                    ]); ?>

                 

             </div>
         </div>
     </div>

 <?php endforeach ?>