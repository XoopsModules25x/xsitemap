#
# Table structure for table `xsitemap_plugin`
#
		
CREATE TABLE  `xsitemap_plugin` (
`plugin_id` int (8)   NOT NULL  auto_increment,
`plugin_name` varchar (20)   NOT NULL ,
`plugin_mod_version` varchar (5)   NOT NULL ,
`plugin_mod_table` varchar (255)   NOT NULL ,
`plugin_cat_id` varchar (255)   NOT NULL ,
`plugin_cat_pid` varchar (255)   NOT NULL ,
`plugin_cat_name` varchar (255)   NOT NULL ,
`plugin_weight` varchar (255)   NOT NULL ,
`plugin_call` varchar (255)   NOT NULL ,
`plugin_submitter` int (10)   NOT NULL default '0',
`plugin_date_created` int (10)   NOT NULL default '0',
`plugin_online` tinyint (1)   NOT NULL default '0',
PRIMARY KEY (`plugin_id`),
KEY `plugin_name` (`plugin_name`)
) ENGINE=MyISAM;

INSERT INTO `xsitemap_plugin` (`plugin_name`, `plugin_mod_version`, `plugin_mod_table`, `plugin_cat_id`, `plugin_cat_pid`, `plugin_cat_name`, `plugin_weight`, `plugin_call`, `plugin_submitter`, `plugin_date_created`, `plugin_online`) VALUES
('News', '1.6x', 'topics', 'topic_id', 'topic_pid', 'topic_title', 'topic_title', 'index.php?storytopic=', 1, 1250632800, 1),
('Articles', '2.41', 'ams_topics', 'topic_id', 'topic_pid', 'topic_title', 'topic_title', 'index.php?storytopic=', 1, 1250632800, 1),
('Classifieds', '2.53', 'classifieds_categories', 'cid', 'pid', 'title', 'title', 'catview.php?cid=', 1, 1250805600, 1),
('Jobs', '4.4', 'jobs_categories', 'cid', 'pid', 'title', 'title', 'jobscat.php?cid=', 1, 1250805600, 1),
('Publisher', '1.0', 'publisher_categories', 'categoryid', 'parentid', 'name', 'name', 'category.php?categoryid=', 1, 1250805600, 1),
('Oledrion', '2.2', 'oledrion_cat', 'cat_cid', 'cat_pid', 'cat_title', 'cat_title', 'category.php?cat_cid=', 1, 1250805600, 1),
('Smart section', '2.14', 'smartsection_categories', 'categoryid', 'parentid', 'name', 'name', 'category.php?categoryid=', 1, 1250805600, 1),
('Extgallery', '1.0.5', 'extgallery_publiccat', 'cat_id', 'cat_id', 'cat_name', 'cat_name', 'public-categories.php?id=', 1, 1250805600, 1),
('My album', '2.8.4', 'myalbum_cat', 'cid', 'pid', 'title', 'title', 'viewcat.php?cid=', 1, 1250805600, 1);

