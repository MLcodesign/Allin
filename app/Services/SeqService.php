<?php
namespace App\Services;

use DB;
use App\Package;

class SeqService extends BaseService{    
    private function getSeqNextval($seqName = "order_seq"){
        $seq = DB::table('seq')->where('seq_name', '=', $seqName)->lockForUpdate()->first();
        DB::table('seq')->increment('nextval', 1, array('seq_name' => $seqName));
        return $seq->nextval;
    }
    
    public function getFormatNextval($seqName = "order_seq"){
        $nextval = $this->getSeqNextval($seqName);
        $checkCode = env("PAYMENT_ORDER_PREFIX", "OD");
        $ym = date("Ym");
        $seq = str_pad($nextval,8,"0",STR_PAD_LEFT);
        $randCode = rand(10, 99);
        return join("", array($checkCode, $ym, $seq, $randCode));    
    }
}