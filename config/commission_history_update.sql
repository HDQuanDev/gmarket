-- Add new columns to existing commission_history table
ALTER TABLE `commission_history` 
ADD COLUMN `previous_balance` double NOT NULL DEFAULT 0 AFTER `seller_earning`,
ADD COLUMN `current_balance` double NOT NULL DEFAULT 0 AFTER `previous_balance`;
