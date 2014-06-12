<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 07/06/14
 * Time: 18:44
 */

class ProdutosTipo extends Eloquent {
    protected $table = 'produtos_tipo_ptp';
    protected $primaryKey = 'id_ptp';
    public $timestamps = false;

    public function produtos(){
        return $this->hasMany('Produtos', 'id_ptp', 'id_ptp_pro');
    }
} 