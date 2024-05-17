-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 17/05/2024 às 00:23
-- Versão do servidor: 5.7.23-23
-- Versão do PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `frankd21_pwranking`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos_paginas`
--

CREATE TABLE `acessos_paginas` (
  `id` int(11) NOT NULL,
  `pagina` varchar(255) NOT NULL,
  `acessos` int(11) NOT NULL,
  `ultimo_acesso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos_unicos_paginas`
--

CREATE TABLE `acessos_unicos_paginas` (
  `id` int(11) NOT NULL,
  `pagina` varchar(255) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `ultimo_acesso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Estrutura para tabela `anexosnoticias`
--

CREATE TABLE `anexosnoticias` (
  `id` int(11) NOT NULL,
  `noticiaid` int(11) NOT NULL,
  `nomeArquivo` varchar(256) NOT NULL,
  `nomeSalvo` varchar(256) NOT NULL,
  `caminho` varchar(256) NOT NULL,
  `dataCadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos_usuarios`
--

CREATE TABLE `cargos_usuarios` (
  `id` int(11) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `permissoes` text NOT NULL,
  `datacriacao` datetime NOT NULL,
  `dataupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_eventos`
--

CREATE TABLE `categoria_eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `categoria_eventos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_noticias`
--

CREATE TABLE `categoria_noticias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_tutoriais`
--

CREATE TABLE `categoria_tutoriais` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




-- --------------------------------------------------------

--
-- Estrutura para tabela `competitivo_bloqueio`
--

CREATE TABLE `competitivo_bloqueio` (
  `id` int(11) NOT NULL,
  `charid` int(11) NOT NULL,
  `databloqueio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `competitivo_guilds`
--

CREATE TABLE `competitivo_guilds` (
  `guild_id` int(11) NOT NULL,
  `guild_nome` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `master` int(11) NOT NULL,
  `announce` varchar(1000) NOT NULL,
  `sysinfo` varchar(1000) NOT NULL,
  `last_op_time` int(11) NOT NULL,
  `participantes` int(11) NOT NULL,
  `membros` varchar(10000) DEFAULT NULL,
  `dataupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `competitivo_personagens`
--

CREATE TABLE `competitivo_personagens` (
  `charid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `raca` int(11) NOT NULL,
  `classe` int(11) NOT NULL,
  `genero` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `cultivo` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `reputacao` int(11) NOT NULL,
  `dataupdate` datetime NOT NULL,
  `guild_id` int(11) DEFAULT NULL,
  `equipamentos` text NOT NULL,
  `spouse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `competitivo_pvp`
--

CREATE TABLE `competitivo_pvp` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `matou_id` int(11) NOT NULL,
  `morreu_id` int(11) NOT NULL,
  `matou_guild_id` int(11) DEFAULT NULL,
  `morreu_guild_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `competitivo_territorios`
--

CREATE TABLE `competitivo_territorios` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `owner` int(11) DEFAULT NULL,
  `occupy_time` int(11) NOT NULL,
  `challenger` int(11) DEFAULT NULL,
  `deposit` int(11) NOT NULL,
  `cutoff_time` int(11) NOT NULL,
  `battle_time` int(11) NOT NULL,
  `bonus_time` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `timeout` int(11) NOT NULL,
  `maxbonus` int(11) NOT NULL,
  `challenge_time` int(11) NOT NULL,
  `challengerdetails` varchar(1000) NOT NULL,
  `reserved1` int(11) NOT NULL,
  `reserved2` int(11) NOT NULL,
  `reserved3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `chave` varchar(255) NOT NULL,
  `valor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `chave`, `valor`) VALUES
(1, 'gerais', '{\"nomeservidor\":\"PW Frank Duque\",\"versaoservidor\":\"155\",\"linkpainel\":\"https:\\/\\/example.com\",\"vlogo\":7,\"extlogo\":\"png\",\"vfavicon\":13,\"extfavicon\":\"png\"}'),
(2, 'integracoes', '{\"usarrecaptcha\":0,\"recaptchasitekey\":\"\",\"recaptchasecretkey\":\"\",\"usardisqus\":0,\"disqusshortname\":\"\",\"usarmailchimp\":0,\"mailchimpcode\":\"                                                \",\"usaranalytics\":0,\"analyticsid\":\"\",\"usarfacebook\":0,\"linkpaginafacebook\":\"https:\\/\\/www.facebook.com\\/PWoriental\\/?view_public_for=1180395175455495\"}'),
(3, 'competitivo', '{\"usarpvp\":1,\"mostrarzeradosenegativospvp\":0,\"pontosmatarpvp\":\"4\",\"pontosmorrer\":null,\"usarpve\":1,\"usartw\":1,\"guildlisttxtultipdate\":\"2020-02-12 09:02:23\",\"guildlistpngultipdate\":\"2020-02-12 09:02:29\",\"usargvg\":1,\"mostrarzeradosenegativosgvg\":0,\"usarlistaclans\":1,\"limiterankingpvp\":\"50\",\"limiterankingpve\":\"51\",\"limiterankinggvg\":\"50\",\"usarmensagempvp\":1,\"canalmensagenspvp\":\"11\",\"usartrocaitenspvp\":1,\"comandoconsultapontos\":\"@@pontospvp\",\"comandoconsultaitens\":\"@@itenspvp\",\"comandosacaritens\":\"@@sacarpvp\"}'),
(4, 'mensageiro', '{\"usarmensageiro\":1}'),
(5, 'tw', '{\"usarupdatetw\":0}'),
(7, 'pve', '{\"usarupdatepve\":1}'),
(9, 'scriptgolds', '{\"usarscriptgolds\":0}'),
(10, 'updatepve', '{\"UltUpdatepve\":\"10-05-2024 05:01:29\",\"TempoGastopve\":\"85.7790\"}'),
(11, 'updatetw', '{\"UltUpdatetw\":\"10-05-2024 02:16:56\",\"TempoGastotw\":\"7.4322\"}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL,
  `dataupdate` datetime NOT NULL,
  `caminho_imagem` varchar(500) DEFAULT NULL,
  `tipo` enum('client','patcher') NOT NULL,
  `link` varchar(1000) NOT NULL,
  `downloads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `conteudo` longtext NOT NULL,
  `datacriacao` datetime NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `dataupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `cor` varchar(10) DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text,
  `datacriacao` datetime NOT NULL,
  `pos` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `max_count` int(11) NOT NULL,
  `data` int(11) DEFAULT NULL,
  `proctype` int(11) DEFAULT NULL,
  `expire_date` int(11) DEFAULT NULL,
  `guid1` int(11) DEFAULT NULL,
  `guid2` int(11) DEFAULT NULL,
  `mask` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pvp`
--

CREATE TABLE `itens_pvp` (
  `id` int(11) NOT NULL,
  `cor` varchar(6) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `pontossaque` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `pos` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `max_count` int(11) NOT NULL,
  `data` int(11) DEFAULT NULL,
  `proctype` int(11) DEFAULT NULL,
  `expire_date` int(11) DEFAULT NULL,
  `guid1` int(11) DEFAULT NULL,
  `guid2` int(11) DEFAULT NULL,
  `mask` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensageiro`
--

CREATE TABLE `mensageiro` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `periodicidade` varchar(100) NOT NULL,
  `canal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `mensageiro`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens_pvp`
--

CREATE TABLE `mensagens_pvp` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `mensagens_pvp`
--

INSERT INTO `mensagens_pvp` (`id`, `mensagem`) VALUES
(26, '{{nick_matou}} acabou com {{nick_morreu}} em um confronto intenso!');

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` longtext NOT NULL,
  `datacriacao` datetime NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `resumo` varchar(250) NOT NULL,
  `dataupdate` datetime NOT NULL,
  `destaque` smallint(6) NOT NULL DEFAULT '0',
  `arquivo_header` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `conteudo`, `datacriacao`, `categoria_id`, `usuario_id`, `resumo`, `dataupdate`, `destaque`, `arquivo_header`) VALUES
(25, 'Teste de Notícia', ' Teste', '2024-05-05 18:04:26', 8, 1, 'Teste', '2024-05-08 19:59:12', 0, 'https://pwranking.frankduque.com/assets/site/img/blog-img-1.jpg'),


-- --------------------------------------------------------

--
-- Estrutura para tabela `saque_itens_pvp`
--

CREATE TABLE `saque_itens_pvp` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `itemnome` varchar(255) NOT NULL,
  `pontos` int(11) NOT NULL,
  `charid` int(11) NOT NULL,
  `datasaque` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `scriptgolds`
--

CREATE TABLE `scriptgolds` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `canal` int(11) NOT NULL,
  `levelminimo` int(11) NOT NULL,
  `periodicidade` varchar(100) NOT NULL,
  `cultivominimo` int(11) NOT NULL,
  `unicoip` tinyint(4) NOT NULL,
  `estaronline` tinyint(4) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `unicoconta` tinyint(4) NOT NULL,
  `ultimaexecucao` datetime NOT NULL,
  `usarrankingpve` tinyint(4) NOT NULL DEFAULT '1',
  `entregarviaapi` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Estrutura para tabela `tutoriais`
--

CREATE TABLE `tutoriais` (
  `id` int(11) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `conteudo` longtext NOT NULL,
  `datacriacao` datetime NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Estrutura para tabela `updatepve`
--

CREATE TABLE `updatepve` (
  `id` int(11) NOT NULL,
  `periodicidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Estrutura para tabela `updatetw`
--

CREATE TABLE `updatetw` (
  `id` int(11) NOT NULL,
  `periodicidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  `permissao` enum('Admin','Equipe') NOT NULL DEFAULT 'Equipe',
  `cargo_id` int(11) DEFAULT NULL,
  `GAuthSecret` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `dataCadastro`, `permissao`, `cargo_id`, `GAuthSecret`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$QsK1JDPN82Ynl6hTfHWLvuMsxdD4V6uc7kXIWnZqT7aqxyZ7f.tKu', '2020-02-27 08:45:26', 'Admin', 0, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acessos_paginas`
--
ALTER TABLE `acessos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `acessos_unicos_paginas`
--
ALTER TABLE `acessos_unicos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `anexosnoticias`
--
ALTER TABLE `anexosnoticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anexo_noticias` (`noticiaid`);

--
-- Índices de tabela `cargos_usuarios`
--
ALTER TABLE `cargos_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria_eventos`
--
ALTER TABLE `categoria_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria_noticias`
--
ALTER TABLE `categoria_noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria_tutoriais`
--
ALTER TABLE `categoria_tutoriais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `competitivo_bloqueio`
--
ALTER TABLE `competitivo_bloqueio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charid` (`charid`);

--
-- Índices de tabela `competitivo_guilds`
--
ALTER TABLE `competitivo_guilds`
  ADD UNIQUE KEY `fid` (`guild_id`),
  ADD KEY `master` (`master`);

--
-- Índices de tabela `competitivo_personagens`
--
ALTER TABLE `competitivo_personagens`
  ADD PRIMARY KEY (`charid`),
  ADD UNIQUE KEY `charid` (`charid`),
  ADD KEY `charid_2` (`charid`),
  ADD KEY `guild_id` (`guild_id`);

--
-- Índices de tabela `competitivo_pvp`
--
ALTER TABLE `competitivo_pvp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matou_guild_id` (`matou_guild_id`),
  ADD KEY `morreu_guild_id` (`morreu_guild_id`),
  ADD KEY `matou_id` (`matou_id`),
  ADD KEY `morreu_id` (`morreu_id`);

--
-- Índices de tabela `competitivo_territorios`
--
ALTER TABLE `competitivo_territorios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `challenger` (`challenger`),
  ADD KEY `owner` (`owner`);

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `itemid` (`itemid`);

--
-- Índices de tabela `itens_pvp`
--
ALTER TABLE `itens_pvp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Índices de tabela `mensageiro`
--
ALTER TABLE `mensageiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens_pvp`
--
ALTER TABLE `mensagens_pvp`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `saque_itens_pvp`
--
ALTER TABLE `saque_itens_pvp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charid` (`charid`);

--
-- Índices de tabela `scriptgolds`
--
ALTER TABLE `scriptgolds`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tutoriais`
--
ALTER TABLE `tutoriais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `updatepve`
--
ALTER TABLE `updatepve`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `updatetw`
--
ALTER TABLE `updatetw`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos_paginas`
--
ALTER TABLE `acessos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `acessos_unicos_paginas`
--
ALTER TABLE `acessos_unicos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19831;

--
-- AUTO_INCREMENT de tabela `anexosnoticias`
--
ALTER TABLE `anexosnoticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cargos_usuarios`
--
ALTER TABLE `cargos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categoria_eventos`
--
ALTER TABLE `categoria_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `categoria_noticias`
--
ALTER TABLE `categoria_noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `categoria_tutoriais`
--
ALTER TABLE `categoria_tutoriais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `competitivo_bloqueio`
--
ALTER TABLE `competitivo_bloqueio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `competitivo_pvp`
--
ALTER TABLE `competitivo_pvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31915;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67079;

--
-- AUTO_INCREMENT de tabela `itens_pvp`
--
ALTER TABLE `itens_pvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `mensageiro`
--
ALTER TABLE `mensageiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `mensagens_pvp`
--
ALTER TABLE `mensagens_pvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `saque_itens_pvp`
--
ALTER TABLE `saque_itens_pvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `scriptgolds`
--
ALTER TABLE `scriptgolds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tutoriais`
--
ALTER TABLE `tutoriais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `updatepve`
--
ALTER TABLE `updatepve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `updatetw`
--
ALTER TABLE `updatetw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anexosnoticias`
--
ALTER TABLE `anexosnoticias`
  ADD CONSTRAINT `fk_anexo_noticias` FOREIGN KEY (`noticiaid`) REFERENCES `noticias` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `competitivo_bloqueio`
--
ALTER TABLE `competitivo_bloqueio`
  ADD CONSTRAINT `competitivo_bloqueio_ibfk_1` FOREIGN KEY (`charid`) REFERENCES `competitivo_personagens` (`charid`);

--
-- Restrições para tabelas `competitivo_guilds`
--
ALTER TABLE `competitivo_guilds`
  ADD CONSTRAINT `competitivo_guilds_ibfk_1` FOREIGN KEY (`master`) REFERENCES `competitivo_personagens` (`charid`);

--
-- Restrições para tabelas `competitivo_personagens`
--
ALTER TABLE `competitivo_personagens`
  ADD CONSTRAINT `competitivo_personagens_ibfk_1` FOREIGN KEY (`guild_id`) REFERENCES `competitivo_guilds` (`guild_id`);

--
-- Restrições para tabelas `competitivo_pvp`
--
ALTER TABLE `competitivo_pvp`
  ADD CONSTRAINT `competitivo_pvp_ibfk_1` FOREIGN KEY (`matou_guild_id`) REFERENCES `competitivo_guilds` (`guild_id`),
  ADD CONSTRAINT `competitivo_pvp_ibfk_2` FOREIGN KEY (`morreu_guild_id`) REFERENCES `competitivo_guilds` (`guild_id`),
  ADD CONSTRAINT `competitivo_pvp_ibfk_3` FOREIGN KEY (`matou_id`) REFERENCES `competitivo_personagens` (`charid`),
  ADD CONSTRAINT `competitivo_pvp_ibfk_4` FOREIGN KEY (`morreu_id`) REFERENCES `competitivo_personagens` (`charid`);

--
-- Restrições para tabelas `competitivo_territorios`
--
ALTER TABLE `competitivo_territorios`
  ADD CONSTRAINT `competitivo_territorios_ibfk_1` FOREIGN KEY (`challenger`) REFERENCES `competitivo_guilds` (`guild_id`),
  ADD CONSTRAINT `competitivo_territorios_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `competitivo_guilds` (`guild_id`);

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_eventos` (`id`),
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `itens_pvp`
--
ALTER TABLE `itens_pvp`
  ADD CONSTRAINT `itens_pvp_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `itens` (`itemid`);

--
-- Restrições para tabelas `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_noticias` (`id`),
  ADD CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `saque_itens_pvp`
--
ALTER TABLE `saque_itens_pvp`
  ADD CONSTRAINT `saque_itens_pvp_ibfk_1` FOREIGN KEY (`charid`) REFERENCES `competitivo_personagens` (`charid`);

--
-- Restrições para tabelas `tutoriais`
--
ALTER TABLE `tutoriais`
  ADD CONSTRAINT `tutoriais_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_tutoriais` (`id`),
  ADD CONSTRAINT `tutoriais_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargos_usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
