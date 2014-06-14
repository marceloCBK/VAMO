<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 16/05/14
 * Time: 22:50
 */
?>
<div class="ContentMain Center Back MenuMain">
    <div class="ContentWrap Center MenuWrap">
        <?php
        echo $Menu = '
        <div class="MenuBox">
            <a class="MenuButton Escuro" href="'.($link = '/inicio').'"               title="'.($siteName).'">                                    '.$MenuMark.'Início'.'</a>
            <a class="MenuButton Escuro" href="'.($link = '/produtos').'"             title="'.($MenuName = "Produtos").'">                       '.$MenuMark.$MenuName.'</a>
            <a class="MenuButton Escuro" href="'.($link = '/tipos').'"                title="'.($MenuName = "Tipos de Produtos").'">              '.$MenuMark.$MenuName.'</a>
        </div>
        ';
        ?>
    </div>
</div>
