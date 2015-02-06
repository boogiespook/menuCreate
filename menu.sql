DROP TABLE IF EXISTS `meals`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `meals` (
  `id` int(5) NOT NULL auto_increment,
  `description` varchar(100) NOT NULL,
  `day` int(1) default '0',
  `recipeBook` varchar(50) default NULL,
  `page` int(4) default NULL,
  `notes` varchar(100) default NULL,
  `mainComponent` varchar(50) default NULL,
  `image` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `meals`
--

LOCK TABLES `meals` WRITE;
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
INSERT INTO `meals` VALUES (1,'Pork Loin in Cider',0,'',NULL,'','Pork',NULL),(2,'Lamb Curry',0,NULL,NULL,NULL,'Lamb',NULL),(3,'Fish, Mash & Beans',0,NULL,NULL,NULL,'Fish',NULL),(4,'Mushroom Risotto',0,'Ainsley Meals in Minutes',49,NULL,'Vegetables',NULL),(5,'Bangers & Mash',0,NULL,NULL,NULL,'Pork',NULL),(6,'Prawns & Splonka',6,NULL,NULL,NULL,'Pork',NULL),(7,'Chilli & Rice',7,NULL,NULL,NULL,'Minced Beef',NULL),(8,'Chicken Casserole',0,NULL,NULL,NULL,'Chicken',NULL),(9,'Chicken Kiev & Mash',0,NULL,NULL,NULL,'Chicken',NULL),(10,'Spaghetti Bolognese',0,NULL,NULL,NULL,'Minced Beef',NULL),(11,'Chicken Goujons, Salad & Wedges',0,NULL,NULL,NULL,'Chicken',NULL),(12,'Cottage Pie',0,NULL,NULL,NULL,'Minced Beef',NULL),(13,'Fish & Chips',6,NULL,NULL,NULL,'Fish',NULL),(14,'Green Thai Chicken Curry',0,NULL,NULL,NULL,'Chicken',NULL),(15,'Pork Roast with Orange',1,NULL,NULL,NULL,'Pork',NULL),(16,'Beans & Cheese on Toast',0,NULL,NULL,NULL,'Vegetables',NULL),(17,'Pork Stir Fry',0,NULL,NULL,NULL,'Pork',NULL),(18,'Splonka & Halloumi',0,NULL,NULL,NULL,'Pork',NULL),(19,'Prawn Risotto',0,NULL,NULL,NULL,'Prawn',NULL),(20,'Meatballs & Pasta',0,NULL,NULL,NULL,'Minced Beef',NULL),(21,'Sunday Pub Roast',1,NULL,NULL,NULL,'Naughty','images/smile.jpg'),(22,'Lamb Pittas, Salad & Wedges',0,NULL,NULL,NULL,'Lamb',NULL),(23,'Tarragon Chicken',0,NULL,NULL,NULL,'Chicken',NULL),(24,'Tortillas with Pepper & Onions',0,NULL,NULL,NULL,'Minced Beef',NULL),(25,'Beef Tacos',0,NULL,NULL,NULL,'Minced Beef',NULL),(26,'Chicken Curry',0,NULL,NULL,NULL,'Chicken',NULL),(27,'Pasta with Cream, Chicken & Mushrooms',0,NULL,NULL,NULL,'',NULL),(28,'Chicken Risotto',0,NULL,NULL,NULL,'Chicken',NULL),(29,'Sausage, Egg & Chips',0,NULL,NULL,NULL,'Pork',NULL),(30,'Ham, Egg & Chips',0,NULL,NULL,NULL,'Pork',NULL),(31,'Fish & Salad',0,NULL,NULL,NULL,'Fish',NULL),(32,'Chinese Take-away',6,NULL,NULL,NULL,'Naughty','images/smile.jpg'),(33,'Pub Lunch',7,NULL,NULL,NULL,'Naughty','images/smile.jpg'),(34,'Gammon, Pinapple & Wedges',0,NULL,NULL,NULL,'Pork',NULL),(35,'Chicken & Bacon Salad',0,NULL,NULL,NULL,'Pork',NULL),(36,'Gammon & Cauliflower Cheese',0,'Chicken Stir Fry',NULL,NULL,'Pork',NULL),(37,'Homemade Burgers',0,NULL,NULL,'','Minced Beef',NULL),(38,'Garlic Chicken',7,NULL,NULL,NULL,'Chicken',NULL),(39,'Omlettes',0,NULL,NULL,NULL,'Eggs',NULL),(40,'Beef Casserole',0,NULL,NULL,NULL,'Beef',NULL),(41,'Chicken Paillard',0,NULL,NULL,NULL,'Chicken',NULL),(42,'Linguine Carbonara',0,NULL,NULL,NULL,'Chicken',NULL),(43,'Chicken Arrabiatta',0,NULL,NULL,NULL,'Chicken',NULL),(44,'Beef Patties',0,NULL,NULL,NULL,'Minced Beef',NULL),(45,'Stuffed Peppers',7,NULL,NULL,NULL,'Vegetables',NULL),(46,'Roast Chicken',1,NULL,NULL,NULL,'Chicken',NULL),(47,'Roast Beef',1,NULL,NULL,NULL,'Beef',NULL),(48,'Roast Lamb',1,NULL,NULL,NULL,'Lamb',NULL),(49,'Pizza',6,NULL,NULL,NULL,'Naughty','images/smile.jpg'),(50,'Spicy Sausages & Wedges',0,'Ainsley Meals in Minutes',155,NULL,'Pork',NULL),(51,'Chicken Satay',0,'Ainsley Gourmet Meals ',11,NULL,'Chicken',NULL),(52,'Hot Crispy Chicken Sandwich',0,'Ainsley Gourmet Meals ',11,NULL,'Chicken',NULL),(53,'Prawn & Chilli Ginger Cake',6,'Ainsley Gourmet Meals ',35,NULL,'Prawn',NULL),(54,'Baked Penne & Chorizo',0,'Ainsley Gourmet Meals ',98,NULL,'Pork',NULL),(55,'Butternet Squash Risotto',0,NULL,NULL,NULL,'Vegetables',NULL),(56,'Beouf Bourguinonne',0,'AWT 100 Recipes',22,NULL,'Beef',NULL),(57,'Hot Chilli Chicken Fajitas',0,'AWT 100 Recipes',76,NULL,'Chicken',NULL),(58,'Sirloin Steak & Sarah Spuds',0,NULL,NULL,NULL,'Beef',NULL),(59,'Camenbert Chicken & Cranberry',7,'Chicken Cookbook',66,NULL,'Chicken',NULL);
/*!40000 ALTER TABLE `meals` ENABLE KEYS */;
UNLOCK TABLES;

