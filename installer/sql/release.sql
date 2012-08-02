-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2012 at 12:53 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

--
-- Database: `release`
--

-- command split --

--
-- Table structure for table `ats_appointment_issued`
--

CREATE TABLE IF NOT EXISTS `ats_appointment_issued` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `position` varchar(64) NOT NULL,
  `sg` varchar(8) NOT NULL,
  `status` varchar(32) NOT NULL,
  `nature` varchar(64) NOT NULL,
  `item_no` varchar(16) NOT NULL,
  `publication` varchar(32) NOT NULL,
  `issuance` varchar(32) NOT NULL,
  `received_csc` varchar(32) NOT NULL,
  `acted_upon` varchar(32) NOT NULL,
  `kss` varchar(32) NOT NULL,
  `pdf` varchar(32) NOT NULL,
  `pds` varchar(32) NOT NULL,
  `education` varchar(32) NOT NULL,
  `eligibility` varchar(32) NOT NULL,
  `nbi` varchar(32) NOT NULL,
  `oath` varchar(32) NOT NULL,
  `med_cert` varchar(32) NOT NULL,
  `saln` varchar(32) NOT NULL,
  `pes` varchar(32) NOT NULL,
  `remarks` varchar(64) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_asset_business_interests`
--

CREATE TABLE IF NOT EXISTS `ats_asset_business_interests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `company` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `nature_business` varchar(64) NOT NULL,
  `date_acquisition` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_asset_infos`
--

CREATE TABLE IF NOT EXISTS `ats_asset_infos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `s_lname` varchar(64) NOT NULL,
  `s_fname` varchar(64) NOT NULL,
  `s_mname` varchar(64) NOT NULL,
  `s_position` varchar(64) NOT NULL,
  `s_office` varchar(64) NOT NULL,
  `s_tin` varchar(64) NOT NULL,
  `s_cc_no` varchar(64) NOT NULL,
  `s_issue_at` varchar(64) NOT NULL,
  `s_issue_date` varchar(64) NOT NULL,
  `tin` varchar(64) NOT NULL,
  `cc_no` varchar(64) NOT NULL,
  `issue_at` varchar(64) NOT NULL,
  `issue_date` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_asset_liabilities`
--

CREATE TABLE IF NOT EXISTS `ats_asset_liabilities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `nature` varchar(64) NOT NULL,
  `name_creditors` varchar(64) NOT NULL,
  `amount` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_asset_personals`
--

CREATE TABLE IF NOT EXISTS `ats_asset_personals` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `kind` varchar(64) NOT NULL,
  `year_acquired` varchar(4) NOT NULL,
  `acquisition_cost` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_asset_properties`
--

CREATE TABLE IF NOT EXISTS `ats_asset_properties` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `kind` varchar(64) NOT NULL,
  `location` varchar(64) NOT NULL,
  `year_acquired` varchar(4) NOT NULL,
  `mode_acquisition` varchar(64) NOT NULL,
  `nature_property` varchar(64) NOT NULL,
  `assessed_value` varchar(16) NOT NULL,
  `market_value` varchar(16) NOT NULL,
  `land_cost` varchar(16) NOT NULL,
  `improvement_cost` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_asset_relatives`
--

CREATE TABLE IF NOT EXISTS `ats_asset_relatives` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `position` varchar(64) NOT NULL,
  `relationship` varchar(32) NOT NULL,
  `name_address` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_asset_unmarrieds`
--

CREATE TABLE IF NOT EXISTS `ats_asset_unmarrieds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `birth_date` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_biometric_devices`
--

CREATE TABLE IF NOT EXISTS `ats_biometric_devices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `serial_no` varchar(32) NOT NULL,
  `model` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `com_port` varchar(4) NOT NULL,
  `machine_number` varchar(4) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_budget_expenditures`
--

CREATE TABLE IF NOT EXISTS `ats_budget_expenditures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `expenditures` varchar(64) NOT NULL,
  `office_id` int(11) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `budget_amount` double NOT NULL,
  `account_code` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_budget_expenses`
--

CREATE TABLE IF NOT EXISTS `ats_budget_expenses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(128) NOT NULL,
  `budget_expenditure_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_compensatory_timeoffs`
--

CREATE TABLE IF NOT EXISTS `ats_compensatory_timeoffs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `office_id` int(11) NOT NULL,
  `month` varchar(2) NOT NULL,
  `year` varchar(4) NOT NULL,
  `days` varchar(8) NOT NULL,
  `dates` varchar(128) NOT NULL,
  `date_file` varchar(16) NOT NULL,
  `type` varchar(8) NOT NULL,
  `status` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_divisions`
--

CREATE TABLE IF NOT EXISTS `ats_divisions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_dtr`
--

CREATE TABLE IF NOT EXISTS `ats_dtr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `log_date` date NOT NULL,
  `am_login` varchar(32) NOT NULL,
  `am_logout` varchar(32) NOT NULL,
  `pm_login` varchar(32) NOT NULL,
  `pm_logout` varchar(32) NOT NULL,
  `ot_login` varchar(32) NOT NULL,
  `ot_logout` varchar(32) NOT NULL,
  `manual_log_id` int(11) DEFAULT NULL,
  `leave_type_id` int(2) DEFAULT NULL,
  `leave_half_day` tinyint(1) DEFAULT NULL,
  `office_id` int(11) NOT NULL,
  `orig_dtr` varchar(128) NOT NULL DEFAULT '',
  `compensatory_timeoff_id` int(16) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `downloaded` tinyint(1) NOT NULL,
  `uploaded` tinyint(1) NOT NULL,
  `date_acquired` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_dtr_1` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_dtr_temp`
--

CREATE TABLE IF NOT EXISTS `ats_dtr_temp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(10) NOT NULL,
  `office_id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `logs` varchar(32) NOT NULL,
  `log_type` tinyint(1) NULL COMMENT '0-in ,1-out',
  `date_extract` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_dtr_1` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_employee`
--

CREATE TABLE IF NOT EXISTS `ats_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(10) DEFAULT NULL,
  `salut` varchar(20) NOT NULL,
  `fname` varchar(64) DEFAULT NULL,
  `mname` varchar(64) DEFAULT NULL,
  `lname` varchar(64) DEFAULT NULL,
  `position` varchar(64) NOT NULL,
  `assistant_dept_head` int(2) NOT NULL,
  `salary_grade` varchar(10) NOT NULL,
  `step` tinyint(4) NOT NULL,
  `permanent` tinyint(4) NOT NULL,
  `employee_movement_id` int(4) NOT NULL DEFAULT '1',
  `first_day_of_service` varchar(20) NOT NULL,
  `sex` varchar(4) NOT NULL,
  `office_code` varchar(255) DEFAULT NULL,
  `office_id` int(11) NOT NULL,
  `division_id` int(4) NOT NULL,
  `section_id` int(4) NOT NULL,
  `detailed_office_id` int(11) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pics` varchar(40) NOT NULL,
  `finger_pics` varchar(200) NOT NULL,
  `base64_pics` longtext NOT NULL,
  `tpl` varchar(200) NOT NULL,
  `base64_tpl` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `shift_type` int(11) NOT NULL,
  `last_update` date NOT NULL COMMENT 'date last update( upload to main server)',
  `newly_added` tinyint(1) NOT NULL,
  `updated` tinyint(1) NOT NULL,
  `item_number` varchar(32) NOT NULL,
  `last_promotion` varchar(32) NOT NULL,
  `level` varchar(64) NOT NULL,
  `eligibility` varchar(64) NOT NULL,
  `graduated` varchar(32) NOT NULL,
  `course` varchar(64) NOT NULL,
  `units` varchar(32) NOT NULL,
  `post_grad` varchar(64) NOT NULL,
  `birth_date` date NOT NULL,
  `res_address` varchar(200) NOT NULL,
  `tax_status` varchar(32) NOT NULL,
  `dependents` varchar(32) NOT NULL,
  `date_retired` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dept_code` (`office_code`),
  KEY `pers_id` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_employee_duties`
--

CREATE TABLE IF NOT EXISTS `ats_employee_duties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duty_no` double DEFAULT NULL,
  `employee_id` double DEFAULT NULL,
  `duty_from` varchar(32) NOT NULL,
  `duty_to` varchar(32) NOT NULL,
  `duty_desc` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_employee_id_requests`
--

CREATE TABLE IF NOT EXISTS `ats_employee_id_requests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `status` enum('requested','for_printing','released') NOT NULL,
  `date_request` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_employee_movements`
--

CREATE TABLE IF NOT EXISTS `ats_employee_movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_movement_code` varchar(255) DEFAULT NULL,
  `employee_movement` varchar(255) DEFAULT NULL,
  `employee_movement_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_employee_schedule`
--

CREATE TABLE IF NOT EXISTS `ats_employee_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `hour_from` varchar(8) NOT NULL,
  `hour_to` varchar(8) NOT NULL,
  `shift_type` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- command split --

--
-- Table structure for table `ats_employee_status`
--

CREATE TABLE IF NOT EXISTS `ats_employee_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(32) DEFAULT NULL,
  `employee_status` varchar(255) DEFAULT NULL,
  `employee_status_description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_files`
--

CREATE TABLE IF NOT EXISTS `ats_files` (
  `file_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(64) NOT NULL,
  `file_size` mediumint(8) unsigned NOT NULL,
  `file` mediumblob NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_groups`
--

CREATE TABLE IF NOT EXISTS `ats_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- command split --

--
-- Dumping data for table `ats_groups`
--

INSERT INTO `ats_groups` (`id`, `name`, `description`) VALUES
(1, 'Super System Administrator', '');

-- command split --

--
-- Table structure for table `ats_holiday`
--

CREATE TABLE IF NOT EXISTS `ats_holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `regular` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

-- command split --

--
-- Dumping data for table `ats_holiday`
--

INSERT INTO `ats_holiday` (`id`, `description`, `date`, `regular`) VALUES
(12, 'Christmas Day', '2009-12-25', 0),
(3, 'Bonifacio Day', '2009-11-30', 0),
(4, 'All Soul''s Day', '2009-11-01', 0),
(5, 'All Soul''s Day Extended', '2009-11-02', 0),
(6, 'HOLIDAY', '2009-01-02', 0),
(7, 'Good Friday', '2009-04-10', 0),
(15, 'New Years Day', '2009-01-01', 0),
(16, 'Christmas Day', '2010-12-25', 0),
(53, 'HOLIDAY', '2010-12-27', 0),
(18, 'All Soul''s Day', '2010-11-01', 0),
(36, 'Foundation Day', '2010-03-04', 0),
(25, 'Good Friday', '2010-04-02', 0),
(24, 'Maunday Thursday', '2010-04-01', 0),
(22, 'New Years Day', '2010-01-01', 0),
(26, 'Araw ng Kagitingan', '2010-04-09', 0),
(27, 'Independence Day', '2010-06-14', 0),
(28, 'National Heroes Day', '2010-08-30', 0),
(42, 'RAMADAN', '2010-09-10', 0),
(47, 'Bonifacio Day', '2010-11-29', 0),
(37, 'Holiday', '2010-05-03', 0),
(39, 'Election Day', '2010-05-10', 0),
(40, 'Holiday', '2010-06-23', 0),
(41, 'HOLIDAY', '2010-06-30', 0),
(43, 'Barangay Election', '2010-10-25', 0),
(46, 'Holiday', '2010-11-16', 0),
(51, 'HOLIDAY', '2010-12-24', 0),
(68, 'New Year''s Day', '2011-01-01', 0),
(57, 'New Year''s Eve', '2010-12-31', 0),
(72, 'PPCity Foundation Day', '2011-03-04', 0),
(59, 'Araw ng Kagitingan', '2011-04-09', 0),
(60, 'Maundy Thursday', '2011-04-21', 0),
(61, 'Good Friday', '2011-04-22', 0),
(62, 'Labor Day', '2011-05-01', 0),
(63, 'Independence Day', '2011-06-12', 0),
(64, 'National Heroes Day', '2011-08-29', 0),
(65, 'Bonifacio Day', '2011-11-30', 0),
(78, 'New Year''s Day', '2012-01-01', 0),
(67, 'Rizal Day', '2011-12-30', 0),
(69, 'Ninoy Aquino Day', '2011-08-21', 0),
(70, 'All Saints Day', '2011-11-01', 0),
(73, 'holiday', '2011-06-20', 0),
(74, 'holiday', '2011-06-23', 0),
(75, 'Holiday', '2011-08-30', 0),
(76, 'Holiday', '2011-10-31', 0),
(77, 'Eid''l Adha', '2011-11-07', 0),
(79, 'Maunday Thursday', '2012-04-05', 0),
(80, 'Good Friday', '2012-04-06', 0),
(81, 'Araw ng Kagitingan', '2012-04-09', 0),
(82, 'Labor Day', '2012-05-01', 0),
(83, 'Independence Day', '2012-06-12', 0),
(84, 'National Heroes Day', '2012-08-27', 0),
(85, 'Bonifacio Day', '2012-11-30', 0),
(86, 'Christmas Day', '2012-12-25', 0),
(87, 'Rizal Day', '2012-12-30', 0),
(88, 'Chinese New Year', '2012-01-23', 0),
(89, 'Ninoy Aquino Day', '2012-08-21', 0),
(90, 'All Saints Day', '2012-11-01', 0),
(91, 'Additional special (non-working)day', '2012-11-02', 0),
(92, 'Last Day of the Year', '2012-12-31', 0),
(93, 'Laguna Day', '2012-06-19', 0);

-- command split --

--
-- Table structure for table `ats_leave_apps`
--

CREATE TABLE IF NOT EXISTS `ats_leave_apps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(10) NOT NULL,
  `office_id` int(11) NOT NULL,
  `multiple` varchar(64) NOT NULL,
  `month` int(2) unsigned zerofill NOT NULL,
  `year` int(4) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `month5` varchar(2) NOT NULL,
  `year5` varchar(4) NOT NULL,
  `multiple5` varchar(64) NOT NULL,
  `special_priv_id` int(11) NOT NULL,
  `days` double NOT NULL,
  `mone` int(11) NOT NULL COMMENT 'tell what kind of mone leave 1= vl, 2= sl',
  `date_encode` date NOT NULL,
  `allow_sat_sun` int(11) NOT NULL,
  `username` varchar(16) NOT NULL COMMENT 'employee encode',
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_leave_balance`
--

CREATE TABLE IF NOT EXISTS `ats_leave_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `sick_leave` double NOT NULL,
  `vacation_leave` double NOT NULL,
  `spl` double NOT NULL,
  `forced` double NOT NULL,
  `monetary_equivalent` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_leave_card`
--

CREATE TABLE IF NOT EXISTS `ats_leave_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `period` varchar(32) NOT NULL,
  `particulars` varchar(64) NOT NULL,
  `v_earned` double NOT NULL,
  `v_abs` double NOT NULL,
  `v_balance` double NOT NULL,
  `v_abs_wop` double NOT NULL,
  `s_earned` double NOT NULL,
  `s_abs` double NOT NULL,
  `s_balance` double NOT NULL,
  `s_abs_wop` double NOT NULL,
  `action_take` varchar(128) NOT NULL,
  `dates` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `special_priv_id` int(11) NOT NULL,
  `manual_log_id` int(11) NOT NULL,
  `card_no` tinyint(2) NOT NULL COMMENT 'index card page number',
  `pass_slip_date` date NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `forced_leave_system_generated` enum('no','yes') NOT NULL DEFAULT 'no',
  `listing_order` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_leave_conversion_table`
--

CREATE TABLE IF NOT EXISTS `ats_leave_conversion_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minutes` int(11) NOT NULL,
  `equivalent_day` varchar(5) NOT NULL COMMENT 'equivalent day for deduction',
  `day` tinyint(2) NOT NULL,
  `leave_earned` double NOT NULL COMMENT 'equivalent leave earned from day(number of days)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

-- command split --

--
-- Dumping data for table `ats_leave_conversion_table`
--

INSERT INTO `ats_leave_conversion_table` (`id`, `minutes`, `equivalent_day`, `day`, `leave_earned`) VALUES
(1, 0, '0.000', 1, 0.042),
(2, 1, '0.002', 2, 0.083),
(4, 3, '0.006', 3, 0.125),
(3, 2, '0.004', 4, 0.167),
(5, 4, '0.008', 5, 0.208),
(6, 5, '0.010', 6, 0.25),
(7, 6, '0.012', 7, 0.292),
(8, 7, '0.015', 8, 0.333),
(9, 8, '0.017', 9, 0.375),
(10, 9, '0.019', 10, 0.417),
(11, 10, '0.021', 11, 0.458),
(12, 11, '0.023', 12, 0.5),
(13, 12, '0.025', 13, 0.542),
(14, 13, '0.027', 14, 0.583),
(15, 14, '0.029', 15, 0.625),
(16, 15, '0.031', 16, 0.667),
(17, 16, '0.033', 17, 0.708),
(18, 17, '0.035', 18, 0.75),
(19, 18, '0.037', 19, 0.792),
(20, 19, '0.040', 20, 0.833),
(21, 20, '0.042', 21, 0.875),
(22, 21, '0.044', 22, 0.917),
(23, 22, '0.046', 23, 0.958),
(24, 23, '0.048', 24, 1),
(25, 24, '0.050', 25, 1.042),
(26, 25, '0.053', 26, 1.083),
(27, 26, '0.054', 27, 1.125),
(28, 27, '0.056', 28, 1.167),
(29, 28, '0.058', 29, 1.208),
(30, 29, '0.060', 30, 1.25),
(31, 30, '0.062', 0, 0),
(32, 31, '0.065', 0, 0),
(33, 32, '0.067', 0, 0),
(34, 33, '0.069', 0, 0),
(35, 34, '0.071', 0, 0),
(36, 35, '0.073', 0, 0),
(37, 36, '0.075', 0, 0),
(38, 37, '0.077', 0, 0),
(39, 38, '0.079', 0, 0),
(40, 39, '0.081', 0, 0),
(41, 40, '0.083', 0, 0),
(42, 41, '0.085', 0, 0),
(43, 42, '0.087', 0, 0),
(44, 43, '0.090', 0, 0),
(45, 44, '0.092', 0, 0),
(46, 45, '0.094', 0, 0),
(47, 46, '0.096', 0, 0),
(48, 47, '0.098', 0, 0),
(49, 48, '0.100', 0, 0),
(50, 49, '0.102', 0, 0),
(51, 50, '0.104', 0, 0),
(52, 51, '0.106', 0, 0),
(53, 52, '0.108', 0, 0),
(54, 53, '0.110', 0, 0),
(55, 54, '0.112', 0, 0),
(56, 55, '0.115', 0, 0),
(57, 56, '0.117', 0, 0),
(58, 57, '0.119', 0, 0),
(59, 58, '0.121', 0, 0),
(60, 59, '0.123', 0, 0),
(61, 60, '0.125', 0, 0);

-- command split --

--
-- Table structure for table `ats_leave_details`
--

CREATE TABLE IF NOT EXISTS `ats_leave_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(16) NOT NULL,
  `period` date NOT NULL,
  `particulars` varchar(64) NOT NULL,
  `v_earned` double NOT NULL,
  `v_abs` double NOT NULL,
  `v_balance` double NOT NULL,
  `v_abs_wop` double NOT NULL,
  `s_earned` double NOT NULL,
  `s_abs` double NOT NULL,
  `s_balance` double NOT NULL,
  `s_abs_wop` double NOT NULL,
  `action_take` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_leave_earn`
--

CREATE TABLE IF NOT EXISTS `ats_leave_earn` (
  `leave_earn_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `vacation_leave` double NOT NULL,
  `date_earned` date NOT NULL,
  `sick_leave` double NOT NULL,
  `particulars` varchar(40) NOT NULL,
  `forwarded` double NOT NULL,
  `forwarded_note` varchar(200) NOT NULL,
  PRIMARY KEY (`leave_earn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_leave_earn_sched`
--

CREATE TABLE IF NOT EXISTS `ats_leave_earn_sched` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(2) unsigned zerofill NOT NULL,
  `year` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `done2` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

-- command split --

--
-- Dumping data for table `ats_leave_earn_sched`
--

INSERT INTO `ats_leave_earn_sched` (`id`, `month`, `year`, `done`, `done2`) VALUES
(2, 01, 2009, 0, 0),
(3, 02, 2009, 0, 0),
(4, 03, 2009, 0, 0),
(5, 04, 2009, 1, 0),
(6, 05, 2009, 1, 0),
(7, 06, 2009, 1, 0),
(8, 07, 2009, 0, 0),
(9, 08, 2009, 1, 0),
(10, 09, 2009, 0, 0),
(11, 10, 2009, 0, 0),
(12, 11, 2009, 1, 0),
(13, 12, 2009, 1, 0),
(14, 01, 2010, 1, 0),
(15, 02, 2010, 1, 0),
(16, 03, 2010, 1, 0),
(17, 04, 2010, 1, 0),
(18, 05, 2010, 1, 1),
(19, 06, 2010, 1, 1),
(20, 07, 2010, 1, 1),
(21, 08, 2010, 1, 1),
(22, 09, 2010, 1, 1),
(23, 10, 2010, 1, 1),
(24, 11, 2010, 1, 1),
(25, 12, 2010, 1, 1),
(26, 01, 2011, 1, 1),
(27, 02, 2011, 1, 1),
(28, 03, 2011, 1, 1),
(29, 04, 2011, 1, 1),
(30, 05, 2011, 1, 1),
(31, 06, 2011, 1, 1),
(32, 07, 2011, 1, 1),
(33, 08, 2011, 1, 1),
(34, 09, 2011, 1, 1),
(35, 10, 2011, 1, 1),
(36, 11, 2011, 1, 1),
(37, 12, 2011, 1, 1),
(38, 01, 2012, 1, 1),
(39, 02, 2012, 1, 1),
(40, 03, 2012, 1, 1),
(41, 04, 2012, 1, 1),
(42, 05, 2012, 1, 1),
(43, 06, 2012, 1, 1),
(44, 07, 2012, 1, 0),
(45, 08, 2012, 0, 0),
(46, 09, 2012, 0, 0),
(47, 10, 2012, 0, 0),
(48, 11, 2012, 0, 0),
(49, 12, 2012, 0, 0),
(50, 01, 2013, 0, 0),
(51, 02, 2013, 0, 0),
(52, 03, 2013, 0, 0),
(53, 04, 2013, 0, 0),
(54, 05, 2013, 0, 0),
(55, 06, 2013, 0, 0),
(56, 07, 2013, 0, 0),
(57, 08, 2013, 0, 0),
(58, 09, 2013, 0, 0),
(59, 10, 2013, 0, 0),
(60, 11, 2013, 0, 0),
(61, 12, 2013, 0, 0),
(62, 01, 2014, 0, 0),
(63, 02, 2014, 0, 0),
(64, 03, 2014, 0, 0),
(65, 04, 2014, 0, 0),
(66, 05, 2014, 0, 0),
(67, 06, 2014, 0, 0),
(68, 07, 2014, 0, 0),
(69, 08, 2014, 0, 0),
(70, 09, 2014, 0, 0),
(71, 10, 2014, 0, 0),
(72, 11, 2014, 0, 0),
(73, 12, 2014, 0, 0),
(74, 01, 2015, 0, 0),
(75, 02, 2015, 0, 0),
(76, 03, 2015, 0, 0),
(77, 04, 2015, 0, 0),
(78, 05, 2015, 0, 0),
(79, 06, 2015, 0, 0),
(80, 07, 2015, 0, 0),
(81, 08, 2015, 0, 0),
(82, 09, 2015, 0, 0),
(83, 10, 2015, 0, 0),
(84, 11, 2015, 0, 0),
(85, 12, 2015, 0, 0);

-- command split --

--
-- Table structure for table `ats_leave_forwarded`
--

CREATE TABLE IF NOT EXISTS `ats_leave_forwarded` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `forwarded_vacation` double NOT NULL,
  `forwarded_sick` double NOT NULL,
  `forwarded_note` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_leave_list`
--

CREATE TABLE IF NOT EXISTS `ats_leave_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type_id` tinyint(4) NOT NULL,
  `special_priv_id` int(11) NOT NULL,
  `with_pay` tinyint(4) NOT NULL DEFAULT '1',
  `employee_id` varchar(10) NOT NULL,
  `office_id` int(11) NOT NULL,
  `date_from_to` date NOT NULL,
  `number_days` double NOT NULL,
  `particulars` varchar(40) NOT NULL,
  `manual_log_id` int(11) NOT NULL,
  `date_acquired` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_leave_type`
--

CREATE TABLE IF NOT EXISTS `ats_leave_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL,
  `leave_name` text NOT NULL,
  `deductable` tinyint(1) NOT NULL,
  `deduct_to` int(11) NOT NULL COMMENT 'ex: deduct to sick or vac leave',
  `allow_per_year` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- command split --

--
-- Dumping data for table `ats_leave_type`
--

INSERT INTO `ats_leave_type` (`id`, `code`, `leave_name`, `deductable`, `deduct_to`, `allow_per_year`, `description`) VALUES
(1, 'VL', 'Vacation Leave', 0, 0, 0, ''),
(2, 'Sick Leave', 'Sick Leave', 0, 0, 0, ''),
(3, 'Spec.PL', 'Special Privilege Leave(MC#6)', 0, 0, 3, 'Personal Milestone\r\nParental Obligation\r\nFilial Obligation\r\nDomestic Emergency\r\nPersonal Transaction\r\n                        = 3 day limit for a given year shall be strictly observed: an employee can avail of one\r\n                           special privilege leave for three days or a combination of any of the leaves for maximum\r\n                           of 3 days in a given year.  (no deduction)'),
(4, 'Pater. Leave', 'Paternity Leave', 0, 0, 7, '7 days (no deduction)'),
(5, 'Mat. Leave', 'Maternity Leave', 0, 0, 60, '60 days (no deduction)'),
(6, 'Solo P Leave', 'Solo Parent Leave', 0, 0, 7, '7 days (no deduction)'),
(7, 'FL', 'Forced Leave/Mandatory Leave', 0, 1, 0, 'all officials & employees with 10 days or more VL credits shall be required\r\n                            to go on VL whether continuous or intermitent for a minimum of 5 working days annually.'),
(9, 'Monet. Leave', 'Monetization Leave', 0, 0, 0, 'Regular Monetization-  deducted against VL    (50% Monetization-  deducted against VL & SL)'),
(10, 'Commu. Leave', 'Commutation Leave', 0, 0, 0, ''),
(11, 'Rehab. Leave', 'Rehabilitation Leave ', 0, 0, 0, 'maximum of 6 months (no deduction)'),
(12, 'Stu. Leave', 'Study Leave', 0, 0, 0, '6 months'),
(13, 'Cal. Leave', 'Calamity Leave(MC #29)', 0, 0, 0, ''),
(15, 'VSL', 'Vacation Sick Leave', 0, 0, 0, 'considered as SL but it is deducted against VL'),
(16, 'SLWOP', 'Sick Leave Without Pay', 0, 0, 0, ''),
(17, 'VLWOP', 'Vacation Leave Without Pay', 0, 0, 0, ''),
(18, 'Comp. Leave', 'Compensatory Leave', 0, 0, 0, ''),
(19, 'LWP', 'Leave Without Pay', 0, 0, 0, ''),
(20, '', 'Special Leave for Women', 0, 0, 0, ''),
(21, '', 'Terminal Leave', 0, 0, 0, ''),
(22, 'CENT. LEAVE', 'Centennial Leave', 0, 0, 0, ''),
(23, 'RUR. Service', 'Rural Service', 0, 0, 0, '');

-- command split --

--
-- Table structure for table `ats_leave_wop_table`
--

CREATE TABLE IF NOT EXISTS `ats_leave_wop_table` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `days` double NOT NULL,
  `days_leave_wop` double NOT NULL,
  `leave_credits_earned` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_logs`
--

CREATE TABLE IF NOT EXISTS `ats_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `office_id` int(11) NOT NULL,
  `command` varchar(100) NOT NULL,
  `details` varchar(512) DEFAULT NULL,
  `employee_id_affected` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_manual_log`
--

CREATE TABLE IF NOT EXISTS `ats_manual_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `if_leave` int(11) NOT NULL,
  `log_type` tinyint(4) NOT NULL,
  `if_single_time` tinyint(4) NOT NULL,
  `cover_if_ob_or_leave` varchar(100) NOT NULL,
  `cover_if_ob_or_leave2` varchar(100) NOT NULL,
  `multiple` tinyint(1) NOT NULL,
  `cancelled` tinyint(4) NOT NULL,
  `notes` text NOT NULL,
  `date_created` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_messages`
--

CREATE TABLE IF NOT EXISTS `ats_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `reserve` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_migrations`
--

CREATE TABLE IF NOT EXISTS `ats_migrations` (
  `version` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- command split --

--
-- Dumping data for table `ats_migrations`
--

INSERT INTO `ats_migrations` (`version`) VALUES
(150);

-- command split --

--
-- Table structure for table `ats_modules`
--

CREATE TABLE IF NOT EXISTS `ats_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_new_settings`
--

CREATE TABLE IF NOT EXISTS `ats_new_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(32) NOT NULL,
  `value` varchar(256) NOT NULL,
  `sample` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_office`
--

CREATE TABLE IF NOT EXISTS `ats_office` (
  `office_id` int(11) NOT NULL AUTO_INCREMENT,
  `office_code` varchar(10) NOT NULL,
  `office_name` text NOT NULL,
  `account_no` varchar(16) NOT NULL,
  `program` varchar(512) NOT NULL,
  `office_address` varchar(64) NOT NULL,
  `salary_grade_type` varchar(32) NOT NULL,
  `office_head` varchar(64) NOT NULL,
  `employee_id` varchar(16) NOT NULL,
  `position` varchar(64) NOT NULL,
  `office_location` varchar(8) NOT NULL DEFAULT 'internal',
  `compensatory` tinyint(4) NOT NULL,
  PRIMARY KEY (`office_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_office_pass`
--

CREATE TABLE IF NOT EXISTS `ats_office_pass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(32) NOT NULL,
  `office_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_out` varchar(32) NOT NULL,
  `time_in` varchar(32) NOT NULL,
  `seconds` int(11) NOT NULL,
  `date_acquired` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- command split --

--
-- Table structure for table `ats_payroll_additional_compensation`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_additional_compensation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `taxable` varchar(16) NOT NULL,
  `frequency` varchar(16) NOT NULL,
  `order` int(2) NOT NULL,
  `deductible` varchar(4) NOT NULL,
  `basis` varchar(8) NOT NULL,
  `status` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_deduction_agencies`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_deduction_agencies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(16) NOT NULL,
  `agency_name` varchar(64) NOT NULL,
  `report_order` int(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_deduction_informations`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_deduction_informations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `desc` varchar(128) NOT NULL,
  `deduction_agency_id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `mandatory` varchar(16) NOT NULL,
  `tax_exempted` varchar(3) NOT NULL,
  `er_share` varchar(3) NOT NULL,
  `official` varchar(16) NOT NULL,
  `optional_amount` varchar(3) NOT NULL,
  `amount_exempted` varchar(8) NOT NULL,
  `report_order` int(4) NOT NULL,
  `line_no` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_deduction_loans`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_deduction_loans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `deduction_information_id` int(11) NOT NULL,
  `date_loan` varchar(16) NOT NULL,
  `loan_gross` varchar(16) NOT NULL,
  `months_pay` varchar(16) NOT NULL,
  `monthly_pay` varchar(16) NOT NULL,
  `date_from` varchar(16) NOT NULL,
  `date_to` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_deduction_optional`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_deduction_optional` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `deduction_information_id` int(11) NOT NULL,
  `date_from` varchar(16) NOT NULL,
  `date_to` varchar(16) NOT NULL,
  `status` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_pae`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_pae` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tax_status` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  `effectivity_date` varchar(16) NOT NULL,
  `effectivity_date_to` varchar(16) NOT NULL,
  `exemption` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_philhealth_schedules`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_philhealth_schedules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `effectivity_date` varchar(16) NOT NULL,
  `effectivity_date_to` varchar(16) NOT NULL,
  `start_range` varchar(16) NOT NULL,
  `end_range` varchar(16) NOT NULL,
  `salary_based` varchar(16) NOT NULL,
  `monthly_share` varchar(16) NOT NULL,
  `employee_share` varchar(16) NOT NULL,
  `employer_share` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_staff_entitlement`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_staff_entitlement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `additional_compensation_id` int(11) NOT NULL,
  `effectivity_date` varchar(32) NOT NULL,
  `ineffectivity_date` varchar(32) NOT NULL,
  `amount` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_payroll_tax_table`
--

CREATE TABLE IF NOT EXISTS `ats_payroll_tax_table` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_range` double NOT NULL,
  `end_range` double NOT NULL,
  `fix_amount` double NOT NULL,
  `percentage` double NOT NULL,
  `over_limit` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_children`
--

CREATE TABLE IF NOT EXISTS `ats_pds_children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `children` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_education_background`
--

CREATE TABLE IF NOT EXISTS `ats_pds_education_background` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `level` tinyint(2) NOT NULL COMMENT '1 for elementary  up to 5 for graduate studies',
  `school_name` varchar(100) NOT NULL,
  `degree_course` varchar(100) NOT NULL,
  `year_graduated` varchar(5) NOT NULL,
  `highest_grade` varchar(5) NOT NULL,
  `attend_from` varchar(50) NOT NULL,
  `attend_to` varchar(50) NOT NULL,
  `scholarship` varchar(50) NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_eligibility`
--

CREATE TABLE IF NOT EXISTS `ats_pds_eligibility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `type` varchar(256) NOT NULL COMMENT 'career service/ra 1080 (board/bar) under sprecial laws/ces/csee',
  `rating` varchar(20) NOT NULL,
  `date_exam_conferment` date NOT NULL,
  `place_exam_conferment` varchar(200) NOT NULL,
  `license_no` varchar(20) NOT NULL,
  `license_release_date` date NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_family_background`
--

CREATE TABLE IF NOT EXISTS `ats_pds_family_background` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `spouse_lname` varchar(40) NOT NULL,
  `spouse_fname` varchar(40) NOT NULL,
  `spouse_mname` varchar(40) NOT NULL,
  `spouse_occupation` varchar(40) NOT NULL,
  `spouse_employer` varchar(40) NOT NULL,
  `spouse_biz_ad` varchar(60) NOT NULL,
  `spouse_tel` varchar(40) NOT NULL,
  `father_lname` varchar(40) NOT NULL,
  `father_fname` varchar(40) NOT NULL,
  `father_mname` varchar(40) NOT NULL,
  `mother_lname` varchar(40) NOT NULL,
  `mother_fname` varchar(40) NOT NULL,
  `mother_mname` varchar(40) NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_organization`
--

CREATE TABLE IF NOT EXISTS `ats_pds_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT 'name and address of org',
  `inclusive_date_from` date NOT NULL,
  `inclusive_date_to` date NOT NULL,
  `number_of_hours` double NOT NULL,
  `position` varchar(40) NOT NULL COMMENT 'position/nature of work',
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_other_info`
--

CREATE TABLE IF NOT EXISTS `ats_pds_other_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `special_skills` varchar(500) NOT NULL,
  `recognition` varchar(500) NOT NULL,
  `membership_organization` varchar(500) NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_personal_info`
--

CREATE TABLE IF NOT EXISTS `ats_pds_personal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(200) NOT NULL,
  `sex` varchar(2) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(40) NOT NULL,
  `height` varchar(16) NOT NULL,
  `weight` varchar(16) NOT NULL,
  `blood_type` varchar(20) NOT NULL,
  `gsis` varchar(20) NOT NULL,
  `pagibig` varchar(20) NOT NULL,
  `philhealth` varchar(20) NOT NULL,
  `sss` varchar(20) NOT NULL,
  `res_address` varchar(200) NOT NULL,
  `res_zip` varchar(20) NOT NULL,
  `res_tel` varchar(20) NOT NULL,
  `permanent_address` varchar(200) NOT NULL,
  `permanent_zip` varchar(20) NOT NULL,
  `permanent_tel` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `cp` varchar(20) NOT NULL,
  `agency_employee_no` varchar(40) NOT NULL,
  `tin` varchar(20) NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_profile`
--

CREATE TABLE IF NOT EXISTS `ats_pds_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `item_number` varchar(32) NOT NULL,
  `position` varchar(64) NOT NULL,
  `office_id` int(11) NOT NULL,
  `salary_grade` varchar(8) NOT NULL,
  `salary` varchar(16) NOT NULL,
  `status` varchar(32) NOT NULL,
  `last_promotion` varchar(32) NOT NULL,
  `level` varchar(32) NOT NULL,
  `eligibility` varchar(32) NOT NULL,
  `first_day` varchar(32) NOT NULL,
  `graduated` varchar(32) NOT NULL,
  `course` varchar(64) NOT NULL,
  `units` varchar(16) NOT NULL,
  `post_grad` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_questions`
--

CREATE TABLE IF NOT EXISTS `ats_pds_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `question_no` int(11) NOT NULL,
  `answer` tinyint(1) NOT NULL,
  `details` varchar(256) NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_references`
--

CREATE TABLE IF NOT EXISTS `ats_pds_references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(200) NOT NULL,
  `tel_no` varchar(40) NOT NULL,
  `ctc_no` varchar(32) NOT NULL,
  `issue_on` varchar(32) NOT NULL,
  `issue_at` varchar(32) NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_training`
--

CREATE TABLE IF NOT EXISTS `ats_pds_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `training_event_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `number_hours` varchar(16) NOT NULL,
  `conducted_by` varchar(200) NOT NULL,
  `location` varchar(16) NOT NULL,
  `sy` varchar(16) NOT NULL,
  `sem` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'publish or inherit',
  `date_modified` date NOT NULL,
  `as_of` date NOT NULL COMMENT 'tell the date last updated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_pds_work_experience`
--

CREATE TABLE IF NOT EXISTS `ats_pds_work_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `inclusive_date_from` varchar(16) NOT NULL,
  `inclusive_date_to` varchar(16) NOT NULL,
  `position` varchar(256) NOT NULL,
  `company` varchar(256) NOT NULL,
  `monthly_salary` varchar(16) NOT NULL,
  `salary_grade` varchar(10) NOT NULL,
  `status` varchar(40) NOT NULL,
  `govt_service` tinyint(1) NOT NULL DEFAULT '1',
  `movement_code` varchar(32) NOT NULL,
  `employee_status_code` varchar(64) NOT NULL,
  `position_code` varchar(64) NOT NULL,
  `department_code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='also known as service record' AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_permissions`
--

CREATE TABLE IF NOT EXISTS `ats_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `module` varchar(50) NOT NULL,
  `roles` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

-- command split --

--
-- Dumping data for table `ats_permissions`
--

INSERT INTO `ats_permissions` (`id`, `group_id`, `module`, `roles`) VALUES
(1, 1, 'users', '["index","save","delete","my_account"]'),
(2, 1, 'groups', '["save","delete"]'),
(3, 1, 'permissions', '["save","delete","group"]'),
(4, 1, 'employees', '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
(5, 1, 'pds', '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
(6, 1, 'personnel', '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
(7, 1, 'training_manage', '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
(8, 1, 'attendance', '["view_attendance","dtr","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
(9, 1, 'manual_manage', '["login","cto","cto_apps","cto_forward_balance","office_pass"]'),
(10, 1, 'office_manage', '["view_offices","add_office","edit_office","divisions"]'),
(11, 1, 'leave_manage', '["records","leave_card","cancel_leave","file_leave","encode_leave_card","leave_apps","forwarded","undertime","cancel_undertime","wop","stop_earnings","reports","perform_leave_earnings","settings"]'),
(12, 1, 'settings_manage', '["salary_grade","holiday","schedules","employee_schedule","audit_trail","general_settings","backup","offline_update"]'),
(23, 6, 'leave_manage', '["records","leave_card","cancel_leave","file_leave","encode_leave_card","leave_apps","forwarded","undertime","cancel_undertime","wop","stop_earnings","perform_leave_earnings","settings"]'),
(32, 3, 'attendance', '["view_attendance","dtr","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
(40, 7, 'employees', '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
(41, 7, 'pds', '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
(42, 7, 'personnel', '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
(43, 7, 'training_manage', '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
(52, 2, 'employees', '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
(53, 2, 'pds', '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
(54, 2, 'personnel', '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
(55, 2, 'training_manage', '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
(56, 2, 'attendance', '["dtr"]'),
(57, 2, 'manual_manage', '["office_pass"]'),
(58, 2, 'office_manage', '["view_offices","add_office","edit_office","divisions"]'),
(65, 7, 'manual_manage', '["login"]'),
(72, 6, 'employees', '["index","add_employee","edit_employee","delete_employee","add_cart","remove_cart","id_request"]'),
(73, 6, 'pds', '["personal_info","employee_profile","family","education","examination","work","voluntary_work","trainings","other_info","position_details","service_record","scanned_docs","reports","pds_print_preview","sr_print_preview","training_preview"]'),
(74, 6, 'personnel', '["assets","assets_spouse","assets_unmarried","assets_real_properties","assets_personals","assets_liabilities","assets_business_interests","assets_relatives","assets_other_info","personnel_schedule"]'),
(75, 6, 'training_manage', '["type","type_save","type_delete","course","course_save","course_delete","event","event_save","evenr_delete","attendance","attendance_save","attendance_delete","contact_type","contact_type_save","contact_type_delete","contact_info","contact_info_save","contact_info_delete"]'),
(76, 6, 'attendance', '["view_attendance","dtr","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
(79, 6, 'settings_manage', '["salary_grade","holiday","schedules","employee_schedule","audit_trail","general_settings","backup","offline_update"]'),
(90, 5, 'leave_manage', '["records","leave_card","cancel_leave","file_leave","leave_apps","reports"]'),
(91, 1, 'appointment', '["issued"]'),
(100, 9, 'attendance', '["view_attendance","view_attendance_only","dtr","jo","double_entries","view_absences","view_late","view_ob","view_tardiness","view_ten_tardiness"]'),
(101, 9, 'manual_manage', '["login","cto","cto_apps","cto_forward_balance","office_pass"]');

-- command split --

--
-- Table structure for table `ats_plantilla`
--

CREATE TABLE IF NOT EXISTS `ats_plantilla` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(16) NOT NULL,
  `item_no` varchar(16) NOT NULL,
  `year` varchar(4) NOT NULL,
  `position` varchar(128) NOT NULL,
  `sg` varchar(8) NOT NULL,
  `amount` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_salary_grade`
--

CREATE TABLE IF NOT EXISTS `ats_salary_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sg` int(11) NOT NULL,
  `step1` double(15,2) DEFAULT NULL,
  `step2` double(15,2) DEFAULT NULL,
  `step3` double(15,2) DEFAULT NULL,
  `step4` double(15,2) DEFAULT NULL,
  `step5` double(15,2) DEFAULT NULL,
  `step6` double(15,2) DEFAULT NULL,
  `step7` double(15,2) DEFAULT NULL,
  `step8` double(15,2) DEFAULT NULL,
  `year` varchar(4) NOT NULL,
  `salary_grade_type` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

-- command split --

--
-- Dumping data for table `ats_salary_grade`
--

INSERT INTO `ats_salary_grade` (`id`, `sg`, `step1`, `step2`, `step3`, `step4`, `step5`, `step6`, `step7`, `step8`, `year`, `salary_grade_type`) VALUES
(1, 1, 6149.00, 6303.00, 6460.00, 6622.00, 6788.00, 6958.00, 7131.00, 7310.00, '2009', ''),
(2, 2, 6703.00, 6871.00, 7042.00, 7219.00, 7398.00, 7583.00, 7773.00, 7968.00, '2009', ''),
(3, 3, 7307.00, 7489.00, 7675.00, 7868.00, 8063.00, 8266.00, 8471.00, 8684.00, '2009', ''),
(4, 4, 7891.00, 8087.00, 8290.00, 8496.00, 8710.00, 8928.00, 9150.00, 9379.00, '2009', ''),
(5, 5, 8522.00, 8735.00, 8953.00, 9176.00, 9406.00, 9642.00, 9882.00, 10130.00, '2009', ''),
(6, 6, 9204.00, 9434.00, 9670.00, 9911.00, 10160.00, 10414.00, 10673.00, 10941.00, '2009', ''),
(7, 7, 9848.00, 10092.00, 10346.00, 10604.00, 10870.00, 11141.00, 11420.00, 11707.00, '2009', ''),
(8, 8, 10538.00, 10801.00, 11070.00, 11348.00, 11630.00, 11921.00, 12220.00, 12525.00, '2009', ''),
(9, 9, 11275.00, 11557.00, 11846.00, 12143.00, 12446.00, 12756.00, 13077.00, 13401.00, '2009', ''),
(10, 10, 12026.00, 12328.00, 12635.00, 12951.00, 13275.00, 13608.00, 13948.00, 14297.00, '2009', ''),
(11, 11, 12748.00, 13066.00, 13392.00, 13726.00, 10071.00, 14423.00, 14784.00, 15151.00, '2009', ''),
(12, 12, 13512.00, 13850.00, 14197.00, 14552.00, 14915.00, 15289.00, 15670.00, 16061.00, '2009', ''),
(13, 13, 14323.00, 14682.00, 15048.00, 15424.00, 15809.00, 16205.00, 16611.00, 17025.00, '2009', ''),
(14, 14, 15181.00, 15562.00, 15950.00, 16349.00, 16758.00, 17178.00, 17607.00, 18046.00, '2009', ''),
(15, 15, 16093.00, 16494.00, 16907.00, 17329.00, 17763.00, 18208.00, 18662.00, 19130.00, '2009', ''),
(16, 16, 17059.00, 17484.00, 17921.00, 18371.00, 18829.00, 19301.00, 19784.00, 20277.00, '2009', ''),
(17, 17, 18082.00, 18534.00, 18997.00, 19471.00, 19961.00, 20459.00, 20970.00, 21494.00, '2009', ''),
(18, 18, 19168.00, 19647.00, 20138.00, 20642.00, 21158.00, 21685.00, 22229.00, 22784.00, '2009', ''),
(19, 19, 20318.00, 20825.00, 21346.00, 21880.00, 22428.00, 22988.00, 23562.00, 24150.00, '2009', ''),
(20, 20, 21537.00, 22075.00, 22626.00, 23194.00, 23773.00, 24367.00, 24976.00, 25601.00, '2009', ''),
(21, 21, 22397.00, 22958.00, 23532.00, 24120.00, 24722.00, 25340.00, 25975.00, 26623.00, '2009', ''),
(22, 22, 23294.00, 23876.00, 24473.00, 25084.00, 25712.00, 26355.00, 27014.00, 27688.00, '2009', ''),
(23, 23, 24224.00, 24830.00, 25453.00, 26089.00, 26739.00, 27409.00, 28094.00, 28797.00, '2009', ''),
(24, 24, 25196.00, 25825.00, 26472.00, 27132.00, 27812.00, 28506.00, 29219.00, 29950.00, '2009', ''),
(25, 25, 26203.00, 26859.00, 27529.00, 28218.00, 28922.00, 29646.00, 30386.00, 31148.00, '2009', ''),
(26, 26, 27250.00, 27931.00, 28631.00, 29346.00, 30080.00, 30831.00, 31603.00, 32393.00, '2009', ''),
(27, 27, 28340.00, 29050.00, 29777.00, 30520.00, 31282.00, 32065.00, 32866.00, 33689.00, '2009', ''),
(28, 28, 29474.00, 30212.00, 30967.00, 31740.00, 32534.00, 33346.00, 34181.00, 35036.00, '2009', ''),
(29, 29, 30653.00, 31420.00, 32205.00, 33010.00, 33836.00, 34682.00, 35549.00, 36436.00, '2009', ''),
(30, 30, 34939.00, 35813.00, 36709.00, 37626.00, 38566.00, 39531.00, 40518.00, 41530.00, '2009', ''),
(31, 1, 6862.00, 7000.00, 7140.00, 7285.00, 7432.00, 7583.00, 7737.00, 7895.00, '2011', ''),
(32, 2, 7446.00, 7596.00, 7749.00, 7906.00, 8065.00, 8229.00, 8397.00, 8569.00, '2011', ''),
(33, 3, 8080.00, 8243.00, 8409.00, 8580.00, 8753.00, 8932.00, 9113.00, 9301.00, '2011', ''),
(34, 4, 8713.00, 8888.00, 9069.00, 9252.00, 9441.00, 9634.00, 9830.00, 10031.00, '2011', ''),
(35, 5, 9396.00, 9586.00, 9780.00, 9978.00, 10181.00, 10390.00, 10601.00, 10819.00, '2011', ''),
(36, 6, 10133.00, 10338.00, 10548.00, 10761.00, 10981.00, 11206.00, 11434.00, 11669.00, '2011', ''),
(37, 7, 10858.00, 11076.00, 11302.00, 11531.00, 11766.00, 12005.00, 12251.00, 12503.00, '2011', ''),
(38, 8, 11636.00, 11871.00, 12110.00, 12357.00, 12607.00, 12864.00, 13128.00, 13396.00, '2011', ''),
(39, 9, 12469.00, 12721.00, 12978.00, 13242.00, 13510.00, 13785.00, 14067.00, 14353.00, '2011', ''),
(40, 10, 13333.00, 13603.00, 13877.00, 14158.00, 14445.00, 14740.00, 15040.00, 15348.00, '2011', ''),
(41, 11, 14198.00, 14483.00, 14775.00, 15072.00, 15379.00, 15691.00, 16011.00, 16335.00, '2011', ''),
(42, 12, 15119.00, 15422.00, 15733.00, 16050.00, 16374.00, 16706.00, 17044.00, 17390.00, '2011', ''),
(43, 13, 16101.00, 16424.00, 16753.00, 17089.00, 17433.00, 17786.00, 18147.00, 18514.00, '2011', ''),
(44, 14, 17147.00, 17490.00, 17839.00, 18197.00, 18563.00, 18938.00, 19321.00, 19711.00, '2011', ''),
(45, 15, 18292.00, 18661.00, 19040.00, 19426.00, 19822.00, 20228.00, 20640.00, 21064.00, '2011', ''),
(46, 16, 19514.00, 19906.00, 20309.00, 20722.00, 21142.00, 21573.00, 22013.00, 22462.00, '2011', ''),
(47, 17, 20819.00, 21237.00, 21665.00, 22102.00, 22552.00, 23009.00, 23477.00, 23955.00, '2011', ''),
(48, 18, 22214.00, 22659.00, 23115.00, 23581.00, 24057.00, 24542.00, 25041.00, 25549.00, '2011', ''),
(49, 19, 23703.00, 24177.00, 24661.00, 25157.00, 25664.00, 26182.00, 26710.00, 27251.00, '2011', ''),
(50, 20, 25295.00, 25799.00, 26314.00, 26842.00, 27381.00, 27931.00, 28494.00, 29070.00, '2011', ''),
(51, 21, 26671.00, 27200.00, 27741.00, 28293.00, 28856.00, 29433.00, 30024.00, 30626.00, '2011', ''),
(52, 22, 28134.00, 28687.00, 29254.00, 29832.00, 30424.00, 31029.00, 31647.00, 32278.00, '2011', ''),
(53, 23, 29684.00, 30265.00, 30861.00, 31467.00, 32086.00, 32720.00, 33368.00, 34030.00, '2011', ''),
(54, 24, 31334.00, 31943.00, 32567.00, 33201.00, 33853.00, 34516.00, 35195.00, 35890.00, '2011', ''),
(55, 25, 33085.00, 33724.00, 34376.00, 35044.00, 35725.00, 36422.00, 37133.00, 37862.00, '2011', ''),
(56, 26, 34945.00, 35615.00, 36301.00, 37001.00, 37716.00, 38446.00, 39193.00, 39956.00, '2011', ''),
(57, 27, 36923.00, 37627.00, 38347.00, 39080.00, 39830.00, 40597.00, 41380.00, 42181.00, '2011', ''),
(58, 28, 39026.00, 39766.00, 40521.00, 41291.00, 42078.00, 42882.00, 43705.00, 44545.00, '2011', ''),
(59, 29, 41264.00, 42041.00, 42833.00, 43642.00, 44469.00, 45314.00, 46176.00, 47056.00, '2011', ''),
(60, 30, 45941.00, 46813.00, 47705.00, 48615.00, 49544.00, 50495.00, 51464.00, 52455.00, '2011', ''),
(61, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(62, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(63, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(64, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(65, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(66, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(67, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(68, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(69, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(70, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(71, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(72, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(73, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(74, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(75, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(76, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(77, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(78, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(79, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(80, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(81, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(82, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(83, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(84, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(85, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(86, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(87, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(88, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(89, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(90, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011', 'hospital'),
(91, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(92, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(93, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(94, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(95, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(96, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(97, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(98, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(99, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(100, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(101, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(102, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(103, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(104, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(105, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(106, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(107, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(108, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(109, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(110, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(111, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(112, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(113, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(114, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(115, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(116, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(117, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(118, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(119, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', ''),
(120, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012', '');

-- command split --

--
-- Table structure for table `ats_salary_grade_proposed`
--

CREATE TABLE IF NOT EXISTS `ats_salary_grade_proposed` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sg` int(11) NOT NULL,
  `step1` double(15,2) NOT NULL,
  `step2` double(15,2) NOT NULL,
  `step3` double(15,2) NOT NULL,
  `step4` double(15,2) NOT NULL,
  `step5` double(15,2) NOT NULL,
  `step6` double(15,2) NOT NULL,
  `step7` double(15,2) NOT NULL,
  `step8` double(15,2) NOT NULL,
  `year` varchar(4) NOT NULL,
  `salary_grade_type` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_schedules`
--

CREATE TABLE IF NOT EXISTS `ats_schedules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `times` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_schedule_details`
--

CREATE TABLE IF NOT EXISTS `ats_schedule_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `employees` text NOT NULL,
  `dates` text NOT NULL,
  `schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_schedule_employees`
--

CREATE TABLE IF NOT EXISTS `ats_schedule_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `hour_from` varchar(8) NOT NULL,
  `hour_to` varchar(8) NOT NULL,
  `am_in` varchar(8) NOT NULL,
  `am_out` varchar(8) NOT NULL,
  `pm_in` varchar(8) NOT NULL,
  `pm_out` varchar(8) NOT NULL,
  `shift_type` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_service_record`
--

CREATE TABLE IF NOT EXISTS `ats_service_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date_from` varchar(16) NOT NULL,
  `date_to` varchar(16) NOT NULL,
  `designation` varchar(64) NOT NULL,
  `status` varchar(32) NOT NULL,
  `salary` varchar(16) NOT NULL,
  `office_entity` varchar(128) NOT NULL,
  `lwop` varchar(16) NOT NULL,
  `separation_date` varchar(16) NOT NULL,
  `separation_cause` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_sessions`
--

CREATE TABLE IF NOT EXISTS `ats_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- command split --

--
-- Table structure for table `ats_settings`
--

CREATE TABLE IF NOT EXISTS `ats_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `setting_value` text,
  `settings_group` varchar(32) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

-- command split --

--
-- Dumping data for table `ats_settings`
--

INSERT INTO `ats_settings` (`id`, `name`, `setting_value`, `settings_group`, `description`) VALUES
(1, 'system_name', 'Human Resource Management Office, City Government of Puerto Princesa', '0', ''),
(2, 'version', '2.0.0', '0', ''),
(3, 'latest_version', '', '0', ''),
(4, 'sick_earn_amount', '1.25', '0', ''),
(5, 'vacation_earn_amount', '1.25', '0', ''),
(6, 'hours_add', '0.00001,0.000001', '0', ''),
(7, 'server_ip', '', '0', ''),
(8, 'agency', 'quezon', '0', ''),
(9, 'time_interval', '10', '0', ''),
(10, 'minutes_tardy', '1', '0', ''),
(11, 'time_format', '0', '0', ''),
(12, 'overwrite_logs', '0', '0', ''),
(13, 'undertime_tardi', '1', '0', ''),
(14, 'dont_compute ', '', '0', ''),
(15, 'leave_earn', '15', '0', ''),
(16, 'certification_no', '4', '0', ''),
(17, 'statement_no', '4', '0', ''),
(18, 'license', '123456789', '0', ''),
(19, 'update_server', 'mannysoft.com', '0', ''),
(20, 'enable_download', '1', '0', ''),
(21, 'client', '192.168.255.70', '0', ''),
(22, 'ftp_host', '210.213.96.281', '0', ''),
(23, 'ftp_user', 'hrmo', '0', ''),
(24, 'ftp_pass', 'hrmoserver2', '0', ''),
(25, 'ftp_folder', '/wamp/www/ats_service/logs', '0', ''),
(26, 'mannysoft_sql', '', '0', ''),
(27, 'mannysoft_username', '', '0', ''),
(28, 'mannysoft_password', '', '0', ''),
(29, 'mannysoft_db', '', '0', ''),
(30, 'leave_order_chrono', '0', '0', ''),
(31, 'allow_forty_hours', '1', '0', ''),
(32, 'leave_certification_template', '<p>\r\n gtdfasgfds</p>\r\n', '0', ''),
(33, 'lgu_code', '', '0', ''),
(34, 'statement_prepared', 'Mylene J. Atienza', '0', ''),
(35, 'statement_prepared_position', 'Administrative Officer IV (HRMO II)', '0', ''),
(36, 'statement_certified', 'Wenifreda J. Arcegono', '0', ''),
(37, 'statement_certified_position', 'Actg. City Personnel Officer', '0', ''),
(38, 'sr_prepared', 'Nelita D. Hitosis', '0', ''),
(39, 'sr_prepared_position', 'Administrative Assistant II (HRMA)', '0', ''),
(40, 'sr_certified', 'Wenifreda J. Arcegono', '0', ''),
(41, 'sr_certified_position', 'Actg. City Personnel Officer', '0', ''),
(42, 'training_prepared', 'Angelina  E. Magbanua', '0', ''),
(43, 'training_prepared_position', 'Administrative Officer V(Records Officer III)', '0', ''),
(44, 'training_certified', 'Flora M. Aurelio', '0', ''),
(45, 'training_certified_position', 'Supervising Admininistrative Officer (HRMO IV)', '0', ''),
(46, 'republic', 'Republic of the Philippines', '0', ''),
(47, 'lgu_name', 'City Government of Puerto Princesa', '0', ''),
(48, 'lgu_office', 'HUMAN RESOURCE MANAGEMENT OFFICE', '0', ''),
(49, 'lgu_address', 'New City Hall Building, Sta. Monica, Puerto Princesa City', '0', ''),
(50, 'print_office_head_in_dtr', '1', '0', ''),
(51, 'minutes_tardy_am_only', '0', '0', ''),
(52, 'print_overtime_in_dtr', '1', '0', ''),
(53, 'cto_certification', 'Mylene J. Atienza', '0', ''),
(54, 'cto_certification_position', 'Administrative Officer IV (HRMO II)', '0', ''),
(55, 'hospital_view_leave_days', '0', '0', ''),
(56, 'notice_leave_balance', 'Nelly C. Solina', '0', ''),
(57, 'notice_leave_balance_position', 'Administrative Officer V (HRMO II)', '0', ''),
(58, 'notice_leave_balance_noted', 'Wenifreda J. Arcegono', '0', ''),
(59, 'notice_leave_balance_noted_position', 'ACGDH II (Actg. City Personnel Officer)', '0', ''),
(60, 'tardy_autodeduct', 'yes', '0', ''),
(61, 'auto_generate_employee_id', 'no', 'records', ''),
(62, 'enable_id_maker', 'no', 'records', ''),
(63, 'allow_encode_digit_undertime', 'no', 'leave', 'Tell whether the system allow the encoding of undertime digits.'),
(64, 'show_perform_leave_earnings_now', 'yes', 'leave', 'Tell whether the system display the perform leave earnings now link under nav menu.'),
(65, 'show_calendar', 'no', 'leave', 'Show the calendar in file leave'),
(66, 'auto_sixty_days', 'no', 'leave', 'Set 60 days if maternity leave.'),
(67, 'auto_seven_days', 'no', 'leave', 'Set 7 days if paternity leave.'),
(68, 'allow_monetize_using_vl_sl', 'no', 'leave', 'Allow Monetization deduction against both VL and SL.'),
(69, 'encoded_leave_listing_order', 'DESC', 'leave', 'Display the encoded leave in file leave. ASC or DESC'),
(70, 'auto_deduct_forced_leave', 'no', 'leave', 'Set if auto deduct the forced leave every end of the year.'),
(71, 'message_late', 'yes', 'attendance', 'Set if we want to tell the employee that he is late.'),
(72, 'money_value_signatory_prepared', '', 'leave', '.'),
(73, 'money_value_signatory_prepared_position', '', 'leave', '.'),
(74, 'money_value_signatory_certified', '', 'leave', '.'),
(75, 'money_value_signatory_certified_position', '', 'leave', '.'),
(76, 'retirement_signatory_prepared', '', 'leave', '.'),
(77, 'retirement_signatory_prepared_position', '', 'leave', '.'),
(78, 'retirement_signatory_approved', '', 'leave', '.'),
(79, 'retirement_signatory_approved_position', '', 'leave', '.'),
(80, 'retirement_signatory_certified', '', 'leave', '.'),
(81, 'retirement_signatory_certified_position', '', 'leave', '.'),
(82, 'retirement_signatory_attested', '', 'leave', '.'),
(83, 'retirement_signatory_attested_position', '', 'leave', '.'),
(84, 'retirement_signatory_availability', '', 'leave', '.'),
(85, 'retirement_signatory_availability_position', '', 'leave', '.'),
(86, 'retirement_signatory_noted', '', 'leave', '.'),
(87, 'retirement_signatory_noted_position', '', 'leave', '.'),
(88, 'default_salary_grade_year', '2011', 'general', 'the year to be use if needed to use the salary grade.'),
(89, 'auto_deduct_mc_vl', 'no', 'leave', 'MC is 3 days only. Excess must be automatically deducted to VL/SL.'),
(90, 'allow_45mins', 'yes', 'attendance', 'allow 12:45 PM IN'),
(91, 'show_leave_credits_leave_apps', 'yes', 'leave', 'Show leave balance in leave application page.'),
(92, 'view_dtr_leave_time', '15', 'attendance', 'Seconds to close the DTR and leave inquiry.'),
(93, 'minutes_before_log_again_in_am', '5', 'attendance', 'Minutes Before log again in AM.'),
(94, 'show_incomplete_logs', 'yes', 'attendance', 'Show incomplete logs in view attendance.'),
(97, 'leave_card_print_period_from', '', 'leave', 'Show data in leave card with range of date'),
(98, 'leave_card_print_period_to', '', 'leave', 'Show data in leave card with range of date'),
(99, 'enable_add_day_encode_tardy', 'no', 'leave', 'Show the day textbox in adding of tardiness.'),
(100, 'enable_add_earn_menu', 'no', 'leave', 'Show add earn menu.'),
(101, 'seconds_user_idle', '7200', 'users', 'Seconds before logout if user is idle.');

-- command split --

--
-- Table structure for table `ats_shift`
--

CREATE TABLE IF NOT EXISTS `ats_shift` (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `office_id` int(11) NOT NULL,
  `shift_type` int(11) NOT NULL,
  `name` text NOT NULL,
  `times` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`shift_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- command split --

--
-- Dumping data for table `ats_shift`
--

INSERT INTO `ats_shift` (`shift_id`, `office_id`, `shift_type`, `name`, `times`, `description`) VALUES
(1, 19, 1, 'Regular Working Hours (8am-5pm)', '08:00,12:00,13:00,17:00', 'Eight to five with 1 hour interval (12-1pm)'),
(2, 19, 2, 'Hospital Style Working Hours', '06:00,AM,02:00,PM', 'Straight 8 Hours (No interval)'),
(3, 13, 3, 'Special Working Hours', '10:00,PM,06:00,AM', '6am - 12 noon - 3pm - 5pm,  -- '),
(4, 13, 4, '24 Hrs', '08:00,AM,08:00,AM', '24 hrs');

-- command split --

--
-- Table structure for table `ats_special_leave_balance`
--

CREATE TABLE IF NOT EXISTS `ats_special_leave_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `year` varchar(5) NOT NULL,
  `mc` double NOT NULL,
  `paternity` double NOT NULL,
  `maternity` double NOT NULL,
  `solo_parent` double NOT NULL,
  `forced` double NOT NULL,
  `commutation` double NOT NULL,
  `rehabilitation` double NOT NULL,
  `study` double NOT NULL,
  `calamity` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_tardiness`
--

CREATE TABLE IF NOT EXISTS `ats_tardiness` (
  `tardiness_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(10) NOT NULL,
  `office_id` int(11) NOT NULL,
  `late` int(11) NOT NULL,
  `undertime` int(11) NOT NULL,
  `number_tardiness` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `log_type` int(11) NOT NULL,
  `date` date NOT NULL,
  `late_seconds` int(11) NOT NULL,
  `undertime_seconds` int(11) NOT NULL,
  `seconds` int(11) NOT NULL,
  PRIMARY KEY (`tardiness_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_attendees`
--

CREATE TABLE IF NOT EXISTS `ats_training_attendees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `event_code` varchar(255) DEFAULT NULL,
  `employee_id` double DEFAULT NULL,
  `budget_department_id` int(11) NOT NULL,
  `budget_department_code` varchar(255) DEFAULT NULL,
  `relevant` varchar(3) NOT NULL,
  `certified` varchar(3) NOT NULL,
  `employee_local_cost` double DEFAULT NULL,
  `employee_other_cost` double DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_budget_course`
--

CREATE TABLE IF NOT EXISTS `ats_training_budget_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_course_code` varchar(255) DEFAULT NULL,
  `year` double DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_budget_dept`
--

CREATE TABLE IF NOT EXISTS `ats_training_budget_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_department_code` varchar(255) DEFAULT NULL,
  `year` double DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `department_code` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_contacts`
--

CREATE TABLE IF NOT EXISTS `ats_training_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_code` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_co` varchar(255) DEFAULT NULL,
  `contact_address` varchar(255) DEFAULT NULL,
  `contact_city` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_fax` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_specialty` varchar(255) DEFAULT NULL,
  `contact_eval` double DEFAULT NULL,
  `contact_type_id` int(11) NOT NULL,
  `contact_type_code` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_contact_types`
--

CREATE TABLE IF NOT EXISTS `ats_training_contact_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type_code` varchar(255) DEFAULT NULL,
  `contact_type` varchar(255) DEFAULT NULL,
  `contact_type_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_courses`
--

CREATE TABLE IF NOT EXISTS `ats_training_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(255) DEFAULT NULL,
  `course_category` varchar(255) DEFAULT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `course_description` varchar(255) DEFAULT NULL,
  `course_est_duration` varchar(255) DEFAULT NULL,
  `course_est_cost` double DEFAULT NULL,
  `course_ave_eval` double DEFAULT NULL,
  `training_type_id` int(11) NOT NULL,
  `training_type_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_events`
--

CREATE TABLE IF NOT EXISTS `ats_training_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_code` varchar(255) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `event_from` date DEFAULT NULL,
  `event_to` date DEFAULT NULL,
  `event_venue` varchar(255) DEFAULT NULL,
  `event_duration` varchar(255) DEFAULT NULL,
  `contact_id` int(11) NOT NULL,
  `contact_code` varchar(255) DEFAULT NULL,
  `funder_id` int(11) NOT NULL,
  `funder_code` varchar(255) DEFAULT NULL,
  `event_local_cost` double DEFAULT NULL,
  `event_other_cost` double DEFAULT NULL,
  `budget_course_id` int(11) NOT NULL,
  `budget_course_code` varchar(255) DEFAULT NULL,
  `event_eval` double DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_recomended`
--

CREATE TABLE IF NOT EXISTS `ats_training_recomended` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reco_year` double DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `employee_id` double DEFAULT NULL,
  `relevant` tinyint(1) NOT NULL,
  `reco_remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_training_types`
--

CREATE TABLE IF NOT EXISTS `ats_training_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_type_code` varchar(255) DEFAULT NULL,
  `training_type` varchar(255) DEFAULT NULL,
  `training_type_desc` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

--
-- Table structure for table `ats_users`
--

CREATE TABLE IF NOT EXISTS `ats_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `office_id` int(11) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `stat` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- command split --

INSERT INTO `ats_users` (`id`, `group_id`, `username`, `fname`, `mname`, `lname`, `office_id`, `user_type`, `password`, `stat`) VALUES
(1, '{GROUP-ID}', '{USER-NAME}', '{FNAME}', '{MNAME}', '{LNAME}', 1, '1', '{PASSWORD}', 'Active');

-- command split --

--
-- Table structure for table `ats_user_group`
--

CREATE TABLE IF NOT EXISTS `ats_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(64) NOT NULL,
  `roles` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- command split --

--
-- Dumping data for table `ats_user_group`
--

INSERT INTO `ats_user_group` (`id`, `name`, `description`, `roles`) VALUES
(1, 'Super System Administrator', '', ''),
(2, 'System Administrator', '', ''),
(3, 'Timekeeper', '', ''),
(4, 'Official Business Encoder', '', ''),
(5, 'Leave Manager', '', ''),
(6, 'Leave Administrator', '', ''),
(7, 'Records Administrator', '', ''),
(8, 'View Attendance 10 Times Tardy', '', '');

-- command split --

--
-- Table structure for table `ats_user_type`
--

CREATE TABLE IF NOT EXISTS `ats_user_type` (
  `id` int(11) NOT NULL,
  `rank` tinyint(4) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- command split --

--
-- Dumping data for table `ats_user_type`
--

INSERT INTO `ats_user_type` (`id`, `rank`, `name`) VALUES
(1, 1, 'Super System Administrator'),
(2, 2, 'System Administrator'),
(3, 3, 'Timekeeper'),
(4, 4, 'OB Encoder'),
(5, 5, 'Leave Manager'),
(6, 0, 'Leave Administrator'),
(7, 0, 'Records Administrator'),
(8, 0, 'View Attendance 10 Times Tardy');
