

<?php $__env->startSection('title', 'Saques'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gerenciar Saques</h1>
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
            <h3 class="card-title">Lista de Saques</h3>
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
                        <th>Chave PIX</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $saques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saque): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="<?php echo e($saque->status == 'pendente' ? 'table-warning' : ''); ?>">
                        <td><?php echo e($saque->id); ?></td>
                        <td>
                            <strong><?php echo e($saque->user->nome); ?></strong><br>
                            <small><?php echo e($saque->user->email); ?></small>
                        </td>
                        <td><strong>R$ <?php echo e(number_format($saque->valor, 2, ',', '.')); ?></strong></td>
                        <td><code><?php echo e($saque->chave_pix); ?></code></td>
                        <td><?php echo e($saque->created_at->format('d/m/Y H:i')); ?></td>
                        <td>
                            <span class="badge badge-<?php echo e($saque->status_color); ?>">
                                <?php echo e($saque->status_label); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($saque->status == 'pendente'): ?>
                                <form action="<?php echo e(route('admin.saques.aprovar', $saque->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-success" title="Aprovar">
                                        <i class="fas fa-check"></i> Aprovar e Pagar
                                    </button>
                                </form>
                                <form action="<?php echo e(route('admin.saques.rejeitar', $saque->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" title="Rejeitar" 
                                        onclick="return confirm('⚠️ Rejeitar saque de R$ <?php echo e(number_format($saque->valor, 2, ',', '.')); ?>? O valor será devolvido ao usuário.')">
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
                        <td colspan="7" class="text-center">Nenhum saque encontrado</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($saques->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/saques/index.blade.php ENDPATH**/ ?>