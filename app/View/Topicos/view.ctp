<div class="topicos view">
    <h2><?php echo $topico['Topico']['nome']; ?></h2>
    <dl>
        <dt><?php echo __('Descricao'); ?></dt>
        <dd>
			<?php echo h($topico['Topico']['descricao']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Tema'); ?></dt>
        <dd>
			<?php echo $this->Html->link($topico['Tema']['nome'], array('controller' => 'temas', 'action' => 'view', $topico['Tema']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="related">
    <h3>Perguntas neste tópico:</h3>
	<?php if (!empty($perguntas)): ?>
	    <div class="span6">
	        <table class="table table-striped table-hover">
				<?php foreach ($perguntas as $pergunta): ?>
		            <tr>
		                <td><?php echo $this->Html->link(h($pergunta['Pergunta']['titulo']), array(
								'controller' => 'perguntas', 'action' => 'view', $pergunta['Pergunta']['id']
						));?></td>
		            </tr>
				<?php endforeach; ?>
	        </table>

			<?= $this->element('pagination') ?>
	    </div>
	<?php endif; ?>
</div>
