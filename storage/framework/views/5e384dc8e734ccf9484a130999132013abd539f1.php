<?php $__env->startSection('content'); ?>
<section class="content-header">
        <h1>Categorias</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Categorias</li>
          
        </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                
            </div>
                <div class="box-body">
            

        
                            <a href="#" class="btn btn-xs btn-default btn-nuevo-categoria"  data-toggle="modal" data-target="#modal-nuevolista">Nuevo Categoria</a>

                            <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Categoria</th>
                                        
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($reg->childs->count()>0): ?>   
                                           <tr>
                                                <th scope="row"><?php echo e($key+1); ?></th>
                                                <td><?php echo e($reg->name); ?> </td>
                                                
                                                
                                                <td><?php echo e($reg->updated_at); ?></td>
                                                <td>
                                                        <a href="#" data-id="<?php echo e($reg->id); ?>"  class="btn btn-default btn-editar-category btn-xs">Editar</a>
                                                        <a href="#" data-id="<?php echo e($reg->id); ?>" class="btn btn-danger btn-borrar-category btn-xs">Borrar</a>
                                                </td>
                                            </tr>
                                            <?php $__currentLoopData = $reg->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="subpage">
                                                    <th scope="row"></th>
                                                    <td>-- <?php echo e($sub->name); ?> </td>
                                                    
                                                   
                                                    <td><?php echo e($sub->updated_at); ?></td>
                                                    <td>
                                                            <a href="#" data-id="<?php echo e($sub->id); ?>"  class="btn btn-default btn-editar-category btn-xs">Editar</a>
                                                            <a href="#" data-id="<?php echo e($sub->id); ?>" class="btn btn-danger btn-borrar-category btn-xs">Borrar</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key+1); ?></th>
                                            <td><?php echo e($reg->name); ?> </td>
                                            
                                           
                                            <td><?php echo e($reg->updated_at); ?></td>
                                            <td>
                                                    <a href="#" data-id="<?php echo e($reg->id); ?>"  class="btn btn-default btn-editar-category btn-xs">Editar</a>
                                                    <a href="#" data-id="<?php echo e($reg->id); ?>" class="btn btn-danger btn-borrar-category btn-xs">Borrar</a>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
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
            <form id="fr-nuevo-category" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

               
              <input type="hidden" name="admin_id" id="admin_id" value="<?php echo e($admin_id); ?>">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva Categoria</h4>
              </div>
              <div class="modal-body">
                  
                  <div class="form-group">
                      <label for="executiontime">Categoria</label>
                      <input type="text" name="nombre"  class="form-control" />
                        
                  </div>
                  <div class="form-group">
                      <label for="herencia">Categoria a heredar</label>
                      <select name="parent_id" class="form-control"  
						<?php if(count($registros)==0): ?>
							 disabled
						<?php endif; ?>
					   >
                        <option value="0">Seleccione</option>
                         <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($rg->id); ?>"><?php echo e($rg->name); ?></option>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                        
                  </div>
                 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger btn-save-category">Guardar</button>
              </div>
            </form>
        </div>
      </div>
    </div>


    <div class="modal modal-default fade" id="modal-editservice">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="fr-edit-category">
                    <?php echo e(csrf_field()); ?>

                  <input name="_method" type="hidden" value="PUT">
                  <input type="hidden" name="id" id="id" value="">
                  <input type="hidden" name="admin_id" id="admin_id" value="<?php echo e($admin_id); ?>">
                
                  <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Editar Categoria</h4>
                </div>
                
                <div class="modal-body">


                    
                  <div class="form-group">
                        <label for="executiontime">Categoria o subcategoria</label>
                        <input type="text" name="nombre" id="nombre"  class="form-control" />
                          
                    </div>
                    <div class="form-group">
                        <label for="herencia">Categoria a heredar</label>
                            <select name="parent_id" id="parent_id" class="form-control" 
							 <?php if(count($registros)==0): ?>
							 disabled
							<?php endif; ?>
							>
                                <option value="0">Seleccione</option>
                                 <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rg->id); ?>"><?php echo e($rg->name); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          
                    </div>
                   
        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-danger btn-save-edit-category">Guardar</button>
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