<aside class="main-sidebar">
  
    <section class="sidebar">
      
      <ul class="sidebar-menu">
        <?php echo $__env->make('partials.sidebars.'.\App\User::navigation(), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
      </ul>
    </section>
 
  </aside>