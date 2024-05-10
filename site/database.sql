-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 11-Ago-2020 às 20:25
-- Versão do servidor: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos_paginas`
--

CREATE TABLE IF NOT EXISTS `acessos_paginas` (
  `id` int(11) NOT NULL,
  `pagina` varchar(255) NOT NULL,
  `acessos` int(11) NOT NULL,
  `ultimo_acesso` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;



--
-- Estrutura da tabela `acessos_unicos_paginas`
--

CREATE TABLE IF NOT EXISTS `acessos_unicos_paginas` (
  `id` int(11) NOT NULL,
  `pagina` varchar(255) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `ultimo_acesso` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19497 DEFAULT CHARSET=latin1;


--
-- Estrutura da tabela `anexosnoticias`
--

CREATE TABLE IF NOT EXISTS `anexosnoticias` (
  `id` int(11) NOT NULL,
  `noticiaid` int(11) NOT NULL,
  `nomeArquivo` varchar(256) NOT NULL,
  `nomeSalvo` varchar(256) NOT NULL,
  `caminho` varchar(256) NOT NULL,
  `dataCadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos_usuarios`
--

CREATE TABLE IF NOT EXISTS `cargos_usuarios` (
  `id` int(11) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `permissoes` text NOT NULL,
  `datacriacao` datetime NOT NULL,
  `dataupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_eventos`
--

CREATE TABLE IF NOT EXISTS `categoria_eventos` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


--
-- Estrutura da tabela `categoria_noticias`
--

CREATE TABLE IF NOT EXISTS `categoria_noticias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


--
-- Estrutura da tabela `categoria_tutoriais`
--

CREATE TABLE IF NOT EXISTS `categoria_tutoriais` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


--
-- Estrutura da tabela `competitivo_bloqueio`
--

CREATE TABLE IF NOT EXISTS `competitivo_bloqueio` (
  `id` int(11) NOT NULL,
  `charid` int(11) NOT NULL,
  `databloqueio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `competitivo_guilds`
--

CREATE TABLE IF NOT EXISTS `competitivo_guilds` (
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

--
-- Estrutura da tabela `competitivo_mensagens`
--

CREATE TABLE IF NOT EXISTS `competitivo_mensagens` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
--
-- Estrutura da tabela `competitivo_personagens`
--

CREATE TABLE IF NOT EXISTS `competitivo_personagens` (
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
  `guild_id` int(11) NOT NULL,
  `equipamentos` text NOT NULL,
  `spouse` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `competitivo_pvp`
--

CREATE TABLE IF NOT EXISTS `competitivo_pvp` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `matou_id` int(11) NOT NULL,
  `morreu_id` int(11) NOT NULL,
  `matou_guild_id` int(11) NOT NULL,
  `morreu_guild_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31893 DEFAULT CHARSET=latin1;


--
-- Estrutura da tabela `competitivo_territorios`
--

CREATE TABLE IF NOT EXISTS `competitivo_territorios` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `occupy_time` int(11) NOT NULL,
  `challenger` int(11) NOT NULL,
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

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE IF NOT EXISTS `configuracoes` (
  `id` int(11) NOT NULL,
  `chave` varchar(255) NOT NULL,
  `valor` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `chave`, `valor`) VALUES
(1, 'gerais', '{"nomeservidor":"Perfect World Duque","versaoservidor":"155","linkpainel":"https:\\/\\/painel.oriental-games.com\\/login","vlogo":1,"extlogo":"png","vfavicon":11,"extfavicon":"jpg"}'),
(2, 'integracoes', '{"usarrecaptcha":0,"recaptchasitekey":"","recaptchasecretkey":"","usardisqus":0,"disqusshortname":"","usarmailchimp":0,"mailchimpcode":"","usaranalytics":0,"analyticsid":"","usarfacebook":1,"linkpaginafacebook":"https:\\/\\/www.facebook.com\\/PWoriental\\/?view_public_for=1180395175455495"}'),
(3, 'competitivo', '{"usarpvp":1,"mostrarzeradosenegativospvp":0,"pontosmatarpvp":"3","pontosmorrer":null,"usarpve":1,"usartw":1,"guildlisttxtultipdate":"2020-02-12 09:02:23","guildlistpngultipdate":"2020-02-12 09:02:29","usargvg":1,"mostrarzeradosenegativosgvg":0,"usarlistaclans":1,"limiterankingpvp":"50","limiterankingpve":"50","limiterankinggvg":"50","usarmensagempvp":1,"canalmensagenspvp":"11","usartrocaitenspvp":1,"comandoconsultapontos":"@@pontospvp","comandoconsultaitens":"@@itenspvp","comandosacaritens":"@@sacarpvp"}'),
(4, 'mensageiro', '{"usarmensageiro":1}'),
(5, 'tw', '{"usarupdatetw":1}'),
(7, 'pve', '{"usarupdatepve":1}'),
(9, 'scriptgolds', '{"usarscriptgolds":0}'),
(10, 'updatepve', '{"UltUpdatepve":"11-08-2020 17:24:33","TempoGastopve":"271.2295"}'),
(11, 'updatetw', '{"UltUpdatetw":"09-08-2020 00:00:08","TempoGastotw":"6.2162"}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `datacriacao` datetime NOT NULL,
  `dataupdate` datetime NOT NULL,
  `caminho_imagem` varchar(500) DEFAULT NULL,
  `tipo` enum('client','patcher') NOT NULL,
  `link` varchar(1000) NOT NULL,
  `downloads` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `conteudo` longtext NOT NULL,
  `datacriacao` datetime NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `dataupdate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `itens`
--

CREATE TABLE IF NOT EXISTS `itens` (
  `id` int(11) DEFAULT NULL,
  `cor` varchar(10) DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Estrutura da tabela `itenspvp`
--

CREATE TABLE IF NOT EXISTS `itenspvp` (
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `mensageiro`
--

CREATE TABLE IF NOT EXISTS `mensageiro` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `periodicidade` varchar(100) NOT NULL,
  `canal` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `saque_itens_pvp`
--

CREATE TABLE IF NOT EXISTS `saque_itens_pvp` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `itemnome` varchar(255) NOT NULL,
  `pontos` int(11) NOT NULL,
  `charid` int(11) NOT NULL,
  `datasaque` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `scriptgolds`
--

CREATE TABLE IF NOT EXISTS `scriptgolds` (
  `id` int(11) NOT NULL,
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
-- Estrutura da tabela `tutoriais`
--

CREATE TABLE IF NOT EXISTS `tutoriais` (
  `id` int(11) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `conteudo` longtext NOT NULL,
  `datacriacao` datetime NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `updatepve`
--

CREATE TABLE IF NOT EXISTS `updatepve` (
  `id` int(11) NOT NULL,
  `periodicidade` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `updatepve`
--

INSERT INTO `updatepve` (`id`, `periodicidade`) VALUES
(1, '*/5 * * * *');

-- --------------------------------------------------------

--
-- Estrutura da tabela `updatetw`
--

CREATE TABLE IF NOT EXISTS `updatetw` (
  `id` int(11) NOT NULL,
  `periodicidade` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `updatetw`
--

INSERT INTO `updatetw` (`id`, `periodicidade`) VALUES
(1, '0 0 * * 0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  `permissao` enum('Admin','Equipe') NOT NULL DEFAULT 'Equipe',
  `cargo_id` int(11) NOT NULL,
  `GAuthSecret` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `dataCadastro`, `permissao`, `cargo_id`, `GAuthSecret`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$QsK1JDPN82Ynl6hTfHWLvuMsxdD4V6uc7kXIWnZqT7aqxyZ7f.tKu', '2020-02-27 08:45:26', 'Admin', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acessos_paginas`
--
ALTER TABLE `acessos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acessos_unicos_paginas`
--
ALTER TABLE `acessos_unicos_paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anexosnoticias`
--
ALTER TABLE `anexosnoticias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cargos_usuarios`
--
ALTER TABLE `cargos_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria_eventos`
--
ALTER TABLE `categoria_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria_noticias`
--
ALTER TABLE `categoria_noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria_tutoriais`
--
ALTER TABLE `categoria_tutoriais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitivo_bloqueio`
--
ALTER TABLE `competitivo_bloqueio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitivo_guilds`
--
ALTER TABLE `competitivo_guilds`
  ADD UNIQUE KEY `fid` (`guild_id`);

--
-- Indexes for table `competitivo_mensagens`
--
ALTER TABLE `competitivo_mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitivo_personagens`
--
ALTER TABLE `competitivo_personagens`
  ADD PRIMARY KEY (`charid`),
  ADD UNIQUE KEY `charid` (`charid`);

--
-- Indexes for table `competitivo_pvp`
--
ALTER TABLE `competitivo_pvp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitivo_territorios`
--
ALTER TABLE `competitivo_territorios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `itenspvp`
--
ALTER TABLE `itenspvp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensageiro`
--
ALTER TABLE `mensageiro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saque_itens_pvp`
--
ALTER TABLE `saque_itens_pvp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scriptgolds`
--
ALTER TABLE `scriptgolds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutoriais`
--
ALTER TABLE `tutoriais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updatepve`
--
ALTER TABLE `updatepve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updatetw`
--
ALTER TABLE `updatetw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acessos_paginas`
--
ALTER TABLE `acessos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `acessos_unicos_paginas`
--
ALTER TABLE `acessos_unicos_paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19497;
--
-- AUTO_INCREMENT for table `anexosnoticias`
--
ALTER TABLE `anexosnoticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cargos_usuarios`
--
ALTER TABLE `cargos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categoria_eventos`
--
ALTER TABLE `categoria_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categoria_noticias`
--
ALTER TABLE `categoria_noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categoria_tutoriais`
--
ALTER TABLE `categoria_tutoriais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `competitivo_bloqueio`
--
ALTER TABLE `competitivo_bloqueio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `competitivo_mensagens`
--
ALTER TABLE `competitivo_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `competitivo_pvp`
--
ALTER TABLE `competitivo_pvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31893;
--
-- AUTO_INCREMENT for table `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `itenspvp`
--
ALTER TABLE `itenspvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mensageiro`
--
ALTER TABLE `mensageiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `saque_itens_pvp`
--
ALTER TABLE `saque_itens_pvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `scriptgolds`
--
ALTER TABLE `scriptgolds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tutoriais`
--
ALTER TABLE `tutoriais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `updatepve`
--
ALTER TABLE `updatepve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `updatetw`
--
ALTER TABLE `updatetw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
