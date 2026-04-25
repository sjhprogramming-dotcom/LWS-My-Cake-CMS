<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<section class="vh-100"">
    <div class=" container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up & Register</p>

                <!-- <form class="mx-1 mx-md-4"> -->
                <?= $this->Form->create($user) ?>

              <!--   <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">


                        <input type="text" id="form3Example1c" class="form-control" />
                        <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                </div> -->

                <div class="d-flex flex-row align-items-center mb-4">

                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <?=$this->Form->control('email', [
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Enter your email address',
                            'label' => 'Email Address',
                            'required' => true
                    ]); ?>
                        
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                  
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <?= $this->Form->control('password',[
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Enter your password',
                            'label' => 'Password',
                            'required' => true
                        ]);?>
                        
                    </div>
                </div>

                <!-- <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4cd" class="form-control" />
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                        I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                </div> -->

                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <?= $this->Form->button(__('Submit'), [
                        'class' => 'btn btn-primary btn-lg',
                        'style' => 'padding-left: 2.5rem; padding-right: 2.5rem;'
                      ]) ?>
                   
                </div>

                <?= $this->Form->end() ?>

            </div>
            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
            </div>

        </div>

    </div>
    </div>
</section>












