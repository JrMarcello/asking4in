<div class="grupos view">
	<h3>Temas em <?php echo $grupo['Grupo']['nome']; ?></h3>
	<?php if (!empty($temas)): ?>
		<table class="table table-striped table-hover table-bordered">
			<tr>
				<th><?php echo __('Nome'); ?></th>
				<th><?php echo __('Descrição') ?></th>
			</tr>
			<?php foreach ($temas as $tema): ?>
				<tr>
					<td><?php echo $this->Html->link($tema['Tema']['nome'], array(
						'controller' => 'temas', 'action' => 'view', $tema['Tema']['id']
					)); ?></td>
					<td><?php echo $tema['Tema']['descricao']; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>

	<?php echo $this->element('pagination'); ?>
</div>
