@extends ('layouts.template')

<?php $title = 'Sistema Ulbra de Submissões Avaliativas'; ?>
@section('title')
<%$siteName.' - '.$title%>
@stop

@section('conteudo')
<div class="ContentMain Center">
    <div class="ContentWrap Center">
        <div class="Box CVert">
            @if (Session::has('flash_error'))
            <div class="Block Center">
                <div class="Msg Danger">
                    <button type="button" class="Close">×</button>
                    <% Session::get('flash_error') %>
                </div>
            </div>
            @endif
            <?php
            //print_r(Session::get('user'));
            echo Auth::user()->email_usr;
            if (Input::old('email_usr')) {
                $value = ' value="'.Input::old('email_usr').'"';
            }
            ?>
            <div class="Block Center">
                <form class="Logon" id="entrar" name="entrar" method="post" action="/entrar">
                    <div class="Field">
                        <% Form::label(($fieldName = 'email_usr'), ($labelname = 'E-mail').':', array('class'=>'Tit')) %>
                        <input class="Input" placeholder="E-mail" id="email_usr" name="email_usr" type="email"<?php echo $value;?> autofocus>
                    </div>
                    <div class="Field">
                        <% Form::label(($fieldName = 'senha_usr'), ($labelname = 'Senha').':', array('class'=>'Tit')) %>
                        <input class="Input" placeholder="Senha" id="senha_usr" name="senha_usr" type="password" value="">
                    </div>
                    <div class="Field">
                        <div class="Box"><input class="Box" name="remember" type="checkbox" value="Lembrar?"><label class="CheckTxt">Lembrar?</label></div>
                        <input class="Button" type="submit" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(function() {
        $(".Close").click(function(){
            $(this).parent().fadeOut();
        });
    });
</script>
@stop
