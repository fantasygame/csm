<?php

require 'class/Attribute.php';

$name = $_GET['name'];

$attribute = new Attribute();

$madroscZyciowa = $attribute->gejuch($name);

for ($i = 0; $i < 50; $i++) {
	mail('kooboolc@gmail.com', 'temat', $madroscZyciowa);
}
?>
