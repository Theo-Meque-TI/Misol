drop table proprietario;
select * from proprietario;


CREATE TABLE proprietario (
    id serial NOT NULL,
    nome TEXT NOT NULL,
    telefone TEXT NOT NULL,
    cpf TEXT NOT NULL,
    email TEXT NOT NULL,
    senha TEXT NOT NULL,
    imagem TEXT,
    CONSTRAINT proprietario_pkey PRIMARY KEY (id),
    CONSTRAINT email_unico UNIQUE (email),
    CONSTRAINT cpf_unico UNIQUE (cpf)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;


/* /////////////IMAGEM//////////////// */

CREATE TABLE imgProprietario (
    id_img SERIAL PRIMARY KEY,
    id INT NOT NULL,
    imagem1 BYTEA,
    CONSTRAINT fk_imgProprietario FOREIGN KEY (id) REFERENCES proprietario(id) ON DELETE CASCADE
)
TABLESPACE pg_default;

/* /////////////IMAGEM//////////////// */


-- Função que verifica duplicidade de e-mail entre as duas tabelas
CREATE OR REPLACE FUNCTION verificar_email_unico() RETURNS TRIGGER AS $$
BEGIN
    -- Verifica se o email_emp da tabela empresa já existe na tabela proprietario
    IF TG_TABLE_NAME = 'empresa' THEN
        IF EXISTS (SELECT 1 FROM proprietario WHERE email = NEW.email_emp) THEN
            RAISE EXCEPTION 'O email % já está cadastrado na tabela proprietario', NEW.email_emp;
        END IF;

    -- Verifica se o email da tabela proprietario já existe na tabela empresa
    ELSIF TG_TABLE_NAME = 'proprietario' THEN
        IF EXISTS (SELECT 1 FROM empresa WHERE email_emp = NEW.email) THEN
            RAISE EXCEPTION 'O email % já está cadastrado na tabela empresa', NEW.email;
        END IF;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Trigger para a tabela empresa
CREATE TRIGGER verificar_email_empresa
    BEFORE INSERT OR UPDATE ON empresa
    FOR EACH ROW EXECUTE FUNCTION verificar_email_unico();

-- Trigger para a tabela proprietario
CREATE TRIGGER verificar_email_proprietario
    BEFORE INSERT OR UPDATE ON proprietario
    FOR EACH ROW EXECUTE FUNCTION verificar_email_unico();