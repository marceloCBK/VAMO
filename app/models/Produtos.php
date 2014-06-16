<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 07/06/14
 * Time: 18:41
 */

class Produtos extends Eloquent {
    protected $table = 'produtos_pro';
    protected $primaryKey = 'id_pro';
    public $timestamps = false;

    public function tipo(){
        return $this->belongsTo('ProdutosTipo', 'id_ptp_pro', 'id_ptp');
    }

    public function arquivos(){
        return $this->hasMany('Arquivos', 'id_fk_arq', 'id_pro');
    }
} 