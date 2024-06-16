<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Univers-Phyto</title>
</head>
<body>
    <div class="wrapper">
        <?php require_once(__DIR__ . '/header.php'); ?>
        
        <section class="main">
            <div class="main-left">
                <h1>Bienvenue chez UNIVERS-<span>PHYTO</span></h1>
                <p>Votre Partenaire de Confiance pour l'Innovation Agricole Depuis 2009, Engagé à Offrir des Solutions Intégrées et Durables pour Transformer l'Agriculture dans le Sud du Maroc</p>
                <div class="btn stretch">
                    <a href="#contact-us">Contactez-nous</a>
                </div>
            </div>
            <div class="main-right">
                <img src="media/francesco-gallarotti-ruQHpukrN7c-unsplash.jpg" alt="plant">
            </div>
        </section>

        <section class="achivements">
            <div>
                <h3>Réalisation</h3>
                <h3 class="num">80+</h3>
            </div>
            <div>
                <h3>Projets</h3>
                <h3 class="num">80+</h3>
            </div>
            <div>
                <h3>Les agriculteurs</h3>
                <h3 class="num">80+</h3>
            </div>
            <div>
                <h3>Communauté</h3>
                <h3 class="num">80+</h3>
            </div>
        </section>
        <section class="mission-s">
            <h1>Notre Mission & Vision</h1>
            <div class="wrap-m-v">
                <div>
                    <h3>Vision d'Innovation</h3>
                    <p>Engagés à Propulser l'Agriculture du Sud du Maroc vers un Avenir Durable et Productif, en Offrant des Solutions Intégrées, Innovantes et Respectueuses de l'Environnement.</p>
                </div>
                <div>
                    <img src="media/american-public-power-association-513dBrMJ_5w-unsplash.jpg" alt="solar system">
                </div>
                <div>
                    <h3>Vision d'Innovation</h3>
                    <p>Promouvoir le Développement Agricole Durable.</p>
                </div>
                <div class="vegetables">
                    <img src="media/elaine-casap-qgHGDbbSNm8-unsplash.jpg" alt="vegetables">
                </div>
            </div>
        </section>
        <section class="s2">
            <h1>Succès Clients</h1>
            <div class="profile">
                <div class="obj">
                    <img src="media/man-holding-basket-with-vegetables.jpg" alt="">
                    <div>
                        <h3>Mr.Mohamed</h3>
                        <p>"conseils précieux, rendements optimisés."</p>
                    </div>
                </div>
                <div class="obj">
                    <img src="media/gregory-hayes-QFmNQXLPbZc-unsplash.jpg" alt="">
                    <div>
                        <h3>Mr.Ahmed</h3>
                        <p>"conseils précieux, rendements optimisés."</p>
                    </div>   
                </div>
                <div class="obj">
                    <img src="media/zoe-schaeffer-D_VjFp1ds1Y-unsplash.jpg" alt="">
                    <div>
                        <h3>Ms.Fatima</h3>
                        <p>"conseils précieux, rendements optimisés."</p>
                    </div>
                </div>
            </div>
        </section> 
        <section id="contact-us">
            <?php require_once(__DIR__ . '/footer.php'); ?>
        </section>
    </div>
    
</body>
</html>