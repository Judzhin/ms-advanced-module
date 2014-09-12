SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `zam_t_pagetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `namespace` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `zam_t_pagetypes` (`id`, `name`, `namespace`, `controller`, `action`) VALUES
(1, 'Foo Index', 'ZendAdvancedModule\\Controller', 'FooIndex', 'index'),
(2, 'Bar Index', NULL, 'ZendAdvancedModule\\Controller\\Bar', 'index'),
(3, 'Foo Form Submit', NULL, 'ZendAdvancedModule\\Controller\\FooIndex', 'form-submit'),
(4, 'Blog Index', 'ZendAdvancedModule\\Controller', 'Blog', 'index'),
(5, 'View Action', NULL, NULL, 'view');

CREATE TABLE IF NOT EXISTS `zam_t_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `pagetype_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Hostname','Literal','Method','Part','Regex','Scheme','Segment','Query') NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `verb` varchar(255) DEFAULT NULL,
  `regex` varchar(500) DEFAULT NULL,
  `spec` varchar(500) DEFAULT NULL,
  `scheme` enum('http','https','ftp','ftps') DEFAULT NULL,
  `may_terminate` enum('0','1') DEFAULT '1',
  `options` text,
  PRIMARY KEY (`id`),
  KEY `pagetype_id` (`pagetype_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `zam_t_routes` (`id`, `parent_id`, `pagetype_id`, `name`, `type`, `route`, `verb`, `regex`, `spec`, `scheme`, `may_terminate`, `options`) VALUES
(1, NULL, NULL, 'zendadvancedmodule', 'Hostname', ':subdomain.local', NULL, NULL, NULL, NULL, NULL, '{\r\n    "constraints" : {\r\n        "subdomain" : "zendadvancedmodule"\r\n    },\r\n    "defaults" : {\r\n        "type" : "json"\r\n    }\r\n}'),
(2, NULL, 1, 'home', 'Literal', '/', NULL, NULL, NULL, NULL, '1', ''),
(3, NULL, 2, 'bar', 'Literal', '/bar', NULL, NULL, NULL, NULL, '1', ''),
(4, NULL, 3, 'post-put', 'Method', '', 'post,put', NULL, NULL, NULL, NULL, ''),
(5, NULL, 4, 'blog', 'Literal', '/blog', NULL, NULL, NULL, NULL, '1', ''),
(6, 5, 5, 'view', 'Regex', '', NULL, '/(?<id>[a-zA-Z0-9_-]+)(\\.(?<format>(json|html|xml|rss)))?', '/%id%.%format%', NULL, '1', '{\n    "defaults" : {\n        "format" : "html"\n    }\n}'),
(7, NULL, NULL, 'scheme', 'Scheme', NULL, NULL, NULL, NULL, 'https', '1', '{\n    "defaults" : {\n        "https" : true\n    }\n}'),
(8, NULL, 1, 'segment', 'Segment', '/zendadvancedmodule/:controller[/:action]', NULL, NULL, NULL, NULL, '1', '{\r\n    "constraints" : {\r\n        "controller" : "[a-zA-Z][a-zA-Z0-9_-]+",\r\n        "action"     : "[a-zA-Z][a-zA-Z0-9_-]+"\r\n    }\r\n}');


ALTER TABLE `zam_t_routes`
  ADD CONSTRAINT `zam_t_routes_ibfk_1` FOREIGN KEY (`pagetype_id`) REFERENCES `zam_t_pagetypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zam_t_routes_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `zam_t_routes` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;
