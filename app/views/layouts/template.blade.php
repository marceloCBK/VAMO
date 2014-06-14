<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
    <link href="/css/style.css" rel="stylesheet">
    <!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">-->
</head>

<body class="Tema2">

<div class="Wrap">
    <div class="Mudar" title="Alterar Tema"></div>
    <a class="Logout" title="Sair do VAMO" href="/logout"></a>
    @include('IncSite.HeaderMain')
    @yield('conteudo')
</div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
@yield('scripts')
<script type="text/javascript">
$(function() {
    var tema = ['Tema1','Tema2'];
    $('.Mudar').click(function() {
        $('body').removeClass( tema[0] ).addClass( tema[1] );
        tema.reverse();
    });
});
</script>
</body>

</html>
