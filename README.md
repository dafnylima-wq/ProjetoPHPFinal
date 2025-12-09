# ProjetoPHPFinal
É um site e um projeto de simulação para mostrar os processos de criação de uma conta e o cadastro de alunos de uma instituição, mostrando também as estatísticas relacionadas aos dados dos alunos cadastrados. Esse site pode ser usado tanto para uma instituição real como um modelo a ser seguido. Por ser apenas uma simulação, ele não está de nenhuma forma ligado a uma instituição real ou fictícia.

<img width="1917" height="933" alt="index php" src="https://github.com/user-attachments/assets/c4ca939a-b563-407b-b7ee-1e5638f13b47" />
Essa é a tela inicial do projeto, ela dá ao visitante a opção de logar diretamente caso ele possua uma conta ou criar uma no link abaixo caso ele não possua. Quando o visitante loga na sua conta ele é direcionado ao painel de estatísticas do site, que mostra gráficos referentes aos dados dos alunos cadastrados.

<img width="1919" height="950" alt="login php" src="https://github.com/user-attachments/assets/03eafa91-62e3-4f39-afed-a8300687fb9d" />
Essa é a tela de login comentada acima. Para criar uma conta o visitante vai precisar colocar um nome, um e-mail e uma senha, também possuindo a opção de voltar à tela inicial e de sair do site no botão presente na NavBar. O site possui um código que informará caso uma das informações pedidas esteja vazia. Ao criar sua conta e apertar o botão para registrar a conta no sistema, o visitante será direcionado à tela de login principal.

<img width="1919" height="943" alt="telacadastro php" src="https://github.com/user-attachments/assets/cace63c0-55cf-4579-8b4a-39dbd0ecc248" />
Essa é a tela de cadastro para um aluno da instituição, possuindo diversas informações requeridas, sendo elas: nome completo do aluno, sua data de nascimento, o nome do seu responsável, o tipo do seu responsável (mãe, pai, tio e irmão), o curso que o aluno quer fazer ou já faz e as informações de endereço (rua, bairro, CEP, cidade, número da casa) e se o aluno necessita de transporte. Essa página do site também possui um código que impossibilita o cadastro do aluno caso uma das informações não esteja preenchida. Quando o visitante conclui o cadastro corretamente, as informações do aluno são registradas automaticamente no painel de estatísticas e na tabela presente na página “Alunos”, que contém as informações principais do aluno.

<img width="1918" height="944" alt="painel php" src="https://github.com/user-attachments/assets/a3edab5e-3c48-42fb-a7ab-00870566bb34" />
Esse é o painel de estatísticas do site, ele mostra um total de dez consultas sobre os dados variados dos alunos cadastrados. São elas: total de alunos, o total por cada curso separadamente, a distribuição de alunos por curso em forma de um gráfico de pizza, o tipo de responsável do aluno em um gráfico de rosca, um gráfico em barra dos alunos por cidade, um gráfico em barra dos alunos por bairro — sendo os dez bairros que mais aparecem nas informações — e um gráfico de rosca para indicar se o aluno necessita de transporte. Todos os gráficos possuem cores variadas e uma interação dinâmica.

<img width="1919" height="944" alt="alunos php" src="https://github.com/user-attachments/assets/f265c9c1-87b7-4f2d-808c-d24b81c3eb26" />
Essa é a página que demonstra as informações principais dos alunos: nome, cidade e curso, tudo isso em uma tabela que permite tanto editar as informações dos alunos quanto excluir o próprio aluno. A página também possui a opção de buscar o aluno por nome, filtrar por curso e por cidade, além de possuir a opção de limpar a barra de pesquisa. Quando as informações são alteradas, elas também são modificadas no painel de estatísticas, já que os dois são ligados intrinsecamente.

<img width="1916" height="947" alt="myadmi php" src="https://github.com/user-attachments/assets/ffdd7f25-e15a-43c0-894c-098adc388485" />
Essa é a tabela do phpMyAdmin que mostra o banco de dados conectado ao site. É ela que permite que o site funcione corretamente ao armazenar e organizar todas as informações cadastradas.
