Order management application:

--
-- Base de données :  `orders_management`
--

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderDate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `orderDate`) VALUES
(6, 2, '2018-02-09 10:29:10'),
(7, 1, '2018-02-28 10:52:01'),
(8, 3, '2018-03-01 12:43:25'),
(9, 2, '2018-03-01 08:55:24'),
(10, 1, '2018-03-02 12:42:17'),
(11, 1, '2018-03-02 12:42:49'),
(12, 2, '2018-03-02 12:58:59'),
(13, 1, '2018-03-02 01:00:13');

-- --------------------------------------------------------

--
-- Structure de la table `order_detail`
--

CREATE TABLE `order_detail` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `order_detail`
--

INSERT INTO `order_detail` (`orderId`, `productId`, `quantity`, `price`, `discount`) VALUES
(6, 1, 3, 5.4, 0),
(7, 1, 3, 5.4, 0),
(8, 3, 3, 3.84, 0.8),
(9, 3, 3, 3.84, 0.8),
(10, 1, 3, 5.4, 0),
(11, 1, 3, 5.4, 0),
(12, 3, 3, 3.84, 0.8),
(13, 1, 9, 16.2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`productId`, `productName`, `productPrice`) VALUES
(1, 'Coca Cola', 1.8),
(2, 'Fanta', 1.5),
(3, 'Pepsi Cola', 1.6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`userId`, `userName`) VALUES
(1, 'John Smith'),
(3, 'Jon Olson'),
(2, 'Laura Stone');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `productName` (`productName`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;