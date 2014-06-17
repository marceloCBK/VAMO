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
        <?php
        echo '
        <div class="TopContents Center">
            <div class="Titulo">'.$title.'</div>
        </div>
        ';
        ?>
        <div class="Block Center">
            <% Form::model($produtosTipo, array('class' => 'Form', 'method' => (($id)?'PUT':'POST'), 'route' => array('tipos.'.(($id)?'update':'store'), $produtosTipo->id_ptp))) %>

                <div class="Field">
                    <% Form::label(($fieldName = 'nome_ptp'), ($labelname = 'Nome').':', array('class'=>'Tit')) %>
                    <% Form::text($fieldName, Input::old($fieldName), array('class'=>'Input', 'placeholder'=>$labelname)) %>
                </div>
                <div class="Field Status">
                    <% Form::label(($fieldName = 'status_ptp'), ($labelname = 'Status').':', array('class'=>'Tit Box')) %>
                    <% Form::checkbox($fieldName, 1, $produtosTipo->status_ptp,['class' => 'Radio Box']); %>
                </div>

                <% Form::submit('Salvar', array('class' => 'Button')) %>

            <% Form::close() %>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    //Validation ->
    $(function() {
        $('form').validate({
            messages: {
                nome_ptp: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                }
            },
            rules: {
                nome_ptp: {
                    minlength: 3,
                    required: true
                }
            },
            highlight: function(element) {
                $(element).closest('.Input').addClass('Danger');
            },
            unhighlight: function(element) {
                $(element).closest('.Input').removeClass('Danger');
            },
            errorElement: 'span',
            errorClass: 'Block Danger',
            errorPlacement: function(error, element) {
                if(element.parent('.Field').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
        //Vilidation <-
    });
</script>
@stop