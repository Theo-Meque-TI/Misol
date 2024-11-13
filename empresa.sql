drop table empresa;
select * from empresa;


CREATE TABLE empresa (
    id_emp serial NOT NULL,
    nome_emp TEXT NOT NULL,
    telefone_emp TEXT NOT NULL,
    cnpj TEXT NOT NULL,
    email_emp TEXT NOT NULL,
    senha_emp TEXT NOT NULL,
    imagem_emp TEXT,
    CONSTRAINT empresa_pkey PRIMARY KEY (id_emp),
    CONSTRAINT email_unico_emp UNIQUE (email_emp),
    CONSTRAINT cnpj_unico UNIQUE (cnpj)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;


/* /////////////IMAGEM//////////////// */
CREATE TABLE imgEmpresa (
    id_img SERIAL PRIMARY KEY,
    id_emp INT NOT NULL,
    imagem1 BYTEA,
    CONSTRAINT fk_imgEmpresa FOREIGN KEY (id_emp) REFERENCES empresa(id_emp) ON DELETE CASCADE
)
TABLESPACE pg_default;

/* /////////////IMAGEM//////////////// */