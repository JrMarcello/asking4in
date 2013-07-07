<div class="topicos view">
<h2><?php  echo __('Topic'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($topico['Topico']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($topico['Topico']['descricao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($topico['Topico']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Theme'); ?></dt>
		<dd>
			<?php echo $this->Html->link($topico['Tema']['nome'], array('controller' => 'temas', 'action' => 'view', $topico['Tema']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Topic'), array('action' => 'edit', $topico['Topico']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Topic'), array('action' => 'delete', $topico['Topico']['id']), null, __('Are you sure you want to delete # %s?', $topico['Topico']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Topics'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Topic'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes'), array('controller' => 'temas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('controller' => 'temas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'perguntas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'perguntas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($topico['Pergunta'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conteudo'); ?></th>
		<th><?php echo __('Usuario Id'); ?></th>
		<th><?php echo __('Topico Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($topico['Pergunta'] as $pergunta): ?>
		<tr>
			<td><?php echo $pergunta['id']; ?></td>
			<td><?php echo $pergunta['conteudo']; ?></td>
			<td><?php echo $pergunta['usuario_id']; ?></td>
			<td><?php echo $pergunta['topico_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'perguntas', 'action' => 'view', $pergunta['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'perguntas', 'action' => 'edit', $pergunta['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'perguntas', 'action' => 'delete', $pergunta['id']), null, __('Are you sure you want to delete # %s?', $pergunta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'perguntas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
