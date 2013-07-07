<div class="perguntas index">
    <h3><?php echo __('Questions'); ?></h3>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th><?php echo $this->Paginator->sort('title'); ?></th>
            <th><?php echo $this->Paginator->sort('user'); ?></th>
            <th><?php echo $this->Paginator->sort('topic'); ?></th>
        </tr>
        <?php foreach ($perguntas as $pergunta): ?>
            <tr>
                <td><?php echo $this->Html->link(h($pergunta['Pergunta']['titulo']), array('action' => 'view', $pergunta['Pergunta']['id'])); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($pergunta['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $pergunta['Usuario']['id'])); ?>
                </td>
                <td>
                    <?php echo $this->Html->link($pergunta['Topico']['nome'], array('controller' => 'topicos', 'action' => 'view', $pergunta['Topico']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <?= $this->element('pagination'); ?>
</div>
