CREATE DATABASE grandissimo;
USE grandissimo;

CREATE TABLE Funcao(
fnc_id int PRIMARY KEY,
fnc_nome varchar(255)
);

CREATE TABLE Categoria(
ctg_id int PRIMARY KEY AUTO_INCREMENT,
ctg_nome varchar(255),
ctg_status char(1)
);

CREATE TABLE Usuario(
usr_id int PRIMARY KEY AUTO_INCREMENT,
usr_cpf char(11),
usr_email varchar(255),
usr_senha varchar(255),
usr_nome varchar(255),
usr_cep char(8),
usr_cidade varchar(255),
usr_uf char(2),
usr_bairro varchar(255),
usr_endereco varchar(255),
usr_numero int,
usr_complemento varchar(255),
usr_funcao int,
FOREIGN KEY(usr_funcao) REFERENCES Funcao(fnc_id)
);

CREATE TABLE Produto(
prd_id int PRIMARY KEY AUTO_INCREMENT,
prd_nome varchar(255),
prd_imagem varchar(255),
prd_preco decimal(6,2),
prd_qnt int,
prd_status char(1),
prd_descricao varchar(255),
prd_categoria int,
FOREIGN KEY(prd_categoria) REFERENCES Categoria(ctg_id)
);

CREATE TABLE Compra(
cmp_id int PRIMARY KEY AUTO_INCREMENT,
cmp_datapedido date,
cmp_dataentrega date,
cmp_vizinho varchar(255),
cmp_produto int,
FOREIGN KEY(cmp_produto) REFERENCES Produto(prd_id),
cmp_usuario int,
FOREIGN KEY(cmp_usuario) REFERENCES Usuario(usr_id)
);

INSERT INTO Funcao VALUES(1, 'Administrador');
INSERT INTO Funcao VALUES(2, 'Cliente');

INSERT INTO Usuario(usr_email, usr_funcao, usr_senha) VALUES('adm@grandissimo.com', 1, '$2y$10$tN7MW6VVd1Rqk.Zw2bCgh.7cr5Ar9jBDw5WeIlmqx/EKSs7XKcF5O');
-- senha=123456