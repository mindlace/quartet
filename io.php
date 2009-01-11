<?php

require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$fsock=fsockopen('127.0.0.1',9002);
fwrite($fsock, "i=user&cmd=melody&events=0&t219n4e1&t1498n3e1&t1761n7e1&t2028n1e1&t2268n2e1&t2649n8e1&t2661n3e1&t2933n9e1&t2948n6e1&endevents");
?>
i wroted the song!
i can has balls now?
you has balls?