<!DOCTYPE HTML>
<html lang="pt-BR" xml:lang="pt-BR">

<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">
    <!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">-->

</head>

<?php
//Verifica o Tema -->
if (Session::get('tema')) {
    $tema = Session::get('tema');
} else {
    $tema = ['Tema2','Tema1'];//Seta um valor padrão se não existir tema selecionado
    Session::put('tema', $tema);
}
//Verifica o Tema <--
?>

<body class="<% $tema[0] %>">

<div class="Wrap">
    <div class="TopIcons TopLeft">
        <a class="Icon FontPlus Medio"  title="Aumentar Letras" href="/"  ><i class="fa fa-font"></i></a>
        <a class="Icon FontNorm Medio"  title="Normalizar Letras" href="/"><i class="fa fa-font"></i></a>
        <a class="Icon FontMinus Medio"  title="Diminuir Letras" href="/" ><i class="fa fa-font"></i></a>
    </div>
    <div class="TopIcons">
        <a class="Icon Mudar Medio"  title="Alterar Tema" href="/mudar" ><i class="fa fa-eye"></i></a>
        <a class="Icon Logout Medio" title="Sair do VAMO" href="/logout"><i class="fa fa-sign-out"></i></a>
    </div>
    @include('IncSite.HeaderMain')
    @yield('conteudo')
    @include('IncSite.FooterMain')
</div>

<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(function() {
    $('.Mudar').click(function() {
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            type: "GET",
            success: function(result) {
                //console.log(result);
                response = $.parseJSON(result);

                if (response.tema) {
                    var tema = response.tema;
                    $('body').removeClass( tema[1] ).addClass( tema[0] );
                    tema.reverse();
                }

            }
        });
        return false;
    });

    $('.FontPlus').click(function() {
        var size = $("body").css('font-size');

        size = size.replace('px', '');
        size = parseInt(size) +1;

        $("body").css({"font-size":size+"px"});
        return false;
    });

    $('.FontNorm').click(function() {
        $("body").css({"font-size":"16px"});
        return false;
    });

    $('.FontMinus').click(function() {
        var size = $("body").css('font-size');

        size = size.replace('px', '');
        size = parseInt(size) -1;

        $("body").css({"font-size":size+"px"});
        return false;
    });
});
</script>
@yield('scripts')
</body>

</html>
