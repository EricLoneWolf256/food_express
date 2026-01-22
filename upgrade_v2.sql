-- Database Upgrade Script V2
-- Goal: Transform Single-Vendor to Multi-Vendor Platform

-- 1. Create Restaurant Table
CREATE TABLE IF NOT EXISTS `tbl_restaurant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `email` varchar(150),
  `phone` varchar(20),
  `address` text,
  `image_name` varchar(255),
  `password` varchar(255) NOT NULL, -- For restaurant login
  `opening_hours` varchar(100),
  `delivery_radius_km` decimal(10,2) DEFAULT 10.00,
  `rating` decimal(3,2) DEFAULT 0.00,
  `active` varchar(10) DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2. Create Rider Table
CREATE TABLE IF NOT EXISTS `tbl_rider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vehicle_type` varchar(50) DEFAULT 'Bike',
  `plate_number` varchar(50),
  `status` varchar(50) DEFAULT 'Available', -- Available, Busy, Offline
  `current_lat` decimal(10,8),
  `current_long` decimal(11,8),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 3. Update Order Table to support Restaurant, Rider, and sophisticated Status
ALTER TABLE `tbl_order` 
ADD COLUMN `restaurant_id` int(10) unsigned AFTER `id`,
ADD COLUMN `rider_id` int(10) unsigned DEFAULT 0 AFTER `restaurant_id`,
ADD COLUMN `delivery_fee` decimal(10,2) DEFAULT 0.00 AFTER `price`,
ADD COLUMN `delivery_instruction` text AFTER `customer_address`,
ADD COLUMN `delivery_lat` decimal(10,8) AFTER `delivery_instruction`,
ADD COLUMN `delivery_long` decimal(11,8) AFTER `delivery_lat`,
ADD COLUMN `payment_method` varchar(50) DEFAULT 'COD' AFTER `total`,
ADD COLUMN `payment_status` varchar(50) DEFAULT 'Pending' AFTER `payment_method`,
CHANGE COLUMN `status` `status` varchar(50) DEFAULT 'Ordered'; 
-- Status flow: Ordered -> Accepted -> Preparing -> Ready -> Picked Up -> On Delivery -> Delivered

-- 4. Create Order Items Table (Crucial for multi-item orders)
CREATE TABLE IF NOT EXISTS `tbl_order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `food_id` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `add_ons` text, -- JSON string for toppings e.g. {"start_date": "", "toppings": ["Cheese", "Olives"]}
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 5. Update Food Table to link to Restaurant
ALTER TABLE `tbl_food`
ADD COLUMN `restaurant_id` int(10) unsigned DEFAULT 0 AFTER `category_id`,
ADD COLUMN `is_veg` varchar(10) DEFAULT 'No' AFTER `active`,
ADD COLUMN `prep_time_min` int(11) DEFAULT 30 AFTER `is_veg`;

-- 6. Update Users Table for loyalty and precise location
ALTER TABLE `tbl_users`
ADD COLUMN `loyalty_points` int(11) DEFAULT 0,
ADD COLUMN `wallet_balance` decimal(10,2) DEFAULT 0.00,
ADD COLUMN `saved_addresses` text; -- JSON of saved addresses

-- 7. Create Reviews Table
CREATE TABLE IF NOT EXISTS `tbl_reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `restaurant_id` int(10) unsigned NOT NULL,
  `rating` int(1) NOT NULL,
  `review_text` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
