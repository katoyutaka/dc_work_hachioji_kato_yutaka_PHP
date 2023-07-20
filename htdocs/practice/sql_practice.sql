
--
-- テーブルの構造 `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, '野菜'),
(2, '果物'),
(3, '肉'),
(4, '魚'),
(5, '調味料');

-- --------------------------------------------------------

--
-- テーブルの構造 `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_code` int(11) DEFAULT NULL,
  `product_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `product`
--

INSERT INTO `product` (`product_id`, `product_code`, `product_name`, `price`, `category_id`) VALUES
(1, 1001, 'キャベツ', '130', 1),
(2, 1002, 'レタス', '150', 1),
(3, 1003, 'トマト', '100', 1),
(4, 1004, 'きゅうり', '50', 1),
(5, 1005, 'りんご', '170', 2),
(6, 1006, '桃', '250', 2),
(7, 1007, '梨', '300', 2),
(8, 1008, 'バナナ', '120', 2),
(9, 1009, '牛肉', '500', 3),
(10, 1010, '豚肉', '400', 3),
(11, 1011, '鶏肉', '300', 3),
(12, 1012, 'さんま', '200', 4),
(13, 1013, 'アジ', '120', 4),
(14, 1014, 'サバ', '150', 4),
(15, 1015, '塩', '100', 5),
(16, 1016, '胡椒', '500', 5),
(17, 1017, '砂糖', '100', 5),
(18, 1018, '醤油', '150', 5),
(19, 1019, 'コロッケ', '100', 6);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);