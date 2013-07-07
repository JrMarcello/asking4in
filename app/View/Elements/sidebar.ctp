<h4><?php echo __('RECENT GROUPS') ?></h4>
<ul class="nav nav-list" id="side-menu" >
    <?php foreach ($gruposSidebar as $grupo): ?>
    <li class="nav-header" ><?php echo __($grupo['Grupo']['nome']); ?></li>
        <?php foreach ($grupo['Tema'] as $tema): ?>
        <li class="fsize" style="margin-left: 10px;">
            <?php echo $this->Html->link(
                    __($tema['nome']),
                    array('controller' => 'temas', 'action' => 'view', $tema['id'])
            ) ?>
        </li>
        <?php endforeach; ?>
        <li>
            <span style="margin-left: 150px">
            <?php echo $this->Html->link(
                    '',// . $grupo['Grupo']['nome'],
                    array('controller' => 'grupos', 'action' => 'view', $grupo['Grupo']['id']),
                    array('class' => 'icon-plus-sign')
            ); ?>
            </span>
        </li>
        <li class="divider"></li>
    <?php endforeach; ?>
</ul>