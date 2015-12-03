<?php

require ("ResponseHandler.class.php");
class PayResponseHandler extends ResponseHandler {
function isTenpaySign() {
$cmdno = $this->getParameter("cmdno");
$pay_result = $this->getParameter("pay_result");
$date = $this->getParameter("date");
$transaction_id = $this->getParameter("transaction_id");
$sp_billno = $this->getParameter("sp_billno");
$total_fee = $this->getParameter("total_fee");
$fee_type = $this->getParameter("fee_type");
$attach = $this->getParameter("attach");
$key = $this->getKey();
$signPars = "";
$signPars = "cmdno=".$cmdno ."&".
"pay_result=".$pay_result ."&".
"date=".$date ."&".
"transaction_id=".$transaction_id ."&".
"sp_billno=".$sp_billno ."&".
"total_fee=".$total_fee ."&".
"fee_type=".$fee_type ."&".
"attach=".$attach ."&".
"key=".$key;
$sign = strtolower(md5($signPars));
$tenpaySign = strtolower($this->getParameter("sign"));
$this->_setDebugInfo($signPars ." => sign:".$sign .
" tenpaySign:".$this->getParameter("sign"));
return $sign == $tenpaySign;
}
}

?>