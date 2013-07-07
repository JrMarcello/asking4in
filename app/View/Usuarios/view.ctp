
<?php if ($isLogged): ?>
    <div>
        Hi, <?php echo $usuario['Usuario']['nome'];//debug($usuario);?>
    </div>
<?php else: ?>
    <div class="clearfix">&nbsp;</div>
    <div class="alert alert-info span8">Faça login para enviar sua resposta</div>
    <div class="clearfix"></div>
<?php endif; ?>
