SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(4, 'Sports', 0),
(1, 'Entertainment', 3),
(2, 'Politics', 1),
(3, 'Health', 1);


CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(1, 'Social Media', 'Online hostility has become a bigger problem over recent years, particularly with people spending more time on social media during the COVID-19 pandemic. A U.S. survey found four in ten Americans have experienced harassment online—with three-quarters reporting that the most recent abuse happened on social media.', '1', '01 Mar, 2022', 1, '1646672516-et.jpg'),
(2, 'Ahmed Abdulah', 'He began playing the trumpet at age 13 in his native New York City. One of the first groups he performed with was the Master Brotherhood. By the 1970s, he was performing in New Yorks loft scene with various groups including the Melodic Art-Tet (Roger Blank and Ronnie Boykins, later William Parker) and joined the Sun Ra Ark. Ahmed Abdullah formed his own band in 1972 ,and joined the Sun Ra Ark in 1975, working there on and off until 1993, when Sun Ra died.', '1', '03 Mar, 2022', 5, '1646570191-96008507.jpg'),
(3, 'Lincoln Hospital', 'Lincoln Hospital is a full service medical center and teaching hospital affiliated with Weill Cornell Medical College, in the Mott Haven neighborhood of the Bronx, New York City, New York. The medical center is municipally owned by NYC Health + Hospitals. Lincoln is known for innovative programs addressing the specific needs of the community it serves, aggressively tackling such issues as asthma, obesity, cancer, diabetes and tuberculosis. Staffed by a team of more than 300 physicians, the hospital has an inpatient capacity of 347 beds, including 20 neonatal intensive care beds, 23 intensive care beds, 8 pediatric intensive care beds, 7 coronary care beds, and an 11-station renal dialysis unit. With over 144,000 emergency department visits annually, Lincoln has the busiest single site emergency department in New York City and the third busiest in the nation.', '3', '03 Mar, 2022', 2, '1646682194-h1.jpg'),
(4, 'Boyko Borisov', 'Boyko Metodiev Borisov (born 13 June 1959) is a Bulgarian politician who served as the prime minister of Bulgaria from 2009 to 2013, 2014 to 2017, and 2017 to 2021, making him Bulgarias second-longest serving prime minister to date. Borisov was elected Mayor of Sofia in 2004. In December 2005, he was the founding chairman of the conservative political party Citizens for European Development of Bulgaria (GERB), becoming its lead candidate in the 2009 general election. Borisov led GERB to a landslide victory in 2009, defeating the incumbent Socialist Party, and resigned as mayor of Sofia to be sworn in as Prime Minister. He resigned in 2013, after nationwide protests against the governments energy policy, but after leading GERB to victory in the 2014 general election, he became Prime Minister again. His second term ended similarly to his first, after Borisov resigned in January 2017, this time following GERBs defeat in the 2016 presidential election. As before, Borisov led GERB to election victory again in the snap 2017 general election, becoming Prime Minister for a third time.', '2', '03 Mar, 2022', 2, '1646678357-p11.jpg'),
(5, 'Apple', 'Apple is rolling out a series of new heart health resources in February to support users’ health journeys in the US to stay moving and informed. Additionally, the Apple Heart and Movement Study is sharing preliminary lifestyle trends analyzed over the past year.', '1', '03 Mar, 2022', 5, '1646570432-apple_tv_plus_reuters_1561978630049.jpeg');


CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Petar', 'Nedyalkov', 'petar', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'Elon', 'Musk', 'elonmusk', '22eab4afd9d75b89db26ab33ad7fa192', 1),
(3, 'Nikola', 'Nikolov', 'nikola', '9365ea12b2d910e1aceaac190fbc97a5', 0),
(4, 'Georgi', 'Georgiev', 'georgi', 'ce0b1e385c86cff60fb2e68861fb5f5f', 0),
(5, 'Kaloyan', 'Kaloyanov', 'kaloyan', 'c60d7c404f9711b8abec28def61692f4', 0),
(6, 'Dimitar', 'Dimitrov', 'dimitar', 'dc883ce3d99d8a9710ca59c414158cae', 0);


ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);


ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);


ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;


ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;