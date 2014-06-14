@extends ('layouts.template')
<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 07/06/14
 * Time: 16:18
 */
?>

<?php $title = 'Produtos'; ?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')

<div class="ContentMain Center">
    <div class="ContentWrap">
        <h1><% $title %></h1>

        <?php
        $resp = json_decode(Session::get('resp'));
        //print_r($resp);
        if ($resp){
            $mensagem = implode('<br />', $resp->mensagem);
            echo '
            <div class="Msg'.(($resp->response)?' success':' danger').'">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                '.$mensagem.'
            </div>
            ';
        }

        echo '<a type="button" class="Button info" title="Inserir '.$title.'" href="'.(($route)?$route.'/inserir':'').'"><i class="fa fa-plus"></i><div class="ITit">Inserir</div></a>';

        if ($produtos[0]) {
            foreach ($produtos as $produtosRow) { //DADOS
                $produtosPrint .= '
                    <tr'.(($resp->id==$produtosRow->id_pro)?' class="Marcar"':'').'>
                        <td>'.$produtosRow->nome_pro.'</td>
                        <td>'.$produtosRow->descricao_pro.'</td>
                        <td>'.$produtosRow->tipo->nome_ptp.'</td>
                        <td>'.date("d/m/Y",strtotime($produtosRow->first_date_pro)).'</td>
                        <td>'.(($produtosRow->status_pro)
                                ?'<div type="button" class="success">Ativado</div>'
                                :'<div type="button" class="danger">Desativado</div>').'</td>
                        <td>
                        <div class="IBlock">
                            <a type="button" class="warning alterar" title="Editar '.$produtosRow->nome_pro.'" href="'.(($route)?$route.'/'.$produtosRow->id_pro.'/editar':'').'"><i class="fa fa-edit"></i></a>
                            <a type="button" class="danger  deletar" title="Deletar '.$produtosRow->nome_pro.'" href="'.(($route)?$route.'/'.$produtosRow->id_pro:'').'"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
                    </tr>
                    ';
            }
        }

        //ESTRUTURA
        echo '
        <div class="Block">
            <table class="Table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th class="col-lg-6">Descrição</th>
                    <th>Tipo</th>
                    <th>Desde</th>
                    <th>Status</th>
                    <th class="col-lg-1">Ações</th>
                </tr>
                </thead>
                <tbody>
                '.$produtosPrint.'
                </tbody>
            </table>
        </div>
        <div class="Center">
        '. $produtos->links().'
        </div>';
        ?>
    </div>
</div>
@stop

@section('scripts')

<?php
echo '
<script>
$(function() {
    $(".close").click(function(){
        $(this).parent().fadeOut();
    });

    $(".deletar").click(function() {
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            type: "DELETE",
            success: function(result) {
                //console.log(result);
                reponse = $.parseJSON(result);

                if (reponse) {
                    location.reload();
                }
            }
        });
        return false;
    });
});
</script>
';
?>
@stop