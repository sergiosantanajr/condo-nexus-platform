
<?php
session_start();

// Gerar código de verificação aleatório
$captcha = '';
for ($i = 0; $i < 6; $i++) {
    $captcha .= chr(rand(65, 90)); // Letras maiúsculas aleatórias
}

$_SESSION['captcha'] = $captcha;

// Criar uma imagem
$image = imagecreatetruecolor(120, 40);

// Definir cores
$bg = imagecolorallocate($image, 245, 245, 245);
$text_color = imagecolorallocate($image, 50, 50, 50);

// Preencher o fundo
imagefilledrectangle($image, 0, 0, 120, 40, $bg);

// Adicionar linhas aleatórias
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($image, rand(150, 200), rand(150, 200), rand(150, 200));
    imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
}

// Adicionar pontos aleatórios
for ($i = 0; $i < 50; $i++) {
    $pixel_color = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
    imagesetpixel($image, rand(0, 120), rand(0, 40), $pixel_color);
}

// Adicionar o texto do captcha
imagettftext($image, 20, rand(-10, 10), 10, 30, $text_color, __DIR__ . '/../assets/fonts/arial.ttf', $captcha);

// Configurar o cabeçalho para exibir a imagem
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
