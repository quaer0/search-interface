<?php
ob_end_flush();
ini_set("output_buffering", "0");
ob_implicit_flush(true);
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

function echoEvent($datatext) {
    echo "data: ".implode("\ndata: ", explode("\n", $datatext))."\n\n";
}
///usr/bin/sudo /var/www/html/thesaurus/scripts/refresh_index
echoEvent("Start!");
$proc = popen("/var/www/html/thesaurus/scripts/refresh_index", 'r');
echoEvent($proc);
while (!feof($proc)) {
    echoEvent(fread($proc, 4096));
}
echoEvent("Finish!");
?>