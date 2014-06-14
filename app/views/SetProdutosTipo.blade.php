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
$id = $produtosTipo->id_ptp;
$title = (($id)?'Editar ':'Inserir ').'Tipo de Produto';
?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')

<div class="ContentMain Center">
    <div class="ContentWrap">
        <div class="Block Center"><h1><% $title %></h1></div>
        <div class="Block Center">
            <% Form::model($produtosTipo, array('class' => 'Form', 'method' => (($id)?'PUT':'POST'), 'route' => array('tipos.'.(($id)?'update':'store'), $produtosTipo->id_ptp))) %>

                <div class="Field">
                    <% Form::label(($fieldName = 'nome_ptp'), ($labelname = 'Nome').':', array('class'=>'Tit')) %>
                    <% Form::text($fieldName, Input::old($fieldName), array('class'=>'Input', 'placeholder'=>$labelname)) %>
                </div>
                <div class="Field">
                    <% Form::label(($fieldName = 'status_ptp'), ($labelname = 'Status').':', array('class'=>'Tit')) %>
                    <div class="Block">
                        <div class="Block">
                            <% Form::checkbox($fieldName, 1); %>
                        </div>
                    </div>
                </div>

                <% Form::submit('Salvar', array('class' => 'Button')) %>

            <% Form::close() %>
        </div>
    </div>
</div>
@stop