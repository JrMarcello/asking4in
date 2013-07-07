<div class="grupos form">
<?php echo $this->Form->create('Grupo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('facebook_id');
		echo $this->Form->input('nome');
		echo $this->Form->input('Usuario');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
                <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Grupo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Grupo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Themes'), array('controller' => 'temas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('controller' => 'temas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
