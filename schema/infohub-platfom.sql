-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2018 at 06:32 AM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.5-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infohub_platfom`
--
CREATE DATABASE IF NOT EXISTS `infohub_platfom` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `infohub_platfom`;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_admin_accounts`
--

DROP TABLE IF EXISTS `mrfc_admin_accounts`;
CREATE TABLE `mrfc_admin_accounts` (
  `admin_id` int(11) NOT NULL,
  `admin_uname` varchar(40) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_fname` varchar(30) NOT NULL,
  `admin_pword` varchar(40) NOT NULL,
  `admintype_id` int(11) NOT NULL DEFAULT '2',
  `date_lastlog` bigint(20) DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `erased` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_admin_accounts`
--

INSERT INTO `mrfc_admin_accounts` (`admin_id`, `admin_uname`, `admin_email`, `admin_fname`, `admin_pword`, `admintype_id`, `date_lastlog`, `published`, `erased`) VALUES
(2, 'user', 'user@portal.com', 'CMS Admin', '386a5001937dc3920555662fd6dfbabe', 1, 1490412173, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_admin_types`
--

DROP TABLE IF EXISTS `mrfc_admin_types`;
CREATE TABLE `mrfc_admin_types` (
  `admintype_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `t_desc` varchar(125) NOT NULL,
  `language_id` int(1) NOT NULL DEFAULT '1',
  `published` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_admin_types`
--

INSERT INTO `mrfc_admin_types` (`admintype_id`, `title`, `t_desc`, `language_id`, `published`) VALUES
(1, 'Super Administrator', 'Full Access', 1, 1),
(2, 'Part Administrator', 'Partial Access', 1, 1),
(3, 'Mailing Admin', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_app_committee`
--

DROP TABLE IF EXISTS `mrfc_app_committee`;
CREATE TABLE `mrfc_app_committee` (
  `committee_id` int(11) NOT NULL,
  `title` varchar(70) NOT NULL,
  `title_seo` varchar(70) NOT NULL,
  `description` mediumtext,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `is_widget` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_app_committee`
--

INSERT INTO `mrfc_app_committee` (`committee_id`, `title`, `title_seo`, `description`, `published`, `is_widget`) VALUES
(1, 'Agriculture', 'agriculture', 'The committee handles all matters relating to sustainable agricultural practices; poverty eradication by utilization of high value inputs and equipment; value addition for farmers; food security and drought management; production and marketing; fisheries development; and adoption of technological advancements in agriculture.&lt;br&gt;The Committee also addresses matters related to agricultural levies and licenses, devolvement of agricultural projects to Counties, sharing of revenue for export abattoirs in Nairobi, intergovernmental Relations by developing mechanism for consultation and cooperation for the agriculture sector.', 1, 1),
(2, 'Arid &amp; Semi-Arid Land (ASAL)', 'arid-semi-arid-land-asal', '&lt;p&gt;The Arid and Semi-Arid Lands Committee deals with matters relating to the development of Arid and Semi-Arid Lands (ASALs). The committee offers a platform for consultation on key issues such as Contingency planning for drought and other associated risks. The mandate encompasses sharing of best practices, review of policy and legal proposals on issues of food security and drought management in ASALs.&lt;/p&gt;', 0, 1),
(3, 'Cooperatives &amp; Enterprise Development', 'cooperatives-enterprise-development', '&lt;p&gt;The Cooperatives committee was constituted to consider all matters relating to cooperatives development and regulations. The committees&rsquo; mandate revolves around;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Review and develop memorandums on current Bills before National Assembly and Senate relating to Cooperatives;&lt;/li&gt;&lt;li&gt;Review and Coordinate Counties position on National policies relating to Cooperatives&lt;/li&gt;&lt;li&gt;Coordinate any matter relating to Cooperatives at intergovernmental level;&lt;/li&gt;&lt;li&gt;To coordinate and harmonize the Council&rsquo;s position on matters of Cooperatives relations between the two levels of government;&lt;/li&gt;&lt;/ul&gt;', 0, 1),
(4, 'Education', 'education', '&lt;p&gt;The Education, Gender, Youth, Children, Sports, Culture and Social Services Committee is tasked with considering, reviewing and monitoring policy and legislation on matters relating to education, gender, youth, sports, culture and social services and making relevant recommendations. &lt;br&gt;&lt;/p&gt;&lt;p&gt;Also, the committee monitors the implementation and adherence of international standards and national policy and legislation at the county level and makes appropriate recommendations. Besides, the committee also handles all matters related to the 7 mentioned sectoral areas in the 47 County Governments. The committee also acts as a liaison between the Counties and other National Government agencies.&lt;/p&gt;', 1, 1),
(5, 'Finance', 'finance', '&lt;p&gt;The Committee deals with all matters relating to Public finance such as: -&lt;/p&gt;&lt;ul&gt;&lt;ul&gt;&lt;li&gt;Review and monitor of policy and legislation on matters relating to Revenue Sharing; Budget Policy Statement, Revenue Sharing Formula, Division of Revenue Bill and County Allocation of Revenue Bill.&lt;/li&gt;&lt;li&gt;Advise the Council on legislative amendments and intervention areas therein on all sectoral matters such as amendment to the Public Finance Management Act, Public Procurement and Asset Disposal Act, County Governments PFM Regulations.&lt;/li&gt;&lt;li&gt;To advise County Governments on matters of policy and legislation with respect to County functions such as National Government&rsquo;s Budget analysis, County Budget analysis and National Government&rsquo;s expenditure framework.&lt;/li&gt;&lt;li&gt;To coordinate and harmonize the Council&rsquo;s position on matters of fiscal relations between the two levels of government.&lt;/li&gt;&lt;li&gt;To provide a forum for consultation on matters of County Planning, Budgeting and Public Private Partnerships for County Governments.&lt;/li&gt;&lt;/ul&gt;&lt;/ul&gt;', 1, 1),
(6, 'Health', 'health', '&lt;p&gt;Health Committee considers all matters relating to health sector at the Council of Governors. It looks at the institutional structures and related laws, frameworks, policies and programmes on health. &lt;br&gt;&lt;/p&gt;', 1, 1),
(7, 'Human Resources, Labour &amp; Social Welfare', 'human-resources-labour-social-welfare', '&lt;p&gt;The committee handles all matters relating to Labor, Human Resource and Social Welfare of workers in Counties. The Committee promotes the rights of the workers, their remunerations, promotions and general welfare of workers in Counties as per the Labor Laws in Kenya.&lt;/p&gt;&lt;p&gt;On another level, the committee provides technical assistance in terms of information, research, policy analysis and capacity building for County Governments across a range of Human Resources policy issues.&lt;/p&gt;&lt;p&gt;The Human Resource, Labor &amp;amp; Social Welfare division covers issues in the areas of pensions, capacity development, quality of services.&lt;/p&gt;', 0, 1),
(8, 'Information, Technology &amp; Communication', 'information-technology-communication', '&lt;p&gt;The role of ICT in social and economic development cannot be undermined. With this in mind it is imperative that Counties understand and adequately plan for how infrastructure and services can be integrated with Information Communication Technology (ICT) to better serve citizens. &lt;br&gt;&lt;/p&gt;&lt;p&gt;The committee handles all matters relating to ICT development in the County. This involves; review of current bills before the National Assembly, Senate and County Assemblies relating to ICT, review of national policies, research on international best practices for ICT development and innovation.&lt;/p&gt;', 1, 1),
(9, 'Infrastructure', 'infrastructure', '&lt;p&gt;The Roads, Infrastructure and Energy Committee oversees activities related to transport, infrastructure development and energy in the 47 Counties so as to ensure better service delivery to the citizens of Kenya as per the principles of devolution enshrined in the Constitution of Kenya.&lt;/p&gt;&lt;p&gt;The committee offers technical support in terms of information, research, policy analysis, and resource development for County Governments across a range of policy issues targeting the development of transport, infrastructure and energy for increased accessibility to all parts of the Country.&lt;/p&gt;', 1, 1),
(10, 'Intergovernmental Relations', 'intergovernmental-relations', '&lt;p&gt;This Committee deals with all matters relating to the relationship between one County Government and another County Government and the National Government and County Governments; dispute resolution between the two levels of government and amongst the County Governments; and engagements with other intergovernmental relations bodies.&lt;/p&gt;&lt;p&gt;This involves:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Creating sustainable linkages between the Counties and between the National Government and the County Governments that provide opportunity for vibrant intergovernmental consultation and cooperation.&lt;/li&gt;&lt;li&gt;Providing a linkage between County Governments and international associations and bodies to promote best practice and information sharing on matters related to devolution.&lt;/li&gt;&lt;li&gt;Providing a platform for dispute resolution between Counties.&lt;/li&gt;&lt;li&gt;Considering reports from other inter-governmental institutions.&lt;/li&gt;&lt;li&gt;Monitoring the implementation of Council resolutions through the Intergovernmental Relations Technical Committee (IGRTC)&lt;/li&gt;&lt;/ul&gt;', 0, 1),
(11, 'Legal', 'legal', '&lt;p&gt;This Committee deals with all matters relating to constitutional affairs; the organization and administration of law and justice; elections; promotion of principles of leadership, ethics and integrity; and implementation of the provisions of the Constitution on human rights. This involves:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Offering legal support and guidance to all Committees of the Council of Governors and respond to legal issues of interest to the Council and County Governments&lt;/li&gt;&lt;li&gt;Consider, review and monitor policies, laws and regulations that affect County Governments and devolved functions&lt;/li&gt;&lt;li&gt;Support initiatives that seeks to entrench the promotion and protection of human rights in all 47 Counties an advice on adherence to international human rights instruments&lt;/li&gt;&lt;li&gt;Advise all committees on relevant legislative amendments and intervention areas in sectoral matters&lt;/li&gt;&lt;li&gt;Coordinate intra and inter agency and governmental consultations on all legal issues&lt;/li&gt;&lt;li&gt;Advise, on specific cases, whether or not to institute court matters&lt;/li&gt;&lt;/ul&gt;', 1, 1),
(12, 'Resources Mobilization', 'resources-mobilization', '&lt;p&gt;...&lt;/p&gt;', 0, 1),
(13, 'Security &amp; Foreign Affairs', 'security-foreign-affairs', '&lt;p&gt;The Committee handles all matters relating to security and foreign affairs; county policing; internal relations and diplomacy. This achieved through:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Coordination and harmonizing of CoG views and recommendations on security and foreign affairs&lt;/li&gt;&lt;li&gt;Reviewing and analyzing policy and legislative related to county policing and security&lt;/li&gt;&lt;li&gt;Engaging in intergovernmental forums on enhancement of security by the National Government at the County level&lt;/li&gt;&lt;li&gt;Focusing on the international best practices in relation to security and foreign relations at the sub-national level&lt;/li&gt;&lt;/ul&gt;', 0, 1),
(14, 'Tourism &amp; Wildlife', 'tourism-wildlife', '&lt;p&gt;The Tourism and Wildlife Committee was constituted to handle all the matters relating to Tourism and Wildlife Management, tourism being a significant sector and a driver of Kenya&rsquo;s economic development as an Economic Pillar of Vision 2030, therefore the committee has the responsibility of formulating the intergovernmental framework of engagements with the National Government through the Intergovernmental working groups, identifying the key issues in tourism, providing the legislative and administrative actions and consolidating the best practices from Counties in collaboration with the stakeholders.&lt;/p&gt;', 1, 1),
(15, 'Trade and Co-operatives', 'trade-co-operatives', '&lt;p&gt;The Trade, Industry and Investment Committee was constituted to consider all matters relating to trade development and regulations; and investment and divestiture policies.&lt;/p&gt;', 1, 1),
(16, 'Lands, Planning &amp; Urban Development', 'lands-planning-urban-development', '&lt;p&gt;The Urban Development Committee (UDC) was constituted to consider all matters relating to urban development and regulations; investment and urban planning policies. Due to the magnitude of the urban challenges and in recognition of the importance of strategic partnerships with competent agencies and authorities, the committee is keen to harness the knowledge and best practices that exist in the urban development sphere to inspire an era of urban regeneration.&lt;/p&gt;&lt;p&gt;In addition, the committee provides technical assistance in terms of information, research, policy analysis, and resource development for County Governments across a range of policy issues targeting the growth of urban areas as engines of county economy.&lt;/p&gt;', 1, 1),
(17, 'Water, Forestry &amp; Mining', 'water-forestry-mining', '&lt;p&gt;The Water, Forestry and Mining Committee was constituted to consider all matters relating to sustainable water management; mining; climate change; environment management and conservation; forestry; natural resources; pollution and waste management.&lt;br&gt;The committees&rsquo; mandate is to review current bills before National Assembly, Senate and County Assemblies relating to all the above matters; National policies, best practices and emerging trends and technologies, inter-county agreements relating to cross-county resources.&lt;br&gt;The committee provides technical assistance in research, policy analysis, and resource development for county governments across a range of policy issues. The policies target counties as engines of sustainable economic growth.&lt;/p&gt;', 1, 1),
(33, 'All Sectors', 'all-committees', '&lt;p&gt;cross-cutting&lt;/p&gt;', 1, 0),
(34, 'Rules and Business', 'rules-business', 'Rules and Business', 0, 1),
(35, 'Sustainable Development Goals', 'sustainable-development-goals', '&lt;p&gt;...&lt;/p&gt;', 1, 1),
(36, 'Citizen Engagement', 'citizen-engagement', '&lt;p&gt;...&lt;/p&gt;', 1, 1),
(37, 'Gender and Social Services', 'gender-social-services', '&lt;p&gt;...&lt;/p&gt;', 1, 1),
(38, 'Youth', 'youth', '&lt;p&gt;...&lt;/p&gt;', 1, 1),
(39, 'Sports and Culture', 'sports-culture', '&lt;p&gt;...&lt;/p&gt;', 1, 1),
(40, 'Energy', 'energy', '&lt;p&gt;...&lt;/p&gt;', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_app_committee_members`
--

DROP TABLE IF EXISTS `mrfc_app_committee_members`;
CREATE TABLE `mrfc_app_committee_members` (
  `record_id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `leader_role_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_app_profiles`
--

DROP TABLE IF EXISTS `mrfc_app_profiles`;
CREATE TABLE `mrfc_app_profiles` (
  `leader_id` int(11) NOT NULL,
  `leader_type_id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL DEFAULT '0',
  `leader_name` varchar(100) NOT NULL,
  `leader_seo` varchar(100) NOT NULL,
  `leader_blurb` text,
  `constituency` varchar(50) DEFAULT NULL,
  `ward` varchar(50) DEFAULT NULL,
  `date_start` date NOT NULL DEFAULT '2013-03-27',
  `date_end` date DEFAULT NULL,
  `party` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `contacts` mediumtext,
  `status` varchar(20) NOT NULL DEFAULT 'current',
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `leader_extras` text,
  `published` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_cache_vars`
--

DROP TABLE IF EXISTS `mrfc_cache_vars`;
CREATE TABLE `mrfc_cache_vars` (
  `cache_id` varchar(50) NOT NULL,
  `cache_date` bigint(20) NOT NULL,
  `cache_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_cache_vars`
--

INSERT INTO `mrfc_cache_vars` (`cache_id`, `cache_date`, `cache_data`) VALUES
('contentChest', 1528590985, ''),
('galleryChest', 1528594068, ''),
('menuChest', 1529292256, 'a:8:{s:4:\"full\";a:27:{i:1;a:11:{s:2:\"id\";s:1:\"1\";s:5:\"title\";s:4:\"Home\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:4:\"home\";s:10:\"id_section\";s:2:\"10\";s:12:\"id_menu_type\";s:1:\"1\";s:9:\"link_menu\";s:9:\"index.php\";s:9:\"metawords\";s:4:\"home\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:11;a:11:{s:2:\"id\";s:2:\"11\";s:5:\"title\";s:25:\"Experiences & Innovations\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:23:\"experiences-innovations\";s:10:\"id_section\";s:2:\"13\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"program.php\";s:9:\"metawords\";s:26:\"good,practices,innovations\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:2;a:11:{s:2:\"id\";s:1:\"2\";s:5:\"title\";s:5:\"About\";s:11:\"title_alias\";s:20:\"About Maarifa Centre\";s:13:\"menu_seo_name\";s:5:\"about\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:1:\"5\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:13:\"about,maarifa\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:31;a:11:{s:2:\"id\";s:2:\"31\";s:5:\"title\";s:8:\"Counties\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:8:\"counties\";s:10:\"id_section\";s:2:\"20\";s:12:\"id_menu_type\";s:1:\"1\";s:9:\"link_menu\";s:12:\"counties.php\";s:9:\"metawords\";s:8:\"counties\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:12;a:11:{s:2:\"id\";s:2:\"12\";s:5:\"title\";s:13:\"News Articles\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:13:\"news-articles\";s:10:\"id_section\";s:1:\"2\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:13:\"news,articles\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:26;a:11:{s:2:\"id\";s:2:\"26\";s:5:\"title\";s:7:\"Sectors\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:19:\"sectoral-committees\";s:10:\"id_section\";s:2:\"15\";s:12:\"id_menu_type\";s:1:\"1\";s:9:\"link_menu\";s:14:\"committees.php\";s:9:\"metawords\";s:14:\"cog,committees\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:13;a:11:{s:2:\"id\";s:2:\"13\";s:5:\"title\";s:6:\"Events\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:6:\"events\";s:10:\"id_section\";s:1:\"6\";s:12:\"id_menu_type\";s:1:\"1\";s:9:\"link_menu\";s:10:\"events.php\";s:9:\"metawords\";s:15:\"events,calendar\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:9;a:11:{s:2:\"id\";s:1:\"9\";s:5:\"title\";s:12:\"Infographics\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:12:\"infographics\";s:10:\"id_section\";s:1:\"5\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"gallery.php\";s:9:\"metawords\";s:12:\"infographics\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:5;a:11:{s:2:\"id\";s:1:\"5\";s:5:\"title\";s:9:\"Documents\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:9:\"documents\";s:10:\"id_section\";s:1:\"4\";s:12:\"id_menu_type\";s:1:\"1\";s:9:\"link_menu\";s:11:\"library.php\";s:9:\"metawords\";s:7:\"library\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:27;a:11:{s:2:\"id\";s:2:\"27\";s:5:\"title\";s:6:\"Forums\";s:11:\"title_alias\";s:17:\"Discussion Forums\";s:13:\"menu_seo_name\";s:6:\"forums\";s:10:\"id_section\";s:2:\"13\";s:12:\"id_menu_type\";s:1:\"1\";s:9:\"link_menu\";s:10:\"forums.php\";s:9:\"metawords\";s:23:\"communities,of,practice\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:10;a:11:{s:2:\"id\";s:2:\"10\";s:5:\"title\";s:10:\"Factsheets\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:10:\"factsheets\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:13:\"factsheet.php\";s:9:\"metawords\";s:10:\"factsheets\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:34;a:11:{s:2:\"id\";s:2:\"34\";s:5:\"title\";s:5:\"CIDPs\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:5:\"cidps\";s:10:\"id_section\";s:1:\"7\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"library.php\";s:9:\"metawords\";s:5:\"cidps\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:32;a:11:{s:2:\"id\";s:2:\"32\";s:5:\"title\";s:15:\"Legal Documents\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:15:\"legal-documents\";s:10:\"id_section\";s:1:\"7\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"library.php\";s:9:\"metawords\";s:15:\"legal,documents\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:14;a:11:{s:2:\"id\";s:2:\"14\";s:5:\"title\";s:13:\"Presentations\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:13:\"presentations\";s:10:\"id_section\";s:1:\"7\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"library.php\";s:9:\"metawords\";s:21:\"lecture,presentations\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:33;a:11:{s:2:\"id\";s:2:\"33\";s:5:\"title\";s:7:\"Reports\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:7:\"reports\";s:10:\"id_section\";s:1:\"7\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"library.php\";s:9:\"metawords\";s:7:\"reports\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:25;a:11:{s:2:\"id\";s:2:\"25\";s:5:\"title\";s:9:\"Galleries\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:9:\"galleries\";s:10:\"id_section\";s:1:\"9\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"gallery.php\";s:9:\"metawords\";s:7:\"gallery\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:30;a:11:{s:2:\"id\";s:2:\"30\";s:5:\"title\";s:17:\"National Projects\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:17:\"national-projects\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:1:\"2\";s:9:\"link_menu\";s:11:\"mapping.php\";s:9:\"metawords\";s:17:\"national,projects\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:37;a:11:{s:2:\"id\";s:2:\"37\";s:5:\"title\";s:14:\"Privacy Policy\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:14:\"privacy-policy\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:1:\"5\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:14:\"privacy,policy\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:36;a:11:{s:2:\"id\";s:2:\"36\";s:5:\"title\";s:12:\"Terms of Use\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:12:\"terms-of-use\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:1:\"5\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:12:\"terms,of,use\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:35;a:11:{s:2:\"id\";s:2:\"35\";s:5:\"title\";s:6:\"More +\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:4:\"more\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:1:\"6\";s:9:\"link_menu\";s:1:\"#\";s:9:\"metawords\";s:4:\"more\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:15;a:11:{s:2:\"id\";s:2:\"15\";s:5:\"title\";s:8:\"Resource\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:8:\"resource\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:1:\"7\";s:9:\"link_menu\";s:12:\"resource.php\";s:9:\"metawords\";s:8:\"resource\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:16;a:11:{s:2:\"id\";s:2:\"16\";s:5:\"title\";s:19:\"Tag: Classification\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:14:\"classification\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:2:\"10\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:14:\"classification\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:19;a:11:{s:2:\"id\";s:2:\"19\";s:5:\"title\";s:10:\"Case Study\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:10:\"case-study\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:2:\"10\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:10:\"case,study\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:17;a:11:{s:2:\"id\";s:2:\"17\";s:5:\"title\";s:13:\"Good Practice\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:13:\"good-practice\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:2:\"10\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:13:\"good,practice\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:18;a:11:{s:2:\"id\";s:2:\"18\";s:5:\"title\";s:10:\"Innovation\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:10:\"innovation\";s:10:\"id_section\";s:1:\"1\";s:12:\"id_menu_type\";s:2:\"10\";s:9:\"link_menu\";s:11:\"content.php\";s:9:\"metawords\";s:10:\"innovation\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:6;a:11:{s:2:\"id\";s:1:\"6\";s:5:\"title\";s:8:\"Contacts\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:8:\"contacts\";s:10:\"id_section\";s:2:\"11\";s:12:\"id_menu_type\";s:1:\"5\";s:9:\"link_menu\";s:11:\"contact.php\";s:9:\"metawords\";s:8:\"contacts\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}i:29;a:11:{s:2:\"id\";s:2:\"29\";s:5:\"title\";s:7:\"Sitemap\";s:11:\"title_alias\";s:0:\"\";s:13:\"menu_seo_name\";s:7:\"sitemap\";s:10:\"id_section\";s:1:\"8\";s:12:\"id_menu_type\";s:1:\"5\";s:9:\"link_menu\";s:11:\"sitemap.php\";s:9:\"metawords\";s:7:\"sitemap\";s:9:\"to_footer\";s:1:\"0\";s:8:\"to_quick\";s:1:\"0\";s:9:\"id_access\";s:1:\"1\";}}s:4:\"type\";a:7:{i:1;a:6:{i:1;s:1:\"1\";i:31;s:2:\"31\";i:26;s:2:\"26\";i:13;s:2:\"13\";i:5;s:1:\"5\";i:27;s:2:\"27\";}s:5:\"_tree\";a:12:{i:1;s:1:\"1\";i:2;s:1:\"2\";i:31;s:2:\"31\";i:26;s:2:\"26\";i:13;s:2:\"13\";i:5;s:1:\"5\";i:27;s:2:\"27\";i:37;s:2:\"37\";i:36;s:2:\"36\";i:35;s:2:\"35\";i:6;s:1:\"6\";i:29;s:2:\"29\";}i:2;a:10:{i:11;s:2:\"11\";i:12;s:2:\"12\";i:9;s:1:\"9\";i:10;s:2:\"10\";i:34;s:2:\"34\";i:32;s:2:\"32\";i:14;s:2:\"14\";i:33;s:2:\"33\";i:25;s:2:\"25\";i:30;s:2:\"30\";}i:5;a:5:{i:2;s:1:\"2\";i:37;s:2:\"37\";i:36;s:2:\"36\";i:6;s:1:\"6\";i:29;s:2:\"29\";}i:6;a:1:{i:35;s:2:\"35\";}i:7;a:1:{i:15;s:2:\"15\";}i:10;a:4:{i:16;s:2:\"16\";i:19;s:2:\"19\";i:17;s:2:\"17\";i:18;s:2:\"18\";}}s:7:\"section\";a:13:{i:10;a:1:{i:1;s:1:\"1\";}i:13;a:2:{i:11;s:2:\"11\";i:27;s:2:\"27\";}i:1;a:11:{i:2;s:1:\"2\";i:10;s:2:\"10\";i:30;s:2:\"30\";i:37;s:2:\"37\";i:36;s:2:\"36\";i:35;s:2:\"35\";i:15;s:2:\"15\";i:16;s:2:\"16\";i:19;s:2:\"19\";i:17;s:2:\"17\";i:18;s:2:\"18\";}i:20;a:1:{i:31;s:2:\"31\";}i:2;a:1:{i:12;s:2:\"12\";}i:15;a:1:{i:26;s:2:\"26\";}i:6;a:1:{i:13;s:2:\"13\";}i:5;a:1:{i:9;s:1:\"9\";}i:4;a:1:{i:5;s:1:\"5\";}i:7;a:4:{i:34;s:2:\"34\";i:32;s:2:\"32\";i:14;s:2:\"14\";i:33;s:2:\"33\";}i:9;a:1:{i:25;s:2:\"25\";}i:11;a:1:{i:6;s:1:\"6\";}i:8;a:1:{i:29;s:2:\"29\";}}s:3:\"seo\";a:27:{s:4:\"home\";s:1:\"1\";s:23:\"experiences-innovations\";s:2:\"11\";s:5:\"about\";s:1:\"2\";s:8:\"counties\";s:2:\"31\";s:13:\"news-articles\";s:2:\"12\";s:19:\"sectoral-committees\";s:2:\"26\";s:6:\"events\";s:2:\"13\";s:12:\"infographics\";s:1:\"9\";s:9:\"documents\";s:1:\"5\";s:6:\"forums\";s:2:\"27\";s:10:\"factsheets\";s:2:\"10\";s:5:\"cidps\";s:2:\"34\";s:15:\"legal-documents\";s:2:\"32\";s:13:\"presentations\";s:2:\"14\";s:7:\"reports\";s:2:\"33\";s:9:\"galleries\";s:2:\"25\";s:17:\"national-projects\";s:2:\"30\";s:14:\"privacy-policy\";s:2:\"37\";s:12:\"terms-of-use\";s:2:\"36\";s:4:\"more\";s:2:\"35\";s:8:\"resource\";s:2:\"15\";s:14:\"classification\";s:2:\"16\";s:10:\"case-study\";s:2:\"19\";s:13:\"good-practice\";s:2:\"17\";s:10:\"innovation\";s:2:\"18\";s:8:\"contacts\";s:1:\"6\";s:7:\"sitemap\";s:2:\"29\";}s:5:\"child\";a:4:{i:35;a:4:{i:11;s:2:\"11\";i:12;s:2:\"12\";i:25;s:2:\"25\";i:30;s:2:\"30\";}i:3;a:2:{i:9;s:1:\"9\";i:10;s:2:\"10\";}i:5;a:4:{i:34;s:2:\"34\";i:32;s:2:\"32\";i:14;s:2:\"14\";i:33;s:2:\"33\";}i:16;a:3:{i:19;s:2:\"19\";i:17;s:2:\"17\";i:18;s:2:\"18\";}}s:3:\"mom\";a:1:{s:5:\"_link\";a:13:{i:11;s:2:\"35\";i:12;s:2:\"35\";i:9;s:1:\"3\";i:10;s:1:\"3\";i:34;s:1:\"5\";i:32;s:1:\"5\";i:14;s:1:\"5\";i:33;s:1:\"5\";i:25;s:2:\"35\";i:30;s:2:\"35\";i:19;s:2:\"16\";i:17;s:2:\"16\";i:18;s:2:\"16\";}}s:6:\"dircat\";a:2:{s:23:\"experiences-innovations\";s:25:\"Experiences & Innovations\";s:6:\"forums\";s:6:\"Forums\";}s:9:\"_modstamp\";s:10:\"1529292256\";}'),
('resourceChest', 1528271989, '');

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_conf_choices`
--

DROP TABLE IF EXISTS `mrfc_conf_choices`;
CREATE TABLE `mrfc_conf_choices` (
  `choice_id` int(11) NOT NULL,
  `choice_cat` varchar(150) NOT NULL,
  `choice_item` varchar(500) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_conf_choices`
--

INSERT INTO `mrfc_conf_choices` (`choice_id`, `choice_cat`, `choice_item`, `published`) VALUES
(1, 'cmte_role_id', 'Chair Person', 1),
(2, 'cmte_role_id', 'Vice Chair', 1),
(3, 'cmte_role_id', 'Member', 1),
(4, 'cmte_role_id', 'Whip', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_conf_tags`
--

DROP TABLE IF EXISTS `mrfc_conf_tags`;
CREATE TABLE `mrfc_conf_tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL,
  `tag_category` varchar(50) DEFAULT NULL,
  `tag_item_id` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dat_contributions`
--

DROP TABLE IF EXISTS `mrfc_dat_contributions`;
CREATE TABLE `mrfc_dat_contributions` (
  `contrib_id` int(11) NOT NULL,
  `contrib_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `poster_id` int(11) NOT NULL,
  `poster_email` varchar(50) NOT NULL,
  `post_title` mediumtext NOT NULL,
  `post_type` mediumtext NOT NULL,
  `post_description` longtext NOT NULL,
  `post_dated` date NOT NULL,
  `post_county` int(11) NOT NULL,
  `post_resources` text,
  `post_resources_num` int(11) NOT NULL,
  `post_comments` text,
  `contrib_comments` text,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `approved_by` int(11) DEFAULT NULL,
  `archived` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dat_functions`
--

DROP TABLE IF EXISTS `mrfc_dat_functions`;
CREATE TABLE `mrfc_dat_functions` (
  `function_id` int(11) NOT NULL,
  `function` varchar(100) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_dat_functions`
--

INSERT INTO `mrfc_dat_functions` (`function_id`, `function`, `published`) VALUES
(1, 'Agriculture, ASAL', 1),
(2, 'Citizen Engagement', 1),
(3, 'Education, Gender, Youth, Sports, Culture &amp; Social Services', 1),
(4, 'Health', 1),
(5, 'Infrastructure and Energy', 1),
(6, 'Trade, Industry and Investment', 1),
(7, 'Urban Development, Planning and Lands', 1),
(8, 'Water, Forestry and Mining', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dat_indicator`
--

DROP TABLE IF EXISTS `mrfc_dat_indicator`;
CREATE TABLE `mrfc_dat_indicator` (
  `indicator_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `indicator` varchar(150) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dat_statistics`
--

DROP TABLE IF EXISTS `mrfc_dat_statistics`;
CREATE TABLE `mrfc_dat_statistics` (
  `stats_id` int(11) NOT NULL,
  `stats_year` int(11) NOT NULL COMMENT 'collection period',
  `county_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `value` decimal(15,2) DEFAULT NULL,
  `value_label` varchar(50) DEFAULT NULL,
  `comments` tinytext,
  `date_record` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `approved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dd_menu_type`
--

DROP TABLE IF EXISTS `mrfc_dd_menu_type`;
CREATE TABLE `mrfc_dd_menu_type` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(125) DEFAULT NULL,
  `child` tinyint(4) NOT NULL DEFAULT '1',
  `is_static` tinyint(4) NOT NULL DEFAULT '0',
  `path_call` varchar(10) NOT NULL DEFAULT 'com',
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `seq` int(11) NOT NULL DEFAULT '9'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_dd_menu_type`
--

INSERT INTO `mrfc_dd_menu_type` (`id`, `title`, `description`, `child`, `is_static`, `path_call`, `published`, `seq`) VALUES
(1, 'Main Category', NULL, 0, 0, 'com', 1, 1),
(2, 'Child Category', NULL, 1, 0, 'com', 1, 2),
(3, 'Page Tabs', NULL, 1, 0, 'com', 1, 9),
(4, 'Menu Group Title', NULL, 0, 0, 'com', 1, 9),
(5, 'Footer', NULL, 1, 0, 'com', 1, 5),
(6, 'Header', NULL, 1, 0, 'com', 1, 3),
(7, 'Custom Pages', NULL, 1, 0, 'com', 1, 9),
(8, 'Useful / External Link', NULL, 1, 0, 'com', 1, 9),
(9, 'Tabs - Custom Child Link', NULL, 1, 0, 'com', 0, 9),
(10, 'Custom Tags', NULL, 1, 0, 'com', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dd_sections`
--

DROP TABLE IF EXISTS `mrfc_dd_sections`;
CREATE TABLE `mrfc_dd_sections` (
  `id` int(11) NOT NULL,
  `section_cat` enum('menu','cont','all') NOT NULL DEFAULT 'all',
  `title` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `seq` int(11) NOT NULL DEFAULT '9'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_dd_sections`
--

INSERT INTO `mrfc_dd_sections` (`id`, `section_cat`, `title`, `link`, `published`, `seq`) VALUES
(1, 'all', 'Basic Content', 'content.php', 1, 1),
(2, 'all', 'News Content', 'content.php', 1, 2),
(3, 'all', 'Collapsing Content', 'contacc.php', 1, 4),
(4, 'menu', 'Downloads - All', 'library.php', 1, 4),
(5, 'all', 'Gallery Album - Images & Videos', 'gallery.php', 1, 9),
(6, 'all', 'Event Content', 'events.php', 1, 3),
(7, 'all', 'Downloads - Categorized', 'library.php', 1, 9),
(8, 'menu', 'Site Map', 'sitemap.php', 1, 9),
(9, 'all', 'Gallery', 'gallery.php', 1, 9),
(10, 'menu', 'Site Index', 'index.php', 1, 9),
(11, 'all', 'Contacts', 'contact.php', 1, 9),
(12, 'all', 'Press', 'news.php', 0, 9),
(13, 'all', 'Programmes', 'program.php', 1, 9),
(14, 'all', 'Forums', 'forums.php', 1, 9),
(15, 'menu', 'Sector Page', 'committees.php', 1, 9),
(16, 'all', 'Policies', 'policies.php', 0, 9),
(17, 'cont', 'Link Introduction', '#', 1, 9),
(18, 'all', 'Profiles', 'profiles.php', 1, 9),
(19, 'all', 'Project Reports', 'content.php', 0, 9),
(20, 'menu', 'County Page', 'counties.php', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_content`
--

DROP TABLE IF EXISTS `mrfc_dt_content`;
CREATE TABLE `mrfc_dt_content` (
  `id` int(11) NOT NULL,
  `id_portal` int(11) NOT NULL DEFAULT '1',
  `id_menu` int(11) NOT NULL,
  `id_menu2` int(11) DEFAULT NULL,
  `id_section` int(11) NOT NULL,
  `id_access` int(11) NOT NULL DEFAULT '1',
  `parent` tinytext NOT NULL,
  `title` mediumtext NOT NULL,
  `title_sub` mediumtext,
  `url_title_article` varchar(500) DEFAULT NULL,
  `article` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_expire` bigint(20) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hits` int(11) NOT NULL,
  `id_owner` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_by` int(11) DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `frontpage` tinyint(4) NOT NULL DEFAULT '0',
  `sidebar` tinyint(4) NOT NULL DEFAULT '0',
  `intro_home` tinyint(4) NOT NULL DEFAULT '0',
  `intro_hlight` tinyint(4) NOT NULL DEFAULT '0',
  `yn_gallery` tinyint(1) NOT NULL DEFAULT '0',
  `yn_static` tinyint(1) DEFAULT '0',
  `arr_images` text,
  `arr_extras` longtext,
  `article_keywords` varchar(250) NOT NULL,
  `article_metadesc` varchar(250) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL DEFAULT '1',
  `allow_rating` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(250) DEFAULT NULL,
  `link_static` int(11) DEFAULT NULL,
  `seq` tinyint(4) NOT NULL DEFAULT '9'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_content_dates`
--

DROP TABLE IF EXISTS `mrfc_dt_content_dates`;
CREATE TABLE `mrfc_dt_content_dates` (
  `date_record_id` int(11) NOT NULL,
  `id_portal` int(11) NOT NULL DEFAULT '1',
  `id_content` int(8) UNSIGNED DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `venue` text,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_content_parent`
--

DROP TABLE IF EXISTS `mrfc_dt_content_parent`;
CREATE TABLE `mrfc_dt_content_parent` (
  `id_portal` int(11) NOT NULL DEFAULT '1',
  `id_content` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_content_posts`
--

DROP TABLE IF EXISTS `mrfc_dt_content_posts`;
CREATE TABLE `mrfc_dt_content_posts` (
  `id_comment` int(11) NOT NULL,
  `id_content` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `comment` text,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmed_by` int(11) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_downloads`
--

DROP TABLE IF EXISTS `mrfc_dt_downloads`;
CREATE TABLE `mrfc_dt_downloads` (
  `resource_id` int(11) NOT NULL,
  `resource_key` varchar(250) NOT NULL,
  `resource_title` mediumtext NOT NULL,
  `resource_slug` mediumtext,
  `resource_description` text,
  `resource_file` mediumtext NOT NULL,
  `resource_mime` varchar(250) DEFAULT NULL,
  `resource_extension` varchar(10) DEFAULT NULL,
  `resource_size` int(11) NOT NULL DEFAULT '0',
  `date_created` date DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `resource_tags` text,
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `publisher` mediumtext,
  `status` varchar(50) DEFAULT NULL,
  `content_type` text,
  `devolved_functions` text,
  `hits` int(11) NOT NULL DEFAULT '0',
  `alternative_title` mediumtext,
  `year_published` varchar(50) DEFAULT NULL,
  `source_url` mediumtext,
  `language` varchar(50) DEFAULT NULL,
  `file_type` varchar(5) DEFAULT NULL,
  `file_upload_name` mediumtext,
  `resource_image` varchar(100) DEFAULT NULL,
  `access_id` int(11) NOT NULL DEFAULT '1',
  `featured` int(1) NOT NULL DEFAULT '0',
  `posted_by` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `admin_approve` varchar(5) DEFAULT NULL,
  `tweet_action` int(11) NOT NULL DEFAULT '0',
  `seq` int(11) NOT NULL DEFAULT '9',
  `published` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_downloads_parent`
--

DROP TABLE IF EXISTS `mrfc_dt_downloads_parent`;
CREATE TABLE `mrfc_dt_downloads_parent` (
  `resource_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL DEFAULT '0',
  `id_content` int(11) NOT NULL DEFAULT '0',
  `county_id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL,
  `res_type_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `id_portal` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_downloads_type`
--

DROP TABLE IF EXISTS `mrfc_dt_downloads_type`;
CREATE TABLE `mrfc_dt_downloads_type` (
  `res_type_id` int(11) NOT NULL,
  `download_type` varchar(255) NOT NULL,
  `res_type_seo` varchar(250) NOT NULL,
  `resource_id` varchar(255) NOT NULL DEFAULT '0,',
  `seq` int(11) NOT NULL DEFAULT '10',
  `published` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_feedback`
--

DROP TABLE IF EXISTS `mrfc_dt_feedback`;
CREATE TABLE `mrfc_dt_feedback` (
  `id` int(11) NOT NULL,
  `id_portal` int(11) NOT NULL DEFAULT '1',
  `date_record` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `details` mediumtext NOT NULL,
  `ipaddress` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_gallery_category`
--

DROP TABLE IF EXISTS `mrfc_dt_gallery_category`;
CREATE TABLE `mrfc_dt_gallery_category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `gall_code` varchar(20) NOT NULL,
  `gall_path` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `seq` int(11) NOT NULL DEFAULT '9'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_dt_gallery_category`
--

INSERT INTO `mrfc_dt_gallery_category` (`id`, `title`, `gall_code`, `gall_path`, `description`, `published`, `seq`) VALUES
(1, 'Home Banner - Main', 'banner', 'gallery/', NULL, 1, 9),
(2, 'Content Gallery', 'gallery', 'gallery/', NULL, 1, 9),
(3, 'Menu Avatar', 'menu', 'gallery/', NULL, 0, 9),
(4, 'Home Banner - Side', 'banner_side', 'gallery/', NULL, 0, 9),
(5, 'Resource Cover', 'product', 'products/', NULL, 1, 9),
(6, 'Logos', 'logo', 'gallery/', NULL, 0, 9),
(7, 'Project Gallery', 'gallery_project', 'gallery/', NULL, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_gallery_photos`
--

DROP TABLE IF EXISTS `mrfc_dt_gallery_photos`;
CREATE TABLE `mrfc_dt_gallery_photos` (
  `id` int(11) NOT NULL,
  `id_portal` int(11) NOT NULL DEFAULT '1',
  `id_gallery_cat` int(11) NOT NULL DEFAULT '1',
  `title` varchar(150) NOT NULL,
  `title_sub` varchar(250) DEFAULT NULL,
  `description` mediumtext,
  `filename` varchar(100) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(50) NOT NULL DEFAULT 'p',
  `date_posted` datetime NOT NULL,
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tags` mediumtext,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `seq` int(11) NOT NULL DEFAULT '9'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_gallery_photos_parent`
--

DROP TABLE IF EXISTS `mrfc_dt_gallery_photos_parent`;
CREATE TABLE `mrfc_dt_gallery_photos_parent` (
  `id_portal` int(11) NOT NULL DEFAULT '1',
  `id_photo` int(11) NOT NULL,
  `parent_type` varchar(20) NOT NULL DEFAULT '_cont',
  `parent_id` int(11) NOT NULL,
  `id_link` int(11) NOT NULL DEFAULT '0',
  `id_content` int(11) NOT NULL DEFAULT '0',
  `id_product` int(11) NOT NULL DEFAULT '0',
  `id_resource` int(11) NOT NULL DEFAULT '0',
  `id_partner` int(11) NOT NULL DEFAULT '0',
  `rec_stamp` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_menu`
--

DROP TABLE IF EXISTS `mrfc_dt_menu`;
CREATE TABLE `mrfc_dt_menu` (
  `id` int(11) NOT NULL,
  `id_portal` int(11) NOT NULL DEFAULT '1',
  `title` varchar(200) NOT NULL,
  `title_alias` varchar(200) DEFAULT NULL,
  `title_brief` varchar(100) NOT NULL,
  `title_options` mediumtext NOT NULL,
  `id_section` int(11) NOT NULL,
  `id_type_menu` int(11) NOT NULL,
  `parent` tinytext,
  `id_parent1` int(11) DEFAULT NULL,
  `id_parent2` int(11) DEFAULT NULL,
  `description` mediumtext,
  `link` varchar(200) DEFAULT NULL,
  `title_seo` varchar(200) DEFAULT NULL,
  `image` varchar(125) DEFAULT NULL,
  `id_access` int(11) NOT NULL DEFAULT '1',
  `target` varchar(50) NOT NULL DEFAULT '_self',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `date_update` bigint(20) NOT NULL,
  `hits` int(11) NOT NULL,
  `metawords` mediumtext,
  `image_show` tinyint(1) NOT NULL DEFAULT '0',
  `static` tinyint(4) NOT NULL DEFAULT '0',
  `quicklink` tinyint(1) NOT NULL DEFAULT '0',
  `seq` tinyint(4) NOT NULL DEFAULT '9'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_dt_menu`
--

INSERT INTO `mrfc_dt_menu` (`id`, `id_portal`, `title`, `title_alias`, `title_brief`, `title_options`, `id_section`, `id_type_menu`, `parent`, `id_parent1`, `id_parent2`, `description`, `link`, `title_seo`, `image`, `id_access`, `target`, `created`, `published`, `date_update`, `hits`, `metawords`, `image_show`, `static`, `quicklink`, `seq`) VALUES
(1, 1, 'Home', '', 'Home', '', 10, 1, NULL, NULL, NULL, '', '', 'home', '', 1, '_self', '2018-03-03 08:17:47', 1, 1526727393, 0, 'home', 0, 0, 0, 0),
(2, 1, 'About', 'About Maarifa Centre', 'About Maarifa', '', 1, 5, NULL, NULL, NULL, '', '', 'about', '', 1, '_self', '2018-03-03 08:18:19', 1, 1527248945, 0, 'about,maarifa', 0, 0, 0, 1),
(3, 1, 'County Data', '', 'County Data', '', 1, 6, NULL, NULL, NULL, '', 'data.php', 'county-data', '', 1, '_self', '2018-03-03 08:20:49', 0, 1525782113, 0, 'county,data', 0, 0, 0, 4),
(4, 1, 'Knowledge', 'Knowledge Centre', 'Knowledge', '', 1, 2, NULL, NULL, NULL, '', '#', 'knowledge', '', 1, '_self', '2018-03-03 08:21:22', 0, 1526287606, 0, 'knowledge', 0, 0, 0, 6),
(5, 1, 'Documents', '', 'Library', '', 4, 1, '', NULL, 0, '', '', 'documents', '', 1, '_self', '2018-03-03 08:21:43', 1, 1525781938, 0, 'library', 0, 0, 0, 8),
(6, 1, 'Contacts', '', 'Contacts', '', 11, 5, NULL, NULL, NULL, '', '', 'contacts', '', 1, '_self', '2018-03-03 08:22:15', 1, 1527248920, 0, 'contacts', 0, 0, 0, 10),
(7, 1, 'Budget Data', '', 'Budget Data', '', 1, 2, NULL, NULL, NULL, '', '', 'budget-data', '', 1, '_self', '2018-03-03 08:29:53', 0, 1520309081, 0, 'budget,data', 0, 0, 0, 1),
(8, 1, 'Indicators', '', 'Indicators', '', 1, 5, NULL, NULL, NULL, '', '', 'indicators', '', 1, '_self', '2018-03-03 08:30:09', 0, 1528590490, 0, 'indicators', 0, 0, 0, 3),
(9, 1, 'Infographics', '', 'Infographics', '', 5, 2, NULL, NULL, NULL, '', '', 'infographics', '', 1, '_self', '2018-03-03 08:30:24', 1, 1521971240, 0, 'infographics', 0, 0, 0, 5),
(10, 1, 'Factsheets', '', 'Factsheets', '', 1, 2, NULL, NULL, NULL, '', 'factsheet.php', 'factsheets', '', 1, '_self', '2018-03-03 08:30:36', 1, 1520309137, 0, 'factsheets', 0, 0, 0, 9),
(11, 1, 'Experiences &amp; Innovations', '', 'Good Practices &amp; Innovations', '', 13, 2, NULL, NULL, NULL, '', '', 'experiences-innovations', '', 1, '_self', '2018-03-03 08:31:07', 1, 1526287540, 0, 'good,practices,innovations', 0, 0, 0, 1),
(12, 1, 'News Articles', '', 'News Articles', '', 2, 2, NULL, NULL, NULL, '', '', 'news-articles', '', 1, '_self', '2018-03-03 08:31:26', 1, 1526287568, 0, 'news,articles', 0, 0, 0, 3),
(13, 1, 'Events', '', 'Events Calendar', '', 6, 1, 'a:1:{i:0;s:1:\"4\";}', NULL, 0, '', '', 'events', '', 1, '_self', '2018-03-03 08:31:41', 1, 1527249092, 0, 'events,calendar', 0, 0, 0, 5),
(14, 1, 'Presentations', '', 'Lecture Presentations', '', 7, 2, NULL, NULL, NULL, '', '', 'presentations', '', 1, '_self', '2018-03-03 08:33:08', 1, 1525783391, 0, 'lecture,presentations', 0, 0, 0, 9),
(15, 1, 'Resource', '', 'Resource', '', 1, 7, NULL, NULL, NULL, NULL, 'resource.php', 'resource', '', 1, '_self', '2018-03-03 10:02:03', 1, 1520071323, 0, 'resource', 0, 0, 0, 9),
(16, 1, 'Tag: Classification', '', 'Classification', '', 1, 10, '', NULL, 0, '', '', 'classification', '', 1, '_self', '2018-03-03 10:02:42', 1, 1520072014, 0, 'classification', 0, 0, 0, 9),
(17, 1, 'Good Practice', '', 'Good Practice', '', 1, 10, 'a:1:{i:0;s:2:\"16\";}', NULL, 0, '', '', 'good-practice', '', 1, '_self', '2018-03-03 10:07:46', 1, 1520085446, 0, 'good,practice', 0, 0, 0, 9),
(18, 1, 'Innovation', '', 'Innovation', '', 1, 10, 'a:1:{i:0;s:2:\"16\";}', NULL, 0, '', '', 'innovation', '', 1, '_self', '2018-03-03 10:08:36', 1, 1520083940, 0, 'innovation', 0, 0, 0, 9),
(19, 1, 'Case Study', '', 'Case Study', '', 1, 10, NULL, NULL, NULL, '', '', 'case-study', '', 1, '_self', '2018-03-03 10:08:59', 1, 1520085383, 0, 'case,study', 0, 0, 0, 9),
(20, 1, 'Tag: Committees', '', 'Committees', '', 1, 10, '', NULL, 0, '', '', 'committees', '', 1, '_self', '2018-03-03 10:11:57', 0, 1521265498, 0, 'committees', 0, 0, 0, 9),
(21, 1, 'Health', '', 'Health', '', 1, 10, NULL, NULL, NULL, '', '', 'health', '', 1, '_self', '2018-03-03 10:12:51', 0, 1521265461, 0, 'health', 0, 0, 0, 9),
(22, 1, 'Agriculture', '', 'Agriculture', '', 1, 10, NULL, NULL, NULL, '', '', 'agriculture', '', 1, '_self', '2018-03-03 10:14:55', 0, 1521265467, 0, 'agriculture', 0, 0, 0, 9),
(23, 1, 'Arid and Semi-Arid Land', 'ASAL', 'Arid and Semi-Arid Land', '', 1, 10, NULL, NULL, NULL, '', '', 'arid-and-semi-arid-land', '', 1, '_self', '2018-03-03 10:15:35', 0, 1521265479, 0, 'arid,semi,arid,land', 0, 0, 0, 9),
(24, 1, 'Speeches', '', 'Speeches', '', 7, 2, NULL, NULL, NULL, '', '', 'speeches', '', 1, '_self', '2018-03-04 22:48:58', 0, 1523066521, 0, 'speeches', 0, 0, 0, 9),
(25, 1, 'Galleries', '', 'Gallery', '', 9, 2, NULL, NULL, NULL, '', '', 'galleries', '', 1, '_self', '2018-03-05 13:03:22', 1, 1526542281, 0, 'gallery', 0, 0, 0, 9),
(26, 1, 'Sectors', '', 'CoG Committees', '', 15, 1, NULL, NULL, NULL, '', '', 'sectoral-committees', '', 1, '_self', '2018-03-05 13:57:58', 1, 1525786604, 0, 'cog,committees', 0, 0, 0, 4),
(27, 1, 'Forums', 'Discussion Forums', 'Communities of Practice', '', 13, 1, NULL, NULL, NULL, '', 'forums.php', 'forums', '', 1, '_self', '2018-03-05 14:03:14', 1, 1527249117, 0, 'communities,of,practice', 0, 0, 0, 9),
(28, 1, 'Committee Forums A', '', 'Committee Forums', '', 14, 2, NULL, NULL, NULL, '', '', 'committee-forums', '', 1, '_self', '2018-03-06 06:24:54', 0, 1526102526, 0, 'committee,forums', 0, 0, 0, 3),
(29, 1, 'Sitemap', '', 'Sitemap', '', 8, 5, NULL, NULL, NULL, '', '', 'sitemap', '', 1, '_self', '2018-03-06 06:27:07', 1, 1526727377, 0, 'sitemap', 0, 0, 0, 19),
(30, 1, 'National Projects', '', 'National Projects', '', 1, 2, NULL, NULL, NULL, '', 'mapping.php', 'national-projects', '', 1, '_self', '2018-03-22 14:29:27', 1, 1529292256, 0, 'national,projects', 0, 0, 0, 9),
(31, 1, 'Counties', '', 'Counties', '', 20, 1, NULL, NULL, NULL, '', '', 'counties', '', 1, '_self', '2018-03-28 06:53:50', 1, 1522226266, 0, 'counties', 0, 0, 0, 2),
(32, 1, 'Legal Documents', '', 'Legal Documents', '', 7, 2, NULL, NULL, NULL, NULL, '', 'legal-documents', '', 1, '_self', '2018-05-08 12:37:37', 1, 1525783057, 0, 'legal,documents', 0, 0, 0, 9),
(33, 1, 'Reports', '', 'Reports', '', 7, 2, NULL, NULL, NULL, NULL, '', 'reports', '', 1, '_self', '2018-05-08 12:38:01', 1, 1525783081, 0, 'reports', 0, 0, 0, 9),
(34, 1, 'CIDPs', '', 'CIDPs', '', 7, 2, NULL, NULL, NULL, '', '', 'cidps', '', 1, '_self', '2018-05-08 13:46:54', 1, 1525787702, 0, 'cidps', 0, 0, 0, 9),
(35, 1, 'More +', '', 'More', '', 1, 6, NULL, NULL, NULL, '', '#', 'more', '', 1, '_self', '2018-05-14 08:45:01', 1, 1526542244, 0, 'more', 0, 0, 0, 9),
(36, 1, 'Terms of Use', '', 'Terms of Use', '', 1, 5, NULL, NULL, NULL, '', '', 'terms-of-use', '', 1, '_self', '2018-05-19 10:29:54', 1, 1526727335, 0, 'terms,of,use', 0, 0, 0, 9),
(37, 1, 'Privacy Policy', '', 'Privacy Policy', '', 1, 5, NULL, NULL, NULL, NULL, '', 'privacy-policy', '', 1, '_self', '2018-05-19 10:51:29', 1, 1526727089, 0, 'privacy,policy', 0, 0, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_menu_parent`
--

DROP TABLE IF EXISTS `mrfc_dt_menu_parent`;
CREATE TABLE `mrfc_dt_menu_parent` (
  `id_portal` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_dt_menu_parent`
--

INSERT INTO `mrfc_dt_menu_parent` (`id_portal`, `id_menu`, `id_parent`) VALUES
(1, 4, 2),
(1, 7, 3),
(1, 9, 3),
(1, 10, 3),
(1, 11, 35),
(1, 12, 35),
(1, 14, 5),
(1, 17, 16),
(1, 18, 16),
(1, 19, 16),
(1, 21, 20),
(1, 22, 20),
(1, 23, 20),
(1, 24, 5),
(1, 25, 35),
(1, 28, 26),
(1, 30, 35),
(1, 32, 5),
(1, 33, 5),
(1, 34, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_user_posts`
--

DROP TABLE IF EXISTS `mrfc_dt_user_posts`;
CREATE TABLE `mrfc_dt_user_posts` (
  `comment_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply_comment_id` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `approved_by` int(11) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_dt_user_ratings`
--

DROP TABLE IF EXISTS `mrfc_dt_user_ratings`;
CREATE TABLE `mrfc_dt_user_ratings` (
  `rec_category` varchar(20) NOT NULL,
  `rec_id` varchar(11) NOT NULL,
  `total_votes` int(11) NOT NULL DEFAULT '0',
  `total_value` int(11) NOT NULL DEFAULT '0',
  `used_ips` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_forum_categories`
--

DROP TABLE IF EXISTS `mrfc_forum_categories`;
CREATE TABLE `mrfc_forum_categories` (
  `cat_id` int(8) NOT NULL,
  `cat_name` varchar(510) NOT NULL,
  `cat_description` text NOT NULL,
  `cat_current` tinyint(1) NOT NULL DEFAULT '0',
  `cat_published` tinyint(1) NOT NULL DEFAULT '0',
  `cat_by` int(11) NOT NULL,
  `cat_date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cat_date_close` datetime DEFAULT NULL,
  `committee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_forum_categories`
--

INSERT INTO `mrfc_forum_categories` (`cat_id`, `cat_name`, `cat_description`, `cat_current`, `cat_published`, `cat_by`, `cat_date_start`, `cat_date_close`, `committee_id`) VALUES
(2, 'CoG Community Forum', '', 0, 1, 1, '2014-05-26 09:47:40', NULL, NULL),
(3, 'Maarifa Training Committee', '', 0, 1, 1, '2015-07-08 10:00:26', NULL, NULL),
(4, 'Agriculture', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 1),
(5, 'Arid & Semi-Arid Land (ASAL)', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 1),
(6, 'Cooperatives & Enterprise Development', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 15),
(7, 'Education', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 4),
(8, 'Finance, Commerce & Economic Affairs', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 5),
(9, 'Health', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 6),
(10, 'Human Resources, Labour & Social Welfare', '', 0, 0, 0, '2018-03-06 08:50:56', NULL, NULL),
(11, 'Information, Technology & Communication', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 8),
(12, 'Infrastructure & Energy', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 9),
(13, 'Intergovernmental Relations', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, NULL),
(14, 'Legal Affairs & Human Rights', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 11),
(15, 'Resources Mobilization', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, NULL),
(16, 'Security & Foreign Affairs', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, NULL),
(17, 'Tourism & Wildlife', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 14),
(18, 'Trade and Co-operatives', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, 15),
(19, 'Urban Development, Planning & Lands', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, NULL),
(20, 'Water, Forestry & Mining', '', 0, 1, 0, '2018-03-06 08:50:56', NULL, NULL),
(21, 'Citizen Engagement', '&lt;p&gt;...&lt;/p&gt;', 1, 1, 0, '2018-05-25 11:03:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_forum_posts`
--

DROP TABLE IF EXISTS `mrfc_forum_posts`;
CREATE TABLE `mrfc_forum_posts` (
  `post_id` int(8) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL,
  `post_published` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_forum_topics`
--

DROP TABLE IF EXISTS `mrfc_forum_topics`;
CREATE TABLE `mrfc_forum_topics` (
  `topic_id` int(8) NOT NULL,
  `topic_subject` varchar(510) NOT NULL,
  `topic_description` text NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL,
  `topic_published` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_forum_users`
--

DROP TABLE IF EXISTS `mrfc_forum_users`;
CREATE TABLE `mrfc_forum_users` (
  `user_id` int(8) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_log_accounts`
--

DROP TABLE IF EXISTS `mrfc_log_accounts`;
CREATE TABLE `mrfc_log_accounts` (
  `id` int(11) NOT NULL,
  `id_account` varchar(50) DEFAULT NULL,
  `log_desc` tinytext NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_cat_name` varchar(50) DEFAULT NULL,
  `log_cat_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_log_keywords`
--

DROP TABLE IF EXISTS `mrfc_log_keywords`;
CREATE TABLE `mrfc_log_keywords` (
  `keyword` varchar(50) NOT NULL,
  `parent_type` enum('id_content','id_download','id_gallery','project_id') NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_poll_questions`
--

DROP TABLE IF EXISTS `mrfc_poll_questions`;
CREATE TABLE `mrfc_poll_questions` (
  `qid` int(11) NOT NULL,
  `subject` varchar(75) DEFAULT NULL,
  `question` text,
  `date` datetime DEFAULT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `date_end` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrfc_poll_questions`
--

INSERT INTO `mrfc_poll_questions` (`qid`, `subject`, `question`, `date`, `show`, `date_end`, `published`) VALUES
(1, '', 'Are you satisfied with the CoG Intranet services / solutions so far?', '2014-10-01 04:20:22', 0, NULL, 1),
(2, '', 'Have you read the CoG Organization Profile', '2015-07-23 13:49:26', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_poll_responses`
--

DROP TABLE IF EXISTS `mrfc_poll_responses`;
CREATE TABLE `mrfc_poll_responses` (
  `rid` int(11) NOT NULL,
  `qid` int(11) DEFAULT NULL,
  `response` text,
  `votes` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_poll_voters`
--

DROP TABLE IF EXISTS `mrfc_poll_voters`;
CREATE TABLE `mrfc_poll_voters` (
  `vid` bigint(20) NOT NULL,
  `qid` int(11) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `date_record` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_account`
--

DROP TABLE IF EXISTS `mrfc_reg_account`;
CREATE TABLE `mrfc_reg_account` (
  `account_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `namefirst` varchar(50) DEFAULT NULL,
  `namelast` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email_other` varchar(50) DEFAULT NULL,
  `country` varchar(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `account_profile` text,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `ipaddress` varchar(20) DEFAULT NULL,
  `staff` tinyint(1) DEFAULT '0',
  `avatar` varchar(50) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `username` varchar(50) DEFAULT NULL,
  `usersalt` varchar(20) DEFAULT NULL,
  `userpass` varchar(50) DEFAULT NULL,
  `userauth` varchar(50) DEFAULT NULL,
  `remember_code` varchar(50) DEFAULT NULL,
  `uservalid` int(11) NOT NULL DEFAULT '0',
  `date_created` int(11) DEFAULT NULL,
  `date_lastlog` int(11) NOT NULL DEFAULT '0',
  `date_record` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_account_settings`
--

DROP TABLE IF EXISTS `mrfc_reg_account_settings`;
CREATE TABLE `mrfc_reg_account_settings` (
  `account_id` int(11) NOT NULL,
  `setting_id` varchar(50) NOT NULL,
  `setting_val` varchar(50) NOT NULL,
  `setting_update` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_cats`
--

DROP TABLE IF EXISTS `mrfc_reg_cats`;
CREATE TABLE `mrfc_reg_cats` (
  `id_category` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `title_url` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `system_cat` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_cats`
--

INSERT INTO `mrfc_reg_cats` (`id_category`, `title`, `title_url`, `description`, `system_cat`, `published`) VALUES
(1, 'Individual Registration', 'individual-account', '', 0, 1),
(2, 'Feedback Post', 'feedback-post', '', 0, 1),
(3, 'Mailing List', 'mailing-list', ' ', 0, 1),
(4, 'Corporate', 'corporate-account', NULL, 0, 1),
(6, 'Individual', 'individual', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_cats_links`
--

DROP TABLE IF EXISTS `mrfc_reg_cats_links`;
CREATE TABLE `mrfc_reg_cats_links` (
  `id_category` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `id_directory` int(11) NOT NULL,
  `pref_dataset` varchar(20) DEFAULT NULL,
  `rec_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_cats_links`
--

INSERT INTO `mrfc_reg_cats_links` (`id_category`, `account_id`, `id_directory`, `pref_dataset`, `rec_stamp`) VALUES
(3, 1, 0, '', '2017-09-07 08:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_community`
--

DROP TABLE IF EXISTS `mrfc_reg_community`;
CREATE TABLE `mrfc_reg_community` (
  `community_id` int(11) NOT NULL,
  `community_title` varchar(100) NOT NULL,
  `description` mediumtext,
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_community_accounts`
--

DROP TABLE IF EXISTS `mrfc_reg_community_accounts`;
CREATE TABLE `mrfc_reg_community_accounts` (
  `community_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_record` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_countries`
--

DROP TABLE IF EXISTS `mrfc_reg_countries`;
CREATE TABLE `mrfc_reg_countries` (
  `id` int(11) NOT NULL,
  `country` varchar(64) NOT NULL DEFAULT '',
  `country_code` varchar(10) NOT NULL DEFAULT '',
  `iso_code_1` char(2) NOT NULL DEFAULT '',
  `iso_code_2` char(3) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_countries`
--

INSERT INTO `mrfc_reg_countries` (`id`, `country`, `country_code`, `iso_code_1`, `iso_code_2`, `published`) VALUES
(1, 'Afghanistan', ' +93', 'AF', 'AFG', 1),
(2, 'Albania', ' +355', 'AL', 'ALB', 1),
(3, 'Algeria', ' +213', 'DZ', 'DZA', 1),
(4, 'American Samoa', ' +1-684', 'AS', 'ASM', 1),
(5, 'Andorra', ' +376', 'AD', 'AND', 1),
(6, 'Angola', ' +244', 'AO', 'AGO', 1),
(7, 'Anguilla', ' +1-264', 'AI', 'AIA', 1),
(8, 'Antarctica', ' +672', 'AQ', 'ATA', 1),
(9, 'Antigua and Barbuda', ' +1-268', 'AG', 'ATG', 1),
(10, 'Argentina', ' +54', 'AR', 'ARG', 1),
(11, 'Armenia', ' +374', 'AM', 'ARM', 1),
(12, 'Aruba', ' +297', 'AW', 'ABW', 1),
(13, 'Australia', ' +61', 'AU', 'AUS', 1),
(14, 'Austria', ' +43', 'AT', 'AUT', 1),
(15, 'Azerbaijan', ' +994', 'AZ', 'AZE', 1),
(16, 'Bahamas', ' +1-242', 'BS', 'BHS', 1),
(17, 'Bahrain', ' +973', 'BH', 'BHR', 1),
(18, 'Bangladesh', ' +880', 'BD', 'BGD', 1),
(19, 'Barbados', ' +1-246', 'BB', 'BRB', 1),
(20, 'Belarus', ' +375', 'BY', 'BLR', 1),
(21, 'Belgium', ' +32', 'BE', 'BEL', 1),
(22, 'Belize', ' +501', 'BZ', 'BLZ', 1),
(23, 'Benin', ' +229', 'BJ', 'BEN', 1),
(24, 'Bermuda', ' +1-441', 'BM', 'BMU', 1),
(25, 'Bhutan', ' +975', 'BT', 'BTN', 1),
(26, 'Bolivia', ' +591', 'BO', 'BOL', 1),
(27, 'Bosnia and Herzegovina', ' +387', 'BA', 'BIH', 1),
(28, 'Botswana', ' +267', 'BW', 'BWA', 1),
(29, 'Brazil', ' +55', 'BR', 'BRA', 1),
(30, 'British Indian Ocean Territory', ' +246', 'IO', 'IOT', 1),
(31, 'Brunei', ' +673', 'BN', 'BRN', 1),
(32, 'Bulgaria', ' +359', 'BG', 'BGR', 1),
(33, 'Burkina Faso', ' +226', 'BF', 'BFA', 1),
(34, 'Burundi', ' +257', 'BI', 'BDI', 1),
(35, 'Cambodia', ' +855', 'KH', 'KHM', 1),
(36, 'Cameroon', ' +237', 'CM', 'CMR', 1),
(37, 'Canada', ' +1', 'CA', 'CAN', 1),
(38, 'Cape Verde', ' +238', 'CV', 'CPV', 1),
(39, 'Cayman Islands', ' +1-345', 'KY', 'CYM', 1),
(40, 'Central African Republic', ' +236', 'CF', 'CAF', 1),
(41, 'Chad', ' +235', 'TD', 'TCD', 1),
(42, 'Chile', ' +56', 'CL', 'CHL', 1),
(43, 'China', ' +86', 'CN', 'CHN', 1),
(44, 'Christmas Island', ' +61', 'CX', 'CXR', 1),
(45, 'Cocos Islands', ' +61', 'CC', 'CCK', 1),
(46, 'Colombia', ' +57', 'CO', 'COL', 1),
(47, 'Comoros', ' +269', 'KM', 'COM', 1),
(48, 'Cook Islands', ' +682', 'CK', 'COK', 1),
(49, 'Costa Rica', ' +506', 'CR', 'CRI', 1),
(50, 'Croatia', ' +385', 'HR', 'HRV', 1),
(51, 'Cuba', ' +53', 'CU', 'CUB', 1),
(52, 'Curacao', ' +599', 'CW', 'CUW', 1),
(53, 'Cyprus', ' +357', 'CY', 'CYP', 1),
(54, 'Czech Republic', ' +420', 'CZ', 'CZE', 1),
(55, 'Democratic Republic of the Congo', ' +243', 'CD', 'COD', 1),
(56, 'Denmark', ' +45', 'DK', 'DNK', 1),
(57, 'Djibouti', ' +253', 'DJ', 'DJI', 1),
(58, 'Dominica', ' +1-767', 'DM', 'DMA', 1),
(59, 'Dominican Republic', ' +1-849', 'DO', 'DOM', 1),
(60, 'East Timor', ' +670', 'TL', 'TLS', 1),
(61, 'Ecuador', ' +593', 'EC', 'ECU', 1),
(62, 'Egypt', ' +20', 'EG', 'EGY', 1),
(63, 'El Salvador', ' +503', 'SV', 'SLV', 1),
(64, 'Equatorial Guinea', ' +240', 'GQ', 'GNQ', 1),
(65, 'Eritrea', ' +291', 'ER', 'ERI', 1),
(66, 'Estonia', ' +372', 'EE', 'EST', 1),
(67, 'Ethiopia', ' +251', 'ET', 'ETH', 1),
(68, 'Falkland Islands', ' +500', 'FK', 'FLK', 1),
(69, 'Faroe Islands', ' +298', 'FO', 'FRO', 1),
(70, 'Fiji', ' +679', 'FJ', 'FJI', 1),
(71, 'Finland', ' +358', 'FI', 'FIN', 1),
(72, 'France', ' +33', 'FR', 'FRA', 1),
(73, 'French Polynesia', ' +689', 'PF', 'PYF', 1),
(74, 'Gabon', ' +241', 'GA', 'GAB', 1),
(75, 'Gambia', ' +220', 'GM', 'GMB', 1),
(76, 'Georgia', ' +995', 'GE', 'GEO', 1),
(77, 'Germany', ' +49', 'DE', 'DEU', 1),
(78, 'Ghana', ' +233', 'GH', 'GHA', 1),
(79, 'Gibraltar', ' +350', 'GI', 'GIB', 1),
(80, 'Greece', ' +30', 'GR', 'GRC', 1),
(81, 'Greenland', ' +299', 'GL', 'GRL', 1),
(82, 'Grenada', ' +1-473', 'GD', 'GRD', 1),
(83, 'Guam', ' +1-671', 'GU', 'GUM', 1),
(84, 'Guatemala', ' +502', 'GT', 'GTM', 1),
(85, 'Guernsey', ' +44-1481', 'GG', 'GGY', 1),
(86, 'Guinea', ' +224', 'GN', 'GIN', 1),
(87, 'Guinea-Bissau', ' +245', 'GW', 'GNB', 1),
(88, 'Guyana', ' +592', 'GY', 'GUY', 1),
(89, 'Haiti', ' +509', 'HT', 'HTI', 1),
(90, 'Honduras', ' +504', 'HN', 'HND', 1),
(91, 'Hong Kong', ' +852', 'HK', 'HKG', 1),
(92, 'Hungary', ' +36', 'HU', 'HUN', 1),
(93, 'Iceland', ' +354', 'IS', 'ISL', 1),
(94, 'India', ' +91', 'IN', 'IND', 1),
(95, 'Indonesia', ' +62', 'ID', 'IDN', 1),
(96, 'Iran', ' +98', 'IR', 'IRN', 1),
(97, 'Iraq', ' +964', 'IQ', 'IRQ', 1),
(98, 'Ireland', ' +353', 'IE', 'IRL', 1),
(99, 'Isle of Man', ' +44-1624', 'IM', 'IMN', 1),
(100, 'Israel', ' +972', 'IL', 'ISR', 1),
(101, 'Italy', ' +39', 'IT', 'ITA', 1),
(102, 'Ivory Coast', ' +225', 'CI', 'CIV', 1),
(103, 'Jamaica', ' +1-876', 'JM', 'JAM', 1),
(104, 'Japan', ' +81', 'JP', 'JPN', 1),
(105, 'Jersey', ' +44-1534', 'JE', 'JEY', 1),
(106, 'Jordan', ' +962', 'JO', 'JOR', 1),
(107, 'Kazakhstan', ' +7', 'KZ', 'KAZ', 1),
(108, 'Kenya', ' +254', 'KE', 'KEN', 1),
(109, 'Kiribati', ' +686', 'KI', 'KIR', 1),
(110, 'Kosovo', ' +383', 'XK', 'XKX', 1),
(111, 'Kuwait', ' +965', 'KW', 'KWT', 1),
(112, 'Kyrgyzstan', ' +996', 'KG', 'KGZ', 1),
(113, 'Laos', ' +856', 'LA', 'LAO', 1),
(114, 'Latvia', ' +371', 'LV', 'LVA', 1),
(115, 'Lebanon', ' +961', 'LB', 'LBN', 1),
(116, 'Lesotho', ' +266', 'LS', 'LSO', 1),
(117, 'Liberia', ' +231', 'LR', 'LBR', 1),
(118, 'Libya', ' +218', 'LY', 'LBY', 1),
(119, 'Liechtenstein', ' +423', 'LI', 'LIE', 1),
(120, 'Lithuania', ' +370', 'LT', 'LTU', 1),
(121, 'Luxembourg', ' +352', 'LU', 'LUX', 1),
(122, 'Macao', ' +853', 'MO', 'MAC', 1),
(123, 'Macedonia', ' +389', 'MK', 'MKD', 1),
(124, 'Madagascar', ' +261', 'MG', 'MDG', 1),
(125, 'Malawi', ' +265', 'MW', 'MWI', 1),
(126, 'Malaysia', ' +60', 'MY', 'MYS', 1),
(127, 'Maldives', ' +960', 'MV', 'MDV', 1),
(128, 'Mali', ' +223', 'ML', 'MLI', 1),
(129, 'Malta', ' +356', 'MT', 'MLT', 1),
(130, 'Marshall Islands', ' +692', 'MH', 'MHL', 1),
(131, 'Mauritania', ' +222', 'MR', 'MRT', 1),
(132, 'Mauritius', ' +230', 'MU', 'MUS', 1),
(133, 'Mayotte', ' +262', 'YT', 'MYT', 1),
(134, 'Mexico', ' +52', 'MX', 'MEX', 1),
(135, 'Micronesia', ' +691', 'FM', 'FSM', 1),
(136, 'Moldova', ' +373', 'MD', 'MDA', 1),
(137, 'Monaco', ' +377', 'MC', 'MCO', 1),
(138, 'Mongolia', ' +976', 'MN', 'MNG', 1),
(139, 'Montenegro', ' +382', 'ME', 'MNE', 1),
(140, 'Montserrat', ' +1-664', 'MS', 'MSR', 1),
(141, 'Morocco', ' +212', 'MA', 'MAR', 1),
(142, 'Mozambique', ' +258', 'MZ', 'MOZ', 1),
(143, 'Myanmar', ' +95', 'MM', 'MMR', 1),
(144, 'Namibia', ' +264', 'NA', 'NAM', 1),
(145, 'Nauru', ' +674', 'NR', 'NRU', 1),
(146, 'Nepal', ' +977', 'NP', 'NPL', 1),
(147, 'Netherlands', ' +31', 'NL', 'NLD', 1),
(148, 'Netherlands Antilles', ' +599', 'AN', 'ANT', 1),
(149, 'New Caledonia', ' +687', 'NC', 'NCL', 1),
(150, 'New Zealand', ' +64', 'NZ', 'NZL', 1),
(151, 'Nicaragua', ' +505', 'NI', 'NIC', 1),
(152, 'Niger', ' +227', 'NE', 'NER', 1),
(153, 'Nigeria', ' +234', 'NG', 'NGA', 1),
(154, 'Niue', ' +683', 'NU', 'NIU', 1),
(155, 'North Korea', ' +850', 'KP', 'PRK', 1),
(156, 'Northern Mariana Islands', ' +1-670', 'MP', 'MNP', 1),
(157, 'Norway', ' +47', 'NO', 'NOR', 1),
(158, 'Oman', ' +968', 'OM', 'OMN', 1),
(159, 'Pakistan', ' +92', 'PK', 'PAK', 1),
(160, 'Palau', ' +680', 'PW', 'PLW', 1),
(161, 'Palestine', ' +970', 'PS', 'PSE', 1),
(162, 'Panama', ' +507', 'PA', 'PAN', 1),
(163, 'Papua New Guinea', ' +675', 'PG', 'PNG', 1),
(164, 'Paraguay', ' +595', 'PY', 'PRY', 1),
(165, 'Peru', ' +51', 'PE', 'PER', 1),
(166, 'Philippines', ' +63', 'PH', 'PHL', 1),
(167, 'Pitcairn', ' +64', 'PN', 'PCN', 1),
(168, 'Poland', ' +48', 'PL', 'POL', 1),
(169, 'Portugal', ' +351', 'PT', 'PRT', 1),
(170, 'Puerto Rico', ' +1-939', 'PR', 'PRI', 1),
(171, 'Qatar', ' +974', 'QA', 'QAT', 1),
(172, 'Republic of the Congo', ' +242', 'CG', 'COG', 1),
(173, 'Reunion', ' +262', 'RE', 'REU', 1),
(174, 'Romania', ' +40', 'RO', 'ROU', 1),
(175, 'Russia', ' +7', 'RU', 'RUS', 1),
(176, 'Rwanda', ' +250', 'RW', 'RWA', 1),
(177, 'Saint Barthelemy', ' +590', 'BL', 'BLM', 1),
(178, 'Saint Helena', ' +290', 'SH', 'SHN', 1),
(179, 'Saint Kitts and Nevis', ' +1-869', 'KN', 'KNA', 1),
(180, 'Saint Lucia', ' +1-758', 'LC', 'LCA', 1),
(181, 'Saint Martin', ' +590', 'MF', 'MAF', 1),
(182, 'Saint Pierre and Miquelon', ' +508', 'PM', 'SPM', 1),
(183, 'Saint Vincent and the Grenadines', ' +1-784', 'VC', 'VCT', 1),
(184, 'Samoa', ' +685', 'WS', 'WSM', 1),
(185, 'San Marino', ' +378', 'SM', 'SMR', 1),
(186, 'Sao Tome and Principe', ' +239', 'ST', 'STP', 1),
(187, 'Saudi Arabia', ' +966', 'SA', 'SAU', 1),
(188, 'Senegal', ' +221', 'SN', 'SEN', 1),
(189, 'Serbia', ' +381', 'RS', 'SRB', 1),
(190, 'Seychelles', ' +248', 'SC', 'SYC', 1),
(191, 'Sierra Leone', ' +232', 'SL', 'SLE', 1),
(192, 'Singapore', ' +65', 'SG', 'SGP', 1),
(193, 'Sint Maarten', ' +1-721', 'SX', 'SXM', 1),
(194, 'Slovakia', ' +421', 'SK', 'SVK', 1),
(195, 'Slovenia', ' +386', 'SI', 'SVN', 1),
(196, 'Solomon Islands', ' +677', 'SB', 'SLB', 1),
(197, 'Somalia', ' +252', 'SO', 'SOM', 1),
(198, 'South Africa', ' +27', 'ZA', 'ZAF', 1),
(199, 'South Korea', ' +82', 'KR', 'KOR', 1),
(200, 'South Sudan', ' +211', 'SS', 'SSD', 1),
(201, 'Spain', ' +34', 'ES', 'ESP', 1),
(202, 'Sri Lanka', ' +94', 'LK', 'LKA', 1),
(203, 'Sudan', ' +249', 'SD', 'SDN', 1),
(204, 'Suriname', ' +597', 'SR', 'SUR', 1),
(205, 'Svalbard and Jan Mayen', ' +47', 'SJ', 'SJM', 1),
(206, 'Swaziland', ' +268', 'SZ', 'SWZ', 1),
(207, 'Sweden', ' +46', 'SE', 'SWE', 1),
(208, 'Switzerland', ' +41', 'CH', 'CHE', 1),
(209, 'Syria', ' +963', 'SY', 'SYR', 1),
(210, 'Taiwan', ' +886', 'TW', 'TWN', 1),
(211, 'Tajikistan', ' +992', 'TJ', 'TJK', 1),
(212, 'Tanzania', ' +255', 'TZ', 'TZA', 1),
(213, 'Thailand', ' +66', 'TH', 'THA', 1),
(214, 'Togo', ' +228', 'TG', 'TGO', 1),
(215, 'Tokelau', ' +690', 'TK', 'TKL', 1),
(216, 'Tonga', ' +676', 'TO', 'TON', 1),
(217, 'Trinidad and Tobago', ' +1-868', 'TT', 'TTO', 1),
(218, 'Tunisia', ' +216', 'TN', 'TUN', 1),
(219, 'Turkey', ' +90', 'TR', 'TUR', 1),
(220, 'Turkmenistan', ' +993', 'TM', 'TKM', 1),
(221, 'Turks and Caicos Islands', ' +1-649', 'TC', 'TCA', 1),
(222, 'Tuvalu', ' +688', 'TV', 'TUV', 1),
(223, 'Uganda', ' +256', 'UG', 'UGA', 1),
(224, 'Ukraine', ' +380', 'UA', 'UKR', 1),
(225, 'United Arab Emirates', ' +971', 'AE', 'ARE', 1),
(226, 'United Kingdom', ' +44', 'GB', 'GBR', 1),
(227, 'United States', ' +1', 'US', 'USA', 1),
(228, 'Uruguay', ' +598', 'UY', 'URY', 1),
(229, 'Uzbekistan', ' +998', 'UZ', 'UZB', 1),
(230, 'Vanuatu', ' +678', 'VU', 'VUT', 1),
(231, 'Vatican', ' +379', 'VA', 'VAT', 1),
(232, 'Venezuela', ' +58', 'VE', 'VEN', 1),
(233, 'Vietnam', ' +84', 'VN', 'VNM', 1),
(234, 'Virgin Islands (British)', ' +1-284', 'VG', 'VGB', 1),
(235, 'Virgin Islands (U.S.)', ' +1-340', 'VI', 'VIR', 1),
(236, 'Wallis and Futuna', ' +681', 'WF', 'WLF', 1),
(237, 'Western Sahara', ' +212', 'EH', 'ESH', 1),
(238, 'Yemen', ' +967', 'YE', 'YEM', 1),
(239, 'Zambia', ' +260', 'ZM', 'ZMB', 1),
(240, 'Zimbabwe', ' +263', 'ZW', 'ZWE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_county`
--

DROP TABLE IF EXISTS `mrfc_reg_county`;
CREATE TABLE `mrfc_reg_county` (
  `county_id` int(11) NOT NULL,
  `county` varchar(50) NOT NULL,
  `county_seo` varchar(50) NOT NULL,
  `blurb` text,
  `area` varchar(50) DEFAULT NULL,
  `capital` varchar(50) DEFAULT NULL,
  `map` varchar(50) DEFAULT NULL,
  `crest` varchar(50) DEFAULT NULL,
  `constituencies` mediumtext,
  `website` varchar(50) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `twitter` varchar(30) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `youtube` varchar(50) DEFAULT NULL,
  `postaladdress` varchar(50) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT '1',
  `is_widget` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_county`
--

INSERT INTO `mrfc_reg_county` (`county_id`, `county`, `county_seo`, `blurb`, `area`, `capital`, `map`, `crest`, `constituencies`, `website`, `email`, `twitter`, `facebook`, `youtube`, `postaladdress`, `telephone`, `published`, `is_widget`) VALUES
(1, 'Mombasa', 'mombasa', 'Mombasa County is located in Coast province and constitutes 4 constituencies (Changamwe, Kisauni, Likoni and Mvita). Kilindini and Mombasa districts were mapped to this county for the purposes of generating county estimates.<br><br>\nMombasa has a long history the traces can be found from the writings of the 16th century. Many traders did attempt to enforce their governance on the town due to its advantageously central location, where Arab influence is felt prominently till date.<br><br>\n\nThe town of Mombasa remained the center of the Arab trade in ivory and slaves from the 8th to the 16th century. It is known that Arab traders sailed down around to the coast of Kenya from the first century AD who continued to build trade along the ports of Mombasa and Lamu.<br><br>\n\nPortuguese also had their influence on the port that changed the face of the land by burning it almost three times. It is believed that Vasco da Gama was the first known European to visit Mombasa, whose purpose of exploration was to spread the Christian faith to further expand Portugal`s trading area. Mombasa became Portugal`s main trading centre of spices, cotton and coffee, where Fort Jesus was constructed. The Fort served as the major center for trading goods that protected the Portuguese from conflicts with locals the remains of which still attracts a great deal of tourists and visitors. As slavery was highly practiced during that era, the local slaves were exchanged for goods.<br><br>\n\nUntil 1698, the Portuguese controlled the city, but soon the Omani Arabs took over the charge.<br><br>\n\nFinally, the British took control of Mombasa in 1895, wherein the British East African Protectorate was established.<br><br>\n\nColonization perpetuated in Mombasa that promoted European culture over the town and the Kenyan lands. Like in India, the British gained momentum and established control of the port. They even completed a railway line in the early 1900`s from Mombasa to Uganda which is perhaps the major landmark in the history of Mombasa. Thus, from 1887 to 1907, Mombasa remained the capital of the British East Africa Protectorate.<br><br>\n\nThe British rule ended and Kenya received its independence on the 12th December 1963. From herein, began the creation of political parties and unions that faced elections for the formation of a stable government. Though significant political shifts and oppositions led to violence, the pressure from the international and African community led the leaders to finally come to a consensus and form a power-sharing agreement.', '212.5', 'Mombasa (City)', 'mombasa.jpg', NULL, 'Changamwe, Jomvu, Kisauni, Nyali, Likoni, Mvita', 'http://mombasa.go.ke', 'info@mombasa.go.ke', '@MombasaCountyKe', 'Mombasa County Government Watch', '', 'P.O. Box is 81599-80100', '0721328829', 1, 1),
(2, 'Kwale', 'kwale', 'Kwale County is located in south coast of Kenya, it borders the Republic of Tanzania to the South West, and the following Counties; Taita Taveta to the West, Kilifi to the North, Mombasa to the North East and the Indian Ocean to the East.<br><br>\nKwale County covers a total surface area of 8,270.2 square km and accounts for 1.42 per cent of Kenya`s total surface area.<br><br>\n\n<em>Headquarters and Major Towns</em><br><br>\n\nThe County`s capital is Kwale Town which is located 30 km southwest of Mombasa and 15km inland. It borders the Shimba Hills National Reserve. Other major towns include:<br><br>\n<ul>\n<li>Ukunda,</li>\n<li>Msambweni,</li>\n<li>Kinango, and</li>\n<li>Lunga Lunga.</li>\n<li>Geography and Climate</li></ul><br><br>\n\nKwale County has four major topographical features namely the coastal plain, the foot plateau, the coastal uplands and the Nyika plateau. Kwale County has a monsoon type of climate; it`s hot and dry from January â€` April while June to August is the coolest period of the year. Rainfall comes in two seasons i.e. short rains are experienced from October to December while the long rains run from March- June/July. The average temperature of the county is 24.2oC and rainfall amounts range between 400mm and 1,680 mm per annum. Seasonal rivers and the Ramisi River form the drainage pattern in the district. The main rivers and streams are Marere, Mwaluganje and river Ramisi. Rivers Marere and Mwaluganje have been harnessed to provide piped water.<br><br>\n\n<em>The People of Kwale County</em><br><br>\n\nBased on the 2009 Kenya Population and Housing Census, the county had a population of 649,931 which accounted for 1.7 per cent of the total Kenyan population.<br><br>\nKwale County is populated mainly by the Digo and Duruma. These people belong to the Mijikenda ethnic group of coastal Kenya. Other tribes found in the district include the Kambas, Arabs and Indians though to a very small proportion compared to the Digos and Durumas.<br><br>\n\n<em>Electoral Units</em><br><br>\n\nThe County is divided into 4 constituencies and 20 wards. The constituencies are:<br><br>\n<ul>\n<li>Matuga</li>\n<li>Msambweni</li>\n<li>Kinango</li>\n<li>Lunga Lunga</li>\n<li>Potential</li>\n</ul><br><br>\nThe county has rich titanium deposits with extraction activities already on going.<br>\nThe Monsoon type of climate in the region that is characterized by hot and dry weather between January and April and cool weather between June and August is favourable for livestock rearing which is a main activity in certain parts of the county.<br><br>\nBeing criss-crossed by rivers and streams some of which are seasonal, the county has water resources giving the county huge agricultural potential.<br><br>\nPotential to be a key destination for eco-tourism (rainforests and national parks)', '8270.3', 'Kwale', 'kwale.jpg', NULL, 'Msambweni; Lunga lunga; Matuga; Kinango', 'http://www.kwalecountygov.com', 'info@kwale.go.ke', '@OurKwaleCounty', 'Kwale County Government', '', 'P.O Box 4-80403 Kwale Kenya', '+254721883464', 1, 1),
(3, 'Kilifi', 'kilifi', 'Kilifi County covers a total surface area of 12,610 km2 and accounts for 2.17 per cent of Kenya`s total surface area. It borders the counties of Tana River to the North, Taita Taveta to the West, Mombasa and Kwale to the South and the Indian Ocean to the East.<br><br>\n\nMore than half of the land in Kilifi is arable, however only 31% of the farmers hold titles to their land. Maize and cassava are the main subsistence crops grown in the County. The main cash crops grown in the county include coconuts, cashew nuts, sisal and citrus fruits such as mangoes and pineapples.<br><br>\n\nAlthough many health facilities exist within the county, these are unevenly distributed and mainly located along major roads. The lack of permanent health workers operating within the communities reduces efficiency levels in the delivery of medical services. The major health facilities in the county are as follows:<br><br>\n\nnumber, 51% are men while 49% are women. There are 418 primary and 86 secondary schools catering for an estimated 256,000 and 22,500 students respectively. There are 13 youth polytechnics, one college and a University campus.', '12245.9', 'Kilifi', 'kilifi.jpg', NULL, 'Kilifi North; Kilifi South; Kaloleni; Rabai; Ganze; Malindi; Magarini', 'http://kilifi.go.ke', 'government@kilifi.go.ke', '@governorkingi', 'Kilifi County', '', 'P.O Box 519-80108, Kilifi,Kenya', '0713884625', 1, 1),
(4, 'Tana-River', 'tana-river', 'Tana River County is one of the forty seven (47) counties in the Republic of Kenya. The County takes its name from River Tana which is the longest river in Kenya. It is a County in the former Coast Province, Kenya with an area of 35,375.8 square kilometers (13,658.7 sq mi) and a population of 262,684 according to the 2012 census. The administrative headquarter of the county is Hola. The County has three sub counties; Bura, Galole and Garsen.', '35375.8', 'Hola', 'tana river.jpg', NULL, 'Bura; Galole; Garsen', 'http://Tanariver.go.ke', 'info@tanariver.go.ke', '@Galgalofayo', 'Tana River County', '', 'P.O Box 29-70101 Trade Hse, County Council Rd Hola', '0723733817 / 0721792068', 1, 1),
(5, 'Lamu', 'lamu', 'The Lamu Archipelago is a small group of Island situated on Kenya´s Northen Coast line, near Somali. It is made up of Lamu, Manda, pate and Kiwayuu islands. Lamu town is the headquarter of Lamu District, one of the six districts of Kenya´s Coast Province, which boarders the Indian Ocean to the east, the Tana River District to the South-West, the Garissa District to the North and the republic of somali to the North-East. The County has a land surface area of 6,474.7 Km2 that includes the mainland and over 65 Islands that forms the Lamu Archipelago. The total length of the coastline is 130 km while land water mass area stands at 308km<br><br>\n\nPolitically Lamu is divided into two Constituencies: Lamu East and Lamu West. Each constituency is represented by an elected Member of Parliament, who is elected after every five years. Lamu is devolved into a County Government, headed by a Governor. The County has TEN County wards, which are represented in the County Assembly. The County wards are as follows:<br><br>\n<ul>\n<li>Mkomani</li>\n<li>shella</li>\n<li>Faza</li>\n<li>Kiunga</li>\n<li>Basuba</li>\n<li>Hindi</li>\n<li>Hongwe</li>\n<li>Bahari</li>\n<li>Mkunumbi</li>\n<li>Witu</li></ul>', '6497.7', 'Lamu', 'lamu.jpg', NULL, 'Lamu East Constituency; Lamu West Constituency', 'http://Lamu.go.ke', 'info@lamu.go.ke', '@LamuCountyKe', 'Lamu County Government', '', 'P.O. Box 74-80500, LAMU', '0701-785258, 0715 000 555/ 0715 555 111', 1, 1),
(6, 'Taita-Taveta', 'taita-taveta', 'What is known as the Taita tribe actually consists of three separate but closely-related tribes: Wadawida (or Taita), Wasaghala (Sagalla) and Wataveta (Taveta). The Taita Hills are mainly Precambrian mountain ranges consisting of three massifs; Dawida, Saghalla and Kasighau with Dawida outcropping the rest at 2,228 metres above sea level at its highest peak - Vuria; it also has three other main peaks - Iyale, Wesu and Susu. The Taita have a variation of dialects that include the Mbololo, Bura, Wusi, Kidaya, Mghange, Chawia, Mwanda, Kishamba, Werugha, Wumingu, and Wundanyi whereas the Kisaghalla and Kasighau stand on their own as self-sustaining dialects.', '17083.9', 'Mwatate', 'taita-taveta.jpg', NULL, 'Taveta; Wundanyi; Mwatate; Voi', 'http://www.taitataveta.go.ke', 'info@taitataveta.go.ke', 'taitatavetagovt', 'The Taita Taveta County Government', '', 'P.O. Box 1066-80304 Wundanyi', '+254 788186436, +254 718988717', 1, 1),
(7, 'Garissa', 'garissa', 'Garissa County is an administrative county in the former North Eastern Province of Kenya. Its capital town is Garissa. Garissa County has a total population of 623,060. A male population of 334,939 and a female population of 288,121 (census 2009). Garissa has six constituencies namely: Garissa Township, Ijara, Dadaab, Lagdera, Fafi and Balambala.<br><br>\nThe county is low lying, with altitudes ranging between 70m and 400m above sea level. The area is hot and dry much of the year, receiving scarce rainfall in the range of 150mm - 300mm annually. Frequent droughts and unreliable rains do not favour agriculture activities and the growth of pasture for livestock rearing. Tana River runs along the western boundary of the county and is the only permanent natural source of water for Garissa town and the surrounding areas. Seasonal Rivers (laggas) provide water during the wet season for both human and livestock, although they greatly interfere with road transportation. The county also hosts the Boni forest, a section of which is the Boni National Reserve, a protected wildlife conservation area.', '45720.2', 'Garissa', 'garissa.jpg', NULL, 'Dujis; Balambala; Lagdera; Dadaad; Fafi; Ijara', 'http://garissa.go.ke', 'garissa@cog.go.ke, gsa.countyassembly@gmail.com', '@GarissaGov', 'Garissa County', '', 'P.O. Box 57-70100, Garissa', '(020)2586235', 1, 1),
(8, 'Wajir', 'wajir', 'Wajir is a Borana word that means coming together, bequeathed to this part of the country because of the different clans and pastoral communities that used to congregate in areas around Wajir town to water their animals from the abundant and dependable shallow wells that characterize the general land geomorphology.<br /><br />\n\nDue to its centrality to all major town in the region, With its abundant water resources and shallow wells and high human traffic, the British officially established Wajir Town in 1912, to serve as their colonial headquarters. The town Wajir town is now one of the oldest in Kenya after Malindi and Mji wa Kale in Mombasa. Its Centennial Anniversary was marked in 2012 with week longweek-long celebrations amid much pomp and colour.', '55840.6', 'Wajir', 'wajir.jpg', NULL, 'Wajir North; Wajir East; Tarbai; Wajir West; Eldas; Wajir South', 'http://wajir.go.ke/, http://www.wajircounty.com', 'cswajir2013@yahoo.com, wajir@transauthority.go.ke.', '@wajirgov', 'Wajir County', '', 'P.O Box 9-70200,Wajir ', '0723405202,0722521244, 0721820952', 1, 1),
(9, 'Mandera', 'mandera', 'Mandera County is one of the 47 counties in Kenya, located in the North Eastern part of Kenya and borders Ethiopia to the North, Somalia Republic to the East and Wajir County to the South. It is about 1,100km from the capital city of Nairobi by road. The county has an approximate population of 1,025,756 and covers an area of 25,991.5 km2. The County Administratively is subdivided into six Sub Counties namely Mandera West, Mandera South, Banissa, Mandera North, Mandera East and Lafey and further to 30 administrative wards.<br><br>\n\nNomadic pastoralism is the major economic activity in the in the county with camels,goats,sheeps&cattle being the main type of livestock reared. The region vast pasture land has allowed this activity to be viable.<br><br>\n\nThe main water sources in the region are river Daua a number of shallow wells and few major earth pans. The region has small scale agriculture production with small scale horticulture producers supplying Mangoes, pawpaw, onions, kales and Banana to the local market.', '25797.7', 'Mandera', 'mandera.jpg', NULL, 'Mandera West; Banisa; Mandera North; Mandera East; Lafey; Mandera South', 'http://www.mandera.go.ke/', 'info@mandera.go.ke', '@ManderaCGPress', 'Mandera County', '', 'P.0 Box 13-70300 Mandera,Kenya ', '(046)210 4000', 1, 1),
(10, 'Marsabit', 'marsabit', 'Marsabit County which borders Ethiopia to the North and North East, Wajir County to the East, Isiolo County to the South East, Samburu County to the South and South West and Lake Turkana to the West and North West in the former Eastern Province is vast, with an area spawning 70,961.3Km2. It has a current estimated population of 310, 000, while the 2009 Census recorded a population of 291,166 (52% Male & 48% Female). The county comprises four constituencies (Saku, North Horr, Laisamis and Moyale). Administratively it has seven districts.', '66923.1', 'Marsabit', 'marsabit.jpg', NULL, 'Moyale; North Horr; Saku; Laisamis', 'http://marsabit.go.ke/', 'info@marsabit.go.ke', '@MarsabitGov', 'Marsabit County Government ', '', 'P.O Box 29,60500 Marsabit ', '0723582684', 1, 1),
(11, 'Isiolo', 'isiolo', 'Isiolo County is the heart of Kenya,a crucial and strategic gateway between Northern and Southern Kenya.\nThe county government of Isiolo may be only five months old but my team is already down to business in a bid to deliver quality services to the residents.<br><br>\nWith the County Executive Committee members already in office, work has started in earnest and we appreciate the cooperation we are getting from the county assembly.<br><br>\nThe public service board is also in place and the government is in the process of rationalising the staff they inherited from the defunct county councils.<br><br>\nWe are conducting head counts of former the county council employees to weed out ghost workers, if any, and streamline public service within the county.', '25336.1', 'Isiolo', 'isiolo.jpg', NULL, 'Isiolo North; Isiolo South', 'http://isiolo.go.ke/', 'info@isiolo.go.ke', '@CountyIsiolo', 'Isiolo County Government', '', 'P.O Box 36-30600 ,Isiolo', '020-344194/ 0725624489', 1, 1),
(12, 'Meru', 'meru', 'Meru County is centrally located in the country<br>\nIt`s the leading county in Horticulture production<br>\nThere are a number of National Parks and conservancies that attracts tourists to the region. It`s a tourism hotspot with Meru National park hosting unique wildlife attraction among them the Grevy Zebras, Somali Ostrich, Reticulated Giraffe, giraffe Gazelle and the Onyx. The renowned Lewa Conservancy is also at the heart of the county. The county also offers the Mt Kenya climbing tourism circuit<br>\nAgriculture is the major economic activity in this county due to the rich volcanic soils in the high altitude areas. Coffee, tea, French-beans and dairy products as primary produce. Wholesale and retail trade also play important role in the county`s economy.<br>\nIt`s the Leading County that produces Miraa (Khat) for export and hence boosting the economic national grid.', '6930.1', 'Meru', 'meru.jpg', NULL, 'Tigania East; Tigania West; Igembe North; Igembe South; North Imenti; South Imenti; Buuri; Igembe Central; Central Imenti', 'http://meru.go.ke/', 'merucounty@meru.go.ke', '@MeruCountyGovt', 'Meru County Government ', '', 'P.O. Box 120-60200 Meru, Kenya', '202381720, 0709241000', 1, 1),
(13, 'Tharaka-Nithi', 'tharaka-nithi', 'Tharaka-Nithi County is one of the 47 counties in Kenya created by the Kenya Constitution 2010. It borders the Counties of Embu to the South and South West, Meru to the North and North East, Kirinyiga and Nyeri to the West and Kitui to the East and South East. The county lies between latitude 00<sup>0</sup> 07\' and 00<sup>0</sup> 26\' South and between longitudes 37<sup>0</sup> 19\' and 37<sup>0</sup> 46\' East. The total area of the County is 2,662.1 Km<sup>2</sup>; including the shared Mt Kenya forest estimated to have 360Km<sup>2</sup> in Tharaka Nithi County.', '2409.5', 'Kathwana', 'tharaka-nithi.jpg', NULL, 'Nithi; Maara; Tharaka', 'http://tharakanithi.go.ke', 'tharakanithicounty2013@gmail.com', '@nithitharaka', 'Tharaka Nithi', '', 'P.O Box 2-60400, chuka ', '(064)630071', 1, 1),
(14, 'Embu', 'embu', 'Embu lies on the windward slopes of Mt. Kenya. It remarkably occupies the most prime fertile lands of the Kenya highlands. The forest cover hosts a great number of flora and fauna. There are two seasons enjoyed each year and the weather is quite favourable for diverse agricultural activities. Instances of drought or famine are extremely rare.<br><br>\n\nWith sufficient water resources, agriculture is prevalent owing to existence of several rivers that flow through the county. Considering the conservation measures that are in place, the county is projected to become water secure with the consequent rise in both agricultural production and household incomes.<br><br>\n\nBecause of it`s location at the foothill of Mount Kenya, the county`s temperatures are estimated at an average of between 9&deg;C - 28&deg;C. The county receives substantial rainfall with average annual precipitation of 1206mm.<br><br>\n\nThe wettest season is experienced between March and July while the hottest comes between January and mid March. Much of the land is largely arable and is well watered by a number of rivers and streams.', '2555.9', 'Embu', 'embu.jpg', NULL, 'Manyatta; Runyenjes; Gachoka; Siakago', 'www.embu.go.ke', 'info@embu.go.ke', '@embucountygovt', 'Embu County Government ', '', 'Embu County Government', '+254 68 30686; +254 68 30656; +254 771 204 003; +254 703 192 924', 1, 1),
(15, 'Kitui', 'kitui', 'Kitui County is the sixth largest in terms of size and covers an area of 30,520 square kilometers. It is 11th in population size at 1,000,012 based on 2009 census and has steadily grown since. The county is diverse with some areas being semi-arid and mostly dry, while others are fairly arable.<br><br>\n\nThe county, which lies between the altitude of 400m and 1,800m above sea level, is endowed with 14 different kinds of mienrals but the most prominent are coal estimated at one billion tonnes in Mui basin and gypsum in Mwingi area. The two main urban centres are Kitui and Mwingi.<br><br>\n\nKitui is inhabited mainly by the Kamba people, followed by the Tharaka who are found in Tharaka ward but there are also sizable Swahili and Somali population. The Akamba speak Kikamba and are considered friendly and welcoming. There are other communities mainly in urban areas.<br><br>\n\nThe main economic activity is subsistence farming of crops such as maize, beans, pigeon peas, sorghum, millet, cassava etc. Livestock keeping is also popular, especially goats and cattle.<br><br>\n\nThe county has small-scale industries for honey, gypsum and fruit processing. Most residents are Christians, with minority Muslim populations in the main urban centres. Most Christian faiths are represented, including Catholics, AIC, ACK, Presbyterian and evangelical churches.<br><br>\n\nThe central part of the county is characterized by hilly ridges separated by wide low lying areas and has slightly lower elevation of between 600m and 900m above sea level. The highest areas in the county are Kitui Central, Mutitu Hills and Yatta plateau. Due to their altitudes, they receive more rainfall than other areas in the county and are the most productive areas. To the eastern side, the main relief feature is the Yatta plateau, which stretches from the north to the south of the county and lies between rivers Athi and Tiva. The plateau is characterized with plain wide shallow spaced valleys.<br><br>\n\nThe county can be divided into four agro-ecological zones. Semi-arid farming zone has good potential for agricultural development and is currently either cultivated or under woodlands. The semi-arid ranching areas are less fertile and are used for drought resistance crops and livestock keeping. The Arid-agro-pastoral areas are generally suitable for grazing. Finally, the arid-pastoral zones are suitable for rearing of livestock.<br><br>\n\nThe climatic condition varies across the county in terms of rainfall and temperature. The rainfall pattern is bi-modal with long rains falling in the months of March to May. These are usually very erratic and unreliable. The short rains which form the second rainy season fall between October and December and is more reliable. The county experiences high temperatures throughout the year, which ranges from 140c to 340c. The hot months are between mid-July and September and January and February.<br><br>\n\nKitui town is the capital of the County Government of Kitui, 160km east of Nairobi and 75km east of Machakos. It used to be the capital of the Kitui District in Eastern Province. It has eight constituencies and 40 wards. Kitui town is hot, though the nights can be cold. Although most of the sites are located in the outskirts of town, Kitui is a busy trading center, its streets lined with arcaded shops. Monday and Thursday are market days.<br><br>\n\nKitui County Sub-Counties:<br>\n<ul>\n<li>Kitui Central</li>\n<li>Kitui Rural</li>\n<li>Kitui South</li>\n<li>Kitui East</li>\n<li>Kitui West</li>\n<li>Mwingi Central</li>\n<li>Mwingi North</li>\n<li>Mwingi West</li></ul>', '24385.1', 'Kitui', 'kitui.jpg', NULL, 'Mwingi North; Mwingi Central; Mwingi South; Kitui West; Kitui Rural; Kitui Town; Mutitu; Kitui South.', 'www.kitui.go.ke', 'info@kitui.go.ke', 'KituiCountyGovt', 'KITUI County', '', 'P.O. Box 33-90200, Kitui', '0702 615 888; 0702 615 444; 0731 717 100', 1, 1),
(16, 'Machakos', 'machakos', 'Machakos County, nicknamed `Macha,` was the first capital city of Kenya and now, it is an administrative county in Kenya. Machakos has eight (8) constituencies including Machakos Town, Mavoko, Masinga, Yatta, Kangundo, Kathiani, Matungulu, and Mwala. Machakos Town is the administrative capital of the county. <br><br>\n\nMachakos County borders Nairobi and Kiambu counties to the West, Embu to the North, Kitui to the East, Makueni to the South, Kajiado to the South West, and Murang`a and Kirinyaga to the North West. Machakos County stretches from latitudes 0º 45` South to 1º 31` South and longitudes 36&deg; 45` East to 37&deg; 45` East. The county has an altitude of 1000 - 1600 meters above sea level. <br><br>\n\nIt has a Total Population of 1,098,584 people, 264,500 Households and covers an area of 6,208 SQ. KM. The Population density is 177 persons per SQ. KM. The Akamba people are the dominant habitants of Machakos County. <br><br>\n\nThe local climate is semi arid with a hilly terrain covering most parts of the county. The beautiful hilly scenery is perfect for tourist related activities such as camping, hiking safaris, ecotourism and cultural tourism, dance and music festivals among many more. A number of establishments ensure the region has a well rounded hospitality industry. <br><br>\n\nSubsistence agriculture is practiced with Maize and drought-resistant crops such as sorghum and millet being grown. However, the County also plays host to the open air market concept with major market days where large amounts of produce are traded. Fruits, vegetables and other food stuffs like maize and beans are sold in these markets. <br><br>\n\nThe county has been selected as the home to the upcoming Konza Technology City due to its proximity to Nairobi, good infrastructure and availability of massive chunks of land. Machakos County, Nairobi`s Eastern neighbour, is home to important industrial and residential centers like Athi River and Mlolongo. Sadly, the developments do not extend to most parts of the huge county, but that is about to change when a planned technology city development is finalized. <br><br>\n\nDown the road from the junction town of Makutano ya Chumvi will be what is billed as the continent`s first techie city. Built to the book, it will become the world`s third IT magnet after Silicon Valley in California, USA, and Bangalore in Eastern India. This project will attract talent from all over the world through a range of incentives, and it is planned to have state-of-the-art shopping facilities as well as a university. ', '5952.9', 'Machakos', 'machakos.jpg', NULL, 'Masinga; Yatta; Kangundo; Matungulu; Kathiani; Mavoko; Machakos Town; Mwala', 'http://www.machakosgovernment.com', 'info@machakosgovernment.co.ke / governor@machakosgovernment.co.ke', '@DrAlfredMutua', 'Dr.Alfred Mutua ', '', 'P.O Box 262-90110', '044 202 10 17/ 020 2004086', 1, 1),
(17, 'Makueni', 'makueni', 'Makueni County covers an area of 8,034.7 sq km with a projected population of more than 0.9million people. It geographically borders Kajiado County to the West, Taita Taveta County to the South, Kitui County to the East and Machakos County to the North. The county lies in the arid and semi-arid zones of the Eastern region of the country. Major physical features in the county include the Volcanic Chyulu hills which lie along the South West border of the County in Kibwezi West constituency, Mbooni hills in Mbooni sub county and Kilungu hills in Kaiti subcounty.\nThe County is divided into Six sub-counties namely:Makueni,Mbooni, Kaiti,Kibwezi East, Kibwezi West and Kilome. <br><br>\n\nThe county has 30 Assembly Wards namely: <br><br>\n<ol type=\"1\">\n<li>Mbooni subcounty:wards {Tulimani,Mbooni,Kithungo,Kisau/Kiteta,Kako/Waia,Kalawa,}</li>\n<li>Kilome subcounty:wards{Kiima Kiu/Kalanzoni,Mukaa,Kasikeu}</li>\n<li>Kaiti sub county:wards{Kee,Kilungu,Ilima,Ukia}</li>\n<li>Makueni sub county:wards{Nzaui/Kalamba,Muvau,Kathonzweni,Mavindini,Kitise/Kithuki,Wote,Mbitini}</li>\n<li>Kibwezi West sub county:wards{Makindu,Kikumbulyu North,Kikumbulyu South,Nguumo,Nguu/Masumba,Emali/Mulala}</li>\n<li>Kibwezi East subcounty:wards{Masongaleni,Mtito Andei,Thange,Ivingoni}</li></ol><br><br>\nOur County is famous for horticulture, already there are water management community projects like dams, irrigation schemes and boreholes that boost agriculture hence bringing wealth to all. The county has a progressive authority that concentrates on service delivery and continuum investment. It has opened up development information on the web, social networks, maps as well as sms and it strides to be a model county in the country, regional and beyond.', '8008.9', 'Wote', 'makueni.jpg', NULL, 'Mbooni; Kilome; Kaiti; Makueni; Kibwezi West; Kibwezi East.', 'http://makueni.go.ke', 'contact@makueni.go.ke ', '@governorkibwana', 'Governor Press Service-Makueni County', '', 'P.O. Box 78-90300 Makueni', '020 2034944', 1, 1),
(18, 'Nyandarua', 'nyandarua', 'Nyandarua County is a County in the former Central Province of Kenya. Its capital and largest town is Ol Kalou. Formerly the capital was Nyahururu, which is now part of the Laikipia County. Nyandarua County has population of 596,268 [1] and an area of 3,304 km²', '3107.7', 'Ol Kalou', 'nyandarua.jpg', NULL, 'Kinangop; Kipiriri; Ol-kalou; Ol Jorok; Ndaragwa', 'http://www.nyandarua.go.ke ', 'info@nyandarua.go.ke', '@ChangeNyandarua', 'Nyandarua County Government', '', 'P.O Box 701- 20303 OlKalou', ' 0792735720, 0792735736', 1, 1),
(19, 'Nyeri', 'nyeri', 'Nyeri County is located in Central and constitutes 6 constituencies (Tetu, Kieni, Mathira, Othaya, Mukurwe-ini and Nyeri town). Nyeri North and Nyeri South districts were mapped to this county for the purposes of generating county estimates', '2361', 'Nyeri', 'nyeri.jpg', NULL, 'Tetu; Kieni; Mathira; Othaya; Mukurwe-ini; Nyeri Town', 'www.nyeri.go.ke', 'info@nyeri.go.ke', '@county19Nyeri', 'County Government of Nyeri', '', 'P.O Box 1112-10100, Nyeri Kenya', '0721 019019 / 0722019019 / 0774 050050', 1, 1),
(20, 'Kirinyaga', 'kirinyaga', 'Kirinyaga County borders Nyeri County, Murang`a County and Embu County.It covers an area of 1,478.1 square kilometers. The county lies between 1,158 metres and 5,380 metres above sea level in the South and at the Peak of Mt. Kenya respectively. Mt. Kenya which lies on the northern side greatly influences the landscape of the county as well as other topographical features.<br><br>\n\nThe snow melting from the mountain forms the water tower for the rivers that drain in the county and other areas that lie south and west of the county. The county can be divided into three ecological zones; the lowland areas, the midland areas and the highlands. The county is well endowed with a thick, indigenous forest with unique types of trees covering Mt. Kenya. Mt. Kenya Forest covers 350.7 Km2 and is inhabited by a variety of wildlife including elephants, buffaloes, monkeys, bushbucks and colourful birds while the lower parts of the forest zone provides grazing land for livestock.<br><br>\n\nThe rich flora and fauna within the forest coupled with mountain climbing are a great potential for tourist activities. The county has six major rivers namely; Sagana, Nyamindi, Rupingazi, Thiba, Rwamuthambi and Ragati, all of which drain into the Tana River. These rivers are the principal source of water in the county. The water from these rivers has been harnessed through canals to support irrigation at the lower zones of the county.<br><br>\n\nThe county has a tropical climate and an equatorial rainfall pattern. The climatic condition is influenced by the county position along the equator and its position on the windward side of Mt Kenya. The county has two rainy seasons, the long rains and the short rains. Administratively, the county is divided into five districts namely; Kirinyaga East, Kirinyaga West, Mwea East, Mwea West and Kirinyaga Central. The districts are subdivided further into 12 divisions, 30 locations and 81 sub-locations.The county has four constituencies namely Mwea, Ndia, Kirinyaga Central and Gichugu. Kirinyaga County has twenty (20) wards.<br><br>\n\nFrom the Kenya Population and Housing Census 2009 report, the population of the county stood at 528,054 persons with an annual growth rate of 1.5 percent. The population is projected to be 595, 379 in 2017. Kerugoya, Sagana and Wang`uru are the only towns in the County while Kagio and Kagumo comprise the urban centres. The town with the highest population is Wang`uru with a population of 18,437; followed by Kerugoya with a population of 17,122; the least populated town is Sagana with a population of 10,344. The urban centre with the highest population is Kagio with a population of 3,512 followed closely by Kagumo with a population of 3,489. The population of Wang`uru is highest because it has a lot of economic activities, mainly rice farming while Kerugoya town had long been the District administrative headquarters.<br><br>\n\nThe total road network of in the county is 1,109.11 Km, out of which 106.5 Km is bitumen, 462.05 Km is gravel and 540.5 Km is earth surfaced roads. The county has an established road network with 7 tarmac roads passing through it namely Makutano - Embu road, Kutus - Karatina road, Baricho road, Kiburu road, Kutus - Sagana road, Kutus - Kianyaga road and Kabare - Kimunye road. There is only a 5km of railway line and one railway station in the county located in Ndia Constituency but currently not in use.<br><br>\n\nThere is one airstrip located in Mwea constituency.<br><br>\n\nThe mobile phone coverage stands at 99 percent while the number of fixed lines stands at 693 units. There are 5 sub- post offices and 14 cyber-cafes. There is also an increase in the usage of computers and internet in government offices, private businesses and homes due to availability portable modems and affordability of computers and laptops.<br><br>', '1205.4', 'Kerugoya / Kutus', 'kirinyaga.jpg', NULL, 'Mwea; Gichugu; Ndia; Kirinyaga Central', 'http://kirinyaga.go.ke', 'Kirinyagacounty2013@gmail.com', '@CGoKirinyaga/ @GovernorNdathi', 'Kirinyaga County Government', '', 'P.O. BOX 260 -10304. KUTUS.', '0202582237/ 0202054354', 1, 1),
(21, 'Murang\'a', 'muranga', 'Murang`a County is one of the five counties in Central region of the Republic of Kenya. It is bordered to the North by Nyeri, to the South by Kiambu, to the West by Nyandarua and to the East by Kirinyaga, Embu and Machakos counties. It lies between latitudes 0<sup>o</sup> 34` South and 107` South and Longitudes 36<sup>o</sup> East and 37<sup>o</sup> 27` East. The county occupies a total area of 2,558.8Km<sup>2</sup>.', '2325.8', 'Murang\'a', 'muranga.jpg', NULL, 'Kangema; Mathioya; Kiharu; Kigumo; Maragwa; Kandara; Gitanga', 'www.muranga.go.ke', 'info@muranga.go.ke', '@CountyMuranga', 'Muranga County Government', '', 'P.O Box 52-10200 Muranga', '(060)2030271/ 0716833073', 1, 1),
(22, 'Kiambu', 'kiambu', 'Kiambu county is located in Central Kenya and comprises 12 constituencies namely:<br><br>\n<ul>\n<li>Lari.</li>\n<li>Juja.</li>\n<li>Ruiru.</li>\n<li>Kikuyu.</li>\n<li>Limuru.</li>\n<li>Kabete.</li>\n<li>Kiambaa.</li>\n<li>Githunguri.</li>\n<li>Thika Town.</li>\n<li>Kiambu Town.</li>\n<li>Gatundu North.</li>\n<li>Gatundu South.</li></ul><br><br>\nThe County was first set up in 1925, as Kiambu Native District Council, later changing to Kiambu African Native Council in 1958. It finally gained its official name `Kiambu` borrowing from resultant screams arising from tribal raids conducted by the Maasai, who often raided the villages for livestock.<br><br>\n\nAgriculture<br><br>\n\nKiambu is characteristic of fertile soils and plenty of rainfall. There are numerous high potential small holder farms, which pack enough potential to not only feed the county, but also supply Nairobi, Kitui and Kajiado with dairy products, foodstuffs, green vegetables and fresh fruit. Kiambu`s horticultural products, coffee and tea, contribute for a lot in Kenya`s foreign earnings.<br><br>\n\nPopular Attractions<br><br>\n\nTowards Kijabe and Kimende, one gets an opportunity to view the Kenya`s renowned Rift Valley escarpment. These combined with the Mau Mau Caves, Paradise Lost, Chania Falls, Fourteen Falls, Mugumo Gardens, Christina Wangare Gardens, all provide Kiambu with one of the highest tourist potentials in Kenya.<br><br>\n\nThe County is also a home to many urban centres geographically positioned. With its small surface area of about 2,500 square kilometres, Kiambu is perhaps one of the most urbanised counties after Nairobi, Mombasa and Kisumu.<br><br>\n\nIndustrial Hub<br><br>\n\nIn addition to the county`s entrpreunership potential, towns like Kikuyu, Limuru, Ruiru and Thika are home to manufacturing factories, mining, textile and major industrial assembly plants. These have all seen tremendous growth in recent years, providing good commercial opportunities to residents and investors investors alike. They also attract cosmopolitan workers, who enhance the conty`s national and cultural integration, something many counties might never enjoy.<br><br>\n\nReal Estate Potential<br><br>\n\nKiambu is a dormitory zone to the overstretched Nairobi County, as many of its inhabitants; prefer to seek accommodation in the affordable urban centers located within Kiambu, and therefore commute to Nairobi daily. This has spelt a boom to Kiambu`s property prices and residential investments over the years. Moreover, many residential estates are now emerging at a fast rate just off the Thika Super Highway.<br><br>\n\nAside from Thika town, which commands a major residential periphery, Ruiru, Kiambu, Ruaka and Kikuyu towns are all arguably Nairobi`s unsung locations for prime residential estates in the county. Good security, physical and social infrastructure, are just but the few incentives that give these premium properties impetus as excellent sources of revenue and living.<br><br>\n\nPopulation<br><br>\n\nAccording to the general information 2009; Kiambu County has a population of 1,623,282, with a surface area of 2,543 SQ KM and a density of 638 people per SQ KM. It has a 60.8% of the urban population.', '2449.2', 'Kiambu', 'kiambu.jpg', NULL, 'Gatundu South; Gatundu North; Juja; Thika Town; Ruiru; Githunguri; Kiambu; Kiambaa; Kabete; Kikuyu; Limuru; Lari', 'www.kiambu.go.ke', 'info@kiambu.go.ke', '@KiambuCountyGov', 'Kiambu County Government-Kenya', '', 'P.O. Box 2344-00900, Kiambu.', '0709877000', 1, 1),
(23, 'Turkana', 'turkana', 'Located in north western Kenya bordering Marsabit county to the east, Samburu county to the south east, and Baringo and West Pokot County to the south, to the South-west', '71597.8', 'Lodwar', 'turkana.jpg', NULL, 'Turkana North; Turkana West; Turkana Central; Loima; Turkana South; Turkana East; Turkana West', 'www.turkana.go.ke', 'info@turkana.go.ke', '@TurkanaCounty', 'Turkana County', '', ' P.O. Box 11-30500, Turkana. ', '0723730513', 1, 1),
(24, 'West-Pokot', 'west-pokot', 'West Pokot County is among the forty seven counties in Kenya under the new dispensation of county governments. The county has a population of 512,690 (2009 census) and an area of 8,418.2 km²<br /><br />\nIt is located in the Rift Valley and constitutes 3 constituencies (Kacheliba, Kapenguria and Sigor).', '8418.2', 'Kapenguria', 'west pokot.jpg', NULL, 'Kapenguria; Sigor; Kacheliba; Pokot South', 'http://Westpokot.go.ke', 'info@westpokot.go.ke', 'WPCGovernment', 'West Pokot County Government ', '', 'PO Box 222 - 30600,Kapenguria', '05 32014000', 1, 1),
(25, 'Samburu', 'samburu', 'Samburu County is located in Rift Valley and constitutes 2 constituencies (Samburu West and Samburu East).', '20182.5', 'Maralal', 'samburu.jpg', NULL, 'Samburu West; Samburu North; Samburu East', 'http://Samburu.go.ke', 'info@samburu.go.ke ', '@SamburuGovt', 'County Assembly of Samburu ', '', 'P.O. Box 3- 20600, Maralal, Kenya.', '+254 065 62456/ +254 065 62075', 1, 1),
(26, 'Trans-Nzoia', 'trans-nzoia', 'Trans Nzoia County is located in the former Rift Valley Province, it borders the Republic of Uganda to the North West, and the following counties; West Pokot to North, Elgeyo Marakwet to the East, Uasin Gishu and Kakamega to the South, and Bungoma to the West and South West.<br><br>\nArea (Km 2): 2,495.5 Km<sup>2</sup>\nClimate/Weather: Temperatures range from a mean annual minimum of 10&deg;C to a mean maximum of 37&deg;C, with average rainfall amounts of 11,200mm per annum.\nRoad Network: Bitumen Surface (59.2 Km), Gravel Surface (135 Km), Earth Surface (306.5 Km)\nKey National Monument(s): Kitale Museum, Mt. Elgon National Park, Saiwa Swamp National Park\nPopulation: 818,757 (Male - 50 %, Female - 50 %)\nPopulation Density: 328 people per Km<sup>2</sup>', '2469.9', 'Kitale', 'trans-nzoia.jpg', NULL, 'Kwanza; Endebess; Saboti; Kiminini; Cherenganyi', 'http://transnzoia.go.ke', 'countyoftransnzoia@gmail.com', '@Trans_NzoiaGov', 'County Government of Trans-Nzoia', '', 'P.O. Box 4211-30200, Kitale', '(054)30301/ (054) 30302', 1, 1),
(27, 'Uasin-Gishu', 'uasin-gishu', 'Eldoret is a town in western Kenya. It is the capital and largest town in Uasin Gishu County. Lying south of the Cherangani Hills, the local elevation varies from about 2100 metres above sea level at the airport to more than 2700 metres in nearby areas (7000-9000 feet). The population was 289,380 in the 2009 census, and it is currently the fastest growing town in Kenya. It is also the 2nd largest urban centre in midwestern Kenya after Nakuru and the 5th largest urban centre in Kenya.<br /><br />\nThe name \"Eldoret\" is based on the Maasai word \"eldore\" meaning \"stony river\" because the bed of the nearby Sosiani River is very stony. The white settlers decided to call it Eldoret to make it easier for them to pronounce it. At the start of the colonial era, the area was occupied by the Nandi, before that by the Maasai and before that the Sirikwa', '2955.3', 'Eldoret', 'uasin gishu.jpg', NULL, 'Soy; Ainabkoi; Kesses; Kapseret; Moiben', 'http://uasingishu.go.ke', 'info@uasingishu.go.ke', '@UGC_TheChampion', 'County Government of Uasin Gishu', '', 'P.O. Box 40-30100, Eldoret.', '053-2016000 / 020-32603 / 0723412161', 1, 1),
(28, 'Elgeyo-Marakwet', 'elgeyo-marakwet', 'Elgeyo Marakwet County covers a total area of 3029.9 km2. It borders West Pokot County to the North, Baringo County to the East, Trans Nzoia County to the Northwest and Uasin Gishu County to the West. <br><br>\n\nThe county is divided into three topographic zones namely: The Highlands, Kerio Valley and The Escarpment: all of them separated by the conspicuous Elgeyo Escarpment.<br><br>\n\nThe Highlands constitutes 49 percent of the county`s area and is densely populated due to its endowment with fertile soils and reliable rainfall.The Escarpment and the Kerio Valley make up 11percent and 40 percent respectively. There is a marked variation in amount of rainfall in the three zones; The Highlands receive between 1200mm and 1500mm per annum while The Escarpment and the Kerio Valley receives rainfall ranging between 1000mm to 1400mm per annum.<br><br>\n\nIn altitude, the Highland plateau rises from an altitude of 2700 meters above sea level on the Metkei Ridges in the South to 3350 metres above sea level on the Cherangany Hills to the North<br><br>\n\nAdministratively, the county is divided into four sub-counties, namely: Marakwet East, Marakwet West, Keiyo South and Keiyo North each with several Divisions, Locations and Sub-locations.<br><br>\n\nPolitically, the county is divided into four constituencies: Marakwet East, Marakwet West, Keiyo South and Keiyo North and twenty Wards; six in both Marakwet West and Keiyo South and four in Marakwet East and Keiyo North.<br>\n\nThe county`s total population was 370,712 in 2009 (National Population and Housing Census). The 2012 population projection was 401,989. The inter-census population growth rate for the county is 2.7 percent per annum.<br><br>\n\nKeiyo North has the highest population density of 148 persons per km2 while Marakwet East has the lowest with 109 persons per km2. Keiyo South and Marakwet West have 132 km2 and 146 km2 respectively.<br><br>\n\nOn poverty levels, human development indicators show that the county has 57 percent of residents live below the poverty line compared to the national poverty level of 46 percent.<br><br>\n\nThe levels of poverty in the county are geographically distributed. At the Escarpment and The Kerio Valley, poverty levels are as high as 67 percent of the population while in the Highlands poverty levels average 47 percent.', '3049.7', 'Iten', 'elgeyo-marakwet.jpg', NULL, 'Marakwet East; Marakwet West; Keiyo East; Keiyo South', 'http://Elgeyomarakwet.go.ke', 'emcounty2013@gmail.com', '@ElgeyoMarakwetC', 'County Government of Elgeyo Marakwet', '', 'P. O. BOX 384 - 30700, Iten', '721477631; 722287305 / 0734220220', 1, 1),
(29, 'Nandi', 'nandi', 'Nandi County is located in Rift Valley and constitutes 4 constituencies (Mosop, Aldai, Emgwen and Tinderet). Nandi North, Nandi East, Nandi South, Nandi Central and Tinderet districts were mapped to this county for the purposes of generating county estimates<br><br>\nNandi County has huge tourism potential that, when fully and sustainably developed will stimulate employment creation, promote conservation of the natural environment, preserve the culture of the local community, and generally boost the economy of the county.', '2884.5', 'Kapsabet', 'nandi.jpg', NULL, 'Tinderet; Aldai; Nandi Hills; Emgwen North; Emgwen South; Mosop', 'http://Nandi.go.ke', 'info@nandi.go.ke', '@Nandicountygov', 'County Government of Nandi ', '', 'P.O Box 802-30300,  Box 331-30300, Kapsabet', '254(0) 53-52621, 0535252355', 1, 1),
(30, 'Baringo', 'baringo', 'Baringo County is located in the Rift Valley and constitutes 5 constituencies (Baringo Central, Baringo East, Eldama Ravine, Baringo East and Mogotio). Baringo, Baringo North, East Pokot and Koibatek districts were mapped to this county for the purposes of generating county estimates.<br><br>\n\nLocation: Located in Rift-Valley, it borders Turkana and Samburu Counties to the North, Laikipia County to the East, Nakuru County to the South and Kericho, Nandi, Uasin Gishu, Elgeyo Marakwet and West Pokot Counties to the West.', '11075.3', 'Kabarnet', 'baringo.jpg', NULL, 'Baringo East; Baringo West; Baringo Central; Mogotio; Eldema Ravine', 'http://Baringo.go.ke', 'info@baringo.go.ke', 'Baringo_county', 'Baringo County Government', '', 'P. O. Box 53 - 30400, Kabarnet', '(0) 53-22115', 1, 1),
(31, 'Laikipia', 'laikipia', 'Laikipia County is one of the 14 counties within the Rift Valley region and one of the 47 counties in the Republic of Kenya. Laikipia County comprises three administrative sub-counties (the Constituencies) namely: Laikipia East, Laikipia North and Laikipia West. The Laikipia East Sub- County lie to the east, Laikipia North to the North and Laikipia West to the west of the County. The sub-County headquarters are at Nanyuki, Dol Dol and Rumuruti respectively. <br><br>\nLaikipia County comprises four former Local Authorities namely: County council of Laikipia; Municipal council of Nanyuki; Municipal council of Nyahururu; and Town council of Rumuruti.<br><br>\nLaikipia County has not established structures that will define what a village is. However, the County is further sub divided into 15 divisions, 51 locations and 96 sub-locations. <br><br> \nLaikipia County borders Samburu County to the North, Isiolo County to the North East, Meru County to the East, Nyeri County to the South East, Nyandarua County and Nakuru County to the South West and Baringo County to the West. It lies between latitudes 0o 18` and 0o 51` North and between longitude 36o ', '8696.1', 'Rumuruti', 'laikipia.jpg', NULL, 'Laikipia West Constituency; Laikipia East Constituency; Laikipia North Constituency', 'http://laikipia.go.ke', 'info@laikipia.go.ke', '@lc_govt', 'County Government Of Laikipia ', '', 'P. O. Box 487- 10400. Nanyuki.', '254733446830', 1, 1),
(32, 'Nakuru', 'nakuru', 'Nakuru County is located in the former Rift Valley Province of Kenya, about 90km from Nairobi, Nakuru is an agriculturally-rich county blessed with various tourist attractions such as craters and lakes.<br><br>\n\nIt`s made up of 11 constituencies namely;<br><br>\n<ol type=\"1\">\n<li>Naivasha Constituency</li>\n<li>Nakuru Town West Constituency</li>\n<li>Nakuru Town East Constituency</li>\n<li>Kuresoi South Constituency</li>\n<li>Kuresoi North Constituency</li>\n<li>Molo Constituency</li>\n<li>Rongai Constituency</li>\n<li>Subukia Constituency</li>\n<li>Njoro Constituency</li>\n<li>Gilgil Constituency</li>\n<li>Bahati Constituency</li></ol><br><br>\nNakuru borders seven counties; Laikipia to the north east, Kericho to the west, Narok to the south west, Kajiado to the south, Baringo to the north, Nyandarua to the east and Bomet to the west.<br><br>\n\nIt covers an area of 7496.5 square kilometres.<br><br>\n\nThe name Nakuru means `a dusty place` in the Maasai language - in reference to frequent whirlwinds that engulf the area with clouds of dust.', '7509.5', 'Nakuru', 'nakuru.jpg', NULL, 'Molo; Njoro; Naivasha; Gilgil; Kuresoi South; Kuresoi North; Subukia; Rongai; Bahati; Nakuru Town West; Nakuru Town East', 'http://Nakuru.go.ke', 'nakurucounty.governor@gmail.com', '@NakuruCountyGov', 'Nakuru County Government - official ', '', 'P O BOX 907, NAKURU', '0775096861, 0711133005', 1, 1);
INSERT INTO `mrfc_reg_county` (`county_id`, `county`, `county_seo`, `blurb`, `area`, `capital`, `map`, `crest`, `constituencies`, `website`, `email`, `twitter`, `facebook`, `youtube`, `postaladdress`, `telephone`, `published`, `is_widget`) VALUES
(33, 'Narok', 'narok', 'Narok County is situated in Kenya along the Great Rift Valley. It is named after, Enkare Narok, the river flowing through Narok town. It covers an area of 17,944 sq km and has a population of 850,920. The temperature range is 12 to 28 0C and the average rainfall range of 500 to 1,800 mm per annum. The Maasai Mara National Park , an important tourist destination, is located in Narok County. It is home to the Great Wildebeest Migration which is one of the `Seven New Wonders of the World`. <br><br> It constitutes 6 sub-counties namely:<br><br><ol type=\"1\"><li>Kilgoris</li> <li>Narok North</li> <li>Narok South</li> <li>Narok East</li> <li>Narok West</li> <li>Emurua Dikirr</li></ol><br><br> Narok town is the capital Head Quarters of the Narok County and stands as the major centre of commerce in the county.<br><br>\n\nAs per the UN study/research for the Kenya Vision 2030, Narok County is marked as one of the fundamental counties for the achieving economic pillar. Key contributions are in the tourism sector through the Maasai Mara and the agricultural sector through livestock farming. ', '17921.2', 'Narok', 'narok.jpg', NULL, 'Kilgoris; Emurua Dikirr; Narok North; Narok East; Narok West; Narok South', 'http://Narok.go.ke', 'Info@narok.go.ke', '@COUNTYOFNAROK', 'Narok County Government', '', 'P. O Box 545-20500 Narok Kenya.', '0721894485, 0721241577, 0725904436', 1, 1),
(34, 'Kajiado', 'kajiado', 'Kajiado County covers an approximated area of 21,900.9 square kilometers. ?The county consists of a number of administrative districts: Kajiado Central, Isinya, Loitokitok, Magadi, Mashuru, Namanga and Ngong. Kajiado County is adjacent to the Capital City of Kenya, Nairobi. Kajiado`s County neighbours include counties of Machakos, Makueni, Narok, Taita Taveta and Kiambu counties. Here are few towns found in the county - Ngong, Kitengela, Ongata Rongai, Kiserian, Kajiado, Loitokitok, Namanga, Isinya, Sultan Hamud and Ilbisil.<br><br>\n\nThe county`s main physical features include the beautiful plains, valleys ,volcanic hills, scarce vegetation in low altitude areas which increases with altitude and rain this combinations make Kajiado one of few natural selected wildlife habitat in Kenya. Kajiado County like many counties in Kenya is mainly water stressed where community members sometimes find themselves covering an average of 10km in search of water.<br><br>\n\n<span style =\"text-decoration: underline;\">Demographic Features</span>\nThe county has a population growth rate of 5.5 percent; total population was estimated at 807,070 with 401,785 being females and 405,245 males as at the statistics of 2012. The population is projected to grow to 1 million by the year 2017.<br><br>\n\n<span style =\"text-decoration: underline;\">Economic Activities</span>\nEconomic growths and development is majorly depending on the main strengths and future investments in this sectors of Agriculture, Horticulture, Food Crop Farming, Livestock production, Dairy, Beef production, Hides and Skins, Poultry Farming and other Commercial exploits. Tourism is a strength that Kajiado holds dear through the current progress with Amboseli National Park, but not only stopping there for there is a lot of room for good investment in this area.<br><br>\n\n?Kajiado has Forestry about 6,866.88 ha of forest cover. Conservation efforts to improve our forest cover being a serious matter in the hearts of the people of Kajiado. Tree farming as an economic activity is being encouraged.', '21292.7', 'Kajiado', 'kajiado.jpg', NULL, 'Kajiado Central; Kajiado North; Kajiado South; Kajiado East', 'http://Kajiado.go.ke', 'info@kajiado.go.ke', '@KajiadoGov', 'Kajiado County Governmen', '', 'P.O. Box 11, Kajiado. ', '0704600599, 0736630740', 1, 1),
(35, 'Kericho', 'kericho', 'Kericho County is characterized by undulating topography.The overall slopes of the land is towards the west,consequently drainage is in that direction.the county forms a hilly self between the mau escarpments and the lowlands of kisumu<br><br>\n<ul>\n<li>Physical and ecological Conditions</li>\n<li>Ecological Condition.</li>\n<li>Climatic Conditions.</li>\n<li>Administrative Units.</li></ul>', '2454.5', 'Kericho', 'kericho.jpg', NULL, 'Ainamoi; Belgut; Kipkelion East; Kipkelion West; Sigowet; Bureti', 'http://Kericho.go.ke', 'kerichocounty1@gmail.com', '@CountyKericho @Aaroncheruiyot', 'Kericho County', '', 'P.O. Box 1376- 20200, Kericho.', '0700938585', 1, 1),
(36, 'Bomet', 'bomet', 'Bomet County is located in the former Rift Valley Province bordering Kericho County to the North and North East, Narok County to the South East, South, and South West, and Nyamira County to the North West.<br /><br />\nThe county, listed electoral number 36, has Bomet town as its administrative center and covers a total area of 1,997.90 Sq Km. ', '1997.9', 'Bomet', 'bomet.jpg', NULL, 'Sotik; Chepalungu; Bomet East; Bomet Central; Konoin', 'http://Bomet.go.ke', 'info@bomet.go.ke', '@BometCountyGov', 'Bomet County', '', 'P.O. Box 19-20400 BOMET, KENYA', '0772 99 11 44', 1, 1),
(37, 'Kakamega', 'kakamega', 'Kakamega county is located in western kenya about 30km north of the equator. It consists of 12 constituencies in total namely: Butere, Mumias, Matungu, , Likuyani , Mumias East , Khwisero, Shinyalu, Lurambi, Ikolomani, Lugari malava and Navakholo.', '3033.8', 'Kakamega', 'kakamega.jpg', NULL, 'Lugari; Likuyani; Malava; Lurambi; Makholo; Mumias; Mumias East; Matungu; Butere; Khwisero; Shinyalu; Ikolomani', 'www.kakamega.go.ke', 'info@kakamega.go.ke', '@kakamega_govt', 'County Government of Kakemga', '', 'P.O. Box 36- 50100. KAKAMEGA', '056 2031850, 056 2031852, 056 2031853', 1, 1),
(38, 'Vihiga', 'vihiga', 'Vihiga County whose headquarters is in Mbale is Located in the Western Region of Kenya. It boarders Nandi to the East, Kisumu County to the South, Siaya County to the West and KAKAMEGA County to the North. It is one of the four Counties in the former Western Province. Vihiga County has five Constituencies; Luanda, Emuhaya, Hamisi, Sabatia and Vihiga.<br /><br /> The County`s population stands at 612,000. With an annual population growth rate of 2.51%, the population is projected to be 688,778 by the year 2017. It has an annual fertility rate of 5.1% which explains the high population rise. However, the age distribution is given as 0-14 years (45%), 15-64 years (49%), 65 years and above (6%) with the youth representing 25% of the population.', '531.3', 'Vihiga', 'vihiga.jpg', NULL, 'Vihiga; Sabatia; Hamisi; Emuhaya; Luanda', 'http://Vihiga.go.ke', 'info@vihiga.go.ke, communications@vihiga.go.ke', '@vihiga_county', 'Vihiga County', '', 'P. O. Box 344- 50300 vihiga', '(056) 514401, 51590, 0723037863', 1, 1),
(39, 'Bungoma', 'bungoma', 'Bungoma County borders the Republic of Uganda to the West, Teso and Busia districts to the South West, Mumias to the South, Trans-Nzoia, Lugari and Kakamega to the North East.<br><br>\n\nThe County has an area of 3,032.2 sq. Km and lies between 1,200 and 1,800 meters above sea level and experiences mean temperatures of 23 degrees centigrade. Its latitude stands at 0.57 with the longitude of 34.56. The population of Bungoma is estimated at 1,630,934 (as projected in 2009) of which female constitute 52% while male are 48%. Age percentage distribution stands at; 0-14 years 45.9 %, 15-64 years 51.4 % and over 65 years 2.3% <br><br>\n\nThe region has a population density of 453.5 people per sq. Km with a national percentage of 3.6%. Poverty level index stand at 53% while age dependency ration is at 93.8. <br><br>\n\nBungoma is divided into nine administrative and political divisions: Bumula, Kanduyi, Kimilili, Sirisia, Kabuchai, Webuye East, Webuye West, Tongaren, and Mt. Elgon which are further divided into 46 political wards and 88 administrative Locations.', '2206.9', 'Bungoma', 'bungoma.jpg', NULL, 'Mt. Elgon; Sirisia; Kabuchai; Bumula; Kandunyi; Webuye; Bokoli; Kimilili; Tongaren', 'http://bungoma.go.ke', 'info@bungoma.go.ke', '@Bungoma_County_', 'Bungoma County', '', 'P.O. Box 437 - 50200\nBUNGOMA', '(055) 30343, 0725571556', 1, 1),
(40, 'Busia', 'busia', 'Located in western Kenya, it borders Lake Victoria to the South West, the Republic of Uganda to the West, North and North East, and the following Counties; Bungoma and Kakamega to the East, and Siaya to the South East and South.', '1628.4', 'Busia', 'busia.jpg', NULL, 'Teso North; Teso South; Nambale; Matayos; Butula; Funyula; Budalangi', 'http://busiacounty.go.ke', 'info@busiacounty.go.ke', '@BusiaGovernment', 'Busia county', '', 'P. O. BOX 196 - 50400, Busia', '+254715404040', 1, 1),
(41, 'Siaya', 'siaya', 'The County of Siaya borders Busia County to the North, Kakamega County to the Northeast, Vihiga County to the East, Kisumu to the South East, with Lake Victoria to the South and West Siaya County is inhabited by nine communities namely: Yimbo, Alego, Uyoma, Gem, Ugenya, Sakwa, Usonga, Asembo and Uholo. Siaya County shares the shores of Lake Victoria together with other neighbouring counties.<br><br>\nSiaya town the capital of the county is an economic hub with massive potential for providing for the country`s needs. Siaya has had various prominent persons call their origin including the US President Barack Obama.<br><br>\nAgriculture and fishing are the main economic activities. Local agricultural production consists of Rice, Cotton, Coffee, Sugarcane, Tobacco, Kales, indigenous greens, Bananas, Sweet Potatoes and Cassava. Cattle and poultry area also kept.<br><br>\nLake Victoria supports the vibrant fishing industry. There are a number of fisheries in the County that process fish from the lake. The county enjoys relatively good weather patterns throughout the year two rainy seasons annually.<br><br>\nSiaya County constitutes 6 constituencies:<br><br> <ol type=\"1\"><li>Ugenya</li> <li>Ugunja</li> <li>Alego Usonga</li> <li>Gem</li> <li>Bondo</li> <li>Rarieda</li></ol>', '2496.1', 'Siaya', 'siaya.jpg', NULL, 'Ugenya; Ugunja; Alego Usonga; Gem; Bondo; Rareida', 'http://siaya.go.ke', 'info@siaya.go.ke', '@countysiaya, @siayagov', 'Siaya-County Updates/Briefings', '', 'P.O. Box 803-40600, Siaya', '0727898309', 1, 1),
(42, 'Kisumu', 'kisumu', 'Kisumu County is located in Nyanza and constitutes 6 constituencies (Kisumu Town East, Kisumu Town West, kisumu Rural, Nyand, Muhoroni and Nyakach). Kisumu East, Kisumu West and Nyando districts were mapped to this county for the purposes of generating county estimates.', '2009.5', 'Kisumu(City)', 'kisumu.jpg', NULL, 'Kisumu East; Kisumu West; Kisumu Central; Seme; Nyando; Muhoroni; Nyakach', 'http://kisumu.go.ke', 'info@kisumu.go.ke', '@KisumuCoutyKE', 'County Government of Kisumu', '', 'P.O. Box 2738 - 40100, KISUMU', '254 773456711, 057-2025366, 057-2025377', 1, 1),
(43, 'Homa-Bay', 'homa-bay', 'Popularly known as the Bay County, because of its many bays, Homa Bay County has population of 963,794 and an area of 3,183.3 km². About 80% of Kenya`s Lake Victoria is in Homabay County, making the county the leading supplier of fresh lake fish in Kenya.<br><br>\n\nWith breathtaking islands, hills, valleys and the longest shores of Lake Victoria, Homabay provides unrivalled investment opportunities. The County government welcomes investors to the county, and is committed to making Homabay the County of Choice for investors.<br><br>\n\n?Homa Bay County is located in Nyanza and constitutes 6 constituencies (Kasipul Kabondo,Karachuonyo, Rangwe, Dhiwa, Mbita and Gwasi).', '3154.7', 'Homa Bay', 'homa bay.jpg', NULL, 'Kasipul; Kabondo; Karachuonyo; Rangwe; Homabay Town; Ndhiwa; Mbita; Gwasi', 'http://homabay.go.ke', 'info@homabay.go.ke, governor@homabay.go.ke', '@HomaBayGovt', 'County Government of Homa Bay', '', 'P. O. BOX 673 - 40300, Homa Bay.', '+254-734-889977', 1, 1),
(44, 'Migori', 'migori', 'Migori County is located in the West and constitutes 5 constituencies (Rongo, Migori, Uriri, Nyatike and Kuria.). Kuria East, Kuria West, Migori and Rongo districts were mapped to this county for the purposes of generating county estimates', '2586.4', 'Migori', 'migori.jpg', NULL, 'Rongo; Awendo; Migori East; Migori West; Uriri; Nyatike; Kuria East; Kuria West', 'http://migori.co.ke', 'info@migori.go.ke', '@MigoriAssembly', 'Migori County Government, Okoth Obado', '', 'P.O. Box 195-40400, Migori.', '254-726319450, 770304976', 1, 1),
(45, 'Kisii', 'kisii', 'Kisii County is one of the 47 counties in Kenya courtesy of the new constitution of Kenya 2010 which created the new county system of governance. It shares common borders with Nyamira County to the North East, Narok County to the South and Homabay and Migori Counties to the West.\n<br /><br />\nThe county lies between latitude 0 30` and 1 0` South and longitude 34 38` and 35 0` East. The county covers a total area of 1,332.7 km square and is divided into nine constituencies namely: Kitutu Chache North, Kitutu Chache South, Nyaribari Masaba, Nyaribari Chache, Bomachoge Borabu, Bomachoge Chache, Bobasi, South Mugirango and Bonchari. It has 9 sub-counties and 45 Wards respectively.\n<br /><br />\nThe county`s total population is projected at 1,226,873 persons in 2012.This represents 586,062 and 640,811 males and females respectively. By 2017, this population is expected to rise to 1,362,779 persons (650,982 males and 711,797 females). Population distribution in the county is influenced by such factors as physical, historical, patterns of economic development and policies pertaining to land settlement.\n<br /><br />\nPopulation densities are high in areas with large proportions of arable land such as Kitutu Chache South (1348), Nyaribari Chache (1128), Bomachoge Borabu (992), Bomachoge Chache (992) respectively. The county is characterized by a hilly topography with several ridges and valleys and it is endowed with several permanent rivers which flow from East to West into Lake Victoria. Soils in the county are generally good and fertile allowing for agricultural activities.\n<br /><br />\nThe county has a highland equatorial climate resulting into a bimodal rainfall pattern with two rainy seasons, the long rains occurring between February and June and the short rains occurring between September and early December. The adequate rainfall, coupled with moderate temperature is suitable for growing of crops like tea, coffee, maize, beans, and finger millet potatoes, bananas and groundnuts. This also makes it possible to practice dairy farming in the county.', '1317.9', 'Kisii', 'kisii.jpg', NULL, 'Bonchari; South Mugirango; Bomachoge; Bobasi; Gucha; Nyaribari Masaba; Nyaribari Chache Matrani; Mosocho', 'www.kisii.go.ke', 'info@kisii.go.ke', '@kisiicountygov', 'Kisii County', '', 'P.O. Box 4550-40200, Kisii.', '254-58-2030005', 1, 1),
(46, 'Nyamira', 'nyamira', 'Nyamira is one of the 47 counties in Kenya. The county borders Homabay to the north, Kisii to the west, Bomet to the south east and Kericho to the east. The county covers an area of 899km2 and lies between 00 30` and 0045`south, 340 45` and 350 00` east. Administratively the County has 5 districts namely Nyamira, Nyamira North, Borabu, Manga and Masaba North with 13 divisions, 33 locations and 88 sub locations. Politically the county has four constituencies namely West Mugirango, North Mugirango, Borabu and Kititu Masaba with 20 county assembly wards.<br><br>\n\nThe county`s topography is mostly hilly `Gusii highlands`. The Kiabonyoru, Nyabisimba, Nkoora, Kemasare hills and the Manga ridge are the most predominant features in the county. The two topographic zones in the county lie between 1,250 m and 2,100m above the sea level. The low zones comprise of swampy, wetlands and valley bottoms while the upper zones are dominated by the hills. The high altitude has enabled the growth of tea which is the major cash crop and income earner in the county. The permanent rivers and streams found in the county include Sondu, Eaka, Kijauri, Kemera, Charachani, Gucha (Kuja), Bisembe, Mogonga, Chirichiro, Ramacha and Egesagane. All these rivers and several streams found in the county drain their water into Lake Victoria. The major types of soil found in the county are red volcanic (Nitosols) which are deep, fertile and well-drained accounting for 75 per cent while the remaining 25 per cent are those found in the valley bottoms and swampy areas suitable for brick making.<br><br>\n\nThe two major agro-ecological zones are the highland (LH1 and LH2) and covers 82 per cent of the county while the upper midland zone (UM1, UM2 and UM3) covers the remaining 18 per cent. The county has a bimodal pattern of annual rainfall that is well distributed, reliable and adequate for a wide range of crops. Annual rainfall ranges between 1200mm-2100mm per annum. The long and short rain season start from December to June and July to November respectively, with no distinct dry spell separating them. The maximum day and minimum night temperatures are normally between 28.7c and 10.1c respectively, resulting to an average normal temperature of 19.4c which is favourable for both agricultural and livestock production. Below is the map showing the administrative boundaries.', '912.5', 'Nyamira', 'nyamira.jpg', NULL, 'Kitutu Masaba; North Mugirango; West Mugirango; Borabu', 'http://nyamira.go.ke', 'info@nyamira.go.ke', '@Nyamira_County', 'Governor John Nyagarama', '', 'P.O. Box 434-40500, Nyamira.', '254-058-6144288/ (001) 2345678', 1, 1),
(47, 'Nairobi', 'nairobi', 'The Nairobi City County is the creation of the Constitution of Kenya 2010 and successor of the defunct City Council of Nairobi. It operates under the auspices of the Cities and Urban Areas Act, The Devolved Governments Act and a host of other Acts.\nThe Nairobi City County is charged with the responsibility of providing a variety of services to residents within its area of jurisdiction. These include the services that were hitherto provided by the defunct City Council and the ones that have been transferred from the national government.<br /><br />\nThe former include Physical Planning, Public Health, Social Services and Housing, Primary Education Infrastructure, Inspectorate Services, Public Works, Environment Management while the latter include Agriculture, Livestock Development and Fisheries, Trade, Industrialization, Corporate Development, Tourism and Wildlife, Public Service Management.<br /><br />\nThe Nairobi City County, in execution of responsibilities and functions bestowed upon it by the above Acts has been divided into three arms as follows:<br />\n\n<ul><li>The Executive led by The Governor</li>\n<li>The Legislative Arm or the County Assembly headed by The Speaker</li>\n<li>County Public Service Board</li></ul>', '694.9', 'Nairobi (City)', 'nairobi.jpg', NULL, 'Westlands; Parklands; Dagoretti; Karen/Langata; Kibira; Roysambu; Kasarani; Ruaraka; Kariobangi; Kayole; Embakasi; Mihango\nNairobi West; Makadara; Kamukunji; Starehe; Mathare', 'http://nairobi.go.ke', 'info@nairobi.go.ke', '@county_nairobi', 'Nairobi City County', '', 'P.O. Box 30075-00100, Nairobi', '020-344194; 0725-624489', 1, 1),
(48, 'Country wide', 'all-counties-countywide', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_events_booking`
--

DROP TABLE IF EXISTS `mrfc_reg_events_booking`;
CREATE TABLE `mrfc_reg_events_booking` (
  `id` int(11) NOT NULL,
  `date_record` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_content` int(11) NOT NULL,
  `regnum` varchar(50) NOT NULL,
  `orgname` varchar(50) NOT NULL,
  `country` int(11) NOT NULL,
  `orgaddress` tinytext NOT NULL,
  `contacttitle` varchar(10) NOT NULL,
  `contactname` varchar(50) NOT NULL,
  `contactphone` varchar(50) NOT NULL,
  `contactjob` varchar(50) NOT NULL,
  `contactemail` varchar(50) NOT NULL,
  `participants` longtext NOT NULL,
  `participants_num` int(11) NOT NULL,
  `book_booth` tinyint(1) NOT NULL DEFAULT '0',
  `pay_type` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_groups`
--

DROP TABLE IF EXISTS `mrfc_reg_groups`;
CREATE TABLE `mrfc_reg_groups` (
  `group_id` int(11) NOT NULL,
  `group_title` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `published` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_groups`
--

INSERT INTO `mrfc_reg_groups` (`group_id`, `group_title`, `description`, `published`) VALUES
(1, 'Admin', 'Administrator', 1),
(2, 'User', 'User', 1),
(3, 'Editor', 'Editor', 1),
(4, 'Contributor', 'Contributor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_organizations`
--

DROP TABLE IF EXISTS `mrfc_reg_organizations`;
CREATE TABLE `mrfc_reg_organizations` (
  `organization_id` int(11) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `organization_seo` varchar(100) DEFAULT NULL,
  `organization_website` varchar(500) DEFAULT NULL,
  `organization_email` varchar(150) DEFAULT NULL,
  `organization_phone` varchar(150) DEFAULT NULL,
  `organization_profile` text,
  `contact_id` int(11) DEFAULT NULL,
  `logo` mediumtext,
  `social_twitter` varchar(50) DEFAULT NULL,
  `social_facebook` varchar(50) DEFAULT NULL,
  `backlink_url` mediumtext,
  `backlink_image` mediumtext,
  `url` varchar(255) NOT NULL,
  `is_publisher` int(11) NOT NULL DEFAULT '1',
  `is_partner` int(11) NOT NULL DEFAULT '0',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published` int(11) NOT NULL DEFAULT '0',
  `seq` int(11) NOT NULL DEFAULT '90'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_organizations`
--

INSERT INTO `mrfc_reg_organizations` (`organization_id`, `organization`, `organization_seo`, `organization_website`, `organization_email`, `organization_phone`, `organization_profile`, `contact_id`, `logo`, `social_twitter`, `social_facebook`, `backlink_url`, `backlink_image`, `url`, `is_publisher`, `is_partner`, `date_update`, `published`, `seq`) VALUES
(1, 'Council of Governors', 'cog', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '', 1, 0, '2018-03-06 08:43:51', 0, 90),
(2, 'The Open Institute', 'open-institute', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 0, '2018-03-06 08:44:24', 0, 90);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_privilege_list`
--

DROP TABLE IF EXISTS `mrfc_reg_privilege_list`;
CREATE TABLE `mrfc_reg_privilege_list` (
  `priv_id` int(11) NOT NULL,
  `priv_title` varchar(50) NOT NULL,
  `priv_desc` varchar(250) DEFAULT NULL,
  `priv_group` tinyint(1) NOT NULL DEFAULT '0',
  `priv_parent` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_privilege_list`
--

INSERT INTO `mrfc_reg_privilege_list` (`priv_id`, `priv_title`, `priv_desc`, `priv_group`, `priv_parent`, `published`) VALUES
(1, 'user_add', 'Add Users', 0, 0, 1),
(2, 'user_edit', 'Edit Users', 0, 0, 1),
(3, 'content_add', 'Add contents / Events', 0, 0, 1),
(4, 'content_edit', 'Edit contents / Events', 0, 0, 1),
(5, 'content_view', 'View contents / Events', 0, 0, 1),
(6, 'content_approve', 'Approve contents / Events', 0, 0, 1),
(7, 'review_add', 'Add Reviews', 0, 0, 1),
(8, 'review_edit', 'Edit Reviews', 0, 0, 1),
(9, 'review_approve', 'Approve Reviews', 0, 0, 1),
(10, 'resource_add', 'Add resources', 0, 0, 1),
(11, 'resource_edit', 'Edit resources', 0, 0, 1),
(12, 'resource_view', 'View resources', 0, 0, 1),
(13, 'resource_approve', 'Approve resources', 0, 0, 1),
(14, 'community_add', 'Add community', 0, 0, 1),
(15, 'community_edit', 'Edit community', 0, 0, 1),
(16, 'community_approve', 'Approve community', 0, 0, 1),
(17, 'report_view', 'View Reports', 0, 0, 0),
(18, 'facility_add', 'Add Facilities', 0, 0, 0),
(19, 'facility_edit', 'Edit Facilities', 0, 0, 0),
(20, 'facility_view', 'View Facilities', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_privilege_to_roles`
--

DROP TABLE IF EXISTS `mrfc_reg_privilege_to_roles`;
CREATE TABLE `mrfc_reg_privilege_to_roles` (
  `role_id` int(11) NOT NULL,
  `priv_id` int(11) NOT NULL,
  `priv_value` enum('0','1') NOT NULL DEFAULT '0',
  `priv_updated` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_privilege_to_roles`
--

INSERT INTO `mrfc_reg_privilege_to_roles` (`role_id`, `priv_id`, `priv_value`, `priv_updated`) VALUES
(1, 0, '0', 1502579864),
(1, 1, '1', 1502579864),
(1, 2, '1', 1502579864),
(1, 3, '1', 1502579864),
(1, 4, '1', 1502579864),
(1, 5, '1', 1502579864),
(1, 6, '1', 1502579864),
(1, 7, '1', 1502579864),
(1, 8, '1', 1502579864),
(1, 9, '1', 1502579864),
(1, 10, '1', 1502579864),
(1, 11, '0', 0),
(1, 12, '0', 0),
(1, 13, '1', 1502579864),
(1, 14, '1', 1502579864),
(1, 15, '1', 1502579864),
(1, 16, '1', 1502579864),
(1, 17, '0', 0),
(1, 18, '0', 0),
(1, 19, '0', 0),
(1, 20, '0', 0),
(2, 0, '0', 1502579946),
(2, 1, '0', 1502579946),
(2, 2, '0', 1502579946),
(2, 3, '0', 1502579946),
(2, 4, '0', 1502579946),
(2, 5, '1', 1502579946),
(2, 6, '0', 1502579946),
(2, 7, '0', 1502579946),
(2, 8, '0', 1502579946),
(2, 9, '0', 1502579946),
(2, 10, '0', 1502579946),
(2, 11, '0', 1502579946),
(2, 12, '1', 1502579946),
(2, 13, '0', 1502579946),
(2, 14, '0', 1502579946),
(2, 15, '0', 1502579946),
(2, 16, '0', 1502579946),
(2, 17, '0', 0),
(2, 18, '0', 0),
(2, 19, '0', 0),
(2, 20, '0', 0),
(3, 0, '0', 1502580013),
(3, 1, '0', 1502580013),
(3, 2, '0', 1502580013),
(3, 3, '1', 1502580013),
(3, 4, '1', 1502580013),
(3, 5, '1', 1502580013),
(3, 6, '1', 1502580013),
(3, 7, '1', 1502580013),
(3, 8, '1', 1502580013),
(3, 9, '1', 1502580013),
(3, 10, '1', 1502580013),
(3, 11, '1', 1502580013),
(3, 12, '1', 1502580013),
(3, 13, '1', 1502580013),
(3, 14, '1', 1502580013),
(3, 15, '1', 1502580013),
(3, 16, '1', 1502580013),
(3, 17, '0', 0),
(3, 18, '0', 0),
(3, 19, '0', 0),
(3, 20, '0', 0),
(4, 0, '0', 1502580170),
(4, 1, '0', 1502580170),
(4, 2, '0', 1502580170),
(4, 3, '1', 1502580170),
(4, 4, '1', 1502580170),
(4, 5, '1', 1502580170),
(4, 6, '1', 1502580170),
(4, 7, '0', 1502580170),
(4, 8, '0', 1502580170),
(4, 9, '1', 1502580170),
(4, 10, '1', 1502580170),
(4, 11, '1', 1502580170),
(4, 12, '1', 1502580170),
(4, 13, '1', 1502580170),
(4, 14, '0', 1502580170),
(4, 15, '0', 1502580170),
(4, 16, '0', 1502580170),
(4, 17, '0', 0),
(4, 18, '0', 0),
(4, 19, '0', 0),
(4, 20, '0', 0),
(5, 0, '0', 1502580231),
(5, 1, '0', 1502580231),
(5, 2, '0', 1502580231),
(5, 3, '1', 1502580231),
(5, 4, '1', 1502580231),
(5, 5, '1', 1502580231),
(5, 6, '0', 1502580231),
(5, 7, '1', 1502580231),
(5, 8, '0', 1502580231),
(5, 9, '0', 1502580231),
(5, 10, '1', 1502580231),
(5, 11, '1', 1502580231),
(5, 12, '1', 1502580231),
(5, 13, '0', 1502580231),
(5, 14, '1', 1502580231),
(5, 15, '1', 1502580231),
(5, 16, '0', 1502580231),
(5, 17, '0', 0),
(5, 18, '0', 0),
(5, 19, '0', 0),
(5, 20, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_reg_roles`
--

DROP TABLE IF EXISTS `mrfc_reg_roles`;
CREATE TABLE `mrfc_reg_roles` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `published` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mrfc_reg_roles`
--

INSERT INTO `mrfc_reg_roles` (`role_id`, `role_title`, `description`, `published`) VALUES
(1, 'Administrator', 'System Administrator', 1),
(2, 'User', 'General User', 1),
(3, 'Contributor', 'Content Manager', 1),
(4, 'Content Approver', 'Content Approver', 1),
(5, 'Expert', 'Expert', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrfc_sys_logs`
--

DROP TABLE IF EXISTS `mrfc_sys_logs`;
CREATE TABLE `mrfc_sys_logs` (
  `log_id` int(11) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_type` varchar(50) DEFAULT NULL,
  `log_action` varchar(20) DEFAULT NULL,
  `log_item_id` int(11) DEFAULT NULL,
  `log_details` text,
  `log_by` int(11) DEFAULT NULL,
  `organization_id` varchar(10) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mrfc_admin_accounts`
--
ALTER TABLE `mrfc_admin_accounts`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `mrfc_admin_types`
--
ALTER TABLE `mrfc_admin_types`
  ADD PRIMARY KEY (`admintype_id`);

--
-- Indexes for table `mrfc_app_committee`
--
ALTER TABLE `mrfc_app_committee`
  ADD PRIMARY KEY (`committee_id`);

--
-- Indexes for table `mrfc_app_committee_members`
--
ALTER TABLE `mrfc_app_committee_members`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `mrfc_app_profiles`
--
ALTER TABLE `mrfc_app_profiles`
  ADD PRIMARY KEY (`leader_id`),
  ADD UNIQUE KEY `leader_type_id` (`leader_type_id`,`county_id`,`leader_name`);

--
-- Indexes for table `mrfc_cache_vars`
--
ALTER TABLE `mrfc_cache_vars`
  ADD UNIQUE KEY `cache_id` (`cache_id`);

--
-- Indexes for table `mrfc_conf_choices`
--
ALTER TABLE `mrfc_conf_choices`
  ADD PRIMARY KEY (`choice_id`),
  ADD UNIQUE KEY `choice_cat` (`choice_cat`,`choice_item`);

--
-- Indexes for table `mrfc_conf_tags`
--
ALTER TABLE `mrfc_conf_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`,`tag_category`,`tag_item_id`);

--
-- Indexes for table `mrfc_dat_contributions`
--
ALTER TABLE `mrfc_dat_contributions`
  ADD PRIMARY KEY (`contrib_id`);

--
-- Indexes for table `mrfc_dat_functions`
--
ALTER TABLE `mrfc_dat_functions`
  ADD PRIMARY KEY (`function_id`),
  ADD UNIQUE KEY `function` (`function`);

--
-- Indexes for table `mrfc_dat_indicator`
--
ALTER TABLE `mrfc_dat_indicator`
  ADD PRIMARY KEY (`indicator_id`),
  ADD UNIQUE KEY `function_id` (`function_id`,`indicator`);

--
-- Indexes for table `mrfc_dat_statistics`
--
ALTER TABLE `mrfc_dat_statistics`
  ADD PRIMARY KEY (`stats_id`),
  ADD UNIQUE KEY `stats_year` (`stats_year`,`county_id`,`function_id`,`indicator_id`);

--
-- Indexes for table `mrfc_dd_menu_type`
--
ALTER TABLE `mrfc_dd_menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_dd_sections`
--
ALTER TABLE `mrfc_dd_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_dt_content`
--
ALTER TABLE `mrfc_dt_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_dt_content_dates`
--
ALTER TABLE `mrfc_dt_content_dates`
  ADD PRIMARY KEY (`date_record_id`);

--
-- Indexes for table `mrfc_dt_content_parent`
--
ALTER TABLE `mrfc_dt_content_parent`
  ADD UNIQUE KEY `id_content` (`id_content`,`id_parent`,`county_id`,`committee_id`);

--
-- Indexes for table `mrfc_dt_content_posts`
--
ALTER TABLE `mrfc_dt_content_posts`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `mrfc_dt_downloads`
--
ALTER TABLE `mrfc_dt_downloads`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `mrfc_dt_downloads_parent`
--
ALTER TABLE `mrfc_dt_downloads_parent`
  ADD UNIQUE KEY `resource_id` (`resource_id`,`id_menu`,`id_content`,`county_id`,`committee_id`,`res_type_id`,`organization_id`);

--
-- Indexes for table `mrfc_dt_downloads_type`
--
ALTER TABLE `mrfc_dt_downloads_type`
  ADD PRIMARY KEY (`res_type_id`),
  ADD UNIQUE KEY `download_type_seo` (`res_type_seo`);

--
-- Indexes for table `mrfc_dt_feedback`
--
ALTER TABLE `mrfc_dt_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_dt_gallery_category`
--
ALTER TABLE `mrfc_dt_gallery_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_dt_gallery_photos`
--
ALTER TABLE `mrfc_dt_gallery_photos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`,`filename`);

--
-- Indexes for table `mrfc_dt_menu`
--
ALTER TABLE `mrfc_dt_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_dt_menu_parent`
--
ALTER TABLE `mrfc_dt_menu_parent`
  ADD UNIQUE KEY `id_portal` (`id_portal`,`id_menu`,`id_parent`);

--
-- Indexes for table `mrfc_dt_user_posts`
--
ALTER TABLE `mrfc_dt_user_posts`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `mrfc_dt_user_ratings`
--
ALTER TABLE `mrfc_dt_user_ratings`
  ADD UNIQUE KEY `rec_category` (`rec_category`,`rec_id`);

--
-- Indexes for table `mrfc_forum_categories`
--
ALTER TABLE `mrfc_forum_categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name_unique` (`cat_name`);

--
-- Indexes for table `mrfc_forum_posts`
--
ALTER TABLE `mrfc_forum_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_topic` (`post_topic`),
  ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `mrfc_forum_topics`
--
ALTER TABLE `mrfc_forum_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD UNIQUE KEY `topic_subject` (`topic_subject`,`topic_cat`);

--
-- Indexes for table `mrfc_forum_users`
--
ALTER TABLE `mrfc_forum_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_unique` (`user_name`);

--
-- Indexes for table `mrfc_log_accounts`
--
ALTER TABLE `mrfc_log_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_log_keywords`
--
ALTER TABLE `mrfc_log_keywords`
  ADD UNIQUE KEY `keyword` (`keyword`,`parent_type`,`parent_id`);

--
-- Indexes for table `mrfc_poll_questions`
--
ALTER TABLE `mrfc_poll_questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `mrfc_poll_responses`
--
ALTER TABLE `mrfc_poll_responses`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `mrfc_poll_voters`
--
ALTER TABLE `mrfc_poll_voters`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `mrfc_reg_account`
--
ALTER TABLE `mrfc_reg_account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `mrfc_reg_account_settings`
--
ALTER TABLE `mrfc_reg_account_settings`
  ADD UNIQUE KEY `account_id` (`account_id`,`setting_id`);

--
-- Indexes for table `mrfc_reg_cats`
--
ALTER TABLE `mrfc_reg_cats`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `mrfc_reg_cats_links`
--
ALTER TABLE `mrfc_reg_cats_links`
  ADD UNIQUE KEY `id_category` (`id_category`,`account_id`);

--
-- Indexes for table `mrfc_reg_community`
--
ALTER TABLE `mrfc_reg_community`
  ADD PRIMARY KEY (`community_id`),
  ADD UNIQUE KEY `community_title` (`community_title`);

--
-- Indexes for table `mrfc_reg_community_accounts`
--
ALTER TABLE `mrfc_reg_community_accounts`
  ADD UNIQUE KEY `community_id` (`community_id`,`account_id`);

--
-- Indexes for table `mrfc_reg_countries`
--
ALTER TABLE `mrfc_reg_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_reg_county`
--
ALTER TABLE `mrfc_reg_county`
  ADD PRIMARY KEY (`county_id`),
  ADD UNIQUE KEY `county` (`county`);

--
-- Indexes for table `mrfc_reg_events_booking`
--
ALTER TABLE `mrfc_reg_events_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mrfc_reg_groups`
--
ALTER TABLE `mrfc_reg_groups`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group` (`group_title`);

--
-- Indexes for table `mrfc_reg_organizations`
--
ALTER TABLE `mrfc_reg_organizations`
  ADD PRIMARY KEY (`organization_id`),
  ADD UNIQUE KEY `organization` (`organization`);

--
-- Indexes for table `mrfc_reg_privilege_list`
--
ALTER TABLE `mrfc_reg_privilege_list`
  ADD PRIMARY KEY (`priv_id`),
  ADD UNIQUE KEY `priv_title` (`priv_title`);

--
-- Indexes for table `mrfc_reg_privilege_to_roles`
--
ALTER TABLE `mrfc_reg_privilege_to_roles`
  ADD UNIQUE KEY `role_id` (`role_id`,`priv_id`);

--
-- Indexes for table `mrfc_reg_roles`
--
ALTER TABLE `mrfc_reg_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `group` (`role_title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mrfc_admin_accounts`
--
ALTER TABLE `mrfc_admin_accounts`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mrfc_admin_types`
--
ALTER TABLE `mrfc_admin_types`
  MODIFY `admintype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mrfc_app_committee`
--
ALTER TABLE `mrfc_app_committee`
  MODIFY `committee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `mrfc_app_committee_members`
--
ALTER TABLE `mrfc_app_committee_members`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_app_profiles`
--
ALTER TABLE `mrfc_app_profiles`
  MODIFY `leader_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_conf_choices`
--
ALTER TABLE `mrfc_conf_choices`
  MODIFY `choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mrfc_conf_tags`
--
ALTER TABLE `mrfc_conf_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dat_contributions`
--
ALTER TABLE `mrfc_dat_contributions`
  MODIFY `contrib_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dat_functions`
--
ALTER TABLE `mrfc_dat_functions`
  MODIFY `function_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mrfc_dat_indicator`
--
ALTER TABLE `mrfc_dat_indicator`
  MODIFY `indicator_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dat_statistics`
--
ALTER TABLE `mrfc_dat_statistics`
  MODIFY `stats_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dd_menu_type`
--
ALTER TABLE `mrfc_dd_menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mrfc_dd_sections`
--
ALTER TABLE `mrfc_dd_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mrfc_dt_content`
--
ALTER TABLE `mrfc_dt_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dt_content_dates`
--
ALTER TABLE `mrfc_dt_content_dates`
  MODIFY `date_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dt_content_posts`
--
ALTER TABLE `mrfc_dt_content_posts`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dt_downloads`
--
ALTER TABLE `mrfc_dt_downloads`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dt_downloads_type`
--
ALTER TABLE `mrfc_dt_downloads_type`
  MODIFY `res_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dt_feedback`
--
ALTER TABLE `mrfc_dt_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dt_gallery_category`
--
ALTER TABLE `mrfc_dt_gallery_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mrfc_dt_gallery_photos`
--
ALTER TABLE `mrfc_dt_gallery_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_dt_menu`
--
ALTER TABLE `mrfc_dt_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `mrfc_dt_user_posts`
--
ALTER TABLE `mrfc_dt_user_posts`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_forum_categories`
--
ALTER TABLE `mrfc_forum_categories`
  MODIFY `cat_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mrfc_forum_posts`
--
ALTER TABLE `mrfc_forum_posts`
  MODIFY `post_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_forum_topics`
--
ALTER TABLE `mrfc_forum_topics`
  MODIFY `topic_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_forum_users`
--
ALTER TABLE `mrfc_forum_users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_log_accounts`
--
ALTER TABLE `mrfc_log_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_poll_questions`
--
ALTER TABLE `mrfc_poll_questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mrfc_poll_responses`
--
ALTER TABLE `mrfc_poll_responses`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_poll_voters`
--
ALTER TABLE `mrfc_poll_voters`
  MODIFY `vid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_reg_account`
--
ALTER TABLE `mrfc_reg_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_reg_cats`
--
ALTER TABLE `mrfc_reg_cats`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mrfc_reg_community`
--
ALTER TABLE `mrfc_reg_community`
  MODIFY `community_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_reg_countries`
--
ALTER TABLE `mrfc_reg_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `mrfc_reg_county`
--
ALTER TABLE `mrfc_reg_county`
  MODIFY `county_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `mrfc_reg_events_booking`
--
ALTER TABLE `mrfc_reg_events_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mrfc_reg_groups`
--
ALTER TABLE `mrfc_reg_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mrfc_reg_organizations`
--
ALTER TABLE `mrfc_reg_organizations`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mrfc_reg_roles`
--
ALTER TABLE `mrfc_reg_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
