<div class="topicos view">
    <h3><?php echo $topico['Topico']['nome']; ?></h3>
    <dl>
        <dt><?php echo __('Description'); ?></dt>
        <dd>
			<?php echo h($topico['Topico']['descricao']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Theme'); ?></dt>
        <dd>
			<?php echo $this->Html->link($topico['Tema']['nome'], array('controller' => 'temas', 'action' => 'view', $topico['Tema']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="related">
    <h4>Questions in this topic:</h4>
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
