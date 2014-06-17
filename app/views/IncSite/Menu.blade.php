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
            <a class="MenuButton Escuro" href="'.($link = '/inicio').'"               title="'.($siteName).'">                                    <div>'.$MenuMark.'Início'.'</div></a>
            <a class="MenuButton Escuro" href="'.($link = '/produtos').'"             title="'.($MenuName = "Produtos").'">                       <div>'.$MenuMark.$MenuName.'</div></a>
            <a class="MenuButton Escuro" href="'.($link = '/tipos').'"                title="'.($MenuName = "Tipos de Produtos").'">              <div>'.$MenuMark.$MenuName.'</div></a>
        </div>
        ';
        ?>
    </div>
</div>
