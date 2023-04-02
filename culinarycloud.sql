-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2023 at 12:17 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_93648137`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE IF NOT EXISTS `admininfo` (
  `Username` varchar(90) CHARACTER SET utf8mb4 NOT NULL,
  `Password` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `Refnum` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`Username`, `Password`, `Refnum`) VALUES
('Mrunal', '$2y$10$.bJx.ZeLb59qEJP9yp4aieZUBu60gDpCt4QOwn4bMZfeSluZFkBOS', 12345678),
('KyraJB', '$2y$10$hDrq9ZHS9essufpDL/NjYe5NgSFjA0ueGoEWZX0ZFClC/n2yF.zAy', 93648137);

-- --------------------------------------------------------

--
-- Table structure for table `bloginfo`
--

CREATE TABLE IF NOT EXISTS `bloginfo` (
  `BlogName` varchar(90) CHARACTER SET utf8mb4 NOT NULL,
  `BID` int(11) NOT NULL,
  `BlogCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(2000) CHARACTER SET utf8mb4 NOT NULL,
  `Continent` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `CityandCountry` varchar(60) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cc1` tinyint(4) NOT NULL DEFAULT '0',
  `cc2` tinyint(4) NOT NULL DEFAULT '0',
  `cc3` tinyint(4) NOT NULL DEFAULT '0',
  `cc4` tinyint(4) NOT NULL DEFAULT '0',
  `cc5` tinyint(4) NOT NULL DEFAULT '0',
  `cc6` tinyint(4) NOT NULL DEFAULT '0',
  `Username` varchar(90) CHARACTER SET utf8mb4 NOT NULL,
  `Thumbnail` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bloginfo`
--

INSERT INTO `bloginfo` (`BlogName`, `BID`, `BlogCreated`, `Description`, `Continent`, `CityandCountry`, `cc1`, `cc2`, `cc3`, `cc4`, `cc5`, `cc6`, `Username`, `Thumbnail`) VALUES
('The Sugar Shack', 1, '2023-03-25 22:37:09', 'Welcome to The Sugar Shack, the ultimate destination for anyone with a sweet tooth! Here, we share delicious and easy-to-follow recipes for all your favorite sugary treats, from classic chocolate chip cookies to extravagant layer cakes. Join us on a journey through the world of confections, and indulge in the most mouthwatering desserts you&#039;ve ever tasted!', 'North America', 'Kelowna, Canada', 1, 0, 0, 0, 0, 0, 'KyraJB', 'images/641f77953b8a2.sugar.png'),
('Food Daredevil', 2, '2023-03-26 04:26:37', 'Welcome to Food Daredevil, the ultimate destination for food lovers and thrill-seekers! Join me on my culinary adventures as I take on the most outrageous food challenges and push my taste buds to the limit. From giant burgers to spicy wings to bizarre culinary creations, I fearlessly try it all and report back with humor, honesty, and a healthy dose of sarcasm. Whether you&#039;re a foodie looking for a good laugh or a fellow daredevil looking for inspiration, this is the blog for you. Let&#039;s eat!', 'Europe', '', 0, 1, 0, 0, 0, 0, 'Mrunal', 'images/641fc97d292a6.food-daredevil.png'),
('Dining Destinations', 3, '2023-03-26 04:29:18', 'Welcome to Dining Destinations, where we take you on a journey to explore the world&#039;s best culinary experiences. From the busy streets of Tokyo to the tranquil vineyards of Tuscany, we travel the globe to discover hidden gems and popular hotspots that are worth a visit. Our team of food critics and writers provide honest, unbiased reviews and recommendations, giving you an inside look at the food, atmosphere, and service of each restaurant we visit. Join us as we explore new cultures, cuisines, and flavors, and uncover the best dining destinations around the world.', 'Europe', '', 0, 0, 0, 1, 1, 0, 'Mrunal', 'images/641fca1e3b0b4.dining-destinations.png'),
('Vegan Foodie Friends', 4, '2023-03-26 04:54:43', 'Welcome to Vegan Foodie Friends, where we celebrate the joy of plant-based eating with food challenges and collaborations. Our mission is to explore the delicious world of vegan cuisine and share our experiences with you. From hearty comfort food to creative gourmet dishes, we&#039;re always on the lookout for new and exciting flavors to try. But we don&#039;t just eat - we also collaborate with other bloggers and chefs to share their unique perspectives and recipes. Join our community of vegan foodie friends and discover the endless possibilities of plant-based eating!', 'North America', '', 0, 1, 0, 0, 0, 1, 'TestUser', 'images/641fd013a56d8.vegan-foodie-friends.png'),
('Recipe Revolt', 5, '2023-03-26 04:57:28', 'Welcome to Recipe Revolt, where we take on food challenges and share our favorite recipes with you. Our team of culinary enthusiasts are always looking for new and exciting food challenges to take on, whether it&#039;s a spicy noodle challenge or a massive burger challenge. We document our experiences and share tips and tricks on how to tackle these challenges. But we don&#039;t just stop there - we also share our favorite recipes that we&#039;ve perfected in our own kitchens. From appetizers to desserts, we&#039;ve got you covered. Join us in the Recipe Rumble and discover the thrill of culinary conquests!', 'North America', '', 1, 1, 0, 0, 0, 0, 'TestUser', 'images/641fd0b8abcfb.recipe-revolt.jpg'),
('Food for All', 6, '2023-03-26 05:11:07', 'Welcome to Food for All, where we believe that everyone deserves access to delicious, healthy food. Our mission is to collaborate with our local community and food banks to provide nutritious meals for those in need. Through our blog, we share recipes, tips, and tricks for cooking on a budget and reducing food waste. We also feature stories of individuals and organizations making a difference in the fight against hunger. Join us in our journey towards a world where no one goes hungry, and everyone has access to good food. Together, we can create a community where food is for all.', 'South America', '', 0, 0, 0, 0, 0, 1, 'FoodForAll', 'images/641fd3eb66d14.food-for-all.jpg'),
('Northern Nibbles', 7, '2023-03-26 05:17:46', 'Welcome to Northern Nibbles, where we share the best of Canadian cuisine. Our blog is dedicated to bringing you authentic Canadian recipes, from classic dishes like poutine and maple-glazed salmon, to modern twists on traditional favorites. We believe that food is an essential part of Canadian culture, and we are passionate about sharing it with the world. Our recipes are made with fresh, locally-sourced ingredients, and we love to showcase the diverse flavors and culinary traditions of our country. Whether you&#039;re a seasoned home cook or just getting started, our blog has something for everyone. Join us on a culinary journey across Canada with Northern Nibbles.', 'North America', 'Vancouver, Canada', 1, 0, 0, 0, 0, 0, 'Bojangles', 'images/641fd57a17964.northern-nibbles.png'),
('Simple Eats', 8, '2023-03-26 05:35:51', 'Welcome to Simple Eats, where we believe that cooking delicious meals should be easy and accessible to everyone. Our blog is dedicated to sharing simple, easy-to-follow recipes that are perfect for beginners. We know that starting out in the kitchen can be intimidating, so we&#039;re here to help yo build your confidence and master the basics. From quick weeknight dinners to weekend brunches, we&#039;ve got you covered with recipes that are both delicious and stress-free. Our focus is on using fresh, whole ingredients that are easy to find and affordable. Join us on a journey towards effortless cooking and simple eats that the whole family will love.', 'Asia', '', 1, 0, 0, 0, 0, 0, 'TestUser2', 'images/641fd9b6f2bc5.simple-eats.png'),
('The Hungry Traveler', 9, '2023-03-26 05:40:34', 'Welcome to The Hungry Traveler, where we believe that food is the best way to explore the world. Our blog is dedicated to sharing our adventures in culinary exploration, as we travel the globe in search of delicious and authentic dishes. From street food in Southeast Asia to haute cuisine in Europe, we&#039;re always on the lookout for the next great culinary discovery. But we&#039;re not just about the food – we&#039;re passionate about the stories and people behind the dishes. We love to connect with locals, chefs, and food enthusiasts to learn about the history and culture of each destination. Join us on a journey towards flavor-filled travels, as we satisfy our wanderlust and our appetites, one bite at a time.', 'North America', '', 0, 0, 0, 0, 1, 0, 'KyraJB', 'images/641fdad2504f0.the-hungry-traveler.png'),
('The Chef&#039;s Table', 10, '2023-03-26 05:43:14', 'Welcome to The Chef&#039;s Table, a blog dedicated to the art and science of cuisine. Our blog is inspired by the tradition of the chef&#039;s table – a place where culinary masters gather to craft and enjoy their creations. Through our blog, we aim to share that same level of culinary excellence with our readers, bringing you inside the world of our kitchen and beyond. From farm to table, we share our passion for fresh, seasonal ingredients and innovative cooking techniques. Our chefs will share their tips and tricks, while our sommeliers and mixologists will guide you through the world of wine and spirits. But we&#039;re not just about the food and drink – we&#039;re dedicated to creating a complete dining experience. Join us at The Chef&#039;s Table as we explore the world of gastronomy and savor the finer things in life.', 'Asia', '', 0, 0, 1, 0, 0, 0, 'TestUser2', 'images/641fdb720b378.chef-table.png'),
('Savory Secrets', 11, '2023-03-26 06:06:57', 'Welcome to Savory Secrets, your go-to source for tantalizing recipes and culinary inspiration. Our blog is dedicated to sharing the savory secrets of the world&#039;s most talented chefs, home cooks, and food enthusiasts. We believe that cooking is an art form, and we&#039;re passionate about helping our readers create dishes that are as delicious as they are beautiful. At Savory Secrets, you&#039;ll find a wealth of recipes, cooking tips, and culinary hacks that will elevate your kitchen skills to the next level. Whether you&#039;re an experienced chef or a novice cook, our blog has something to offer. From mouthwatering appetizers to decadent desserts, our recipes are sure to impress. We&#039;re also committed to providing a diverse range of recipes that cater to different dietary needs and preferences, including vegetarian, vegan, gluten-free, and more.', 'Asia', '', 1, 0, 1, 0, 0, 0, 'TestUser2', 'images/641fe10137d96.savory-secrets.png'),
('Television food', 12, '2023-03-27 05:53:22', 'All I shall say is this: The BEST television food satisfaction you will find anywhere.', 'North America', 'New York, USA', 0, 1, 1, 0, 0, 0, 'fallon', 'images/64212f5298d29.Screenshot_2023-03-26_224125.png');

-- --------------------------------------------------------

--
-- Table structure for table `blogpost`
--

CREATE TABLE IF NOT EXISTS `blogpost` (
  `Author` varchar(90) CHARACTER SET utf8mb4 NOT NULL,
  `BlogTitle` varchar(90) CHARACTER SET utf8mb4 NOT NULL,
  `PID` int(11) NOT NULL,
  `BID` int(11) NOT NULL,
  `BlogSecondaryTitle` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `DatePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Image` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `Content` varchar(2200) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogpost`
--

INSERT INTO `blogpost` (`Author`, `BlogTitle`, `PID`, `BID`, `BlogSecondaryTitle`, `DatePosted`, `Image`, `Content`) VALUES
('KyraJB', 'Satisfy Your Sweet Tooth', 1, 1, 'Rich Chocolate Cupcakes', '2023-03-25 22:38:41', 'images/641f77f1beb36.chocolate-cupcake.png', 'If you&#039;re a chocoholic, these rich chocolate cupcakes are sure to satisfy your cravings. With a decadent chocolate flavor and a smooth, creamy frosting, they cupcakes are a chocolate lover&#039;s dream.\r\n\r\nIngredients:\r\n\r\n- 1 1/2 cups all-purpose flour\r\n\r\n- 1/2 cup unsweetened cocoa powder\r\n\r\n- 1 teaspoon baking soda\r\n\r\n- 1/2 teaspoon baking powder\r\n\r\n- 1/2 teaspoon salt\r\n\r\n- 1/2 cup unsalted butter, softened\r\n\r\n- 1 cup granulated sugar\r\n\r\n- 2 large eggs\r\n\r\n- 2 teaspoons vanilla extract\r\n\r\n- 1/2 cup milk\r\n\r\nInstructions:\r\n\r\n1. Preheat the oven to 350°F (175°C). Line a cupcake pan with cupcake liners.\r\n\r\n2. In a medium bowl, whisk together the flour, cocoa powder, baking soda, baking powder, and salt.\r\n\r\n3. In a large bowl, cream together the butter and sugar until light and fluffy. Beat in the eggs one at a time, then stir in the vanilla extract.\r\n\r\n4. Add the dry ingredients to the butter mixture in three additions, alternating with the milk and beginning and ending with the dry ingredients.\r\n\r\n5. Divide the batter evenly among the cupcake liners, filling each about two-thirds full.\r\n\r\n6. Bake for 18-20 minutes, or until a toothpick inserted into the center of a cupcake comes out clean.\r\n\r\n7. Remove from the oven and let cool completely before frosting.\r\n\r\n8. To make the frosting, cream together 1/2 cup of unsalted butter, 2 cups of powdered sugar, 1/4 cup of unsweetened cocoa powder, and 2-3 tablespoons of milk until light and fluffy.\r\n\r\n9. Frost the cupcakes and decorate as desired.'),
('KyraJB', 'Satisfy Your Sweet Tooth Part 2', 2, 1, 'Classic Vanilla Cupcakes', '2023-03-25 22:43:57', 'images/641f792d45e0e.vanilla-cupcake.png', 'Vanilla cupcakes are a timeless classic, and this recipe is sure to please. With a moist and fluffy texture and a rich vanilla flavor, these cupcakes are perfect for any occasion.\r\n\r\nIngredients:\r\n\r\n- 1 1/2 cups all-purpose flour\r\n\r\n- 1 1/2 teaspoons baking powder\r\n\r\n- 1/2 teaspoon salt\r\n\r\n- 1/2 cup unsalted butter, softened\r\n\r\n- 1 cup granulated sugar\r\n\r\n- 2 large eggs\r\n\r\n- 2 teaspoons vanilla extract\r\n\r\n- 1/2 cup milk\r\n\r\nInstructions:\r\n\r\n1. Preheat the oven to 350°F (175°C). Line a cupcake pan with cupcake liners.\r\n\r\n2. In a medium bowl, whisk together the flour, baking powder, and salt.\r\n\r\n3. In a large bowl, cream together the butter and sugar until light and fluffy. Beat in the eggs one at a time, then stir in the vanilla extract.\r\n\r\n4. Add the dry ingredients to the butter mixture in three additions, alternating with the milk and\r\nbeginning and ending with the dry ingredients.\r\n\r\n5. Divide the batter evenly among the cupcake liners, filling each about two-thirds full.\r\n\r\n6. Bake for 18-20 minutes, or until a toothpick inserted into the center of a cupcake comes out clean.\r\n\r\n7. Remove from the oven and let cool completely before frosting.'),
('KyraJB', 'Fun and Festive Holiday Treats', 3, 1, 'Candy Cane Bark', '2023-03-25 22:50:29', 'images/641f7ab5249ec.candy-cane-bark.png', 'This easy-to-make candy cane bark is a festive and delicious treat that everyone will love. It&#039;s a perfect holiday gift or party favor, and can be customized with your favorite toppings.\r\n\r\nIngredients:\r\n\r\n- 12 oz semisweet chocolate chips\r\n\r\n- 6 oz white chocolate chips\r\n\r\n- 6-8 candy canes, crushed\r\n\r\nOptional: sprinkles, chopped nuts, or other toppings\r\n\r\n\r\nDirections:\r\n\r\n1. Line a baking sheet with parchment paper.\r\n\r\n2. Melt the semisweet chocolate chips in a double boiler or in the microwave, stirring every 30\r\nseconds until melted and smooth.\r\n\r\n3. Pour the melted chocolate onto the prepared baking sheet and spread evenly.\r\n\r\n4. Melt the white chocolate chips in a double boiler or in the microwave, stirring every 30 seconds\r\nuntil melted.'),
('KyraJB', 'Fun and Festive Holiday Treats Part 2', 4, 1, 'Gingerbread Cookies', '2023-03-25 22:54:26', 'images/641f7ba22dae9.gingerbread.png', 'No holiday dessert spread is complete without gingerbread cookies. This classic recipe is easy to make and can be cut into fun holiday shapes like stars, trees, and snowflakes. Add a little royal icing and some festive sprinkles for a decorative touch.\r\n\r\nIngredients:\r\n\r\n- 3 cups all-purpose flour\r\n\r\n- 1 tsp baking soda\r\n\r\n- 2 tsp ground ginger\r\n\r\n- 1 tsp ground cinnamon\r\n\r\n- 1/2 tsp ground cloves\r\n\r\n- 1/4 tsp salt\r\n\r\n- 1/2 cup unsalted butter, at room temperature\r\n\r\n- 1/2 cup brown sugar\r\n\r\n- 1/4 cup molasses\r\n\r\n- 1 large egg\r\n\r\n\r\nDirections:\r\n\r\n1. In a medium bowl, whisk together the flour, baking soda, ginger, cinnamon, cloves, and salt.\r\n\r\n2. In a large bowl, beat the butter and sugar together until light and fluffy. Beat in the molasses\r\nand egg until well combined.\r\n\r\n3. Gradually add the flour mixture to the butter mixture, mixing until just combined.\r\n\r\n4. Divide the dough into two equal portions and shape into disks. Wrap each disk in plastic wrap\r\nand chill in the refrigerator for at least 2 hours or overnight.\r\n\r\n5. Preheat the oven to 350°F (175°C). Line a baking sheet with parchment paper.\r\n\r\n6. On a lightly floured surface, roll out the dough to 1/4 inch thickness. Use cookie cutters to\r\ncut out desired shapes and transfer to the prepared baking sheet.\r\n\r\n7. Bake for 10-12 minutes, until the edges are lightly browned. Cool on the baking sheet for 5\r\nminutes before transferring to a wire rack to cool completely.'),
('Bojangles', 'Canadian Pizza', 5, 7, 'Hockey Edition', '2023-03-26 05:30:40', 'images/641fd8803dcbc.canada.png', 'If you&#039;re looking for a fun and delicious way to celebrate all things Canadian, why not try making a Canadian-themed pizza? With toppings like bacon, maple syrup, and Canadian cheddar cheese, this pizza is sure to be a hit with anyone who loves all things Canadian. Here&#039;s how to make it:\r\n\r\nIngredients:\r\n\r\n1 pre-made pizza crust (or make your own!)\r\n\r\n1/2 cup tomato sauce\r\n\r\n1/2 cup shredded Canadian cheddar cheese\r\n\r\n4 strips of bacon, cooked and crumbled\r\n\r\n1/4 cup chopped red onion\r\n\r\n1/4 cup chopped green bell pepper\r\n\r\n2 tablespoons maple syrup\r\n\r\nSalt and pepper, to taste\r\n\r\nInstructions:\r\n\r\n1. Preheat your oven to 425°F.\r\n\r\n2. Place the pizza crust on a baking sheet or pizza stone.\r\n\r\n3. Spread the tomato sauce evenly over the crust, leaving about 1/2 inch around the edges.\r\n\r\n4. Sprinkle the shredded Canadian cheddar cheese over the sauce.\r\n\r\n5. Add the crumbled bacon, chopped red onion, and chopped green bell pepper on top of the cheese.\r\n\r\n6. Drizzle the maple syrup over the toppings.\r\n\r\n7. Season with salt and pepper to taste.\r\n\r\n8. Bake the pizza for 12-15 minutes, or until the crust is golden brown and the cheese is melted and bubbly.\r\n\r\n9. Remove the pizza from the oven and let it cool for a few minutes before slicing and serving.\r\n\r\nThis Canadian-themed pizza is the perfect way to celebrate Canada Day, a hockey game, or any occasion that calls for a delicious and unique pizza. Enjoy!'),
('Mrunal', 'The Spiciest Wings Challenge', 6, 2, 'Surviving the Burn', '2023-03-26 18:40:54', 'images/642091b663949.spicy-wings.jpg', 'Are you ready for some serious heat? Because in this blog post, we&#039;re taking on the spiciest wings challenge. That&#039;s right, we&#039;re putting our taste buds to the test and trying some of the hottest wings around. Will we be able to handle the burn, or will we be crying for mercy? Let&#039;s find out.\r\n\r\nWe&#039;re at a local restaurant that specializes in spicy food, and we&#039;ve ordered their spiciest wings on the menu. The waiter warns us that they&#039;re not for the faint of heart, but we&#039;re feeling confident. After all, we&#039;re Food Daredevils, right?\r\n\r\nThe wings arrive, and we take a deep breath before diving in. The first bite is...intense. Our mouths are immediately on fire, and we start to sweat. The heat is almost unbearable, but we soldier on, determined to finish the challenge.\r\n\r\nWe try to distract ourselves from the heat by talking about anything and everything, but it&#039;s hard to concentrate when your mouth feels like it&#039;s been set ablaze. We drink water, milk, and even eat some bread, but nothing seems to help. We&#039;re in full survival mode now.\r\n\r\nFinally, after what feels like an eternity, we finish the last wing. We&#039;re breathing heavily, our faces are red, and we&#039;re covered in sweat. But we did it. We survived the spiciest wings challenge.\r\nSo, was it worth it? Well, it depends on your perspective. If you&#039;re someone who loves spicy food and enjoys pushing your limits, then yes, it&#039;s definitely worth it. The rush of endorphins and adrenaline you feel after eating something that hot is hard to describe. But if you&#039;re someone who can&#039;t handle the heat, then it&#039;s probably not worth the pain and discomfort.\r\n\r\nOverall, the spiciest wings challenge was a memorable experience. We learned that we can handle more heat than we thought, but also that there is a limit to how much spice we can take. Would we do it again? Maybe. But for now, we&#039;ll stick to slightly less spicy food.'),
('Mrunal', 'Tokyo', 7, 3, 'A Culinary Adventure', '2023-03-26 18:55:47', 'images/64209533759a7.Tokyo.jpg', 'Welcome to Dining Destinations, where we take you on a journey to explore the world&#039;s best culinary experiences. In this blog post, we&#039;re exploring Tokyo, Japan, a city that is famous for its incredible food scene. From street food to Michelin-starred restaurants, there is something for everyone in this bustling metropolis. Join us as we delve into the food culture of Tokyo and uncover some of the best dining destinations in the city.\r\n\r\n1. Ramen Shops:\r\nRamen is a staple food in Japan, and Tokyo is home to some of the best ramen shops in the country. From classic tonkotsu ramen to spicy miso ramen, there is a flavor for every taste bud. Our top picks include Ichiran, a chain restaurant famous for its individual ramen booths, and Tsuta, the world&#039;s first Michelin-starred ramen restaurant.\r\n\r\n2. Sushi Bars:\r\nSushi is another famous Japanese dish, and Tokyo is home to some of the best sushi bars in the world. At these sushi bars, you can expect to find the freshest fish and expertly crafted sushi rolls. Our top picks include Sushi Dai, a tiny restaurant in Tsukiji Market that is famous for its long lines and amazing sushi, and Jiro Sushi, a three-Michelin-starred restaurant that was featured in the documentary &quot;Jiro Dreams of Sushi.&quot;\r\n\r\n3. Izakayas:\r\nIzakayas are Japanese pubs that serve small plates of food and drinks. These casual restaurants are popular with locals and tourists alike, and they offer a great opportunity to sample a variety of Japanese dishes. Our top picks include Torikizoku, a chain izakaya that offers grilled chicken skewers for only 298 yen (less than $3), and Kagaya, a quirky izakaya where the owner performs magic tricks for guests.'),
('TestUser', '5 Easy and Delicious Vegan Breakfast Ideas', 8, 4, 'Fuel Your Day', '2023-03-26 19:03:09', 'images/642096ed7c44a.vegan-breakfast.jpg', 'As a vegan, breakfast can sometimes feel like a challenge. But fear not - there are plenty of delicious and nutritious plant-based options to start your day off right! In this post, we&#039;ll share 5 easy and tasty vegan breakfast ideas that you can enjoy any day of the week.\r\n\r\nOvernight Oats\r\nOvernight oats are a convenient and tasty breakfast option that you can prepare the night before. Simply mix together rolled oats, plant-based milk, and your favorite toppings (such as fruit, nuts, or seeds) and let it sit in the fridge overnight. In the morning, you&#039;ll have a creamy and satisfying breakfast that&#039;s perfect for busy mornings.\r\n\r\nTofu Scramble\r\nIf you&#039;re missing scrambled eggs, try making a tofu scramble instead. Crumble up some firm tofu and cook it with your favorite veggies and spices for a savory and protein-packed breakfast. Serve it with some toast or avocado for a filling meal.\r\n\r\nSmoothie Bowl\r\nSmoothie bowls are a fun and creative way to enjoy a nutritious breakfast. Simply blend together your favorite fruits and veggies with some plant-based milk and pour it into a bowl. Top it with some granola, nuts, or seeds for some crunch and texture.\r\n\r\nBreakfast Burrito\r\nWho doesn&#039;t love a breakfast burrito? Simply fill a tortilla with some scrambled tofu, beans, veggies, and salsa for a hearty and flavorful breakfast. You can even make a big batch and freeze them for an easy grab-and-go breakfast during the week.\r\n\r\nVegan Pancakes\r\nPancakes are a classic breakfast food, and they can easily be made vegan. Simply substitute eggs with a flax egg or applesauce, and use plant-based milk instead of dairy milk. Top them with some fruit, maple syrup, or nut butter for a delicious and indulgent breakfast.\r\n\r\nWe hope these vegan breakfast ideas inspire you to start your day off with some plant-based goodness. What are some of your favorite vegan breakfasts? Let us know in the comments below!'),
('Bojangles', 'Explore the Flavors of Canada: A Culinary Journey with Northern Nibbles', 9, 7, 'A Culinary Journey with Northern Nibbles', '2023-03-26 20:51:02', 'images/6420b036a83e5.canada2.jpg', 'Welcome to Northern Nibbles, your go-to blog for discovering the best of Canadian cuisine. From coast to coast, Canada is home to a diverse range of culinary traditions and flavors, and we are here to showcase them all.\r\nAt Northern Nibbles, we are passionate about sharing authentic Canadian recipes that highlight the unique ingredients and flavors of each region. Whether you&#039;re looking for classic comfort food or a modern twist on a traditional dish, we&#039;ve got you covered.\r\n\r\nOne dish that is synonymous with Canadian cuisine is poutine. This deliciously indulgent dish features crispy fries, savory gravy, and gooey cheese curds. It&#039;s a favorite among Canadians and visitors alike, and for good reason. Our recipe for classic poutine is sure to satisfy your cravings and transport you to the streets of Montreal.\r\n\r\nAnother Canadian staple is maple-glazed salmon. Canada is known for its fresh and sustainable seafood, and this dish is a perfect showcase of the country&#039;s bountiful waters. Our recipe features a sweet and savory glaze made with pure Canadian maple syrup, soy sauce, and ginger. It&#039;s a simple yet elegant dish that will impress any dinner guest.\r\n\r\nBut Canadian cuisine is not just about comfort food and seafood. Our country is home to a rich and diverse culinary landscape, shaped by the many cultures that call Canada home. From Quebec&#039;s French-inspired cuisine to the spicy flavors of the Caribbean, there&#039;s something for everyone in Canada.\r\n\r\nSo, whether you&#039;re a seasoned home cook or just starting out, join us on a culinary journey across Canada with Northern Nibbles. From hearty stews to decadent desserts, we&#039;ve got everything you need to explore the flavors of Canada. Stay tuned for more delicious recipes and culinary adventures!'),
('Mrunal', 'India', 10, 3, 'My home revisited', '2023-03-27 00:59:36', 'images/6420ea78527c5.Screenshot_2023-03-26_175908.png', 'Indian cuisine dates back over 5000 years. Each region has its own traditions, religions and culture that influence its food. Hindus tend to be vegetarian and Muslims tend to have meat dishes, although pork is forbidden. Indian food has been influenced by Mongolian, Persian and Chinese cuisine, among others. '),
('fallon', 'GordonGram', 11, 12, 'Our first legendary guest: Gordon Ramsay', '2023-03-27 05:59:21', 'images/642130b93d455.Screenshot_2023-03-26_225850.png', 'Gordon James Ramsay is a British chef, restaurateur, television personality and writer. His restaurant group, Gordon Ramsay Restaurants, was founded in 1997 and has been awarded 17 Michelin stars overall; it currently holds a total of seven. His signature restaurant, Restaurant Gordon Ramsay in Chelsea, London, has held three Michelin stars since 2001. After rising to fame on the British television miniseries Boiling Point in 1999, Ramsay became one of the best-known and most influential chefs in the world.\r\n\r\nTune in on Friday, April 1st, 9pm to see the culinary ninja in action.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `Username` varchar(90) CHARACTER SET utf8mb4 NOT NULL,
  `Title` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `Content` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `BID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `CommentPosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Username`, `Title`, `Content`, `BID`, `PID`, `CommentPosted`) VALUES
('Bojangles', 'Boring', 'I don''t like Gordon Ramsay boo', 12, 11, '2023-03-27 06:33:49'),
('Bojangles', 'Ick', 'I like meat!', 4, 8, '2023-03-27 06:34:24'),
('Bojangles', 'ImLazy', 'I''m too lazy to cook but these look great!', 1, 4, '2023-03-27 06:34:53'),
('Bojangles', 'Meh', 'Vanilla is okay. I much prefer the rich chocolate cupcakes to this. C+', 1, 2, '2023-03-27 06:35:23'),
('Bojangles', 'I NEED SPICY WINGS', 'I NEED THEM NOW', 2, 6, '2023-03-27 06:37:01'),
('Bojangles', 'More Coming Soon!', 'Stay tuned for more!', 7, 9, '2023-03-27 06:45:01'),
('fallon', 'Great Idea!', 'Tried it today and became an instant favourite!! Stay tuned for a new game on my show ;)', 2, 6, '2023-03-27 05:37:08'),
('KyraJB', 'Awesome Work!', 'I''m so proud of you! Keep going!', 7, 5, '2023-03-26 08:10:58'),
('KyraJB', 'FOMO', 'Thank you for the wonderful tips! Now I really want to visit Tokyo.', 3, 7, '2023-03-26 20:26:29'),
('KyraJB', 'TheSugarShack', 'Hope you enjoyed reading!', 1, 4, '2023-03-27 06:20:33'),
('KyraJB', 'Yummy!', 'This is my favourite recipe!', 1, 1, '2023-03-27 06:20:48'),
('Mrunal', 'Delicious!!', 'Just tried it, so yummy!!!', 1, 4, '2023-03-27 00:52:51'),
('TestUser', 'Awesome recipe!', 'Great job!', 1, 1, '2023-03-26 17:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `Name` varchar(90) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `BirthDate` date NOT NULL,
  `Username` varchar(90) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `AccountCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ProfileImage` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`Name`, `Email`, `BirthDate`, `Username`, `Password`, `AccountCreated`, `ProfileImage`, `isAdmin`, `Status`) VALUES
('Adam Fipke', 'adamfipke@gmail.com', '2000-08-26', 'Bojangles', '$2y$10$CYKal31p4Ay5E4ndcQgSKufFUpmDvYce5se3R5gPG/mP1KASd4UTW', '2023-03-26 05:14:58', 'images/641fd4d280dcd.CanadaMan.png', 0, 1),
('Jimmy Fallon', 'fallontonight@gmail.com', '1974-09-19', 'fallon', '$2y$10$DzntU6IsBP53L/hYNYB8iu5GUAcVlTWSysn..x5LAcJ0HGKT1MSn.', '2023-03-27 05:33:06', 'images/64212a92b017f.face3.png', 0, 1),
('FoodForAll Incorporated', 'foodforall@gmail.com', '1999-01-01', 'FoodForAll', '$2y$10$Hucc9D/wHwszqZwUc8mqAuRBIHrpxDjVI6F4HYsElmSp8f/sAGfQe', '2023-03-26 05:00:31', 'images/641fd16f7d8db.food-for-all.jpg', 0, 1),
('Kyra Barnes', 'kjbarnes6410@gmail.com', '2000-01-01', 'KyraJB', '$2y$10$hDrq9ZHS9essufpDL/NjYe5NgSFjA0ueGoEWZX0ZFClC/n2yF.zAy', '2023-03-22 03:01:46', 'images/641fda30bfec2.devpost_pfp.png', 1, 1),
('Mrunal Aroskar', 'mrunalaroskar17@gmail.com', '2000-09-03', 'Mrunal', '$2y$10$.bJx.ZeLb59qEJP9yp4aieZUBu60gDpCt4QOwn4bMZfeSluZFkBOS', '2023-03-22 22:14:47', 'images/641b7dd7c11ef.lexiuwu.png', 1, 1),
('Test User', 'test@gmail.com', '2000-09-03', 'TestUser', '$2y$10$bPRUWQAatqjrpxiSCruIAOQ0Tnb6p9kt7hlwDPpH/IlYch4LTaaxC', '2023-03-22 22:50:27', 'images/641b863366950.tulip.jpg', 0, 1),
('Test UserTwo', 'testuser2@gmail.com', '1998-01-01', 'TestUser2', '$2y$10$n9zzf3VOhVTBm3SIHn48I.gJ.NZZ1eKoKqqGAqzKG6tkseUWX91W2', '2023-03-26 05:33:44', 'images/641fd937e96fc.profile.jpg', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`Refnum`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `bloginfo`
--
ALTER TABLE `bloginfo`
  ADD PRIMARY KEY (`BID`),
  ADD UNIQUE KEY `UNIQUE` (`Username`,`BlogName`) USING BTREE;

--
-- Indexes for table `blogpost`
--
ALTER TABLE `blogpost`
  ADD PRIMARY KEY (`PID`),
  ADD UNIQUE KEY `UNIQUE` (`Author`,`BlogTitle`) USING BTREE,
  ADD KEY `BID` (`BID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Username`,`CommentPosted`),
  ADD KEY `BID` (`BID`,`PID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloginfo`
--
ALTER TABLE `bloginfo`
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `blogpost`
--
ALTER TABLE `blogpost`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD CONSTRAINT `admininfo_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `userinfo` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bloginfo`
--
ALTER TABLE `bloginfo`
  ADD CONSTRAINT `bloginfo_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `userinfo` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogpost`
--
ALTER TABLE `blogpost`
  ADD CONSTRAINT `blogpost_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `bloginfo` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogpost_ibfk_2` FOREIGN KEY (`BID`) REFERENCES `bloginfo` (`BID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`BID`, `PID`) REFERENCES `blogpost` (`BID`, `PID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
