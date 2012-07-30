INSERT INTO `{PREFIX}users` (`id`, `email`, `password`, `salt`, `group_id`, `ip_address`, `active`, `activation_code`, `created_on`, `last_login`, `username`, `forgotten_password_code`, `remember_code`) VALUES
    (1,'{EMAIL}', '{PASSWORD}', '{SALT}', 1, '', 1, '', {NOW}, {NOW}, '{USER-NAME}', NULL, NULL);
	
-- command split --



-- command split --