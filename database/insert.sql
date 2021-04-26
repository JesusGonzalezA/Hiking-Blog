USE SIBW;

INSERT INTO events (title, place, date, author, photo, description) 
    VALUES ('Los cahorros', 'Granada', NOW(), 'Jesus Gonzalez', "/assets/places/cahorros.jpg",
            'El desfiladero de los Cahorros del río Monachil es un paraje de
            tenebrosas sacudidas geológicas y caprichosas esculturas 
            naturales, creadas por las imparables crecidas de la cuenca 
            fluvial, que han excavado cuevas, bóvedas, paredes y formaciones
            rocosas a lo largo de los siglos. La segunda parte de la 
            excursión remonta los espectaculares Tajos de Cibrinalejo y 
            disfruta de unas vistas magníficas de los cortijos agrícolas 
            del Camino de la Solana.

            El itinerario comienza en la era de los Portachuelos, que está 
            en la carretera que va desde Monachil hasta el Purche. 100 
            metros abajo de dicha era, que es un aparcamiento, sale una 
            pista que nos lleva hasta la era de los renegrales, siguiendo 
            siempre el camino de los cahorros altos. De ahí sale un camino 
            que en 15 minutos nos sitúa en los cahorros, en concreto en el 
            impresionante puente colgante.

            A partir de este momento el paisaje es espectacular, cuyo máximo 
            exponente es la Cueva de las Palomas, el pequeño "desfiladero" 
            artificial del rio que sirve para llevar una tuberia, hasta que 
            el paisaje se abre en el paraje de las azuelas, si seguimos 
            recto a media hora de camino nos encontramos con un desvio a la 
            izquierda que cruzamos por el puente de las chorreras...

            En la página web del ayuntamiento de monachil, se encuentra 
            también esta ruta a la vez que otras rutas por el municipio y 
            su circunscripción, hay hasta un total de 7 con una descripción 
            excelente. Para más información en inglés leer este artículo de 
            spain-holiday.com');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Alhama de Granada', 'Granada', NOW() + 1, "/assets/places/alhama.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Alicun', 'Granada', NOW() + 1, "/assets/places/alicun.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, author) 
    VALUES ('Camino Mozarabe', 'Granada', NOW() + 1, 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Canal espartera', 'Granada', NOW() + 1, "/assets/places/canal-espartera.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Cerro buitre', 'Granada', NOW() + 1, "/assets/places/cerro-buitre.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Cerro huenes', 'Granada', NOW() + 1, "/assets/places/cerro-huenes.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Cerrada rio castril', 'Granada', NOW() + 1, "/assets/places/cerrada-rio-castril.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Circular atalaya', 'Granada', NOW() + 1, "/assets/places/circular-atalaya.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Circular Lanjarón', 'Granada', NOW() + 1, "/assets/places/circular-lanjaron.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Pino señora', 'Granada', NOW() + 1, "/assets/places/pino-señora.jpg", 'Jesus Gonzalez');
INSERT INTO events (title, place, date, photo, author) 
    VALUES ('Sierra Alfaguara', 'Granada', NOW() + 1, "/assets/places/sierra-alfaguara.jpg", 'Jesus Gonzalez');

INSERT INTO banned_words(word) VALUES ('tonto');
INSERT INTO banned_words(word) VALUES ('idiota');
INSERT INTO banned_words(word) VALUES ('feo');
INSERT INTO banned_words(word) VALUES ('callate');
INSERT INTO banned_words(word) VALUES ('imbecil');
INSERT INTO banned_words(word) VALUES ('cr');
INSERT INTO banned_words(word) VALUES ('lorem');
INSERT INTO banned_words(word) VALUES ('ipsum');


INSERT INTO gallery(idEvent, photo) VALUES (1,"/assets/places/pino-señora.jpg");
INSERT INTO gallery(idEvent, photo) VALUES (1,"/assets/places/sierra-alfaguara.jpg");
INSERT INTO gallery(idEvent, photo) VALUES (1,"/assets/places/circular-lanjaron.jpg");

INSERT INTO tags(description) VALUES ("Familiar");
INSERT INTO tags(description) VALUES ("Acuatica");
INSERT INTO tags(description) VALUES ("Rural");
INSERT INTO tags(description) VALUES ("Alta montana");
INSERT INTO tags(description) VALUES ("Inicial");
INSERT INTO tags(description) VALUES ("Intermedio");
INSERT INTO tags(description) VALUES ("Avanzado");

INSERT INTO tags_events(idTag, idEvent) VALUES (1,1);
INSERT INTO tags_events(idTag, idEvent) VALUES (2,1);
INSERT INTO tags_events(idTag, idEvent) VALUES (3,1);
INSERT INTO tags_events(idTag, idEvent) VALUES (4,2);
INSERT INTO tags_events(idTag, idEvent) VALUES (5,2);
INSERT INTO tags_events(idTag, idEvent) VALUES (6,2);