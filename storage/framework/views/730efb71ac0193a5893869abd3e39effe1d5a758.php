<?php $__env->startSection('content'); ?>
<section class="content-header">
        <h1>Asociados</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Asociados</li>
          
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
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Marca Comercial</th>
                                        <th scope="col">Contacto</th>
                                        <th scope="col">Email contact</th>
                                        <th scope="col">Webmail</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                  <?php $__currentLoopData = $socios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $socio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       <th><?php echo e($key + 1); ?></th>
                                       <td><?php echo e(@$socio->name); ?></td>
                                       <td><?php echo e(@$socio->email); ?></td>
                                       <td><?php echo e(@$socio->profile->tradename); ?></td>
                                       <td><?php echo e(@$socio->profile->contact); ?></td>
                                       <td><?php echo e(@$socio->profile->email); ?></td>
                                       <td><?php echo e(substr(@$socio->profile->website, 0, 30)); ?></td>
                                        <td>
                                                <a href="/admin/listasociados/<?php echo e($socio->id); ?>/edit "  data-id="<?php echo e($socio->id); ?>" class="btn btn-xs btn-default btn-listasociados-editar-link">Editar</a>
                                                 
											<?php if($socio->status==1): ?>
											     <a href="#" data-id="<?php echo e($socio->id); ?>" class="btn btn-xs  btn-warning btn-listausuario-activa">Activar</a>
											<?php else: ?>
												 <a href="#" data-id="<?php echo e($socio->id); ?>" class="btn btn-xs btn-success btn-listausuario-desactiva">Desactivar</a>
											<?php endif; ?>
                                                <a href="#" data-id="<?php echo e($socio->id); ?>" class="btn btn-xs btn-danger btn-listasociados-delete">Eliminar</a>
											
                                                
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

   

    <div class="modal modal-default fade" id="modal-edit-listasociados">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="fr-edit-listasociados">
                    <?php echo e(csrf_field()); ?>

                    
                  <input name="_method" type="hidden" value="PUT">
                  <input type="hidden" name="id" id="id" value="">
                
                  <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Editar Datos Asociado</h4>
                </div>
                
                <div class="modal-body">

                    <div class="form-group">
                        <label for="marca">Marca Comercial</label>
                        <input type="text" name="marca" id="marca" class="form-control">
                    </div>
  
                    <div class="form-group">
                        <label for="marca">Contacto</label>
                        <input type="text" name="contacto" id="contacto" class="form-control">
                    </div> 

                    <div class="form-group">
                        <label for="email">Email Contacto</label>
                        <input type="email" name="emailcontacto" id="emailcontacto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="precio">Website</label>
                        <input type="text" name="website" id="website" class="form-control" />
                          
                    </div>
                   
        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-danger btn-save-listasociados">Guardar</button>
                </div>
            </form>
          </div>
        </div>    
    </div>

    <form id="fr-listcliente-service" method="post" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <input name="_method" type="hidden" value="PUT">
    </form>

<form id="fr-delete">
      <?php echo e(csrf_field()); ?>

      <input name="_method" type="hidden" value="DELETE">  
</form>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>