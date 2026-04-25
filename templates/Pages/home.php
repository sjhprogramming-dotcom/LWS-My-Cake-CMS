<div class="page-content bg-cakephpred mb-4 pb-5">

    <div class="container text-white">
        <div class="col-md-8 mb-4 mx-auto pt-5 pb-5">
            <div class="content mx-auto text-center">
                <h1 class="display-1 text-white">Welcome</h1>
                <h3 class="display-3 text-white">this site concentrates on everything cakephp </h3>
                <div class="pt-5">

                    <a href="#" class="btn btn-lg btn-cakephpwhite">Visit Bootstrap</a>
                    <a href="#" class="btn btn-lg btn-cakephpwhite">Visit CakePHP</a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="page-content bg-white mb-4">
    <div class="container">
        <div class="row featurette mt-5  ">
            <div class="col-md-5">

                <?= $this->Html->image('home/image1_0.jpg', [
                    'class' => 'img-fluid img-thumbnail',
                    'alt' => 'title image'
                ]) ?>

            </div>
            <div class="col-md-7">
                <div class="content-homepage">
                    <h1 class="border-bottom display-3">Journey through the steps</h1>
                    <p>Learn how to build on the cakePHP 40 min CMS tutorial and expand your knowledge through explanation (bad) and download the compelted source code</p>

                </div>
            </div>
        </div>
        <div class="row featurette mt-5  ">

            <div class="col-md-7">
                <div class="content-homepage">
                    <h1 class="border-bottom display-3">Authorization, Authentication and more...</h1>
                    <p class="lead">Use in built plugins to secure you website and give access and auth to those who need it</p>
                </div>
            </div>
            <div class="col-md-5">
                <?= $this->Html->image('home/AdobeStock_153503397.png', [
                    'class' => 'img-fluid img-thumbnail',
                    'alt' => 'title image',
                    'width' => 560,
                    'height' => 560

                ]) ?>

            </div>
        </div>

        <div class="row featurette mt-5 mb-5  ">
            <div class="col-md-5">

                <?= $this->Html->image('home/image1_0.jpg', [
                    'class' => 'img-fluid img-thumbnail',
                    'alt' => 'title image'
                ]) ?>
            </div>
            <div class="col-md-7">
                <div class="content-homepage">
                    <h1 class="border-bottom display-3">Full bootstrap integration</h1>
                    <p>Make your site compatiable with all devices and build templates to suit the requirements of the application</p>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="page-content bg-cakephpmustard">
    <div class="container">
        <h2 class="text-center pt-5">Stay up to date</h2>
        <div class="row pt-4 pb-5 mx-auto">
            <div class="col-md-6">

                <p class="lead">Submit your email address to get notifications on new posts and news relating to this website.</p>
            </div>
            <div class="col-md-6 mx-auto">

                <form class="d-flex gap-2 mx-auto">
                    <input type="text" placeholder="Enter your email address" class="form-control" />
                    <input type="button" class="btn btn-lg btn-outline-cakephpred" value="send it" />
                </form>

            </div>
        </div>
    </div>
</div>
</main>