<div class="respostas view">
<h2><?php  echo __('Answers'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($resposta['Resposta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conteudo'); ?></dt>
		<dd>
			<?php echo h($resposta['Resposta']['conteudo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Score'); ?></dt>
		<dd>
			<?php echo h($resposta['Resposta']['score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pergunta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resposta['Pergunta']['conteudo'], array('controller' => 'perguntas', 'action' => 'view', $resposta['Pergunta']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resposta['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $resposta['Usuario']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Resposta'), array('action' => 'edit', $resposta['Resposta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Resposta'), array('action' => 'delete', $resposta['Resposta']['id']), null, __('Are you sure you want to delete # %s?', $resposta['Resposta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Respostas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resposta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Perguntas'), array('controller' => 'perguntas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pergunta'), array('controller' => 'perguntas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
