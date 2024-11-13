CREATE TABLE imgPropriedade (
    id_img SERIAL PRIMARY KEY,
    id_propri INT NOT NULL,
    imagem1 BYTEA,
    imagem2 BYTEA,
    imagem3 BYTEA,
    CONSTRAINT fk_imgPropriedade FOREIGN KEY (id_propri) REFERENCES propriedade (id_propri) ON DELETE CASCADE
)
TABLESPACE pg_default;