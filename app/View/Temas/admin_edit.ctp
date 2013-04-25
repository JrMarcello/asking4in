<div class="temas form">
<?php echo $this->Form->create('Tema'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Tema'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('descricao');
		echo $this->Form->input('nome');
		echo $this->Form->input('grupo_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tema.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Tema.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Temas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Grupos'), array('controller' => 'grupos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupo'), array('controller' => 'grupos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Topicos'), array('controller' => 'topicos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Topico'), array('controller' => 'topicos', 'action' => 'add')); ?> </li>
	</ul>
</div>
