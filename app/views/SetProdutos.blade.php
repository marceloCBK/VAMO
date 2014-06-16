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
        <?php
        echo '
        <div class="TopContents Center">
            <div class="Titulo">'.$title.'</div>
        </div>
        ';
        ?>
        <div class="Block Center">
            <% Form::model($produtos, array('class' => 'Form', 'method' => (($id)?'PUT':'POST'), 'enctype' => 'multipart/form-data', 'route' => array('produtos.'.(($id)?'update':'store'), $produtos->id_pro))) %>

                <div class="Field">
                    <% Form::label(($fieldName = 'nome_pro'), ($labelname = 'Nome').':', array('class'=>'Tit')) %>
                    <% Form::text($fieldName, Input::old($fieldName), array('class'=>'Input', 'placeholder'=>$labelname)) %>
                </div>

                <?php /*
                @if ($produtosTipo[0])
                <div class="Field">
                    <% Form::label(($fieldName = 'id_ptp_pro'), ($labelname = 'Tipo').':', array('class'=>'Tit')) %>
                    <div class="Check Block">
                        @foreach ($produtosTipo as $produtosTipoRow)
                        <div class="Box Item">
                            <% Form::radio($fieldName, $produtosTipoRow->id_ptp, NULL, ['class' => 'Radio Box']); %>
                            <% Form::label($fieldName, $produtosTipoRow->nome_ptp, array('class'=>'Tit Box')) %>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                */ ?>

                @if ($produtosTipo[0])
                <div class="Field List">
                    <?php
                    echo Form::label(($fieldName = 'id_ptp_pro'), ($labelname = 'Tipo').':', array('class'=>'Tit'));

                    foreach ($produtosTipo as $produtosTipoRow) {
                        $List[$produtosTipoRow->id_ptp] = $produtosTipoRow->nome_ptp;
                    }
                    echo Form::select('id_ptp_pro', $List, $produtos->id_ptp_pro,['class'=>'Input']).'<i class="fa fa-arrow-down"></i>';
                    ?>
                </div>
                @endif
                <div class="Field">
                    <?php
                    echo Form::label(($fieldName = 'nome_arq'), ($labelname = 'Imagem de Vitrine').':', array('class'=>'Tit'));
                    $fieldName = 'nome_arq'; echo '<input type="file" class="Input Upload" id="'.$fieldName.'" name="'.$fieldName.'">';
                    ?>
                </div>
                <div class="Field">
                    <% Form::label(($fieldName = 'descricao_pro'), ($labelname = 'Descrição').':', array('class'=>'Tit')) %>
                    <% Form::textarea($fieldName, Input::old($fieldName), array('class'=>'Input', 'placeholder'=>$labelname, 'cols'=>'none', 'rows'=>'7')) %>
                </div>
                <div class="Block"></div>
                    <div class="Field Status">
                        <% Form::label(($fieldName = 'status_pro'), ($labelname = 'Status').':', array('class'=>'Tit Box')) %>
                        <% Form::checkbox($fieldName, 1, $produtos->status_pro,['class' => 'Radio Box']); %>
                    </div>

                    <% Form::submit('Salvar', array('class' => 'Button')) %>
                </div>

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
                nome_pro: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                },
                descricao_pro: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                }
            },
            rules: {
                nome_pro: {
                    minlength: 3,
                    required: true
                }
                ,descricao_pro: {
                    minlength: 15,
                    //maxlength: 15,
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