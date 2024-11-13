drop table administrador;
select * from administrador;


CREATE TABLE administrador (
    id serial NOT NULL,
    nome TEXT NOT NULL,
    telefone TEXT NOT NULL,
    cpf TEXT NOT NULL,
    email TEXT NOT NULL,
    senha TEXT NOT NULL,
    imagem TEXT,
	ativo boolean NOT NULL,
    CONSTRAINT administrador_pkey PRIMARY KEY (id),
    CONSTRAINT email_unico UNIQUE (email),
    CONSTRAINT cpf_unico_admin UNIQUE (cpf)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;


INSERT INTO administrador(nome, telefone, cpf, email, senha, imagem, ativo)
        VALUES ('Admin', '17996630709', '000.000.000-00', 'admin@gmail.com', crypt('admin123', gen_salt('bf', 8)), 'admin.png', true)