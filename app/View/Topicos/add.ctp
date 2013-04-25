<div class="topicos form">
	<?php echo $this->Form->create('Topico', Configure::read('Form.Options')); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Tópico'); ?></legend>
		<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('descricao', array('type' => 'textarea', 'label' => 'Descrição'));
		echo $this->Form->input('tema_id');
		?>
	</fieldset>
	<?php echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-primary')); ?>
</div>
