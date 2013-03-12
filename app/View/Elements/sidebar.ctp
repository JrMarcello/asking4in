<h4>Tópicos recentes</h4>
<ul class="nav nav-list" id="side-menu">
    <?php foreach ($topicosSidebar as $topico): ?>
        <li class="nav-header"><?php echo $topico['Topico']['nome']; ?></li>
        <?php foreach ($topico['Pergunta'] as $pergunta): ?>
        <li>
            <?php echo $this->Html->link(
                    $pergunta['titulo'],
                    array('controller' => 'perguntas', 'action' => 'view', $pergunta['id'])
            ) ?>
        </li>
        <?php endforeach; ?>
        <li>
            <span>
            <?php echo $this->Html->link(
                    'Mais em ' . $topico['Topico']['nome'],
                    array('controller' => 'topicos', 'action' => 'view', $topico['Topico']['id']),
                    array('class' => 'btn btn-mini')
            ); ?>
            </span>
        </li>
        <li class="divider"></li>
    <?php endforeach; ?>
</ul>