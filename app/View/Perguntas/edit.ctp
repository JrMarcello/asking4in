<div class="perguntas form">
<?php echo $this->Form->create('Pergunta'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pergunta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('conteudo');
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('topico_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Pergunta.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Pergunta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Perguntas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Topicos'), array('controller' => 'topicos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Topico'), array('controller' => 'topicos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Respostas'), array('controller' => 'respostas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resposta'), array('controller' => 'respostas', 'action' => 'add')); ?> </li>
	</ul>
</div>
