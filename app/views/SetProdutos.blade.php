@extends ('layouts.template')
<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 07/06/14
 * Time: 16:09
 */
?>

<?php
$id = $produtos->id_pro;
$title = (($id)?'Editar ':'Inserir ').'Produto';
?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')

<div class="ContentMain Center">
    <div class="ContentWrap">
        <div class="Block Center"><h1><% $title %></h1></div>
        <div class="Block Center">
            <% Form::model($produtos, array('class' => 'Form', 'method' => (($id)?'PUT':'POST'), 'route' => array('produtos.'.(($id)?'update':'store'), $produtos->id_pro))) %>

                <div class="Field">
                    <% Form::label(($fieldName = 'nome_pro'), ($labelname = 'Nome').':', array('class'=>'Tit')) %>
                    <% Form::text($fieldName, Input::old($fieldName), array('class'=>'Input', 'placeholder'=>$labelname)) %>
                </div>
                @if ($produtosTipo[0])
                <div class="Field">
                    <% Form::label(($fieldName = 'id_ptp_pro'), ($labelname = 'Tipo').':', array('class'=>'Tit')) %>
                    <div class="Block">
                        @foreach ($produtosTipo as $produtosTipoRow)
                        <div class="Block">
                            <% Form::label($fieldName, $produtosTipoRow->nome_ptp.':', array('class'=>'Tit')) %>
                            <% Form::radio($fieldName, $produtosTipoRow->id_ptp); %>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="Field">
                    <% Form::label(($fieldName = 'status_pro'), ($labelname = 'Status').':', array('class'=>'Tit')) %>
                    <div class="Block">
                        <div class="Block">
                            <% Form::checkbox($fieldName, 1); %>
                        </div>
                    </div>
                </div>
                <div class="Field">
                    <% Form::label(($fieldName = 'descricao_pro'), ($labelname = 'Descrição').':', array('class'=>'Tit')) %>
                    <% Form::textarea($fieldName, Input::old($fieldName), array('class'=>'Input', 'placeholder'=>$labelname, 'cols'=>'none', 'rows'=>'none')) %>
                </div>

                <% Form::submit('Salvar', array('class' => 'Button')) %>

            <% Form::close() %>
        </div>
    </div>
</div>
@stop