<?php

// Load the background image
$background_img = imagecreatefromjpeg("background.jpg"); // Ustaw ścieżkę do własnego obrazka tła

// Create a full HD image
$img_width = 1920;
$img_height = 1080;
$img = imagecreatetruecolor($img_width, $img_height);
$white = imagecolorallocate($img, 255, 255, 255);
imagefill($img, 0, 0, $white);

// Calculate the number of times to repeat the background
$num_repeats_x = intval($img_width / imagesx($background_img)) + 1;
$num_repeats_y = intval($img_height / imagesy($background_img)) + 1;

// Paste the background image on the new image, repeating it
for ($i = 0; $i < $num_repeats_x; $i++) {
    for ($j = 0; $j < $num_repeats_y; $j++) {
        imagecopy($img, $background_img, $i * imagesx($background_img), $j * imagesy($background_img), 0, 0, imagesx($background_img), imagesy($background_img));
    }
}

// Define the font to be used for the text
$font_size = 80;
$font_path = "arial.ttf"; // Ustaw ścieżkę do czcionki

// Get the text size
$text = "Pierwsza zasada magii: \nMuszisz być inteligentniejszy od reszty.";
//$text = "Ja tu byłem.";
$text_box = imagettfbbox($font_size, 0, $font_path, $text);
$text_width = abs($text_box[2] - $text_box[0]);
$text_height = abs($text_box[5] - $text_box[3]);

// Calculate the position for the text
$x = ($img_width - $text_width) / 2;
$y = ($img_height - $text_height) / 2 + 80; // Dopasuj położenie do lepszego wyświetlenia tekstu

// Define the text color (white)
$text_color = imagecolorallocate($img, 255, 255, 255);

// Draw the text on the image
imagettftext($img, $font_size, 0, $x, $y, $text_color, $font_path, $text);

// Save the imagej
imagepng($img, "quote_text.png");
imagedestroy($img);
echo '<img src="quote_text.png" height=300 />';