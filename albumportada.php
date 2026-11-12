<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicRoom - Detalle del Álbum</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .header-banner-container {
            position: relative;
            width: 100%;
            height: 340px;
            background-color: #4a0d14;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        .banner-img-fondo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.4;
            z-index: 1;
        }
        .header-overlay-centro {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 25px;
        }
        .titulo-principal {
            font-size: 2.8rem;
            margin: 0 0 12px 0;
            color: #ffffff;
            font-weight: bold;
            text-shadow: 0 2px 4px rgba(0,0,0,0.6);
        }
        .search-box-container input {
            width: 380px;
            padding: 10px 18px;
            border-radius: 20px;
            border: none;
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            outline: none;
            font-size: 0.95rem;
        }
        .search-box-container input::placeholder {
            color: #f0f0f0;
        }
        .nav-bar {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 25px;
            margin-bottom: 15px;
            background: rgba(0, 0, 0, 0.3);
            padding: 10px 30px;
            border-radius: 20px;
        }
        .nav-bar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .nav-bar a:hover {
            border-bottom: 2px solid #ffffff;
            padding-bottom: 2px;
        }

        .album-detail-container {
            max-width: 900px;
            margin: 40px auto;
            background: rgba(0, 0, 0, 0.25);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
            color: #fff;
            display: flex;
            gap: 40px;
            align-items: center;
        }
        .album-detail-img {
            width: 280px;
            height: 280px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.5);
        }
        .album-detail-info {
            flex: 1;
        }
        .album-detail-info h2 {
            margin-top: 0;
            color: #ffcccc;
            font-size: 2.4rem;
            margin-bottom: 10px;
        }
        .album-detail-info h3 {
            color: #ddd;
            font-size: 1.3rem;
            font-weight: normal;
            margin-bottom: 20px;
        }
        .album-detail-info p {
            margin: 8px 0;
            font-size: 1rem;
            color: #f0f0f0;
        }
        .btn-volver {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: background 0.2s;
        }
        .btn-volver:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body>

    <header class="header-banner-container">
        <img src="img/banner.jpg" alt="Banner MusicRoom" class="banner-img-fondo">

        <div class="header-overlay-centro">
            <h1 class="titulo-principal">MusicRoom</h1>
            <div class="search-box-container">
                <input type="text" id="buscadorPrincipal" placeholder="Buscar artista, canción o álbum...">
            </div>
        </div>

        <nav class="nav-bar">
            <a href="index.php">INICIO</a>
            <a href="rankings.php">RANKING</a>
            <a href="crear.php">CREAR</a>
            <a href="fav.php">FAV</a>
            <a href="perfil.php">PERFIL</a>
        </nav>
    </header>

    <main class="main-content">
        <?php
        // Definición completa de los 86 álbumes
        $discosRankings = [
            1 => ["nombre" => "Views", "artista" => "Drake", "genero" => "Hip hop, pop rap y R&B contemporáneo", "anio" => "2016"],
            2 => ["nombre" => "Sonder Son", "artista" => "Brent Faiyaz", "genero" => "R&B", "anio" => "2017"],
            3 => ["nombre" => "Starboy", "artista" => "The Weeknd", "genero" => "R&B contemporáneo, pop y synth-pop", "anio" => "2016"],
            4 => ["nombre" => "Fine Line", "artista" => "Harry Styles", "genero" => "Pop rock, con influencias de pop psicodélico, folk, soul, funk e indie pop", "anio" => "2019"],
            5 => ["nombre" => "Love Deluxe", "artista" => "Sade", "genero" => "Soul, R&B, jazz-pop", "anio" => "2018"],
            6 => ["nombre" => "Scorpion", "artista" => "Drake", "genero" => "Hip hop, R&B, trap y pop-rap", "anio" => "2018"],
            7 => ["nombre" => "Currents", "artista" => "Tame Impala", "genero" => "Pop psicodélico, rock electrónico, synth-pop y disco", "anio" => "2015"],
            8 => ["nombre" => "Debí tirar más fotos", "artista" => "Bad Bunny", "genero" => "Música urbana, reguetón, house, plena, bomba, salsa y música jíbara de Puerto Rico", "anio" => "2024"],
            9 => ["nombre" => "Dont Smile At Me", "artista" => "Billie Eilish", "genero" => "Pop alternativo, indie pop y electropop", "anio" => "2017"],
            10 => ["nombre" => "Honestly, Nevermind", "artista" => "Drake", "genero" => "Dance / House con influencias de R&B y pop rap", "anio" => "2022"],
            11 => ["nombre" => "La Vida Era Mas Corta", "artista" => "Milo J", "genero" => "Música urbana, trap, folklore argentino, tango y electrónica", "anio" => "2025"],
            12 => ["nombre" => "The Miseducation Of Lauryn Hill", "artista" => "Lauryn Hill", "genero" => "Neo soul, R&B contemporáneo e hip hop", "anio" => "1998"],
            13 => ["nombre" => "Songs In The Key Of Life", "artista" => "Steve Wonder", "genero" => "Soul, R&B, funk, jazz y pop", "anio" => "1976"],
            14 => ["nombre" => "The New Abnormal", "artista" => "The Strokes", "genero" => "Rock alternativo, indie rock y garage rock", "anio" => "2020"],
            15 => ["nombre" => "My World", "artista" => "Justin Bieber", "genero" => "Pop, teen pop, R&B y dance pop", "anio" => "2009"],
            16 => ["nombre" => "IGOR", "artista" => "Tyler, The Creator", "genero" => "Hip hop, neo soul, funk y R&B alternativo", "anio" => "2019"],
            17 => ["nombre" => "SOUR", "artista" => "Olivia Rodrigo", "genero" => "Pop punk, rock alternativo y pop alternativo", "anio" => "2021"],
            18 => ["nombre" => "Take Me Home", "artista" => "One Direction", "genero" => "Pop, dance pop, pop rock y teen pop", "anio" => "2012"],
            19 => ["nombre" => "Up All Night", "artista" => "One Direction", "genero" => "Pop rock y pop adolescente", "anio" => "2011"],
            20 => ["nombre" => "Un Verano Sin Ti", "artista" => "Bad Bunny", "genero" => "Latin pop, cumbia, reggae, indie pop y diversos ritmos tropicales caribeños", "anio" => "2022"],
            21 => ["nombre" => "La Grasa de las Capitales", "artista" => "Serú Girán", "genero" => "Rock, rock progresivo, jazz fusión y rock/pop tradicional", "anio" => "1979"],
            22 => ["nombre" => "El Amor Después Del Amor", "artista" => "Fito Páez", "genero" => "Rock en español, pop rock y rock argentino", "anio" => "1992"],
            23 => ["nombre" => "El Camino Más Largo", "artista" => "No Te Va A Gustar", "genero" => "Rock, Reggae y Latin (pop rock, ska y reggae)", "anio" => "2008"],
            24 => ["nombre" => "Yendo de la cama al living", "artista" => "Charly García", "genero" => "Pop rock, art pop, pop progresivo y new wave", "anio" => "1982"],
            25 => ["nombre" => "Modern Clics", "artista" => "Charly García", "genero" => "New wave, rock en español y pop rock", "anio" => "1983"],
            26 => ["nombre" => "Frank", "artista" => "Amy Winehouse", "genero" => "Jazz, soul, R&B contemporáneo y funk", "anio" => "2003"],
            27 => ["nombre" => "1967-1970 (The Beatles)", "artista" => "The Beatles", "genero" => "Rock, rock psicodélico, pop rock y art rock", "anio" => "1973"],
            28 => ["nombre" => "Abbey Road", "artista" => "The Beatles", "genero" => "Rock, pop rock, blues rock y rock clásico", "anio" => "1969"],
            29 => ["nombre" => "Off The Wall", "artista" => "Michael Jackson", "genero" => "Pop, música disco, funk y R&B", "anio" => "1979"],
            30 => ["nombre" => "Xscape", "artista" => "Michael Jackson", "genero" => "Pop y R&B", "anio" => "2014"],
            31 => ["nombre" => "Sweetener", "artista" => "Ariana Grande", "genero" => "Pop y R&B", "anio" => "2018"],
            32 => ["nombre" => "Believe", "artista" => "Justin Bieber", "genero" => "Pop, dance pop, R&B", "anio" => "2012"],
            33 => ["nombre" => "AM", "artista" => "Arctic Monkeys", "genero" => "Indie rock, rock alternativo y hard rock", "anio" => "2013"],
            34 => ["nombre" => "Whatever People Say I Am, That's What I'm Not", "artista" => "Arctic Monkeys", "genero" => "Indie rock, garage rock revival y punk rock", "anio" => "2006"],
            35 => ["nombre" => "111", "artista" => "Milo J", "genero" => "Música urbana, balada, pop, música alternativa y corridos tumbados", "anio" => "2023"],
            36 => ["nombre" => "Channel Orange", "artista" => "Frank Ocean", "genero" => "R&B, neo soul, hip hop, pop, funk y música psicodélica", "anio" => "2012"],
            37 => ["nombre" => "Blonde", "artista" => "Frank Ocean", "genero" => "R&B alternativo, art pop, soul vanguardista y pop psicodélico", "anio" => "2016"],
            38 => ["nombre" => "Hit Me Hard And Soft", "artista" => "Billie Eilish", "genero" => "Pop alternativo y pop", "anio" => "2024"],
            39 => ["nombre" => "You Seem Pretty Sad For A Girl So In Love", "artista" => "Olivia Rodrigo", "genero" => "Indie pop y pop rock", "anio" => "2026"],
            40 => ["nombre" => "Queen II", "artista" => "Queen", "genero" => "Hard rock, glam rock, rock progresivo, art rock y heavy metal", "anio" => "1974"],
            41 => ["nombre" => "1989", "artista" => "Taylor Swift", "genero" => "Synth-pop, dance-pop y electropop", "anio" => "2014"],
            42 => ["nombre" => "Lover", "artista" => "Taylor Swift", "genero" => "Pop, synth-pop, electropop y pop rock", "anio" => "2019"],
            43 => ["nombre" => "Reputation", "artista" => "Taylor Swift", "genero" => "Electropop, synth-pop, R&B, trap y dance-pop", "anio" => "2017"],
            44 => ["nombre" => "Red", "artista" => "Taylor Swift", "genero" => "Pop, country y rock", "anio" => "2012"],
            45 => ["nombre" => "1989 (Edición Deluxe)", "artista" => "Taylor Swift", "genero" => "Synth-pop, dance-pop y electropop", "anio" => "2014"],
            46 => ["nombre" => "Por Si Mañana No Estoy", "artista" => "Omar Courtz", "genero" => "Pop, country y rock", "anio" => "2012"],
            47 => ["nombre" => "Musaeleva", "artista" => "Omar Courtz", "genero" => "Reggaetón, Trap Latino y Afrobeat", "anio" => "2024"],
            48 => ["nombre" => "Un Mechón de Pelo", "artista" => "Tini", "genero" => "Pop alternativo, spoken word, minimalista, electrónica, rock latino y R&B latino", "anio" => "2024"],
            49 => ["nombre" => "Cupido", "artista" => "Tini", "genero" => "Música urbana, pop latino y cumbia", "anio" => "2023"],
            50 => ["nombre" => "MP3", "artista" => "Emilia", "genero" => "Música urbana, pop latino y cumbia", "anio" => "2023"],
            51 => ["nombre" => "Antes de Ameri", "artista" => "Duki", "genero" => "Trap latino", "anio" => "2023"],
            52 => ["nombre" => "Graduation", "artista" => "Kanye West", "genero" => "Hip hop, pop rap, música electrónica y synth-pop", "anio" => "2007"],
            53 => ["nombre" => "Yeezus", "artista" => "Kanye West", "genero" => "Hip hop industrial, hip hop experimental y música electrónica", "anio" => "2013"],
            54 => ["nombre" => "Loud", "artista" => "Rihanna", "genero" => "Pop, R&B y dance-pop", "anio" => "2010"],
            55 => ["nombre" => "Anti (Deluxe)", "artista" => "Rihanna", "genero" => "Pop, R&B, dancehall, soul psicodélico, hip hop y trap", "anio" => "2016"],
            56 => ["nombre" => "Don’t Stop The Music", "artista" => "Rihanna", "genero" => "R&B, dance-pop, electrónica, techno y house", "anio" => "2007"],
            57 => ["nombre" => "I Am... Sasha Fierce", "artista" => "Beyoncé", "genero" => "R&B contemporáneo, Pop y Balada", "anio" => "2008"],
            58 => ["nombre" => "De Visita", "artista" => "Maia Reficco", "genero" => "Pop alternativo con matices de la escena alternativa", "anio" => "2026"],
            59 => ["nombre" => "SOS", "artista" => "SZA", "genero" => "R&B contemporáneo, alt-R&B, hip-hop, pop, indie rock y soul", "anio" => "2022"],
            60 => ["nombre" => "Ctrl", "artista" => "SZA", "genero" => "Alt-R&B, neo soul, hip-hop, trap, indie rock y música electrónica", "anio" => "2017"],
            61 => ["nombre" => "The Eminem Show", "artista" => "Eminem", "genero" => "Hip hop y rap rock", "anio" => "2002"],
            62 => ["nombre" => "Man's Best Friends", "artista" => "Sabrina Carpenter", "genero" => "Pop, soft rock, disco-pop, funk y R&B", "anio" => "2025"],
            63 => ["nombre" => "Blood Sugar Sex Magik", "artista" => "Red Hot Chili Peppers", "genero" => "Funk rock, rap rock y funk metal", "anio" => "1991"],
            64 => ["nombre" => "Hot Space", "artista" => "Queen", "genero" => "Pop rock, funk rock, disco, dance y R&B", "anio" => "1982"],
            65 => ["nombre" => "Get Rich Or Die Tryin'", "artista" => "50 Cent", "genero" => "Hip hop, gangsta rap y thug rap", "anio" => "2003"],
            66 => ["nombre" => "Ready to Die (Big Poppa)", "artista" => "The Notorious B.I.G.", "genero" => "Gangsta rap y hardcore hip hop de la Costa Este", "anio" => "1994"],
            67 => ["nombre" => "Greatest Hits", "artista" => "2Pac", "genero" => "West Coast rap, gangsta rap y G-Funk", "anio" => "1998"],
            68 => ["nombre" => "Appetite for Destruction (Sweet Child O' Mine)", "artista" => "Guns N' Roses", "genero" => "Hard rock y Rock", "anio" => "1987"],
            69 => ["nombre" => "21", "artista" => "Adele", "genero" => "Soul, pop, R&B, blues y country", "anio" => "2011"],
            70 => ["nombre" => "1000 Forms of Fear", "artista" => "Sia", "genero" => "Pop, electropop, reggae e hip hop", "anio" => "2014"],
            71 => ["nombre" => "Nothing but the Beat", "artista" => "David Guetta", "genero" => "Música electrónica, house, electro house, progressive house, EDM y dance-pop", "anio" => "2011"],
            72 => ["nombre" => "Fijación Oral Vol. 1", "artista" => "Shakira", "genero" => "Pop latino, pop rock, soft rock y folclor latino", "anio" => "2005"],
            73 => ["nombre" => "Doo-Wops & Hooligans", "artista" => "Bruno Mars", "genero" => "Pop, R&B, soul, reggae pop y pop rock", "anio" => "2010"],
            74 => ["nombre" => "Parachutes", "artista" => "Coldplay", "genero" => "Rock alternativo, post-britpop, indie rock y soft rock", "anio" => "2000"],
            75 => ["nombre" => "The Dark Side of the Moon", "artista" => "Pink Floyd", "genero" => "Rock psicodélico, art rock y rock espacial", "anio" => "1973"],
            76 => ["nombre" => "Nevermind", "artista" => "Nirvana", "genero" => "Grunge y rock alternativo", "anio" => "1991"],
            77 => ["nombre" => "Music from Big Pink (The Band)", "artista" => "The Band", "genero" => "Roots rock, rock and roll y folk rock", "anio" => "1968"],
            78 => ["nombre" => "Grace", "artista" => "Jeff Buckley", "genero" => "Rock alternativo y folk rock", "anio" => "1994"],
            79 => ["nombre" => "Hatful of Hollow", "artista" => "The Smiths", "genero" => "Jangle pop, indie pop, post-punk y rock alternativo", "anio" => "1984"],
            80 => ["nombre" => "Outlandos d'Amour", "artista" => "The Police", "genero" => "New wave, post-punk, punk rock y reggae rock", "anio" => "1978"],
            81 => ["nombre" => "Blue Album", "artista" => "Weezer", "genero" => "Alternative rock, power pop y indie rock", "anio" => "1994"],
            82 => ["nombre" => "Algo Mejor", "artista" => "Fabiana Cantilo", "genero" => "Pop rock", "anio" => "1991"],
            83 => ["nombre" => "Esperando el Milagro", "artista" => "Las Pelotas", "genero" => "Rock alternativo y rock en español", "anio" => "2003"],
            84 => ["nombre" => "Everybody Else Is Doing It, So Why Can't We?", "artista" => "The Cranberries", "genero" => "Rock alternativo y indie pop", "anio" => "1993"],
            85 => ["nombre" => "In Rainbows", "artista" => "Radiohead", "genero" => "Rock alternativo, art rock y rock experimental", "anio" => "2007"],
            86 => ["nombre" => "Positions", "artista" => "Ariana Grande", "genero" => "Pop, R&B y trap-pop", "anio" => "2020"]
        ];

        // Obtenemos el ID de la URL (por defecto 1 si no viene definido)
        $id = isset($_GET['id']) ? intval($_GET['id']) : 1;

        // Validamos si el ID existe en el arreglo
        if (array_key_exists($id, $discosRankings)) {
            $disco = $discosRankings[$id];
        } else {
            // Valor por defecto en caso de un ID que no esté en la lista
            $disco = [
                "nombre" => "Álbum #" . $id,
                "artista" => "Artista Desconocido",
                "genero" => "Musical",
                "anio" => "2023"
            ];
        }
        ?>

        <div class="album-detail-container">
            <img src="img/disco<?php echo $id; ?>.jpg" alt="<?php echo htmlspecialchars($disco['nombre']); ?>" class="album-detail-img">
            <div class="album-detail-info">
                <h2><?php echo htmlspecialchars($disco['nombre']); ?></h2>
                <h3><?php echo htmlspecialchars($disco['artista']); ?></h3>
                <p><strong>Año de lanzamiento:</strong> <?php echo htmlspecialchars($disco['anio']); ?></p>
                <p><strong>Género:</strong> <?php echo htmlspecialchars($disco['genero']); ?></p>
                <a href="rankings.php" class="btn-volver">← Volver a Rankings</a>
            </div>
        </div>
    </main>

</body>

</html>