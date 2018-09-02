<aside class="main-sidebar">
  
        <section class="sidebar">
          
          <ul class="sidebar-menu">
              <li class="header">MENU</li>
              <li>
                    <a href="/admin/solicitudes">
                      <i class="fa fa-th"></i> <span>Solicitudes</span>
                    </a>
                  </li>
              <li>
                  <a  href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="fa fa-th"></i> <span> <?php echo e(__('Salir')); ?></span>
                  </a>
                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                      <?php echo e(csrf_field()); ?>

                  </form>
              </li>        
          </ul>
        </section>
     
      </aside>