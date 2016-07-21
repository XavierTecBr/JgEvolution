<?php

/*
 * Exibir os erros no Bootstrap.
 */

if (isset($_SESSION['erros'])):
    echo '<div class="alert alert-danger alert-dismissable" style="">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    foreach ($_SESSION['erros'] as $erros):
        echo '<p>' . $erros . '</p>';
    endforeach;
    echo '</div>';
    unset($_SESSION['erros']);
endif;
