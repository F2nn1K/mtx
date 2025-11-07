

<?php $__env->startSection('title', 'Corridas'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gerenciar Corridas</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/admin-custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/admin-clean.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Corridas</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('admin.corridas.create')); ?>" class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i> Nova Corrida
                </a>
            </div>
        </div>
        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Local</th>
                        <th>Data/Hora</th>
                        <th>Categoria</th>
                        <th>Pilotos</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $corridas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $corrida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($corrida->id); ?></td>
                        <td><strong><?php echo e($corrida->nome); ?></strong></td>
                        <td><?php echo e($corrida->local); ?></td>
                        <td><?php echo e($corrida->data_hora->format('d/m/Y H:i')); ?></td>
                        <td><?php echo e($corrida->categoria); ?></td>
                        <td><?php echo e($corrida->pilotos()->count()); ?></td>
                        <td>
                            <?php if($corrida->status == 'aberta'): ?>
                                <span class="badge badge-success">Aberta</span>
                            <?php elseif($corrida->status == 'ao_vivo'): ?>
                                <span class="badge badge-danger">Ao Vivo</span>
                            <?php elseif($corrida->status == 'finalizada'): ?>
                                <span class="badge badge-secondary">Finalizada</span>
                            <?php else: ?>
                                <span class="badge badge-warning"><?php echo e(ucfirst($corrida->status)); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.corridas.edit', $corrida->id)); ?>" class="btn btn-sm btn-primary" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="<?php echo e(route('admin.corridas.destroy', $corrida->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('⚠️ ATENÇÃO! Isso vai excluir a corrida e TODAS as <?php echo e($corrida->apostas()->count()); ?> apostas relacionadas. Tem certeza?')" 
                                    title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center">Nenhuma corrida cadastrada</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($corridas->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/corridas/index.blade.php ENDPATH**/ ?>