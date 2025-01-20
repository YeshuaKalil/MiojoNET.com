-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/01/2025 às 03:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mvc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `IdUsuario` int(11) NOT NULL,
  `IdRecord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curtidas`
--

INSERT INTO `curtidas` (`IdUsuario`, `IdRecord`) VALUES
(27, 40),

-- --------------------------------------------------------

--
-- Estrutura para tabela `records`
--

CREATE TABLE `records` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(40) NOT NULL,
  `Content` varchar(4000) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `Curtidas` int(11) NOT NULL,
  `Compartilhar` int(1) NOT NULL,
  `Idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `records`
--

INSERT INTO `records` (`Id`, `Nome`, `Content`, `Img`, `Curtidas`, `Compartilhar`, `Idusuario`) VALUES
(39, 'O Caldo da Escolha', 'Era uma noite comum, ou pelo menos parecia ser. Sob o brilho pálido da lua que atravessava a janela da cozinha, um homem solitário enfrentava um dilema incomum: escolher entre um pacote de miojo e um cup noodles.\r\n\r\nO miojo, embalado com simplicidade, oferecia possibilidades infinitas. Com um pouco de criatividade, poderia se transformar em algo além do trivial. Já o cup noodles, compacto e direto, era eficiência pura – perfeito para quem não queria perder tempo.\r\n\r\nEle colocou a chaleira no fogo, o som da água começando a ferver ecoando pela cozinha silenciosa. Mas algo estava estranho. A luz acima piscou, lançando sombras que pareciam dançar pelas paredes. Um vento gelado soprou pela fresta da porta, e então ele ouviu: um leve farfalhar vindo do pacote de miojo.\r\n\r\nCurioso, abriu o pacote com cuidado. Entre os blocos secos de macarrão, havia algo inesperado: um pequeno pedaço de papel dobrado. Ele desdobrou o bilhete, que carregava uma mensagem escrita à mão:\r\n\r\n“Escolha sabiamente, ou pagará o preço.”\r\n\r\nEle franziu o cenho, sentindo a adrenalina subir. Olhou para o cup noodles ao lado. Sua embalagem brilhava de forma estranha, quase como se o estivesse desafiando. Aquela simples refeição rápida se transformara num enigma sinistro.\r\n\r\nCom um sorriso irônico – um reflexo de sua natureza calma diante do perigo – ele tomou uma decisão ousada. Misturaria os dois. Despejou o tempero do miojo dentro do cup noodles, criando uma fusão improvável. Quando levou a primeira colherada à boca, o mundo ao seu redor pareceu congelar.\r\n\r\nDe repente, ele não estava mais na cozinha. Em vez disso, encontrava-se num campo infinito de macarrão, onde criaturas grotescas feitas de caldo e noodles rastejavam pelo chão. Vozes sibilavam em sua mente:\r\n\r\n“Você não respeitou as regras. Agora, pertence a nós.”\r\n\r\nSem hesitar, ele agarrou uma colher que inexplicavelmente estava em seu bolso e começou a lutar contra as criaturas. Cada golpe fazia o caldo espirrar como chuva ácida, mas ele não se intimidava. Este não era seu primeiro confronto com o inexplicável.\r\n\r\nQuando finalmente voltou à cozinha, o prato estava vazio, e o bilhete havia desaparecido. O silêncio parecia mais pesado, quase reverente. Ele olhou pela janela para a lua e soltou uma risada baixa.\r\n\r\nAfinal, escolhas sempre têm consequências – e ele sabia que, de algum jeito, essa não seria a última vez que enfrentaria o desconhecido.', '', 1, 1, 25),
(40, 'coxinhaoleosa', 'Eu gosto de coxinhas.', '', 1, 1, 26),
(41, 'miojo e cup noodles', 'Eu odeio miojo e cupnoodles. O criador também não gosta! Por que ele colocou essas comidas? Seria muito melhor se colocasse ketchup e mostarda.', '', 0, 1, 26),
(42, 'Avaliação de um mestre de jogos (MvC)', 'Odiei me fez sentir de uma forma que eu nunca achei que fosse me sentir. Fui chamado de burro de mil formas diferentes. 😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭😭.\r\nTirando isso, a gameplay parece interessante, refinada, porém ainda não entrou no meu sistema as informações necessárias para jogar esse jogo.\r\nNão foi possível ter um maior aprofundamento na história, pois infelizmente não consegui passar da terceira fase do jogo (não que eu estivesse no modo normal sabe).\r\nÉ um jogo preconceituoso com as pessoas que nunca jogaram um jogo antes, já que o criador não dispôs um tempo necessário dá sua vida para auxiliar novos jogadores, como por exemplo os botões necessários para essa atividade.\r\nPorém, a premissa do jogo é inovadora e intrigante, com gráficos (visual) promissores.', '', 0, 1, 27),

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Img` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nome`, `Senha`, `Email`, `Img`) VALUES
(23, 'Admin', '$2y$12$CyJb6rsoOrZjbDO0MnfXFuJexjsh5ZPg.VGD.OnjOYutYCUdLtvOS', 'Admin@gmail.com', 'low-profile.png'),
(25, 'shadowhawk', '$2y$12$StPu3fPZQiZtB0DCB.Xg7O34YMjaiNVOU99vnnWQzawknErEHhA8u', 'shadowhawk27@gmail.com', 'shadowhawk.png'),
(26, 'coxinhaoleosa', '$2y$12$HIvqwiaIpe1LRggIX5RINerQgI4.sy6QKbvk8aLM2Lr8cXn8byJjO', 'coxinhacomcatupiry@gmail.com', 'quetchup.jpeg'),
(27, 'sir abacatão', '$2y$12$bho0O06Z/YwDMs24zIJkEOz.lXlMH7md71fB4Ng/pJVr2ExpRCCEO', 'hatejayceforever@gmail.com', '88888.jpeg'),

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`IdUsuario`,`IdRecord`),
  ADD KEY `IdRecord` (`IdRecord`);

--
-- Índices de tabela `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Idusuario` (`Idusuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `records`
--
ALTER TABLE `records`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`Id`),
  ADD CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`IdRecord`) REFERENCES `records` (`Id`);

--
-- Restrições para tabelas `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`Idusuario`) REFERENCES `usuarios` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
