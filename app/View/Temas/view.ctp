<div class="temas view">
    <h2><?php echo $tema['Tema']['nome']; ?></h2>
    <dl>
        <dt><?php echo __('Descricao'); ?></dt>
        <dd>
			<?php echo h($tema['Tema']['descricao']); ?>
            &nbsp;
        </dd>
        <dt>Grupo</dt>
        <dd>
			<?php echo $this->Html->link($tema['Grupo']['nome'], array('controller' => 'grupos', 'action' => 'view', $tema['Grupo']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="related">
	<h3>Tópicos:</h3>
	<?php if (!empty($topicos)): ?>
		<table class="table table-striped table-hover">
			<tr>
				<th><?php echo __('Nome'); ?></th>
				<th><?php echo __('Descricao'); ?></th>
			</tr>
			<?php foreach ($topicos as $topico): ?>
				<tr>
					<td><?php
						echo $this->Html->link($topico['Topico']['nome'], array(
							'controller' => 'topicos', 'action' => 'view', $topico['Topico']['id']
						));
						?></td>
					<td><?php echo $topico['Topico']['descricao']; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>

	<?php echo $this->element('pagination'); ?>
</div>
