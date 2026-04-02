<?php
$expected = realpath(__DIR__ . '/../env.ini');
echo "Trying: " . __DIR__ . "/../env.ini<br>";
echo "realpath: " . ($expected ?: 'NOT FOUND') . "<br>";

echo "file_exists: " . (file_exists(__DIR__ . '/../env.ini') ? 'YES' : 'NO') . "<br>";
echo "is_readable: " . (is_readable(__DIR__ . '/../env.ini') ? 'YES' : 'NO') . "<br>";