<div class="topicos form">
<?php echo $this->Form->create('Topico'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Topico'); ?></legend>
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

		<li><?php echo $this->Html->link(__('List Topicos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Temas'), array('controller' => 'temas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tema'), array('controller' => 'temas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Perguntas'), array('controller' => 'perguntas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pergunta'), array('controller' => 'perguntas', 'action' => 'add')); ?> </li>
	</ul>
</div>
