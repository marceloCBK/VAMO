@extends ('layouts.template')
<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 07/06/14
 * Time: 16:18
 */
?>

<?php $title = 'Tipo de Produtos'; ?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<div class="ContentMain Center">
    <div class="ContentWrap">
        <?php
        echo '
        <div class="TopContents">
            <div class="Titulo">'.$title.'</div>
            <a class="Button info" title="Inserir '.$title.'" href="'.(($route)?$route.'/inserir':'').'"><i class="fa fa-plus"></i><div class="ITit">Inserir</div></a>
        </div>
        ';

        $response = json_decode(Session::get('resp'));
        if ($response){
            $mensagem = implode('<br />', $response->mensagem);
            echo '
            <div class="Msg'.(($response->resp)?' Success':' Danger').'">
                <button class="Close">×</button>
                '.$mensagem.'
            </div>
            ';
        }
        if ($produtosTipo[0]) {
            foreach ($produtosTipo as $produtosTipoRow) { //DADOS
                $produtosTipoPrint .= '
                    <tr'.(($resp->id==$produtosTipoRow->id_ptp)?' class="Marcar"':'').'>
                        <td headers="Nome">'.$produtosTipoRow->nome_ptp.'</td>
                        <td headers="Desde">'.date("d/m/Y",strtotime($produtosTipoRow->first_date_ptp)).'</td>
                        <td headers="Status">'.(($produtosTipoRow->status_ptp)
                                ?'<div class="Block Success">Ativado</div>'
                                :'<div class="Block Danger">Desativado</div>').'</td>
                        <td headers="Ações">
                        <div class="IBlock">
                            <a class="Warning alterar" title="Editar '.$produtosTipoRow->nome_ptp.'" href="'.(($route)?$route.'/'.$produtosTipoRow->id_ptp.'/editar':'').'"><i class="fa fa-edit"></i></a>
                            <a class="Danger  deletar" title="Deletar '.$produtosTipoRow->nome_ptp.'" href="'.(($route)?$route.'/'.$produtosTipoRow->id_ptp:'').'"><i class="fa fa-times"></i></a>
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
                <details><summary>Lista de '.$title.'</summary></details>
                <caption>Lista de '.$title.'</caption>

                <thead>
                <tr>
                    <th id="Nome">Nome</th>
                    <th id="Desde">Desde</th>
                    <th id="Status">Status</th>
                    <th id="Ações" class="col-lg-1">Ações</th>
                </tr>
                </thead>
                <tbody>
                '.$produtosTipoPrint.'
                </tbody>
            </table>
        </div>
        <div class="Center">
        '. $produtosTipo->links().'
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
    $(".Close").click(function(){
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