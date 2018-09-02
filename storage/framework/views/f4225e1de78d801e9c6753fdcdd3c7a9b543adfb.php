

<?php $__env->startSection('content'); ?>
<section class="content-header">
        <h1>Clientes</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Clientes</li>
          
        </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                
            </div>
                <div class="box-body">
            

        
                            <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Fecha</th>
                                       
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                  <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       <th><?php echo e($key+1); ?></th>
                                       <td><?php echo e($client->name); ?> </td>
                                       <td><?php echo e($client->email); ?></td>
                                       <td><?php echo e($client->created_at); ?></td>
                                        <td>
                                                <a href="#"  data-id="<?php echo e(@$client->id); ?>" class="btn btn-xs btn-default btn-listcliente-editar">Editar</a>
                                                <?php if(@$client->status==1): ?>
                                                    <a href="#" data-id="<?php echo e(@$client->id); ?>" class="btn btn-xs btn-warning btn-listausuario-activa">Activar</a>
                                                <?php else: ?>
                                                  <a href="#" data-id="<?php echo e(@$client->id); ?>" class="btn btn-xs btn-success btn-listausuario-desactiva">Desactivar</a>
                                                <?php endif; ?>
                                                <a href="#" data-id="<?php echo e(@$client->id); ?>" class="btn btn-xs btn-danger btn-listcliente-delete">Eliminar</a>
                                                
                                        </td>
                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                            </table>        
                       
                   
                        </div>
                    </div>             
                </div>  
        </div>            
 </section>

    <div class="modal modal-default fade" id="modal-nuevolista">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="fr-listcliente-service" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input name="_method" type="hidden" value="PUT">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Cliente</h4>
              </div>
              <div class="modal-body">
                  
                  
                  

                  

                  
                  
                  
                 
              </div>
              
              <div class="modal-footer">
              
              </div>
            </form>
        </div>
      </div>
    </div>


    <div class="modal modal-default fade" id="modal-editlistcliente">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="fr-edit-listcliente">
                    <?php echo e(csrf_field()); ?>

                  <input name="_method" type="hidden" value="PUT">
                  <input type="hidden" name="id" id="id" value="">
                
                  <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Editar Datos Cliente</h4>
                </div>
                
                <div class="modal-body">


                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres" />
                          
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="email" />
                            
                    </div>
        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-danger btn-save-liscliente">Guardar</button>
                </div>
            </form>
          </div>
        </div>    
    </div>

<form id="fr-delete">
      <?php echo e(csrf_field()); ?>

      <input name="_method" type="hidden" value="DELETE">  
</form>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>