<div class="topicos form">
<?php echo $this->Form->create('Topico'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Topic'); ?></legend>
	<?php
		echo $this->Form->input('descricao');
		echo $this->Form->input('nome');
		echo $this->Form->input('tema_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Topics'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Themes'), array('controller' => 'temas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('controller' => 'temas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'perguntas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'perguntas', 'action' => 'add')); ?> </li>
	</ul>
</div>
