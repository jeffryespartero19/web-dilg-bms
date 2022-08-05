CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Brgy_Inventory` (
  `Inventory_ID` BIGINT(15) NOT NULL,
  `Stock_No` VARCHAR(15) NULL,
  `Inventory_Name` VARCHAR(255) NULL,
  `Card_File_ID` INT(10) NOT NULL,
  `Item_Category_ID` INT(10) NOT NULL,
  `Unit_of_Measure_ID` INT(10) NOT NULL,
  `Item_Status_ID` INT(10) NOT NULL,
  `Item_Inspection_ID` BIGINT(15) NOT NULL,
  `Date_Received` DATETIME NULL,
  `Remarks` VARCHAR(255) NULL,
  `Barangay_ID` INT(10) NOT NULL,
  `City_Municipality_ID` INT(10) NOT NULL,
  `Province_ID` INT(10) NOT NULL,
  `Region_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
  
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Inventory_for_Disposal` (
  `Disposal_Inventory_ID` INT(10) NOT NULL,
  `Inventory_ID` BIGINT(15) NOT NULL,
  `Date_Disposed` DATE NULL,
  `Item_Status_ID` INT(10) NOT NULL,
  `Remarks` VARCHAR(255) NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);


CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_File_Attachment` (
  `Attachment_ID` BIGINT(15) NOT NULL,
  `Disposal_Inventory` INT(10) NOT NULL,
  `File_Name` VARCHAR(255) NULL,
  `File_Size` INT(10) NULL,
  `File_Location` VARCHAR(255) NULL,
  `File_Type` VARCHAR(50) NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Inventory_to_Dispose` (
  `Disposal_Inventory_ID` BIGINT(15) NOT NULL,
  `Inventory_ID` BIGINT(15) NOT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Inhabitants_Equipment_Borrow_Request` (
  `Equipment_Request_ID` INT(10) NOT NULL,
  `Resident_ID` BIGINT(15) NOT NULL,
  `Purpose` VARCHAR(255) NULL,
  `Remarks` VARCHAR(255) NULL,
  `Date_Borrowed` DATETIME NULL,
  `Expected_Return_Date` DATETIME NULL,
  `Date_Returned` DATETIME NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Equipment_Borrowed` (
  `Borrowed_Equipment_ID` BIGINT(15) NOT NULL,
  `Equipment_Request_ID` INT(10) NOT NULL,
  `Inventory_ID` BIGINT(15) NOT NULL,
  `Item_Inspection_ID` BIGINT(15) NOT NULL,
  `Quantity_Borrowed` INT(10) NULL,
  `Borrowed_Equipmnet_Status_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Item_Inspection` (
  `Item_Inspection_ID` BIGINT(15) NOT NULL,
  `Received_Item_ID` BIGINT(15) NOT NULL,
  `Inspection_Date` DATETIME NULL,
  `Markings` VARCHAR(100) NULL,
  `Serial_No` VARCHAR(100) NULL,
  `Item_Status_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Inventory_BegBal` (
  `Inventory_BegBal_ID` INT(10) NOT NULL,
  `Inventory_ID` BIGINT(15) NOT NULL,
  `Unit_Cost` DOUBLE(10,2) NULL,
  `Quantity` INT(10) NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Received_Item` (
  `Received_Item_ID` BIGINT(15) NOT NULL,
  `Card_File_ID` INT(10) NOT NULL,
  `Inventory_ID` BIGINT(15) NOT NULL,
  `Item_Status_ID` INT(10) NOT NULL,
  `Donation` BIT(1) NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Received_Quantity` INT(10) NULL,
  `Date_Received` DATE NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`MAINTENANCE_BINS_Unit_of_Measure` (
  `Unit_of_Measure_ID` INT(10) NOT NULL,
  `Unit_of_Measure` VARCHAR(100) NULL,
  `Active` BIT(1) NULL DEFAULT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Supplies_Issuance` (
  `Issued_Supplies_ID` INT(10) NOT NULL,
  `Inventory_ID` BIGINT(15) NOT NULL,
  `Date_and_Time_Issued` DATETIME NULL,
  `Issued_Qty` INT(10) NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Recipients` VARCHAR(100) NULL,
  `Purpose` VARCHAR(255) NULL,
  `Remarks` VARCHAR(255) NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`MAINTENANCE_BINS_Item_Classification` (
  `Item_Classification_ID` INT(10) NOT NULL,
  `Item_Classification` VARCHAR(255) NULL,
  `Active` BIT(1) NULL DEFAULT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Physical_Count_Inventory` (
  `Physical_Count_Inventory_ID` BIGINT(15) NOT NULL,
  `Inventory_ID` BIGINT(15) NOT NULL,
  `On_Hand_Per_Count` INT(10) NULL,
  `Remarks` VARCHAR(255) NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`BINS_Physical_Count` (
  `Physical_Count_ID` INT(10) NOT NULL,
  `Item_Category_ID` INT(10) NOT NULL,
  `Physical_Count_Inventory_ID` BIGINT(15) NOT NULL,
  `Transaction_No` VARCHAR(30) NULL,
  `Particulars` VARCHAR(255) NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`MAINTENANCE_BINS_Borrowed_Equipment_Status` (
  `Borrowed_Equipment_Status_ID` INT(10) NOT NULL,
  `Equipment_Status` VARCHAR(255) NULL,
  `Active` BIT(1) NULL DEFAULT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`MAINTENANCE_BINS_Item_Status` (
  `Item_Status_ID` INT(10) NOT NULL,
  `Item_Status` VARCHAR(255) NULL,
  `Active` BIT(1) NULL DEFAULT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);

CREATE TABLE IF NOT EXISTS `dilg_bis`.`MAINTENANCE_BINS_Item Category` (
  `Item_Category_ID` INT(10) NOT NULL,
  `Item_Category_Name` VARCHAR(255) NULL,
  `Item_Classification_ID` INT(10) NOT NULL,
  `Active` BIT(1) NULL DEFAULT NULL,
  `Encoder_ID` INT(10) NOT NULL,
  `Date_Stamp` DATETIME NULL
);