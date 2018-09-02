<div class="col-md-4">
    <div class="card">
        <div class="card-header"><?php echo e(__("Socialite")); ?></div>
        <div class="card-body">
            <a href="<?php echo e(route('social_auth',['driver' => 'google'])); ?>" class="btn btn-google btn-lg btn-block">
                <?php echo e(__('Google')); ?> <i class="fa fa-google"></i>
            </a>
            <a href="<?php echo e(route('social_auth',['driver' => 'facebook'])); ?>" class="btn btn-facebook btn-lg btn-block">
                <?php echo e(__('Facebook')); ?> <i class="fa fa-facebook"></i>
            </a>
        </div>
    </div>
</div>