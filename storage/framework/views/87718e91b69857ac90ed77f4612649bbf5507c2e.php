<?php $__env->startSection('content'); ?>
<section class="content-header">
        <h1>CONFIGURACIONES DE ENTORNO</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Listado de servicios</li>
          
        </ol>
</section>
<section class="content">
        <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            SERVICIOS
                        </div>
                        <div class="box-body">
            
                                <a href="#" class="btn btn-xs btn-default btn-nuevo-categoria"  data-toggle="modal" data-target="#modal-nuevolista">Nuevo Categoria</a>
                    
        
                            <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Servicio</th>
                                        
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php if($reg->childs->count()>0): ?>   
                                   <tr <?php if($reg->status==1): ?>
									   class="clsoff"
									   <?php endif; ?>
									   >
                                        <th scope="row"> * </th>
                                        <td><?php echo e($reg->name); ?> </td>
                                        
                                        
                                       
                                        <td>
                                             <a href="#" data-id="<?php echo e($reg->id); ?>"  class="btn btn-default btn-editar-category btn-xs">Editar</a>
											<?php if($reg->status==1): ?>
											<a  href="#" class="btn btn-estado btn-xs btn-primary" data-id="<?php echo e($reg->id); ?>" data-estado="2" >Activar</a>
				  							<?php else: ?>
											<a  href="#" class="btn btn-estado btn-xs btn-primary" data-id="<?php echo e($reg->id); ?>" data-estado="1">Desactivar</a>
											<?php endif; ?>
                                             <a href="#" data-id="<?php echo e($reg->id); ?>" class="btn btn-danger btn-borrar-category btn-xs">Borrar</a>
                                        </td>
                                    </tr>
                                    <?php $__currentLoopData = $reg->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="subpage 
											   <?php if($reg->status==1): ?>
											   clsoff
											   <?php endif; ?>
											   ">
                                            <th scope="row"></th>
                                            <td>-- <?php echo e($sub->name); ?> </td>
                                            
                                           
                                           
                                            <td>
                                                    <a href="#" data-id="<?php echo e($sub->id); ?>"  class="btn btn-default btn-editar-category btn-xs">Editar</a>
											<?php if($sub->status==1): ?>
											<a  href="#" class="btn btn-sub-estado btn-xs btn-primary" data-id="<?php echo e($sub->id); ?>" data-estado="2" >Activar</a>
				  							<?php else: ?>
											<a  href="#" class="btn btn-sub-estado btn-xs btn-primary" data-id="<?php echo e($sub->id); ?>" data-estado="1">Desactivar</a>
											<?php endif; ?>
                                                    <a href="#" data-id="<?php echo e($sub->id); ?>" class="btn btn-danger btn-borrar-category btn-xs">Borrar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <p>&nbsp;</p>
                                      </tbody>
                            </table>    
                            <?php echo e($servicios->links()); ?>    
                       
                   
                        </div>
                    </div>             
                </div>  

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            MODIFICAR DATOS DE ACCESO
                        </div>
                        <div class="box-body">
            

        
                            <form  id="fr-datosacceso" action="/admin/entorno/<?php echo e($admin->id); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input name="_method" type="hidden" value="PUT">
                                    <input type="hidden" name="id" id="id" value="<?php echo e($admin->id); ?>">
                                    
                                    <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo e($admin->email); ?>" placeholder="Email">
                                            <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="form-group  <?php echo e($errors->has('oldpassword') ? ' has-error' : ''); ?>">
                                            <label for="password">Password Anterior</label>
                                            <input type="password" name="oldpassword" class="form-control" placeholder="Password anterior">
                                            <?php if($errors->has('oldpassword')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('oldpassword')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div> 
                                    <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                            <label for="password">Password Nuevo</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password nuevo">
                                            <?php if($errors->has('password')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    <div class="form-group <?php echo e($errors->has('npassword') ? ' has-error' : ''); ?>">
                                            <label for="password">Repita Password</label>
                                            <input type="password" name="npassword" class="form-control " placeholder="Repita password">
                                            <?php if($errors->has('npassword')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('npassword')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                    </div> 

                                    <div class="modal-footer">
                                           
                                            <button type="submit" class="btn btn-danger btn-save-mdatas">Guardar</button>
                                    </div>
                            </form> 
                       
                   
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
						<?php if(count($servicios)==0): ?>
							 disabled
						<?php endif; ?>
					   >
							  
                        <option value="0">Seleccione</option>
                         <?php $__currentLoopData = $servall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
								<?php if(count($servicios)==0): ?>
							 		disabled
								<?php endif; ?>
							   >
                                <option value="0">Seleccione</option>
                                 <?php $__currentLoopData = $servall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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