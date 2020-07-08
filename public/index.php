<?php

require_once '../bootloader.php';

use App\Views\Navigation;

$data = [
    [
        'url' => '/assets/img/taxi-1.jpg',
        'offer' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
         Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen book.
           It has survived not only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged. It was popularised'
    ],
    [
        'url' => '/assets/img/taxi-2.jpg',
        'offer' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
         Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen book.
           It has survived not only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged. It was popularised'
    ],
    [
        'url' => '/assets/img/taxi-3.jpg',
        'offer' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
         Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen book.
           It has survived not only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged. It was popularised'
    ]
];

$navigationView = new Navigation();
$navigation_html = $navigationView->render();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/style.css">

        <title>Sport Club</title>
    </head>
    <body>
        <?php print $navigation_html; ?>
        <div class="photo"></div>
        <div class="cards-container">
            <?php foreach ($data as $card) : ?>
                <div class="card">
                    <div class="image" style="background-image: url('<?php print $card['url']; ?>')"></div>
                    <h3>Offer</h3>
                    <p><?php print $card['offer']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2304.219426156676!2d25.33569661544398!3d54.
		723355078378475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd96e7d814e149%3A0xdd7887e198efd4c7!2sSau
		l%C4%97tekio%20al.%2015%2C%20Vilnius%2010221!5e0!3m2!1slt!2slt!4v1594121485430!5m2!1slt!2slt" width="600"
                height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        <?php require_once '../core/templates/footer.php'; ?>
    </body>
</html>
