

<?php $__env->startSection('title', 'Depósitos'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gerenciar Depósitos</h1>
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
            <h3 class="card-title">Lista de Depósitos</h3>
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
                        <th>Usuário</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Comprovante</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $depositos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="<?php echo e($deposito->status == 'pendente' ? 'table-warning' : ''); ?>">
                        <td><?php echo e($deposito->id); ?></td>
                        <td>
                            <strong><?php echo e($deposito->user->nome); ?></strong><br>
                            <small><?php echo e($deposito->user->email); ?></small>
                        </td>
                        <td><strong>R$ <?php echo e(number_format($deposito->valor, 2, ',', '.')); ?></strong></td>
                        <td><?php echo e($deposito->created_at->format('d/m/Y H:i')); ?></td>
                        <td>
                            <span class="badge badge-<?php echo e($deposito->status_color); ?>">
                                <?php echo e($deposito->status_label); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($deposito->comprovante): ?>
                                <a href="<?php echo e($deposito->comprovante); ?>" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file"></i> Ver
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Sem comprovante</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($deposito->status == 'pendente'): ?>
                                <form action="<?php echo e(route('admin.depositos.aprovar', $deposito->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-success" title="Aprovar">
                                        <i class="fas fa-check"></i> Aprovar
                                    </button>
                                </form>
                                <form action="<?php echo e(route('admin.depositos.rejeitar', $deposito->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" title="Rejeitar" 
                                        onclick="return confirm('Rejeitar depósito de R$ <?php echo e(number_format($deposito->valor, 2, ',', '.')); ?>?')">
                                        <i class="fas fa-times"></i> Rejeitar
                                    </button>
                                </form>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center">Nenhum depósito encontrado</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($depositos->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/depositos/index.blade.php ENDPATH**/ ?>