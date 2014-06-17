@extends ('layouts.template')

<?php
/*foreach (Config::get('Globals') as $key => $globalsRow) {
    $$key = $globalsRow;
}*/
$title = '404 Página Não Encontrada';
if(!($siteName)) $siteName = 'VAMO';
if(!($siteTit)) $siteTit = 'Venda de Acessórios para Motocicletas';
?>
@section('title')
<%$siteName.' - '.$title%>
@stop

@section('conteudo')

<h1><%$title%></h1>
@stop
