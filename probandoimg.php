<?php phpinfo() ?>
<?php

/* Generar una matriz de píxeles. 2000 píxeles por raya de color */
$cuenta = 2000 * 3;

$píxeles = 
   array_merge(array_pad(array(), $cuenta, 0),
               array_pad(array(), $cuenta, 255), 
               array_pad(array(), $cuenta, 0),
               array_pad(array(), $cuenta, 255),
               array_pad(array(), $cuenta, 0));

/* Ancho y alto. El área es la cantidad de píxeles dividido
   por tres. Tres viene de 'RGB', tres valores por píxel */
$ancho = $alto = pow((count($píxeles) / 3), 0.5);

/* Crear una imagen vacía */
$im = new Imagick();
$im->newImage($ancho, $alto, 'gray');

/* Importar los píxeles a la imagen.
   ancho * alto * strlen("RGB") debe coincidir con count($píxeles) */
$im->importImagePixels(0, 0, $ancho, $alto, "RGB", Imagick::PIXEL_CHAR, $píxeles);

/* Imprimir como una imagen jpeg */
$im->setImageFormat('jpg');
header("Content-Type: image/jpg");
echo $im;

?>