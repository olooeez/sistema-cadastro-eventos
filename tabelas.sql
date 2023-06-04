CREATE OR REPLACE TABLE users(
    id_user integer auto_increment PRIMARY KEY,
    nome VARCHAR(30),
    email VARCHAR(30),
    senha VARCHAR(30),
    user_type VARCHAR(30)
);

CREATE OR REPLACE TABLE categories(
    id_categories integer auto_increment PRIMARY KEY,
    nome VARCHAR(20)
); 

CREATE OR REPLACE TABLE events(
    id_event integer auto_increment PRIMARY KEY,
    titulo VARCHAR(30),
    descricao VARCHAR(200),
    data_hora TIMESTAMP,
    local VARCHAR(50),
    id_categoria integer,
    preco VARCHAR(20),
    imagens text,
    FOREIGN KEY (id_categoria) references categories(id_categories)
);



CREATE OR REPLACE TABLE registrations(
    id_registrations integer auto_increment PRIMARY KEY,
    id_usuario integer,
    id_evento integer,
    statusPagamento integer,

    FOREIGN KEY (id_usuario) references users(id_user),
    FOREIGN KEY (id_evento) references events(id_event)
);

CREATE OR REPLACE TABLE reviews(
    id_reviews integer auto_increment PRIMARY KEY,
    avaliacoes VARCHAR(100),
    comentarios VARCHAR(100),
    id_usuario  integer,
    id_evento integer,
    pontuacao integer,
    FOREIGN KEY (id_usuario) references users(id_user),
    FOREIGN KEY (id_evento) references events(id_event)

);