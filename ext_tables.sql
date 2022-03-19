#
# Table structure for table 'tx_powermail_domain_model_field'
#
CREATE TABLE tx_powermail_domain_model_field (
	tx_powermailcountry_format tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_powermailcountry_limit tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_powermailcountry_territories text NOT NULL,
);
