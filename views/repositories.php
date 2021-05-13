<?php if (!empty($repositories)): ?>
    <h1><?php esc_attr_e('Autor:', 'github-search'); ?></h1>

    <ul>
        <li>
            <a href="<?php echo esc_html($profile) ?>">
                <?php esc_attr_e('Visualizar', 'github-search'); ?>
            </a>
        </li>
    </ul>

    <h1><?php esc_attr_e('Repositórios:', 'github-search'); ?></h1>

    <ul>
        <?php foreach ($repositories as $repository): ?>
            <li><?php echo esc_html($repository->name) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
