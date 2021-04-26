USE SIBW;

CREATE TABLE events
( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    photo VARCHAR(50),
    title VARCHAR(100) NOT NULL, 
    place VARCHAR(100) NOT NULL, 
    date DATE NOT NULL, 
    author VARCHAR(100) NOT NULL REFERENCES users(email),
    description VARCHAR(3000)
);

CREATE TABLE comments
( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    idEvent INT NOT NULL,
    comment VARCHAR(300) NOT NULL,
    date DATE NOT NULL, 
    author VARCHAR(100) NOT NULL REFERENCES users(email),
    isEdited BOOLEAN DEFAULT(FALSE) NOT NULL,
    FOREIGN KEY(idEvent) REFERENCES events(id)
);

CREATE TABLE banned_words
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(15) NOT NULL UNIQUE
);

CREATE TABLE gallery
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    idEvent INT NOT NULL,
    photo VARCHAR(50) NOT NULL,
    FOREIGN KEY(idEvent) REFERENCES events(id)
);

CREATE TABLE tags
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(20) NOT NULL
);

CREATE TABLE tags_events
(
    idTag INT NOT NULL REFERENCES tags(id),
    idEvent INT NOT NULL REFERENCES events(id),
    PRIMARY KEY(idTag, idEvent)
);

CREATE TABLE users 
(
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL
);