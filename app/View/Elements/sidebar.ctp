<h4>GRUPOS RECENTES</h4>
<ul class="nav nav-list" id="side-menu">
    <?php foreach ($gruposSidebar as $grupo): ?>
        <li class="nav-header"><?php echo $grupo['Grupo']['nome']; ?></li>
        <?php foreach ($grupo['Tema'] as $tema): ?>
        <li class="fsize">
            <?php echo $this->Html->link(
                    $tema['nome'],
                    array('controller' => 'temas', 'action' => 'view', $tema['id'])
            ) ?>
        </li>
        <?php endforeach; ?>
        <li>
            <span>
            <?php echo $this->Html->link(
                    'Mais em ' . $grupo['Grupo']['nome'],
                    array('controller' => 'grupos', 'action' => 'view', $grupo['Grupo']['id']),
                    array('class' => 'btn btn-mini')
            ); ?>
            </span>
        </li>
        <li class="divider"></li>
    <?php endforeach; ?>
</ul>