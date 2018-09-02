<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->

    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Slabo+27px" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css?v=25')); ?>">
</head>
<body>
    <div id="app">
       <?php echo $__env->make('partials.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <main class="py-4">
            <?php if(session('message')): ?>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-{ session('message')[0] }}">
                        <h3><?php echo e(__('Mensaje informativo')); ?></h3>
                        <p><?php echo e(session('message')[1]); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>


<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GOOGLE_API_KEY')); ?>&libraries=places" ></script>
    <script src="<?php echo e(asset('js/main.js?v=19')); ?>" defer></script>
   
</body>
</html>
