<header>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container"> 
            <a href="<?php echo e(url('/')); ?>" class="navbar-brand">
                <?php echo e(config('app.name')); ?>

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                 
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                    <?php echo $__env->make('partials.navigations.'.\App\User::navigation(), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </ul>
              
            </div>
        </div>
    </nav>
</header>