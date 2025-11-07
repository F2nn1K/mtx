

<?php $__env->startSection('title', 'Usuários'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Gerenciar Usuários</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/admin-custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/admin-clean.js')); ?>"></script>
<script>
function editarSaldo(userId, saldoAtual) {
    const novoSaldo = prompt('Editar saldo do usuário #' + userId + '\nSaldo atual: R$ ' + saldoAtual + '\n\nNovo saldo:', saldoAtual);
    if (novoSaldo !== null) {
        fetch('/admin/usuarios/' + userId + '/editar-saldo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ saldo: novoSaldo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ Saldo atualizado com sucesso!');
                location.reload();
            } else {
                alert('❌ Erro ao atualizar saldo!');
            }
        });
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Usuários</h3>
        </div>
        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Saldo</th>
                            <th>Apostas</th>
                            <th>Status</th>
                            <th>Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($usuario->id); ?></td>
                            <td><strong><?php echo e($usuario->nome); ?></strong></td>
                            <td><?php echo e($usuario->email); ?></td>
                            <td><?php echo e($usuario->cpf); ?></td>
                            <td><strong>R$ <?php echo e(number_format($usuario->saldo, 2, ',', '.')); ?></strong></td>
                            <td><?php echo e($usuario->apostas_count); ?></td>
                            <td>
                                <?php if($usuario->ativo): ?>
                                    <span class="badge badge-success">Ativo</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Bloqueado</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($usuario->created_at->format('d/m/Y')); ?></td>
                            <td>
                                <form action="<?php echo e(route('admin.usuarios.toggle', $usuario->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php if($usuario->ativo): ?>
                                        <button type="submit" class="btn btn-sm btn-warning" 
                                            onclick="return confirm('Bloquear <?php echo e($usuario->nome); ?>?')" 
                                            title="Bloquear">
                                            <i class="fas fa-ban"></i> Bloquear
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-sm btn-success" 
                                            onclick="return confirm('Ativar <?php echo e($usuario->nome); ?>?')" 
                                            title="Ativar">
                                            <i class="fas fa-check"></i> Ativar
                                        </button>
                                    <?php endif; ?>
                                </form>
                                <button class="btn btn-sm btn-info" onclick="editarSaldo(<?php echo e($usuario->id); ?>, <?php echo e($usuario->saldo); ?>)" title="Editar Saldo">
                                    <i class="fas fa-wallet"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center">Nenhum usuário encontrado</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($usuarios->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/usuarios/index.blade.php ENDPATH**/ ?>