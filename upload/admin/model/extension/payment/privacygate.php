<?php

class ModelExtensionPaymentPrivacyGate extends Model
{
    public function install()
    {
        $this->db->query("
	    	CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "privacygate_order` (
	        	`id` INT(11) NOT NULL AUTO_INCREMENT,
	        	`store_order_id` INT(11) NOT NULL,
	        	`store_total_amount` FLOAT NOT NULL,	        	
	        	`privacygate_charge_code` VARCHAR(50) NOT NULL,
	        	`privacygate_transaction_id` VARCHAR(100),
	        	`privacygate_status` TEXT,
	        	`privacygate_coins_expected` FLOAT,	        	
	        	`privacygate_coins_received` FLOAT,
	        	`privacygate_received_currency` TEXT NOT NULL,
	        	PRIMARY KEY (`id`)
	     	) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;
    	");

        $this->load->model('setting/setting');

        $settings = array();
        $settings['payment_privacygate_api_test_mode'] = 0;
        $settings['payment_privacygate_order_status_id'] = 1;
        $settings['payment_privacygate_completed_status_id'] = 2;
        $settings['payment_privacygate_pending_status_id'] = 1;
        $settings['payment_privacygate_resolved_status_id'] = 5;
        $settings['payment_privacygate_unresolved_status_id'] = 8;
        $settings['payment_privacygate_expired_status_id'] = 14;
        $settings['payment_privacygate_total'] = 30;
        $settings['payment_privacygate_sort_order'] = 0;

        $this->model_setting_setting->editSetting('payment_privacygate', $settings);
    }

    public function uninstall()
    {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "privacygate_order`;");
    }
}
