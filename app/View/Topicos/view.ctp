<div class="topicos view">
    <h2><?php echo __('Tópico'); ?></h2>
    <dl>
        <dt><?php echo __('Nome'); ?></dt>
        <dd>
            <?php echo h($topico['Topico']['nome']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Descricao'); ?></dt>
        <dd>
            <?php echo h($topico['Topico']['descricao']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Tema'); ?></dt>
        <dd>
            <?php echo $this->Html->link($topico['Tema']['nome'], array('controller' => 'temas', 'action' => 'view', $topico['Tema']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="related">
    <h3><?php echo __('Perguntas deste Tópico'); ?></h3>
    <?php if (!empty($topico['Pergunta'])): ?>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th><?php echo __('Conteudo'); ?></th>
                <th><?php echo __('Usuario'); ?></th>
            </tr>
            <?php foreach ($topico['Pergunta'] as $pergunta): ?>
                <tr>
                <td><?php echo $this->Html->link(h($pergunta['conteudo']), array('controller' => 'perguntas', 'action' => 'view', $pergunta['id'])); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($pergunta['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $pergunta['Usuario']['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <?php // echo $this->Html->link(__('Perguntar neste Tópico'), array('controller' => 'perguntas', 'action' => 'add'), array('class' => 'btn'));  ?>
    </div>
</div>
