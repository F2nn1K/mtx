

<?php $__env->startSection('title', 'Apostas'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Todas as Apostas</h1>
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
            <h3 class="card-title">Lista de Apostas</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Corrida</th>
                            <th>Piloto</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Cotação</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $apostas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aposta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($aposta->id); ?></td>
                            <td>
                                <strong><?php echo e($aposta->user->nome); ?></strong><br>
                                <small><?php echo e($aposta->user->email); ?></small>
                            </td>
                            <td><?php echo e($aposta->corrida->nome); ?></td>
                            <td>#<?php echo e($aposta->piloto->numero); ?> <?php echo e($aposta->piloto->nome); ?></td>
                            <td><?php echo e($aposta->tipo_aposta_label); ?></td>
                            <td><strong>R$ <?php echo e(number_format($aposta->valor, 2, ',', '.')); ?></strong></td>
                            <td><?php echo e($aposta->cotacao); ?>x</td>
                            <td>
                                <?php if($aposta->status == 'ativa'): ?>
                                    <span class="badge badge-warning">Ativa</span>
                                <?php elseif($aposta->status == 'venceu'): ?>
                                    <span class="badge badge-success">Venceu - R$ <?php echo e(number_format($aposta->valor_ganho, 2, ',', '.')); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Perdeu</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($aposta->created_at->format('d/m/Y H:i')); ?></td>
                            <td>
                                <?php if($aposta->status == 'ativa'): ?>
                                <form action="<?php echo e(route('admin.apostas.cancelar', $aposta->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('⚠️ Cancelar aposta e devolver R$ <?php echo e(number_format($aposta->valor, 2, ',', '.')); ?> ao usuário?')" 
                                        title="Cancelar aposta">
                                        <i class="fas fa-times"></i> Cancelar
                                    </button>
                                </form>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center">Nenhuma aposta encontrada</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($apostas->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/apostas/index.blade.php ENDPATH**/ ?>