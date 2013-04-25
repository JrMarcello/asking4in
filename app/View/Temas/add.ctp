<div class="temas form">
	<?php echo $this->Form->create('Tema', Configure::read('Form.Options')); ?>
	<fieldset>
		<legend><?php echo __('Add Tema'); ?></legend>
		<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('descricao', array('type' => 'textarea', 'label' => 'Descrição'));
		echo $this->Form->input('grupo_id');
		?>
	</fieldset>
	<?php echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-primary')); ?>
</div>
