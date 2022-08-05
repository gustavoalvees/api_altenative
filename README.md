# api_altenative
api para criptomoedas altenativas cuja base seja do codigo BitcoinECDSA (https://github.com/BitcoinPHP/BitcoinECDSA.php)


..
api adaptada para moeda JUNDCOIN (https://jundcoin.com.br/)


guia de uso:
  arquivo "jundcoin.conf" jogar na pasta "local" onde fica os bloco da criptomoeda
     no caso da jundcoin ( windows ) se encontra na "%appdata%/jundcoin/", no linux se encontra em ~/jundcoin/
  
  no jundcoin.conf se encontra tais configurações para conexão rpc!
  
  ''' Jundcoin.conf
  rpcuser=admin          # Usuario RPC
  rpcpassword=admin2     # Senha   RPC
  rpcallowip=127.0.0.1   # ip permitido ( local )
  rpcport=70             # Porta RCP
  server=1               # Modo server ON
  daemon=1               # Funcionar rpc em background
  enableaccounts=1       # Acesso a multiaccounts
  staking=0              # Retira stack
  listen=1               # Maximo de conexões
  '''
  
  
Guia de uso da API:

* Methods ( version 1.0.0 )
  /1.0.0/info/
     - Retorna informações basica da aplicação
     
  /1.0.0/generateaddress/
     - gera endereço jundcoin ( passivel para alteração da sua moeda )
     
  /1.0.0/getbalance/?key={}
     - pega balaço total ( saldo ) da moeda, somente se tiver alguma transação em bloco
     
  /1.0.0/getpubkey/?key={}
     - pega public key atraves da private key
  
  /1.0.0/sendvalue/
     - manda valor usando endereço privado, !!!! FUNÇÂO EM MANUTEÇÂO !!!!!
