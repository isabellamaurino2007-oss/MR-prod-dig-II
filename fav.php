<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicRoom - Tus Favoritos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos específicos y pulidos para favoritos */
        .fav-header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .fav-contador {
            color: #d1a1a7;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .fav-controles {
            display: flex;
            gap: 10px;
        }

        .fav-select {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            padding: 8px 14px;
            border-radius: 12px;
            outline: none;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .fav-select:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .fav-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 20px;
            padding-bottom: 40px;
        }

        /* Tarjeta de favorito con botón flotante para eliminar */
        .fav-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 12px;
            position: relative;
            transition: transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .fav-card:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
        }

        .fav-img-wrapper {
            position: relative;
            width: 100%;
            height: 145px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .fav-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .fav-card:hover .fav-img-wrapper img {
            transform: scale(1.05);
        }

        .btn-quitar-fav {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(43, 8, 12, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffcccc;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.2s ease;
            z-index: 5;
            font-size: 0.9rem;
        }

        .fav-card:hover .btn-quitar-fav {
            opacity: 1;
            transform: scale(1);
        }

        .btn-quitar-fav:hover {
            background: #ff4d4d;
            color: #fff;
            border-color: #ff4d4d;
        }
    </style>
</head>

<body>

    <header class="header-banner-container">
        <img src="img/banner.jpg" alt="Banner MusicRoom" class="banner-img-fondo">

        <div class="header-overlay-centro">
            <h1 class="titulo-principal">MusicRoom</h1>
            <div class="search-box-container">
                <input type="text" id="buscadorFavs" placeholder="Busca en tus favoritos...">
            </div>
        </div>

      <nav class="nav-bar">
    <a href="index.php">INICIO</a>
    <a href="rankings.php">RANKING</a>
    <a href="crear.php">CREAR</a>
    <a href="fav.php">FAV</a>
    <a href="perfil.php">PERFIL</a>
    <a href="registro.php">REGISTRO</a> <!-- Enlace añadido -->
</nav>
    </header>

    <main class="main-content">
        
        <section class="dashboard-section visible">
            <div class="fav-header-info">
                <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2.2rem; color: #fff; margin: 0; font-weight: 700;"> Tus Álbumes Favoritos</h2>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span id="contadorFavoritos" class="fav-contador">Calculando...</span>
                    <div class="fav-controles">
                        <select id="ordenFavs" class="fav-select" onchange="cambiarOrdenFavs()">
                            <option value="recientes" style="background: #2b080c;">Más recientes</option>
                            <option value="alfabetico" style="background: #2b080c;">Alfabéticamente</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Contenedor donde se cargarán dinámicamente los favoritos -->
            <div id="contenedor-grid-favs" class="fav-grid-container">
                <!-- Se inyecta por JavaScript -->
            </div>
        </section>

    </main>

    <!-- Notificación Flotante -->
    <div id="toast-notificacion">
        <span></span> <span id="toast-texto">Álbum actualizado de favoritos</span>
    </div>

    <script>
        // Base de datos completa de discos para referencia cruzada
        const discosData = {
            1: ["Views", "Drake"],
            2: ["Sonder Son", "Brent Faiyaz"],
            3: ["Starboy", "The Weeknd"],
            4: ["Fine Line", "Harry Styles"],
            5: ["Love Deluxe", "Sade"],
            6: ["Scorpion", "Drake"],
            7: ["Currents", "Tame Impala"],
            8: ["Debí tirar más fotos", "Bad Bunny"],
            9: ["Dont Smile At Me", "Billie Eilish"],
            10: ["Honestly, Nevermind", "Drake"],
            11: ["La Vida Era Más Corta", "Milo J"],
            12: ["The Miseducation Of Lauryn Hill", "Lauryn Hill"],
            13: ["Songs In The Key Of Life", "Stevie Wonder"],
            14: ["The New Abnormal", "The Strokes"],
            15: ["My World", "Justin Bieber"],
            16: ["IGOR", "Tyler, The Creator"],
            17: ["SOUR", "Olivia Rodrigo"],
            18: ["Take Me Home", "One Direction"],
            19: ["Up All Night", "One Direction"],
            20: ["Un Verano Sin Ti", "Bad Bunny"],
            21: ["La Grasa de las Capitales", "Serú Girán"],
            22: ["El Amor Después Del Amor", "Fito Páez"],
            23: ["El Camino Más Largo", "No Te Va Gustar"],
            24: ["Yendo de la Cama al Living", "Charly García"],
            25: ["Modern Clics", "Charly García"],
            26: ["Frank", "Amy Winehouse"],
            27: ["1967-1970 (The Blue Album)", "The Beatles"],
            28: ["Abbey Road", "The Beatles"],
            29: ["Off The Wall", "Michael Jackson"],
            30: ["Xscape", "Michael Jackson"],
            31: ["Sweetener", "Ariana Grande"],
            32: ["Believe", "Justin Bieber"],
            33: ["AM", "Arctic Monkeys"],
            34: ["Whatever People Say I Am, That's What I'm Not", "Arctic Monkeys"],
            35: ["111", "Milo J"],
            36: ["Channel Orange", "Frank Ocean"],
            37: ["Blonde", "Frank Ocean"],
            38: ["Hit Me Hard And Soft", "Billie Eilish"],
            39: ["You Seem Pretty Sad For A Girl So In Love", "Olivia Rodrigo"],
            40: ["Queen II", "Queen"],
            41: ["1989", "Taylor Swift"],
            42: ["Lover", "Taylor Swift"],
            43: ["Reputation", "Taylor Swift"],
            44: ["Red", "Taylor Swift"],
            45: ["1989 (Deluxe)", "Taylor Swift"],
            46: ["Por Si Mañana No Estoy", "Omar Courtz"],
            47: ["Musaeleva", "Omar Courtz"],
            48: ["Un Mechón de Pelo", "Tini"],
            49: ["Cupido", "Tini"],
            50: ["mp3", "Emilia"],
            51: ["Antes de Ameri", "Duki"],
            52: ["Graduation", "Kanye West"],
            53: ["Yeezus", "Kanye West"],
            54: ["Loud", "Rihanna"],
            55: ["Anti (Deluxe)", "Rihanna"],
            56: ["Don’t Stop the Music", "Rihanna"],
            57: ["I Am... Sasha Fierce", "Beyoncé"],
            58: ["De Visita", "Maia Reficco"],
            59: ["SOS", "SZA"],
            60: ["Ctrl", "SZA"],
            61: ["The Eminem Show", "Eminem"],
            62: ["Man's Best Friend", "Sabrina Carpenter"],
            63: ["Blood Sugar Sex Magik", "Red Hot Chili Peppers"],
            64: ["Hot Space", "Queen"],
            65: ["Get Rich Or Die Tryin'", "50 Cent"],
            66: ["Big Poppa (Ready to Die)", "The Notorious B.I.G."],
            67: ["Greatest Hits", "2Pac"],
            68: ["Sweet Child O' Mine", "Guns N' Roses"],
            69: ["21", "Adele"],
            70: ["1000 Forms of Fear", "Sia"],
            71: ["Nothing but the Beat", "David Guetta"],
            72: ["Fijación Oral Vol. 1", "Shakira"],
            73: ["Doo-Wops & Hooligans", "Bruno Mars"],
            74: ["Parachutes", "Coldplay"],
            75: ["The Dark Side of the Moon", "Pink Floyd"],
            76: ["Nevermind", "Nirvana"],
            77: ["The Rolling Stones", "The Rolling Stones"],
            78: ["Grace", "Jeff Buckley"],
            79: ["Hatful of Hollow", "The Smiths"],
            80: ["Outlandos d'Amour", "The Police"],
            81: ["Blue Album", "Weezer"],
            82: ["Algo Mejor", "Fabiana Cantilo"],
            83: ["Esperando el Milagro", "Las Pelotas"],
            84: ["Everybody Else Is Doing It...", "The Cranberries"],
            85: ["In Rainbows", "Radiohead"],
            86: ["Positions", "Ariana Grande"]
        };

        function mostrarToast(mensaje) {
            let toast = document.getElementById('toast-notificacion');
            let texto = document.getElementById('toast-texto');
            texto.textContent = mensaje;
            toast.classList.add('mostrar');
            setTimeout(() => {
                toast.classList.remove('mostrar');
            }, 3000);
        }

        // Obtener favoritos guardados (simulados con localStorage, con respaldo inicial de Starboy [3] y Views [1])
        function obtenerFavoritos() {
            let favs = JSON.parse(localStorage.getItem('mis_favoritos'));
            if (!favs) {
                favs = ["3", "1"]; // Por defecto los de tu captura
                localStorage.setItem('mis_favoritos', JSON.stringify(favs));
            }
            return favs;
        }

        function renderizarFavoritos(filtroTexto = "") {
            let favsIds = obtenerFavoritos();
            let contenedor = document.getElementById('contenedor-grid-favs');
            let contadorEl = document.getElementById('contadorFavoritos');
            let orden = document.getElementById('ordenFavs').value;

            // Filtrar y ordenar
            let listaFiltrada = favsIds.map(id => {
                let info = discosData[id];
                return info ? { id: id, nombre: info[0], artista: info[1], img: `img/disco${id}.jpg` } : null;
            }).filter(item => item !== null);

            if (filtroTexto) {
                listaFiltrada = listaFiltrada.filter(item => 
                    item.nombre.toLowerCase().includes(filtroTexto) || 
                    item.artista.toLowerCase().includes(filtroTexto)
                );
            }

            if (orden === 'alfabetico') {
                listaFiltrada.sort((a, b) => a.nombre.localeCompare(b.nombre));
            } else {
                // 'recientes' (mantiene orden inverso o original)
                listaFiltrada.reverse();
            }

            contadorEl.textContent = favsIds.length === 1 ? "1 álbum guardado" : `${favsIds.length} álbumes guardados`;

            if (listaFiltrada.length === 0) {
                contenedor.innerHTML = `
                    <div style="grid-column: 1 / -1; background: rgba(0,0,0,0.25); padding: 40px; border-radius: 12px; text-align: center; border: 1px dashed rgba(255,255,255,0.15);">
                        <p style="color: #d1a1a7; font-size: 1.1rem; margin-bottom: 5px; font-weight: 500;">No se encontraron álbumes favoritos</p>
                        <p style="color: #999; font-size: 0.85rem;">Explora los álbumes en el inicio o en los rankings para agregarlos aquí ✨</p>
                    </div>
                `;
                return;
            }

            contenedor.innerHTML = "";
            listaFiltrada.forEach(item => {
                let card = document.createElement('div');
                card.className = "fav-card";
                card.innerHTML = `
                    <div class="fav-img-wrapper" onclick="window.location.href='albumportada.php?id=${item.id}'">
                        <img src="${item.img}" alt="${item.nombre}">
                        <button class="btn-quitar-fav" onclick="event.stopPropagation(); quitarFavorito('${item.id}')" title="Quitar de favoritos">✕</button>
                    </div>
                    <p class="name" style="color: #fff; font-size: 0.9rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 4px;">${item.nombre}</p>
                    <p class="artist" style="color: #d1a1a7; font-size: 0.8rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item.artista}</p>
                    <div style="margin-top: 6px; color: #d1a1a7; font-size: 0.75rem; font-weight: 600;">★★★★★ 4.8</div>
                `;
                contenedor.appendChild(card);
            });
        }

        function quitarFavorito(id) {
            let favs = obtenerFavoritos();
            favs = favs.filter(favId => favId !== id);
            localStorage.setItem('mis_favoritos', JSON.stringify(favs));
            mostrarToast("Álbum removido de favoritos");
            renderizarFavoritos(document.getElementById('buscadorFavs').value.toLowerCase().trim());
        }

        function cambiarOrdenFavs() {
            renderizarFavoritos(document.getElementById('buscadorFavs').value.toLowerCase().trim());
        }

        document.addEventListener("DOMContentLoaded", () => {
            renderizarFavoritos();

            // Buscador en vivo para favoritos
            const inputBuscador = document.getElementById("buscadorFavs");
            if (inputBuscador) {
                inputBuscador.addEventListener("input", function() {
                    renderizarFavoritos(this.value.toLowerCase().trim());
                });
            }
        });
    </script>

</body>

</html>
