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
                <button type="button" class="Close">×</button>
                '.$mensagem.'
            </div>
            ';
        }
        if ($produtos[0]) {
            foreach ($produtos as $produtosRow) { //DADOS
                if ($produtosRow->arquivos[0]) {
                    $routeImg = $produtosRow->arquivos[0]->caminho_arq.'/'.$produtosRow->arquivos[0]->nome_arq;
                    $vitrine = '<div class="Img"><img src="'.$routeImg.'" alt="'.$produtosRow->nome_pro.'" /></div>';
                } else {
                    unset($vitrine);
                }

                $produtosPrint .= '
                    <tr'.(($resp->id==$produtosRow->id_pro)?' class="Marcar"':'').' title="'.$produtosRow->nome_pro.'">
                        <td headers="Imagem">'.$vitrine.'</td>
                        <td headers="Nome">'.$produtosRow->nome_pro.'</td>
                        <td headers="Descrição">'.$produtosRow->descricao_pro.'</td>
                        <td headers="Tipo">'.$produtosRow->tipo->nome_ptp.'</td>
                        <td headers="Desde">'.date("d/m/Y",strtotime($produtosRow->first_date_pro)).'</td>
                        <td headers="Status">'.(($produtosRow->status_pro)
                            ?'<div class="Block Success">Ativado</div>'
                            :'<div class="Block Danger">Desativado</div>').'</td>
                        <td headers="Ações">
                        <div class="IBlock">
                            <a class="Warning alterar" title="Editar '.$produtosRow->nome_pro.'" href="'.(($route)?$route.'/'.$produtosRow->id_pro.'/editar':'').'"><i class="fa fa-edit"></i></a>
                            <a class="Danger  deletar" title="Deletar '.$produtosRow->nome_pro.'" href="'.(($route)?$route.'/'.$produtosRow->id_pro:'').'"><i class="fa fa-times"></i></a>
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
                    <th id="Imagem">Imagem de Vitrine</th>
                    <th id="Nome">Nome</th>
                    <th id="Descrição" class="col-lg-6">Descrição</th>
                    <th id="Tipo">Tipo</th>
                    <th id="Desde">Desde</th>
                    <th id="Status">Status</th>
                    <th id="Ações" class="col-lg-1">Ações</th>
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
#TODO Criar janela modal para confirmação de exclusão
echo '
<script type="text/javascript">
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