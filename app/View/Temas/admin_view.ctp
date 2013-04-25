<div class="temas view">
<h2><?php  echo __('Tema'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tema['Tema']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descricao'); ?></dt>
		<dd>
			<?php echo h($tema['Tema']['descricao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($tema['Tema']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grupo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tema['Grupo']['nome'], array('controller' => 'grupos', 'action' => 'view', $tema['Grupo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tema['Tema']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tema['Tema']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tema'), array('action' => 'edit', $tema['Tema']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tema'), array('action' => 'delete', $tema['Tema']['id']), null, __('Are you sure you want to delete # %s?', $tema['Tema']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Temas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tema'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupos'), array('controller' => 'grupos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupo'), array('controller' => 'grupos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Topicos'), array('controller' => 'topicos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Topico'), array('controller' => 'topicos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Topicos'); ?></h3>
	<?php if (!empty($tema['Topico'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Descricao'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Tema Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tema['Topico'] as $topico): ?>
		<tr>
			<td><?php echo $topico['id']; ?></td>
			<td><?php echo $topico['descricao']; ?></td>
			<td><?php echo $topico['nome']; ?></td>
			<td><?php echo $topico['tema_id']; ?></td>
			<td><?php echo $topico['created']; ?></td>
			<td><?php echo $topico['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'topicos', 'action' => 'view', $topico['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'topicos', 'action' => 'edit', $topico['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'topicos', 'action' => 'delete', $topico['id']), null, __('Are you sure you want to delete # %s?', $topico['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Topico'), array('controller' => 'topicos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
