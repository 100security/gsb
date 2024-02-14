# 🔒 Google Safe Browsing
O Google Safe Browing é uma ferramenta desenvolvida pelo Google com o objetivo de aumentar a segurança na internet ao identificar e avisar os usuários sobre sites potencialmente perigosos.

Através da API disponibilizada pelo Google desenvolvi um script em Python que pesquise pesquisar a reputação do sites e exportar os dados para um banco de dados para que possa visualizar via web.

# Modo Console
![](https://www.100security.com.br/images/gsb-13.png)

# Mobo Web
![](https://www.100security.com.br/images/gsb-23.png)

# Artigo 
www.100security.com.br/gsb

# Demo
www.100security.com.br/gsb-demo

# Execução
Verificar um Site
```
python .\gsb.py -u https://www.100security.com.br
```
Verificar os Sites que estão no arquivo 'sites.txt'
```
python .\gsb.py -f sites.txt
```
Verificar um Site e inserir o resultado no Banco de Dados
```
python .\gsb-db.py -u https://www.100security.com.br
```
Verificar os Sites que estão no arquivo 'sites.txt' e inserir o resultado no Banco de Dados
```
python .\gsb-db.py -f sites.txt
```

# Observação
O script 'gsb-db.py' conta com multithreading oferecendo uma execução rápida e eficaz!
