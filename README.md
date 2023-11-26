# Grandíssimo: loja de instrumentos musicais
![Página inicial](./img/readme/1-home.png)
![Login](./img/readme/2-login.png)
![Cadastro](./img/readme/3-signup.png)
![Comprar bateria](./img/readme/4-purchase.png)
![Listagem de pedidos](./img/readme/5-purchaseorder.png)
![Gerenciar pedidos dos clientes](./img/readme/6-shipping.png)
![Gerenciar produtos](./img/readme/7-product.png)

<br>

## Banco de dados

O arquivo SQL do banco de dados está em *./db/grandissimo.sql*, não se esqueça de modificar as configurações de conexão em *./db/conexao.php* de acordo com as suas preferências.

>  ### Atenção
>  
>  Não adicione ou atualize senhas diretamente pelo SQL, já que elas passam por uma hash

<br>

## Adicionando produtos

"O site está vazio, como adiciono categorias e produtos?" Pelo perfil do administrador.

Se você não modificar o SQL, o perfil de administrador é criado automaticamente. Para primeiro acesso:

>  * E-mail: adm@grandissimo.com
>  * Senha: 123456

Observação: na realidade, esse endereço de e-mail não me pertence.

<br>

## Melhorias futuras

Por ser uma pequena prática de programação web, deixei da lado algumas funções que futuramente podem ser adicionadas:
>  * Website responsivo;
>  * Autenticação de endereço de e-mail;
>  * Enviar recuperação de senha via e-mail cadastrado;
>  * Notificação de entrega de produto;
>  * Carrinho de compras;
>  * Página para gerar e imprimir etiquetas de endereço para entrega;
>  * Avaliação de produtos;
>  * Página "Sobre nós";
>  * Footer com mapa para a loja física;
>  * Opção de guardar imagens em *blob* no banco de dados.
