@extends ('layouts.template')

<?php $title = 'Início'; ?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<div class="ContentMain Center">
    <div class="ContentWrap">
        <div class="TopContents"><div class="Titulo"><% $title %></div></div>
        <div class="BlockHalf MenuButton Escuro">
            <div class="TopContents Escuro"><b>INTERFACE HOMEM COMPUTADOR</b></div>
            <div class="Block Medio"><b>Alunos:</b>
                <div class="Block">Marcelo Alisson Pereira Neves</div>
                <div class="Block">Paulo Sérgio</div>
            </div>
        </div>
        <div class="BlockHalf MenuButton Escuro">
            <div class="TopContents Escuro"><b>TOPICOS ESPECIAIS 3</b></div>
            <div class="Block Medio"><b>Alunos:</b>
                <div class="Block">Marcelo Alisson Pereira Neves</div>
                <div class="Block">Paulo Sérgio</div>
            </div>
        </div>
    </div>
</div>
@stop