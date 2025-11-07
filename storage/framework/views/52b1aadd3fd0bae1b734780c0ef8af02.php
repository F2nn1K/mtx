

<?php $__env->startSection('title', 'Pilotos'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gerenciar Pilotos</h1>
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
            <h3 class="card-title">Lista de Pilotos</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('admin.pilotos.create')); ?>" class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i> Novo Piloto
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

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pilotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piloto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong>#<?php echo e($piloto->numero); ?></strong></td>
                        <td><?php echo e($piloto->nome); ?></td>
                        <td><?php echo e($piloto->categoria); ?></td>
                        <td>
                            <?php if($piloto->ativo): ?>
                                <span class="badge badge-success">Ativo</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Inativo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.pilotos.edit', $piloto->id)); ?>" class="btn btn-sm btn-primary" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('admin.pilotos.destroy', $piloto->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('⚠️ Excluir piloto <?php echo e($piloto->nome); ?>? Isso vai afetar corridas e apostas vinculadas!')" 
                                    title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum piloto cadastrado</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($pilotos->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/pilotos/index.blade.php ENDPATH**/ ?>