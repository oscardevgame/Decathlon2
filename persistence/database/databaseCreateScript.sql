CREATE TABLE perfis (
                id_perfil BIGINT NOT NULL,
                descricao VARCHAR(30) NOT NULL,
                PRIMARY KEY (id_perfil)
);



CREATE TABLE power (
                id_power BIGINT NOT NULL,
                descricao VARCHAR(30) NOT NULL,
                PRIMARY KEY (id_power)
);



CREATE TABLE itens (
                id_itens BIGINT NOT NULL,
                descricao VARCHAR(30) NOT NULL,
                valor DOUBLE PRECISION NOT NULL,
                PRIMARY KEY (id_itens)
);



CREATE TABLE itens_power (
                id_itens_power BIGINT NOT NULL,
                id_power BIGINT NOT NULL,
                id_itens BIGINT NOT NULL,
                PRIMARY KEY (id_itens_power)
);



CREATE TABLE usuarios (
                id_usuario BIGINT NOT NULL,
                email VARCHAR(100) NOT NULL,
                nome VARCHAR(100) NOT NULL,
                senha VARCHAR(255) NOT NULL,
                facebook VARCHAR(100) NOT NULL,
                path_file_foto VARCHAR(255) NOT NULL,
                PRIMARY KEY (id_usuario)
);



CREATE TABLE fans (
                id_fas BIGINT NOT NULL,
                id_usuario BIGINT NOT NULL,
                id_fan BIGINT NOT NULL,
                PRIMARY KEY (id_fas)
);



CREATE TABLE creditos (
                id_credito BIGINT NOT NULL,
                id_usuario BIGINT NOT NULL,
                valor DOUBLE PRECISION NOT NULL,
                PRIMARY KEY (id_credito)
);



CREATE TABLE partida (
                id_partida BIGINT NOT NULL,
                id_usuario BIGINT NOT NULL,
                data DATETIME NOT NULL,
                path_file_tracker VARCHAR(255) NOT NULL,
                PRIMARY KEY (id_partida)
);



CREATE TABLE compras (
                id_vendas BIGINT NOT NULL,
                id_usuario BIGINT NOT NULL,
                id_itens BIGINT NOT NULL,
                data DATETIME NOT NULL,
                valor_pago DOUBLE PRECISION NOT NULL,
                quantidade BIGINT NOT NULL,
                PRIMARY KEY (id_vendas)
);



CREATE TABLE usuario_itens (
                id_power BIGINT NOT NULL,
                id_usuario BIGINT NOT NULL,
                id_itens BIGINT NOT NULL,
                situacao BIGINT NOT NULL,
                PRIMARY KEY (id_power)
);



CREATE TABLE perfil_usuario (
                id_usuario_perfil BIGINT NOT NULL,
                id_perfil BIGINT NOT NULL,
                id_usuario BIGINT NOT NULL,
                PRIMARY KEY (id_usuario_perfil)
);



ALTER TABLE perfil_usuario ADD CONSTRAINT perfis_perfil_usuario_fk
FOREIGN KEY (id_perfil)
REFERENCES perfis (id_perfil)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE itens_power ADD CONSTRAINT power_itens_power_fk
FOREIGN KEY (id_power)
REFERENCES power (id_power)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE itens_power ADD CONSTRAINT itens_itens_power_fk
FOREIGN KEY (id_itens)
REFERENCES itens (id_itens)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE compras ADD CONSTRAINT itens_itens_loja_fk
FOREIGN KEY (id_itens)
REFERENCES itens (id_itens)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE usuario_itens ADD CONSTRAINT itens_usuario_itens_fk
FOREIGN KEY (id_itens)
REFERENCES itens (id_itens)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE perfil_usuario ADD CONSTRAINT usuarios_perfil_usuario_fk
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE usuario_itens ADD CONSTRAINT usuarios_usuario_itens_fk
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE compras ADD CONSTRAINT usuarios_vendas_fk
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE partida ADD CONSTRAINT usuarios_partida_fk
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE creditos ADD CONSTRAINT usuarios_creditos_fk
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE fans ADD CONSTRAINT usuarios_fas_fk
FOREIGN KEY (id_usuario)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


ALTER TABLE fans ADD CONSTRAINT usuarios_fas_fk1
FOREIGN KEY (id_fan)
REFERENCES usuarios (id_usuario)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
