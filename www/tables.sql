CREATE TABLE "customer_bill" (
	"id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	"items_total"	INTEGER NOT NULL,
	"cashier_name"	TEXT NOT NULL,
	"customer_name"	TEXT NOT NULL,
	"customer_number"	TEXT NOT NULL,
	"customer_location"	TEXT,
	"total_price_bill"	TEXT NOT NULL,
	"date_time"	TEXT DEFAULT CURRENT_TIMESTAMP
)
CREATE TABLE "item_details" (
	"id"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"item_name"	TEXT NOT NULL,
	"item_code"	TEXT NOT NULL,
	"item_price"	TEXT NOT NULL,
	"added_on"	TEXT NOT NULL,
	"status"	TEXT DEFAULT 'A'
)
CREATE TABLE "items_selled" (
	"id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	"item_code"	INTEGER NOT NULL,
	"qty_selled"	TEXT,
	"reference_key"	INTEGER NOT NULL
)
CREATE TABLE "sales_report_daily" (
	"id"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"item_code"	TEXT NOT NULL,
	"qty_selled"	INTEGER NOT NULL,
	"date_time"	TEXT NOT NULL,
	"last_added_qty"	INTEGER NOT NULL,
	"invoice_number"	TEXT NOT NULL
)

CREATE TABLE "sales_report_monthly" (
	"id"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"item_code"	TEXT NOT NULL,
	"qty_selled"	INTEGER NOT NULL,
	"date_time"	TEXT NOT NULL,
	"last_added_qty"	INTEGER NOT NULL,
	"invoice_number"	TEXT NOT NULL
)
CREATE TABLE "sales_report_yearly" (
	"id"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"item_code"	TEXT NOT NULL,
	"qty_selled"	INTEGER NOT NULL,
	"date_time"	TEXT NOT NULL,
	"last_added_qty"	INTEGER NOT NULL,
	"invoice_number"	TEXT NOT NULL
)

CREATE TABLE "hotel_info" (
	"id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	"hotel_address"	TEXT NOT NULL,
	"hotel_phone"	TEXT NOT NULL,
	"hote_liscence"	TEXT,
	"hotel_info"	TEXT,
	"mobile"	TEXT,
	"hotel_name"	TEXT
)
hotel_address='',hotel_phone='',hote_liscence='',hotel_info='',mobile='',hotel_name=''