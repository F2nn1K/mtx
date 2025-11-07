

<?php $__env->startSection('title', 'Painel Principal'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Painel Principal - Roraima Bets</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e($totalUsuarios); ?></h3>
                    <p>Usuários Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="<?php echo e(route('admin.usuarios')); ?>" class="small-box-footer">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box" style="background: linear-gradient(135deg, #1a4d3a 0%, #0d2818 100%); color: white;">
                <div class="inner">
                    <h3 style="color: #d4af37;"><?php echo e($totalCorridas); ?></h3>
                    <p>Corridas Cadastradas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-flag-checkered"></i>
                </div>
                <a href="<?php echo e(route('admin.corridas.index')); ?>" class="small-box-footer" style="background: rgba(212, 175, 55, 0.2);">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo e($totalApostasHoje); ?></h3>
                    <p>Apostas Hoje</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <a href="<?php echo e(route('admin.apostas')); ?>" class="small-box-footer">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>R$ <?php echo e(number_format($valorApostasHoje, 2, ',', '.')); ?></h3>
                    <p>Volume Hoje</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="<?php echo e(route('admin.relatorios')); ?>" class="small-box-footer">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <?php if($depositosPendentes > 0): ?>
        <div class="col-md-6">
            <div class="alert alert-warning">
                <h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>
                Existem <strong><?php echo e($depositosPendentes); ?></strong> depósitos pendentes de aprovação.
                <a href="<?php echo e(route('admin.depositos')); ?>" class="alert-link">Clique aqui para visualizar</a>
            </div>
        </div>
        <?php endif; ?>

        <?php if($saquesPendentes > 0): ?>
        <div class="col-md-6">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info-circle"></i> Atenção!</h5>
                Existem <strong><?php echo e($saquesPendentes); ?></strong> saques pendentes de aprovação.
                <a href="<?php echo e(route('admin.saques')); ?>" class="alert-link">Clique aqui para visualizar</a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php if($corridasAoVivo->count() > 0): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-circle text-danger"></i> Corridas AO VIVO</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Data/Hora</th>
                                <th>Apostas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $corridasAoVivo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $corrida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($corrida->nome); ?></strong></td>
                                <td><?php echo e($corrida->local); ?></td>
                                <td><?php echo e($corrida->data_hora->format('d/m/Y H:i')); ?></td>
                                <td><?php echo e($corrida->apostas()->count()); ?> apostas</td>
                                <td>
                                    <a href="<?php echo e(route('admin.corridas.edit', $corrida->id)); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Gerenciar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar"></i> Próximas Corridas</h3>
                </div>
                <div class="card-body">
                    <?php if($proximasCorridas->count() > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Data/Hora</th>
                                <th>Pilotos</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $proximasCorridas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $corrida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($corrida->nome); ?></td>
                                <td><?php echo e($corrida->local); ?></td>
                                <td><?php echo e($corrida->data_hora->format('d/m/Y H:i')); ?></td>
                                <td><?php echo e($corrida->pilotos()->count()); ?> pilotos</td>
                                <td>
                                    <span class="badge badge-success"><?php echo e(ucfirst($corrida->status)); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p class="text-muted">Nenhuma corrida programada.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/admin-custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/admin-clean.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>