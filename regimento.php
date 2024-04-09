<?php

include_once("templates/header.php");
include_once("dao/condominoDAO.php");

$condomino = new CondominoDAO($conn, $BASE_URL);

if (isset($_GET['id'])) {

  include_once("dao/eventsDAO.php");

  $id = filter_input(INPUT_GET, 'id');
  $event = new eventsDAO($conn, $BASE_URL);
  $data = $event->getEventsById($id);

  if ($data == false) {
    header("Location: $BASE_URL");
  }
} elseif (isset($_GET['date'])) {

  $date = filter_input(INPUT_GET, 'date');
}
?>

</head>

<body class="">
  <div class="wrapper">
    <?php include_once("templates/sidebar.php"); ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include_once("templates/navbar.php"); ?>
      <!-- End Navbar -->
      <div class="content">

        <div class="container-xl px-4 mt-4">

          <div class="row">
            <div class="col-lg-8">
              <!-- Change password card-->
              <div class="card mb-4">
                <div class="card-header">VISTA AÉREA CONDOMINIO TUCANOS</div>
                <div class="card-body">
                  <a data-toggle="modal" data-target=".bd-example-modal-lg">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="assets/img/frente.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="assets/img/fundos.png" alt="Second slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </a>
                </div>

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div id="carouselmodal" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselmodal" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselmodal" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block w-100" src="assets/img/frente.png" alt="First slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/fundos.png" alt="Second slide">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselmodal" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselmodal" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- Security preferences card-->
              <div class="card mb-4">
                <div class="card-header text-success">REGIMENTO INTERNO DE CONDOMÍNIO RESIDENCIAL TUCANOS DO CONDOMÍNIO</div>
                <div class="card-body">

                  <h5 class="text-info">DA ENTRADA E SAÍDA DO CONDOMÍNIO</h5>

                  <p>Artigo 6º</p>
                  <p>Parágrafo terceiro. Ao aproximar-se do portão de entrada, todo motorista condômino/morador deverá abrir o vidro da janela da porta do motorista de seu veículo, a fim de possibilitar uma melhor visualização do interior do veículo e identificação de seu condutor pelos funcionários da portaria.</p>

                  <h5 class="text-info">DO USO DA SAUNA</h5>

                  Artigo 7º - O uso da sauna será privativo aos condôminos e no máximo até quatro convidados por condômino.

                  Parágrafo primeiro. O condômino que desejar fazer uso da sauna, nos dias, nos horários e nas condições admitidas por este Regimento Interno, deverá solicitar o seu ligamento com uma hora de antecedência, no mínimo, a fim de permitir à administração preparar as condições para seu adequado uso.

                  Parágrafo segundo. Ao solicitar o funcionamento da sauna, cumprirá ao condômino esclarecer se fará uso da sauna acompanhado de convidados, informando em caso positivo o nome dos seus convidados.

                  Parágrafo terceiro. O uso da sauna por menores de 16 (dezesseis) anos fica condicionada à presença dos pais ou responsáveis legais, cabendo somente a estes responder pela segurança dos mesmos.

                  Parágrafo quarto. O uso da sauna deverá ser realizado com o uso de traje de banho adequado, preservando-se o decoro e o respeito entre os seus frequentadores.

                  Parágrafo quinto. O Conselho Consultivo regulamentará os dias, horários e demais regras de funcionamento da sauna, definindo igualmente sobre a conveniência de proceder-se ou não a cobrança da taxa de uso.

                  DO USO DA SALA DE GINÁSTICA

                  Artigo 8º - O uso da sala de ginástica será privativo aos condôminos e seus hóspedes.

                  Parágrafo primeiro. É proibida a frequência e permanência de menores de 14 (quatorze) anos na sala de ginástica, salvo quando acompanhados dos pais ou de um responsável legal ou mediante expressa autorização outorgada pelo Conselho Consultivo.

                  Parágrafo segundo. Os usuários da sala de ginástica deverão zelar por sua limpeza e conservação, sendo vedada a utilização de calçados sujos ou molhados, bem como sua utilização em trajes de banho ou sem camisa.

                  Parágrafo terceiro. A sala de ginástica não será objeto de reserva para uso exclusivo e nem mesmo poderá abrigar torneios, festas, reuniões etc.

                  Parágrafo quarto. O Conselho Consultivo regulamentará os dias, horários e demais regras de funcionamento da sala de ginástica, definindo igualmente sobre a conveniência de proceder-se ou não a cobrança da taxa de uso.

                  DO USO DA QUADRA POLIESPORTIVA

                  Artigo 9º. No uso da quadra poliesportiva, os condôminos deverão guardar o devido decoro e respeitar as regras de boa convivência, zelando pela boa conservação do local e seus equipamentos.

                  Parágrafo primeiro. Cada condômino poderá ter como convidado para uso da quadra no máximo 12 (doze) pessoas, podendo ser feita reserva exclusiva em qualquer dia da semana, com antecedência na portaria do condomínio. O uso privativo não poderá exceder a uma hora de uso, admitida a prorrogação deste tempo em caso de ausência de reserva por outro condômino.

                  Parágrafo segundo. A da quadra poliesportiva poderá ser usada diariamente das 07:00 às 22:00 horas, com exceção dos Domingos e Feriados, quando o horário será das 9:00 às 22:00 horas, admitida a alteração destes horários pelo Conselho Consultivo.

                  Parágrafo terceiro. Não é permitido o uso ou porte de garrafas, copos ou de quaisquer outros utensílios de vidro, bem como qualquer tipo de alimento nas dependências da quadra poliesportiva.

                  Parágrafo quarto. O Conselho Consultivo poderá determinar a interdição da quadra por ocasião de eventos especiais, bem como prorrogar ou reduzir o horário de utilização da mesma por motivos que entender justificados.

                  Parágrafo quinto. No uso da quadra, é vedada a utilização de sapatos ou outro tipo de calçado inadequados para a prática esportiva, a fim de não danificar o piso.

                  Parágrafo sexto. Em hipótese alguma poderá haver convidados na quadra sem que o condômino anfitrião esteja presente no local.

                  Parágrafo sétimo. O Conselho Consultivo poderá impor outras regras de uso da quadra poliesportiva, sempre com o propósito de garantir o bom uso da mesma.

                  DO USO DA QUADRA DE TÊNIS

                  Artigo 10. No uso da quadra de tênis, os condôminos deverão guardar o devido decoro e respeitar as regras inerentes ao próprio esporte, zelando pela boa conservação do local e seus equipamentos.

                  Parágrafo primeiro. É terminantemente proibido o uso da quadra de tênis para outra finalidade que não seja a prática da modalidade esportiva tênis.

                  Parágrafo segundo. Cada condômino poderá ter como convidado para uso da quadra no máximo 03 (três) pessoas, podendo ser feita reserva exclusiva em qualquer dia da semana, com antecedência na portaria do condomínio. O uso privativo não poderá exceder a uma hora de uso, admitida a prorrogação deste tempo em caso de ausência de reserva por outro condômino.

                  Parágrafo terceiro. A da quadra de tênis poderá ser usada diariamente das 06:00 às 22:00 horas, com exceção dos Domingos e Feriados, quando o horário será das 7:00 às 21:00 horas, admitida a alteração destes horários pelo Conselho Consultivo.

                  Parágrafo quarto. Não é permitido o uso ou porte de garrafas, copos ou de quaisquer outros utensílios de vidro, bem como qualquer tipo de alimento nas dependências da quadra de tênis.

                  Parágrafo quinto. No uso da quadra, é vedada a utilização de sapatos ou outro tipo de calçado inadequados para a prática esportiva, a fim de não danificar o seu piso.

                  Parágrafo sexto. Em hipótese alguma poderá haver convidados na quadra sem que o condômino anfitrião esteja presente no local.

                  Parágrafo sétimo. Durante a semana, os menores de 16 (dezesseis) anos terão preferência no uso da quadra de tênis até as 17:00 horas, sendo que a partir deste horário a preferência passará a ser dos maiores de 16 (dezesseis) anos. Nos finais de semana e feriados, a preferência será somente para os maiores de 16 (dezesseis) anos.

                  Parágrafo oitavo. Fica vedado o uso da quadra de tênis com chuvas ou durante o período destinado à sua manutenção.

                  Parágrafo nono. O Conselho Consultivo poderá impor outras regras de uso da quadra de tênis, sempre com o propósito de garantir o bom uso da mesma, podendo, inclusive, estabelecer ou eliminar o regime de preferências.

                  DO USO DA PISCINA

                  Artigo 11. A piscina poderá ser utilizada pelos condôminos e por seus convidados, estes limitados ao máximo de 12 (doze) pessoas por condômino anfitrião.

                  Parágrafo primeiro. Na hipótese de utilização exclusiva da churrasqueira, o número de convidados poderá ser ampliado para até 40 (quarenta) convidados, sendo, contudo, obrigatória a presença dos pais quando os convidados forem menores de 18 (dezoito) anos.

                  Parágrafo segundo. Fica proibido o uso da piscina por portadores de moléstia infectocontagiosa ou transmissível, podendo a Administração, quando entender necessário, exigir atestado médico dos usuários.

                  Parágrafo terceiro. No uso da piscina, os condôminos e seus convidados deverão guardar o devido decoro e respeitar os bons costumes, evitando comportamentos que possam causar constrangimentos aos demais usuários.

                  Parágrafo quarto. Os danos causados por convidados quando da utilização da piscina serão de responsabilidade dos respectivos condôminos.

                  Paragrafo quinto. É expressamente vedada a utilização de garrafas e/ou outros utensílios de vidro nas dependências da piscina e/ou suas imediações.

                  Parágrafo sexto. Somente será permitido o uso de aparelhos sonoros na área da piscina quando não prejudiquem o sossego dos demais usuários.

                  Parágrafo sétimo. Não será permitida a utilização da piscina para a promoção de festas de qualquer natureza, salvo mediante prévia autorização do Conselho Consultivo, e desde que não prejudiquem os demais moradores.

                  Parágrafo oitavo. É proibida a prática de jogos esportivos na área da piscina que possam de qualquer modo interferir na segurança, sossego ou bem-estar dos demais usuários.

                  Parágrafo nono. É vedada a utilização da piscina por menores de 12 (doze) anos desacompanhados dos pais ou responsáveis.

                  Parágrafo décimo. A administração poderá estabelecer um dia por semana de fechamento da piscina para fins de limpeza, manutenção e tratamento de água.

                  Parágrafo décimo primeiro. O Conselho Consultivo estabelecerá os dias e horários de funcionamento da piscina, bem como poderá impor outras regras complementares para seu bom uso, dando devido conhecimento aos condôminos.

                  Parágrafo décimo segundo. A utilização das piscinas em qualquer horário isenta o Condomínio de qualquer responsabilidade caso ocorram acidentes com as pessoas que indevidamente insistirem em utilizá-las sem a presença do guardião.

                  Parágrafo décimo terceiro. Os móveis e utensílios da piscina não poderão ser retirados nem utilizados para fins diversos daqueles a que se destinam de suas imediações.

                  Parágrafo décimo quarto. Não será permitido o ingresso de pessoas em trajes desapropriados na piscina.

                  Parágrafo décimo quinto. Não será permitido o ingresso de animais de qualquer espécie na área da piscina.

                  DO USO DO PLAYGROUND

                  Artigo 12. O playground destina-se à recreação infantil e é de uso exclusivo dos condôminos, hóspedes e convidados.

                  Parágrafo primeiro. Os pais ou responsáveis deverão orientar as crianças no sentido de preservar a área e aos brinquedos.

                  Parágrafo segundo. O horário de funcionamento do playground será das 08:00 horas às 21:00 horas.

                  Parágrafo terceiro. Não será permitida a prática de jogos ou brincadeiras que possam dificultar o uso da área pelos demais usuários ou que produzam barulho excessivo.

                  Parágrafo quarto. A idade limite para uso é de 12 anos, sendo que os menores de 06 anos deverão estar sempre acompanhados dos pais ou de um responsável.

                  Parágrafo quinto. Quaisquer defeitos nos brinquedos devem ser reportados à Administração.

                  Parágrafo sexto. Não será permitida a presença de pessoa estranha ao condomínio desacompanhada de morador nas dependências do playground.

                  Parágrafo sétimo. Eventuais danos eventualmente causados por hóspedes ou convidados serão indenizados pelo condômino anfitrião.

                  DO USO DA CHURRASQUEIRA

                  Artigo 13. A churrasqueira é de uso privativo dos condôminos e seus convidados, destinando-se à realização de festas e recepções dos condôminos.

                  Parágrafo primeiro. Fica vedado o uso da churrasqueira aos condôminos inadimplentes.

                  Parágrafo segundo. O uso da churrasqueira obriga ao pagamento da taxa de uso.

                  Parágrafo terceiro. O uso da churrasqueira está condicionado à prévia reserva junto à administração, assinatura do termo de responsabilidade e da autorização de débito da taxa de uso.

                  Parágrafo quarto. Poderão ser requisitados simultaneamente o salão de festa e a churrasqueira pelo mesmo condômino, mediante o pagamento das taxas de uso estabelecidas pelo Conselho Consultivo.

                  Parágrafo quinto. Para que a entrada de convidados seja autorizada, o condômino requisitante deverá entregar previamente, na portaria, a listagem de seus convidados, no número máximo de 40 (quarenta) convidados. Durante os meses de dezembro, janeiro e fevereiro, o número máximo de convidados fica reduzido ao máximo de 20 (vinte) convidados.

                  Parágrafo sexto. O cancelamento de reserva deverá ser comunicado com a antecedência mínima de 24 (vinte quatro) horas, sob pena do condômino restar obrigado ao pagamento da taxa de uso.

                  Parágrafo sétimo. Nos eventos realizados na churrasqueira, a utilização de qualquer aparelho que produza som deve ser suspensa após as 22 horas, consoante dispõe a legislação pertinente.

                  Parágrafo oitavo. No uso da churrasqueira, os condôminos e convidados devem guardar o devido decoro e respeitar os bons costumes, evitando comportamentos que possam causar constrangimentos aos demais usuários.

                  Parágrafo nono. Os menores de 16 (dezesseis) anos somente poderão fazer uso da churrasqueira desde que acompanhados dos pais ou de um responsável legal.

                  Parágrafo décimo. Fica o Conselho Consultivo autorizado a baixar outras regras complementares visando o bom e adequado funcionamento da churrasqueira.

                  DO USO DO SALÃO DE FESTAS

                  Artigo 14. O salão de festas é destina-se à utilização exclusiva dos condôminos que efetivamente moram no condomínio, para eventos de caráter social, sendo vedado, a qualquer pretexto, a locação ou a cessão do mesmo a terceiros.

                  Parágrafo primeiro. O uso do salão de festas em datas comemorativas de caráter geral, em especial Páscoa, Dia das Mães, Dia dos Pais, Dia das Crianças, Natal e Ano Novo, será assegurado, preferencialmente, à Administração do Condomínio, por se tratar de ocasiões em que poderão ser promovidas comemorações comunitárias.

                  Parágrafo segundo. O condômino interessado em utilizar o salão de festas deverá reservá-lo junto a Administração do Condomínio com antecedência mínima de 30 (trinta) dias da data de utilização.

                  Parágrafo terceiro. Ao ser deferida a reserva do salão de festas pela administração, o condômino deverá proceder a assinatura do termo de responsabilidade e da autorização de débito da taxa de uso.

                  Parágrafo quarto. A recusa na assinatura do termo de responsabilidade e da autorização de débito da taxa de uso será recebida como desistência na utilização do espaço.

                  Parágrafo quinto. Havendo mais de um condômino interessado em utilizar o salão de festas, na mesma data, a prioridade da reserva será dada ao primeiro da lista.

                  Parágrafo sexto. Em havendo desistência da reserva do salão de festas o condômino deverá comunicar a administração, com no mínimo 48 (quarenta e oito) horas de antecedência e, caso não o faça dentro do prazo estipulado, será cobrada uma taxa no valor correspondente a 50% (cinquenta por cento) do valor da taxa de uso.

                  Parágrafo sétimo. A lotação do salão de festas é de no máximo 100 (cem) pessoas, dentre as quais se incluem: adultos, crianças, convidados e condôminos em geral.

                  Parágrafo oitavo. É proibido ao condômino locatário, utilizar-se das demais áreas comuns para a instalação de qualquer tipo de brinquedo, salvo expressa autorização do Síndico.

                  Parágrafo nono. Não será permitido o uso do salão de festas para fins políticos, religiosos, festas de empresa e festas com venda de ingressos.

                  Parágrafo décimo. O condômino que realizar eventos no salão de festas ficará inteiramente responsável por quaisquer danos materiais e pessoais ocorridos durante a utilização do mesmo, sejam eles causados ao condomínio, a outros condôminos ou a terceiros, por ele ou seus convidados.

                  Parágrafo décimo primeiro. Além de cumprir e fazer cumprir todas as normas regimentais e de providenciar para que seus convidados não causem distúrbios durante o evento festivo, o condômino usuário do salão de festas ainda se obriga a:

                  I – não exceder nem permitir que se excedam os limites da legislação vigente com relação ao som de aparelhos, respeitando sempre a Lei do Silêncio;

                  II - manter o som e o tom de voz baixos a partir das 22:00 (vinte e duas) horas respeitando o horário de descanso dos demais condôminos, bem como as legislações pertinentes;

                  III – permanecer no local durante todo o tempo que transcorrer o evento festivo, dele não se afastando;

                  IV – não cobrar e nem permitir que cobrem taxa de ingresso de qualquer forma ou pretexto.

                  Parágrafo décimo segundo. Fica terminantemente vedada a utilização de conjunto musical no salão de festas.

                  Parágrafo décimo terceiro. Caso o salão de festas seja objeto de utilização em comum, por mais de um condômino, serão os mesmos solidariamente responsáveis pelas infrações ao disposto neste Regimento.

                  Parágrafo décimo quarto. Não ser admitido o funcionamento do salão de festas a partir das 23:00 horas.

                  Parágrafo décimo quinto. Os menores de 18 (dezoito) anos somente poderão fazer uso do salão de festas que acompanhados dos pais ou de um responsável legal.

                  Parágrafo décimo sexto. No uso do salão de festas, os condôminos e convidados devem guardar o devido decoro e respeitar os bons costumes, evitando comportamentos que possam causar constrangimentos aos demais usuários.

                  Parágrafo décimo sétimo. Para eventos com um número de até 50 (cinquenta) convidados, o acesso de veículos e controle de convidados dar-se-á pela portaria, sendo obrigatório o prévio fornecimento de uma listagem contendo o nome de todos os convidados.

                  Parágrafo décimo oitavo. Para eventos com um número de convidados superior a 50 (cinquenta) convidados, o acesso de veículos dar-se-á diretamente pela entrada lateral existente no estacionamento externo de uso comum. Nesta hipótese, ficará o condômino obrigado a contratar segurança e manobrista, às suas expensas, ficando integralmente responsável pelo acesso e controle de seus convidados.

                  Parágrafo décimo nono. Fica o Conselho Consultivo autorizado a baixar outras regras complementares visando o bom e adequado funcionamento do salão de festas.

                  DA CIRCULAÇÃO INTERNA

                  Artigo 15. O tráfego e circulação de veículos, no interior do Condomínio, será realizado em estrito cumprimento das normas estabelecidas no Código de Trânsito Brasileiro, na Convenção do Condomínio, neste Regimento Interno e de outras normas estabelecidas pelo Conselho Consultivo.

                  Parágrafo primeiro. Os pedestres têm absoluta prioridade em relação a qualquer tipo de veículo.

                  Parágrafo segundo. A velocidade máxima permitida será de 30 km/h (trinta quilômetros por hora) para qualquer tipo de veículo motorizado, ficando expressamente proibida a direção de veículos motorizados por menores, incapazes ou qualquer pessoa não qualificada para dirigi-los.

                  Parágrafo terceiro. Em nenhuma hipótese veículos poderão transitar pelas áreas verdes do Condomínio.
                  Parágrafo quarto. É vedada a entrada e circulação no interior do Condomínio, de caminhões que não estejam a serviços de carga e descargas e ônibus.

                  Parágrafo quinto. É vedado estacionar veículos automotores nos lotes de propriedade comum, sobre as calçadas, em frente aos portões de entrada dos lotes exclusivos.

                  Parágrafo sexto. Caso algum Condômino seja proprietário de veículo de grande porte, deverá estacioná-lo dentro de seu imóvel, sendo vedada a permanência ou estacionamento de caminhões de carga, máquinas, e outros veículos de grande porte, nas ruas e dependências comuns do Condomínio, por prazo superior ao necessário para carga e descarga de materiais.

                  Parágrafo sétimo. A entrada de caminhões de mudanças deverá ser comunicada, por escrito, à Administração, com antecedência mínima de 24 (vinte quatro) horas, sendo que, tanto para carregar como para descarregar, somente serão permitidas nos horários das 8:00h às 18:00 h nos dias úteis e, aos sábados, até o meio dia. Fora desses horários, somente com autorização da administração mediante justificativa.

                  Parágrafo oitavo. É vedado utilizar vias públicas ou obstruí-las para prática de atividades particulares, ainda que momentâneas ou eventuais.

                  Parágrafo nono. Os veículos leves em função da segurança deverão pernoitar obrigatoriamente no interior ou em frente ao lote residencial.

                  Parágrafo décimo. É vedada a circulação irregular de veículos ou em desconformidade com a sinalização estabelecida.

                  Parágrafo décimo primeiro. As entregas de equipamentos, materiais e gêneros alimentícios destinados a festas, poderão realizar-se em qualquer dia da semana até às 18 (dezoito) horas, desde que haja um responsável pelo recebimento dos mesmos na residência a que se destinam.

                  Parágrafo décimo segundo. Os veículos de transportes fora das especificações contidas neste Regulamento, somente poderão entrar no Condomínio mediante expressa autorização do Síndico.

                  Parágrafo décimo terceiro. O Conselho Consultivo poderá baixar normas complementares visando o aperfeiçoamento das regras regulamentares da circulação interna do Condomínio.

                  DO ESTACIONAMENTO EXTERNO DE ÁREA COMUM

                  Artigo 16. O uso do estacionamento externo de área comum é destinado exclusivamente ao abrigo temporário e eventual de veículos de hóspedes e convidados dos condôminos, sendo vedado o uso contínuo, bem como sua utilização como estacionamento de barcos, motocicletas, carretas, máquinas, caminhões, móveis, equipamentos diversos ou depósito de quaisquer objetos.

                  DA REALIZAÇÃO DE OBRAS

                  Artigo 17. INCLUIR AS REGRAS DO REGIMENTO VIGENTE. VERIFICAR A NECESSIDADE DE MUDANÇA DE ALGUMA REGRA EM ESPECIAL. ÊNFASE PARA AS REFORMAS.

                  DA COLETA DE LIXO

                  Artigo 18. A coleta de lixo será realizada diariamente de segunda-feira a sábado, em horários estabelecidos pelo Conselho Consultivo.

                  Parágrafo primeiro. É obrigatório aos condôminos e/ou moradores estarem com o lixo devidamente acondicionado em sacos plásticos resistentes, bem como depositá-los na lixeira pelo menos 30 (trinta) minutos antes da hora prevista para seu recolhimento.

                  Parágrafo segundo. É proibida a colocação de entulhos, caixas vazias, engradados e etc., em frente às unidades autônomas ou em qualquer das áreas comuns condominiais, por qualquer período.

                  DOS ANIMAIS DOMÉSTICOS

                  Artigo 19. A permanência de animais domésticos será tolerada, devendo seus proprietários mantê-los restritos à sua unidade autônoma de modo a não causar transtornos o sossego alheio.

                  Parágrafo primeiro. Não será permitido a criação de animais de grande porte e de raças caninas consideradas de ataque e guarda, salvo quando se tratar de animais adestrados com o objetivo de servir de guia para deficientes visuais, com a devida documentação comprobatória.

                  Parágrafo segundo. Os animais domésticos de pequeno e médio porte não poderão transitar livremente pelo condomínio. Para tanto, deverão sempre ser mantidos com coleiras e estarem acompanhados de seus proprietários ou de um responsável. Quaisquer danos que eles venham causar são de responsabilidade dos proprietários.

                  Parágrafo terceiro. Quando em passeio, os animais deverão estar sempre contidos por guias adequadas e as espécies consideradas violentas, deverão utilizar focinheiras.

                  Parágrafo quarto. Os animais encontrados desacompanhados serão denunciados aos órgãos competentes, a fim de que se proceda à coleta do animal.

                  Parágrafo quinto. Caberá ao condômino proprietário do animal zelar pela higiene e limpeza em seu habitat, bem como, quando em circulação nas áreas comuns do condomínio, ficando o condutor do animal responsável pelo recolhimento das fezes ou detritos, devendo portar meios adequados para fazê-lo imediatamente.

                  Parágrafo sexto. Não será permitido animais de estimação defequem ou urinem nas vias, passeios, áreas comuns e privativas dos moradores. Os proprietários dos animais deverão limpar imediatamente a área, na eventualidade dessas ocorrências.

                  Parágrafo sétimo. Fica vedado do acesso dos animais às áreas de uso comum, tais como playground, salão de festas, churrasqueira, piscina, quadras de esportes etc.

                  DAS INFRAÇÕES E PENALIDADES

                  Artigo 20. Constitui infração nos termos deste Regimento Interno a inobservância de qualquer de seus preceitos e legislação pertinentes, sujeitando o infrator às penalidades nele previstas.

                  Parágrafo primeiro. Estão sujeitos às sanções disciplinares deste Regimento Interno todos os condôminos, cônjuges, companheiros, filhos, ocupantes, moradores e locatários do condomínio.

                  Parágrafo segundo. Às infrações a este Regimento Interno serão aplicadas as seguintes sanções disciplinares:

                  a) Advertência verbal;
                  b) Advertência escrita;
                  c) Multa no grau leve no valor equivalente a 50% de uma contribuição mensal;
                  d) Multa no grau médio no valor equivalente à uma contribuição mensal;
                  e) Multa no grau máximo no valor equivalente de duas a cinco contribuições mensais.

                  Parágrafo terceiro. A imposição da multa e seu grau independe da existência de prévia advertência, podendo ser aplicada pelo síndico diretamente em razão do tipo de infração cometida.

                  Parágrafo quarto. No caso de reincidência, o valor da multa será aplicado em dobro.

                  Parágrafo quinto. O condômino penalizado poderá apresentar pedido de reconsideração ao Síndico, dentro de 48 (quarenta e oito) horas da data de recebimento da imposição da penalidade, demonstrando seu inconformismo e expondo os motivos disso. O pedido de reconsideração não será recebido se protocolado fora do prazo.

                  Parágrafo sexto. Negado o pedido de reconsideração, o condômino penalizado poderá interpor recurso ao Conselho Consultivo, devendo tal recurso ser interposto no prazo de até 05 (cinco) dias úteis contados a partir do recebimento ou comunicação de tal negativa. Não se conhecerá os recursos interpostos fora do prazo.

                  Parágrafo sétimo. No julgamento do recurso, a Conselho Consultivo procederá a instrução sumária e oral sobre os fatos que resultaram na multa, ouvindo o condômino em causa, as testemunhas presentes e tomando conhecimento dos demais elementos de acusação e defesa existentes. Em seguida, será confirmada, relevada ou alterada a multa, pelo voto da maioria.

                  Parágrafo oitavo. A data de pagamento estará condicionada ao mesmo dia de vencimento da próxima taxa de condomínio, considerando-se a data de decisão final.

                  Parágrafo nono. Em qualquer Assembleia Geral, a massa condominial poderá impor multas a condôminos que por infração se tenham tornado passíveis de penalidades, realizando, se entender necessário, a instrução sumária de que trata as alíneas supra no que for aplicável.

                  Parágrafo décimo. Resta convencionado e definido que o conselho entenderá como reincidência a ocorrência da mesma infração cometida pelo condômino, independentemente do grau da infração cometida. Para efeito de reincidência, será contado o prazo dos últimos 12 (doze) meses, findo o qual, não serão computadas infrações anteriores a tal período.

                  Parágrafo décimo primeiro. O pagamento da multa não exime o infrator de sua responsabilidade civil pelos danos causados, respondendo o condômino, perante o Condomínio, pelos atos praticados por quaisquer ocupantes de sua unidade autônoma, seja a que título for.

                  DISPOSIÇÕES GERAIS E FINAIS



                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-header text-center">Digite parte do nome do condômino</div>
                <div class="card-body">
                  <div class="mt-3 text-center">
                    <label class="small mb-1 ">Veja todos os moradores da casa:</label>
                    <input class="form-control" name="buscar" id="buscar" type="text" />
                  </div>
                  <div id="resultado">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </main>
      </div>
      <!-- Footer -->
      <?php include_once("templates/footer.php");
