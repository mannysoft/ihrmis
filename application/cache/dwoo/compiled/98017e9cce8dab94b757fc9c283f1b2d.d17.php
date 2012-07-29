<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>array(1) {
  [0]=>
  string(9) "something"
}
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>