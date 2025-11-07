

<?php $__env->startSection('title', 'Relatórios'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Relatórios Financeiros</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/admin-custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/admin-clean.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>R$ <?php echo e(number_format($totalDepositos, 2, ',', '.')); ?></h3>
                    <p>Total Depositado</p>
                </div>
                <div class="icon">
                    <i class="fas fa-arrow-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>R$ <?php echo e(number_format($totalSaques, 2, ',', '.')); ?></h3>
                    <p>Total Sacado</p>
                </div>
                <div class="icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>R$ <?php echo e(number_format($totalApostas, 2, ',', '.')); ?></h3>
                    <p>Total Apostado</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-<?php echo e($lucroCasa > 0 ? 'success' : 'danger'); ?>">
                <div class="inner">
                    <h3>R$ <?php echo e(number_format($lucroCasa, 2, ',', '.')); ?></h3>
                    <p>Lucro da Casa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Apostas por Mês</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Período</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $apostasPorMes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(str_pad($mes->mes, 2, '0', STR_PAD_LEFT)); ?>/<?php echo e($mes->ano); ?></td>
                            <td><?php echo e($mes->total); ?></td>
                            <td>R$ <?php echo e(number_format($mes->valor_total, 2, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center">Nenhum dado disponível</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resumo</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><strong>Total Depositado:</strong></td>
                            <td class="text-right text-success">R$ <?php echo e(number_format($totalDepositos, 2, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Sacado:</strong></td>
                            <td class="text-right text-warning">R$ <?php echo e(number_format($totalSaques, 2, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Saldo em Carteiras:</strong></td>
                            <td class="text-right">R$ <?php echo e(number_format($totalDepositos - $totalSaques, 2, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Apostado:</strong></td>
                            <td class="text-right text-info">R$ <?php echo e(number_format($totalApostas, 2, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Pago (Prêmios):</strong></td>
                            <td class="text-right text-danger">R$ <?php echo e(number_format($totalPago, 2, ',', '.')); ?></td>
                        </tr>
                        <tr class="bg-light">
                            <td><strong>LUCRO DA CASA:</strong></td>
                            <td class="text-right"><strong>R$ <?php echo e(number_format($lucroCasa, 2, ',', '.')); ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/relatorios/index.blade.php ENDPATH**/ ?>