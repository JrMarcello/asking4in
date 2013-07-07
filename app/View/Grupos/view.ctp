<div class="grupos view">
	<h3>Themes in <?php echo __($grupo['Grupo']['nome']); ?></h3>
	<?php if (!empty($temas)): ?>
		<table class="table table-striped table-hover table-bordered">
			<tr>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Description') ?></th>
			</tr>
			<?php foreach ($temas as $tema): ?>
				<tr>
					<td><?php echo $this->Html->link(__($tema['Tema']['nome']), array(
						'controller' => 'temas', 'action' => 'view', $tema['Tema']['id']
					)); ?></td>
					<td><?php echo __($tema['Tema']['descricao']); ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>

	<?php echo $this->element('pagination'); ?>
</div>
