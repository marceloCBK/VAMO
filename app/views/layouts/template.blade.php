<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">
    <!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">-->

</head>

<body class="Tema2">

<div class="Wrap">
    <div class="Mudar Medio" title="Alterar Tema"><i class="fa fa-eye"></i></div>
    <a class="Logout Medio" title="Sair do VAMO" href="/logout"><i class="fa fa-sign-out"></i></a>
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
