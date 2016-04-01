<li class="grid-node col-3">
    <hr>
    <h3><a href="<?php echo get_permalink($program->ID); ?>"><?php echo get_the_title($program->ID); ?></a></h3>
    <p class="hug small strong text-muted">
        <?php
        $masters = get_field('masters_degree_awarded', $program->ID);
        $phd = get_field('doctoral_degree_awarded', $program->ID);
        $certificate = get_field('certificate_awarded', $program->ID);

        echo ($masters) ? "{$masters}<br>" : "";
        echo ($phd) ? "{$phd}<br>" : "";
        echo ($certificate) ? $certificate : "";

        ?>
    </p>
</li>
