

<?php $__env->startSection('title', 'Editar Corrida'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Editar Corrida</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.corridas.update', $corrida->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome da Corrida *</label>
                            <input type="text" name="nome" id="nome" class="form-control <?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                value="<?php echo e(old('nome', $corrida->nome)); ?>" required>
                            <?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="local">Local *</label>
                            <input type="text" name="local" id="local" class="form-control <?php $__errorArgs = ['local'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                value="<?php echo e(old('local', $corrida->local)); ?>" required>
                            <?php $__errorArgs = ['local'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_hora">Data e Hora *</label>
                            <input type="datetime-local" name="data_hora" id="data_hora" 
                                class="form-control <?php $__errorArgs = ['data_hora'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                value="<?php echo e(old('data_hora', $corrida->data_hora->format('Y-m-d\TH:i'))); ?>" required>
                            <?php $__errorArgs = ['data_hora'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="categoria">Categoria *</label>
                            <select name="categoria" id="categoria" class="form-control <?php $__errorArgs = ['categoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Selecione</option>
                                <option value="MX1" <?php echo e(old('categoria', $corrida->categoria) == 'MX1' ? 'selected' : ''); ?>>MX1</option>
                                <option value="MX2" <?php echo e(old('categoria', $corrida->categoria) == 'MX2' ? 'selected' : ''); ?>>MX2</option>
                                <option value="MX3" <?php echo e(old('categoria', $corrida->categoria) == 'MX3' ? 'selected' : ''); ?>>MX3</option>
                                <option value="65cc" <?php echo e(old('categoria', $corrida->categoria) == '65cc' ? 'selected' : ''); ?>>65cc</option>
                                <option value="85cc" <?php echo e(old('categoria', $corrida->categoria) == '85cc' ? 'selected' : ''); ?>>85cc</option>
                            </select>
                            <?php $__errorArgs = ['categoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select name="status" id="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="aberta" <?php echo e(old('status', $corrida->status) == 'aberta' ? 'selected' : ''); ?>>Aberta</option>
                                <option value="ao_vivo" <?php echo e(old('status', $corrida->status) == 'ao_vivo' ? 'selected' : ''); ?>>Ao Vivo</option>
                                <option value="finalizada" <?php echo e(old('status', $corrida->status) == 'finalizada' ? 'selected' : ''); ?>>Finalizada</option>
                                <option value="cancelada" <?php echo e(old('status', $corrida->status) == 'cancelada' ? 'selected' : ''); ?>>Cancelada</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="3"><?php echo e(old('descricao', $corrida->descricao)); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Pilotos Participantes e Cotações</label>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">Selecionar</th>
                                    <th>Número</th>
                                    <th>Nome</th>
                                    <th width="150">Cotação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pilotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piloto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $pilotoCorrida = $corrida->pilotos->firstWhere('id', $piloto->id);
                                    $selecionado = $pilotoCorrida !== null;
                                    $cotacaoAtual = $selecionado ? $pilotoCorrida->pivot->cotacao : '';
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="pilotos_check[]" value="<?php echo e($piloto->id); ?>" 
                                            onchange="toggleCotacao(this, <?php echo e($piloto->id); ?>)" 
                                            <?php echo e($selecionado ? 'checked' : ''); ?>>
                                    </td>
                                    <td><?php echo e($piloto->numero); ?></td>
                                    <td><?php echo e($piloto->nome); ?></td>
                                    <td>
                                        <input type="number" name="pilotos[<?php echo e($piloto->id); ?>]" 
                                            id="cotacao_<?php echo e($piloto->id); ?>" 
                                            class="form-control" 
                                            step="0.01" 
                                            min="1.01" 
                                            placeholder="Ex: 2.50" 
                                            value="<?php echo e($cotacaoAtual); ?>"
                                            <?php echo e($selecionado ? '' : 'disabled'); ?>>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if($corrida->status == 'ao_vivo' || $corrida->status == 'aberta'): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Para finalizar a corrida e processar as apostas, 
                    use o botão "Finalizar Corrida" abaixo.
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Atualizar Corrida
                    </button>
                    <a href="<?php echo e(route('admin.corridas.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    
                    <?php if($corrida->status != 'finalizada' && $corrida->apostas()->count() > 0): ?>
                    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modalFinalizar">
                        <i class="fas fa-flag-checkered"></i> Finalizar Corrida
                    </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <?php if($corrida->status != 'finalizada' && $corrida->apostas()->count() > 0): ?>
    <!-- Modal Finalizar Corrida -->
    <div class="modal fade" id="modalFinalizar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Finalizar Corrida</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo e(route('admin.corridas.finalizar', $corrida->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <p><strong>Informe o resultado da corrida:</strong></p>
                        
                        <div class="form-group">
                            <label>1º Lugar *</label>
                            <select name="primeiro_lugar" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php $__currentLoopData = $corrida->pilotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piloto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($piloto->id); ?>">#<?php echo e($piloto->numero); ?> - <?php echo e($piloto->nome); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>2º Lugar *</label>
                            <select name="segundo_lugar" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php $__currentLoopData = $corrida->pilotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piloto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($piloto->id); ?>">#<?php echo e($piloto->numero); ?> - <?php echo e($piloto->nome); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>3º Lugar *</label>
                            <select name="terceiro_lugar" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php $__currentLoopData = $corrida->pilotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piloto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($piloto->id); ?>">#<?php echo e($piloto->numero); ?> - <?php echo e($piloto->nome); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Volta Mais Rápida</label>
                            <select name="volta_rapida" class="form-control">
                                <option value="">Selecione</option>
                                <?php $__currentLoopData = $corrida->pilotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piloto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($piloto->id); ?>">#<?php echo e($piloto->numero); ?> - <?php echo e($piloto->nome); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>Atenção!</strong> Após finalizar, as apostas serão processadas automaticamente 
                            e os vencedores receberão seus ganhos.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-flag-checkered"></i> Finalizar e Processar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
function toggleCotacao(checkbox, pilotoId) {
    const cotacaoInput = document.getElementById('cotacao_' + pilotoId);
    if (checkbox.checked) {
        cotacaoInput.disabled = false;
        cotacaoInput.required = true;
    } else {
        cotacaoInput.disabled = true;
        cotacaoInput.required = false;
        cotacaoInput.value = '';
    }
}
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leo\Documents\site de apostas\resources\views/admin/corridas/edit.blade.php ENDPATH**/ ?>