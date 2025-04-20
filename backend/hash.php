<?php
$nueva_clave = "Alejandro45";
$hash = password_hash($nueva_clave, PASSWORD_DEFAULT);
echo "Hash generado: " . $hash;
