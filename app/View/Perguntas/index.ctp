<div class="perguntas index">
    <h2><?php echo __('Perguntas'); ?></h2>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th><?php echo $this->Paginator->sort('conteudo'); ?></th>
            <th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
            <th><?php echo $this->Paginator->sort('topico_id'); ?></th>
        </tr>
        <?php foreach ($perguntas as $pergunta): ?>
            <tr>
                <td><?php echo $this->Html->link(h($pergunta['Pergunta']['conteudo']), array('action' => 'view', $pergunta['Pergunta']['id'])); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($pergunta['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $pergunta['Usuario']['id'])); ?>
                </td>
                <td>
                    <?php echo $this->Html->link($pergunta['Topico']['nome'], array('controller' => 'topicos', 'action' => 'view', $pergunta['Topico']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
