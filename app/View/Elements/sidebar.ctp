<h4>Tópicos recentes</h4>
<div class="accordion" id="side-menu">
    <?php foreach ($topicosSidebar as $topico): ?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#side-menu" href="#topico1">
                <?php echo $topico['Topico']['nome']; ?>
            </a>
        </div>
        <div class="collapse" id="topico1">
            <ul class="nav nav-list nav-collapse">
                <?php foreach ($topico['Pergunta'] as $pergunta): ?>
                <li>
                    <?php echo $this->Html->link(
                            $pergunta['titulo'],
                            array('controller' => 'perguntas', 'action' => 'view', $pergunta['id'])
                    ) ?>
                </li>
                <?php endforeach; ?>
                <li class="divider"></li>
                <li>
                    <?php echo $this->Html->link(
                            'Visualizar este tópico',
                            array('controller' => 'topicos', 'action' => 'view', $topico['Topico']['id'])
                    ) ?>
                </li>
            </ul>
        </div>
    </div>
    <?php endforeach; ?>
</div>