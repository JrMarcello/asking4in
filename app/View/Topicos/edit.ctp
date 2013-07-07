<div class="topicos form">
	<?php echo $this->Form->create('Topico', array('inputDefaults' => Configure::read('Form.Defaults'))); ?>
	<fieldset>
		<legend><?php echo __('Edit Topic'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('descricao', array('type' => 'textarea', 'label' => 'Descrição'));
		echo $this->Form->input('tema_id');
		?>
	</fieldset>
	<?php echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn btn-primary')); ?>
</div>
