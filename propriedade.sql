drop table propriedade;
select * from propriedade;


CREATE TABLE propriedade (
    id_propri serial NOT NULL PRIMARY KEY,
    titulo TEXT NOT NULL,
    tamanho TEXT NOT NULL,
    tipo_solo TEXT,
    estado TEXT NOT NULL,
    cidade TEXT NOT NULL,
    coordenadas TEXT NOT NULL,
    id serial NOT NULL,
    CONSTRAINT fk_propriedade_proprietario FOREIGN KEY (id) REFERENCES proprietario (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;