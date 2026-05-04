 <?php

    /**
     * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
     * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the LICENSE.txt
     * Redistributions of files must retain the above copyright notice.
     *
     * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
     * @link          https://cakephp.org CakePHP(tm) Project
     * @since         0.10.0
     * @license       https://opensource.org/licenses/mit-license.php MIT License
     * @var \App\View\AppView $this
     * @var \App\Model\Entity\Article $article
     * @var \App\Model\Entity\Comment $newComment
     * 
     */

    $cakeDescription = 'CakePHP: the rapid development php framework';



    //get the image if there is one

    if (!$article->header_image):
        //No Image specified so lets use the generic
        $articleHeaderImage = "img-headers/blog.jpeg";
    else:
        $articleHeaderImage = $article->header_image;
    endif;


    ?>




 <!DOCTYPE html>
 <html>

 <head>
     <?= $this->Html->charset() ?>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>
         <?= $cakeDescription ?>:
         <?= $this->fetch('title') ?>
     </title>
     <?= $this->Html->meta('icon') ?>

     <?= // $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) 
        $this->Html->css(['https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css'])

        ?>


     <link rel="stylesheet"
         href="https://use.fontawesome.com/releases/v6.5.2/css/all.css">




     <?= $this->Html->css(['style', 'layouts', 'text']) ?>
     <?= $this->fetch('meta') ?>
     <?= $this->fetch('css') ?>

     <!-- Prism core -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.min.css">
     <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.min.js"></script>

     <!-- Language dependencies (REQUIRED ORDER) -->
     <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-markup.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-clike.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-markup-templating.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-php.min.js"></script>

     <!-- Line numbers -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs/plugins/line-numbers/prism-line-numbers.css">
     <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/line-numbers/prism-line-numbers.min.js"></script>

     <!-- Toolbar + copy -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs/plugins/toolbar/prism-toolbar.css">
     <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>

     <!-- Tagify CSS and JS from CDN -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
     <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
     <?= $this->fetch('script') ?>

     <style>
         pre[class*="language-"] {
             counter-reset: line;
         }

         pre[class*="language-"].line-numbers {
             padding-left: 3.8em;
         }
     </style>



 </head>

 <body class="d-flex flex-column min-vh-100">
     <?= $this->element('nav-bar/top-nav') ?>


     <main class="container mt-4 mb-5">

         <?= $this->Flash->render() ?>

         <div class="p-4 p-md-5 mb-4 text-cakephpred rounded header-image" data-bg="<?= $this->Url->image($articleHeaderImage); ?>">
             <div class="col-md-6 text-panel">
                 <h1 class="display-4 fst-italic"><?= h($article->title) ?></h1>
                 <p class="lead my-3">Written By <?= $article->user->username ?>
                 <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
             </div>
         </div>

         <!-- Featured Articles -->
         <div class="row mb-2">
             <?= $this->cell('Featuredarticles') ?>
         </div>
         <!-- End of Feautred Articles -->
         <div class="row g-5">
             <div class="col-md-8">
                 <h3 class="pb-4 mb-4 fst-italic border-bottom">
                     From the Firehose;
                 </h3>

                 <article class="blog-post">
                     <div class="border-bottom">
                         <h2 class="blog-post-title"><?= h($article->title) ?></h2>
                         <p class="blog-post-meta"><?= h($article->created->i18nFormat('MMMM d, yyyy')) ?> by <a href="#"><?= h($article->user->username); ?></a>

                             <?php if ($article->modified > $article->created): ?>
                         <p class="blog-post-meta text-muted">
                             Article last edited and updated on:
                             <?= $article->modified->i18nFormat('MMMM d, yyyy') ?>
                         </p>
                     <?php endif; ?>

                     </p>


                     </div>
                     <div class="mb-4 border-bottom">

                         <div class="d-none">
                             <?= $this->Flash->render('flash') ?>
                             <?= $this->Flash->render('modal_success') ?>
                         </div>

                         <?= str_replace(
                                '<pre class="language-',
                                '<pre class="line-numbers language-',
                                $this->fetch('content')
                            ) ?>


                     </div>


                     <div class="tag_cloud mb-4">

                         <?php if (!empty($article->tags)): ?>
                             <div class="tag-cloud mt-4">
                                 <h5>Tags</h5>
                                 <?php foreach ($article->tags as $tag): ?>
                                     <?= $this->Html->link(
                                            h($tag->title),
                                            ['controller' => 'Articles', 'action' => 'tags', $tag->title],
                                            ['class' => 'tag-item']
                                        ) ?>
                                 <?php endforeach; ?>
                             </div>
                         <?php endif; ?>


                     </div>

                     <div class="card mt-5">
                         <div class="card-header">
                             <h4 class="mb-0">Comments</h4>
                         </div>

                         <div class="card-body">
                             <?php if (empty($comments)): ?>
                                 <p class="text-muted mb-0">No comments yet.</p>
                             <?php else: ?>
                                 <?php foreach ($comments as $comment): ?>
                                     <?= $this->element('/comments/comment', ['comment' => $comment]) ?>
                                 <?php endforeach; ?>
                             <?php endif; ?>
                         </div>


                     </div>
                     <div class="card mt-5">
                         <div class="card-header">
                             <h4>Post a Comment</h4>
                         </div>
                         <div class="card-body">
                             <?php
                                echo $this->Form->create($newComment, [
                                    'url' => [
                                        'controller' => 'Comments',
                                        'action' => 'addNewThread',
                                        $article->id,
                                    ]
                                ]);
                                echo $this->Form->control('title', [
                                    'class' => 'form-control',
                                    'label' => 'Thread Title',
                                    'required' => true,

                                ]);
                                echo $this->Form->control('body', [
                                    'class' => 'form-control',
                                    'label' => 'Thread Comment',
                                    'required' => true
                                ]);
                                echo $this->Form->submit('Post Comment', [
                                    'class' => 'btn btn-cakephpred mt-3'
                                ]);
                                echo $this->Form->end();

                                ?>
                         </div>
                     </div>
                 </article>

             </div>
             <!-- Side Bar -->


             <div class="col-md-4">
                 <div class="position-sticky" style="top: 2rem;">
                     <div class="p-4 mb-3 bg-light rounded">
                         <h4 class="fst-italic">About <?= h($article->user->username); ?></h4>
                         <p class="fst-italic">Member Since <?= h($article->user->created->format('i M Y')); ?>
                         <p class="mb-0"><?= h($article->user->bio); ?></p>
                     </div>




                     <div>
                         <?= $this->cell('Recentarticles') ?>
                     </div>

                     <div class="bg-light rounded d-none d-lg-block">

                         <?= $this->fetch('toc') ?>
                     </div>




                     <div class="p-4">
                         <!-- Show Archive Data -->



                     </div>

                     <div class="p-4 mb-3 bg-light rounded">
                         <h4 class="fst-italic">Elsewhere</h4>
                         <ol class="list-unstyled">
                             <li><a href="#">GitHub</a></li>
                             <li><a href="#">Twitter</a></li>
                             <li><a href="#">Facebook</a></li>
                         </ol>
                     </div>

                     <div class="p-4 mb-5 pn-5 bg-light rounded">
                         <h4 class="fast-italic">Tag Cloud</h4>

                         <?php if (!empty($article->tags)): ?>
                             <div class="tag-cloud mt-4">
                                 <h5>Tags</h5>
                                 <?php foreach ($article->tags as $tag): ?>
                                     <?= $this->Html->link(
                                            h($tag->title),
                                            ['controller' => 'Articles', 'action' => 'index', '?' => ['tags' => $tag->title]],
                                            ['class' => 'tag-item']
                                        ) ?>
                                 <?php endforeach; ?>
                             </div>
                         <?php endif; ?>
                     </div>

                 </div>
             </div>
         </div>
         </div>

     </main>

     <?= $this->element('footers/footer') ?>


     <script>
         document.querySelectorAll('.header-image').forEach(el => {
             const bg = el.getAttribute('data-bg');
             if (bg) {
                 el.style.backgroundImage = `url(${bg})`;
                 el.style.backgroundSize = 'cover';
                 el.style.backgroundPosition = 'center';
             }
         });
     </script>





     <script>
         document.addEventListener('DOMContentLoaded', function() {
             document.querySelectorAll('.reply-toggle').forEach(function(link) {
                 link.addEventListener('click', function(e) {
                     e.preventDefault();

                     const commentId = this.dataset.commentId;
                     const form = document.getElementById('reply-form-' + commentId);

                     form.classList.toggle('d-none');
                 });
             });
         });
     </script>