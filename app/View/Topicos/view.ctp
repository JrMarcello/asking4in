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
    <h3><?php echo __('Perguntas neste Tópico'); ?></h3>
    <?php if (!empty($perguntas)): ?>
    <div class="span6">
        <table class="table">
            <?php foreach ($perguntas as $pergunta): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link(h($pergunta['Pergunta']['titulo']),
                            array('controller' => 'perguntas', 'action' => 'view', $pergunta['Pergunta']['id'])); ?>&nbsp;
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <?= $this->element('pagination') ?>
    </div>
    <?php endif; ?>
</div>
