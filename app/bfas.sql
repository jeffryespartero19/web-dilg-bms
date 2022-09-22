CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Accounts_Information` (
  `Accounts_Information_ID` INT(10) NOT NULL,
  `Account_Type_ID` INT(5) NOT NULL,
  `Account_Code_ID` INT(5) NOT NULL,
  `Account_Name` VARCHAR(100) NULL,
  `Account_Number` INT(10) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Accounts_Information_ID`)
);

CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Budget_Appropriation` (
  `Budget_Appropriation_ID` INT(10) NOT NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Appropriation_No` VARCHAR(50) NULL,
  `Budget_Appropriation_Status_ID` INT(5) NOT NULL,
  `Budget_Year` INT(4) NULL,
  `Fund_Type_ID` INT(5) NOT NULL,
  `Appropriation_Date` DATE NULL,
  `Appropriation_Type_ID` INT(5) NOT NULL,
  `Particulars` VARCHAR(255) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Budget_Appropriation_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_JEV_Collection` (
  `JEV_Collection_ID` INT(10) NOT NULL,
  `Journal_Number` VARCHAR(20) NULL,
  `Bank_Account_ID` INT(5) NOT NULL,
  `Journal_Type_ID` INT(5) NOT NULL,
  `Fund_Type_ID` INT(5) NOT NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Particulars` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`JEV_Collection_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_JEV_Disbursement` (
  `JEV_Disbursement_ID` INT(10) NOT NULL,
  `Journal_Number` VARCHAR(20) NULL,
  `Bank_Account_ID` INT(5) NOT NULL,
  `Journal_Type_ID` INT(5) NOT NULL,
  `Fund_Type_ID` INT(5) NOT NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Particulars` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`JEV_Disbursement_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Obligation_Request_Status` (
  `Obligation_Request_Status_ID` INT(5) NOT NULL,
  `Obligation_Request_Status` VARCHAR(255) NULL,
  `Active` BIT NULL DEFAULT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Obligation_Request_Status_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Budget_Appropriation_Accounts` (
  `Budget_Appropriation_Accounts_ID` INT(15) NOT NULL,
  `Accounts_Information_ID` INT(10) NOT NULL,
  `Budget_Appropriation_ID` INT(10) NOT NULL,
  `Appropriation_Amount` DOUBLE(10,2) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Budget_Appropriation_Accounts_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_SAAODBA` (
  `SAAODBA_ID` INT(10) NOT NULL,
  `Obligation_Request_ID` INT(10) NOT NULL,
  `Fund_Type_ID` INT(5) NOT NULL,
  `SAAODBA_As_of` DATE NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Accounts_Information_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`SAAODBA_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Obligation_Request` (
  `Obligation_Request_ID` INT(10) NOT NULL,
  `Obligation_Request_No` VARCHAR(20) NULL,
  `Multiple_DV_ID` BIGINT(15) NOT NULL,
  `Purchase_Order_No` VARCHAR(20) NULL,
  `Card_File_ID` INT(5) NOT NULL,
  `Fund_Type_ID` INT(5) NOT NULL,
  `Obligation_Request_Date` DATE NULL,
  `Obligation_Request_Status_ID` INT(5) NOT NULL,
  `Budget_Appropriation_ID` INT(10) NOT NULL,
  `Remarks` VARCHAR(255) NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region` VARCHAR(2) NOT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Obligation_Request_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_OBR_Accounts` (
  `OBR_Accounts_ID` BIGINT(15) NOT NULL,
  `Tax_Type_ID` INT(5) NOT NULL,
  `Obligation_Request_ID` INT(10) NOT NULL,
  `Accounts_Information_ID` INT(10) NOT NULL,
  `Amount` DOUBLE(10,2) NULL,
  `Adjustment_Amount` DOUBLE(10,2) NULL,
  `Remarks` VARCHAR(100) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`OBR_Accounts_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_OBR_Disbursement_Voucher` (
  `Multiple_DV_ID` BIGINT(15) NOT NULL,
  `Disbursement_Voucher_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Multiple_DV_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Budget_Realignment_Accounts` (
  `Budget_Realignment_Accounts_ID` BIGINT(15) NOT NULL,
  `Accounts_Information_ID` INT(10) NOT NULL,
  `Budget_Realignment_ID` INT(10) NOT NULL,
  `Appropriation` DOUBLE(10,2) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Budget_Realignment_Accounts_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Disbursement_Voucher` (
  `Disbursement_Voucher_ID` INT(10) NOT NULL,
  `Transaction_No` VARCHAR(10) NULL,
  `Voucher_No` VARCHAR(10) NULL,
  `Appropriation_Type_ID` INT(5) NOT NULL,
  `Fund_Type_ID` INT(5) NOT NULL,
  `Card_File_ID` INT(10) NOT NULL,
  `Disbursement_Voucher_Status_ID` INT(5) NOT NULL,
  `Particulars` VARCHAR(255) NULL,
  `For_Liquidation` BIT NULL,
  `For_Payroll` BIT NULL,
  `For_Cash_Advance` BIT NULL,
  `Disbursement_Check` BIT NULL,
  `Disbursement_Cash` BIT NULL,
  `Remarks` VARCHAR(255) NULL,
  `Multiple_OBR_ID` BIGINT(15) NOT NULL,
  `Tax_Code_ID` INT(5) NOT NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Disbursement_Voucher_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_DV_Accounts` (
  `DV_Accounts_ID` BIGINT(15) NOT NULL,
  `Accounts_Information_ID` INT(10) NOT NULL,
  `Disbursement_Voucher_ID` INT(10) NOT NULL,
  `Amount` DOUBLE(10,2) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`DV_Accounts_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_DV_Obligation_Request` (
  `Multiple_OBR_ID` BIGINT(15) NOT NULL,
  `Obligation_Request_ID` INT(10) NOT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Multiple_OBR_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Budget_Appropriation_Status` (
  `Budget_Appropriation_Status_ID` INT(5) NOT NULL,
  `Budget_Appropriation_Status` VARCHAR(255) NULL,
  `Active` BIT NULL DEFAULT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Budget_Appropriation_Status_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Check_Preparation` (
  `Check_Preparation_ID` INT(10) NOT NULL,
  `Particulars` VARCHAR(255) NULL,
  `Brgy_Officials_and_Staff_ID` INT(10) NOT NULL,
  `Disbursement_Voucher_ID` INT(10) NOT NULL,
  `Voucher_Status_ID` INT(5) NOT NULL,
  `Amount` DOUBLE(10,2) NULL,
  `Bank_Account_ID` INT(5) NOT NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Check_Preparation_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Check_Status_Cleared` (
  `Check_Status_Cleared_ID` INT(10) NOT NULL,
  `Check_Preparation_ID` INT(10) NOT NULL,
  `Cleared_Date` DATETIME NULL,
  `Remarks` VARCHAR(100) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Check_Status_Cleared_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Check_Status_Released` (
  `Check_Status_Released_ID` INT(10) NOT NULL,
  `Check_Preparation_ID` INT(10) NOT NULL,
  `Released_Date` DATE NULL,
  `Received_by` VARCHAR(100) NULL,
  `ID_Presented` VARCHAR(50) NULL,
  `ID_Number` VARCHAR(20) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Check_Status_Released_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Disbursement_Voucher_Status` (
  `Disbursement_Voucher_Status_ID` INT(5) NOT NULL,
  `Disbursement_Voucher_Status` VARCHAR(255) NULL,
  `Active` BIT NULL DEFAULT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Disbursement_Voucher_Status_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Card_Type` (
  `Card_Type_ID` INT(5) NOT NULL,
  `Card_Type` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Card_Type_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Account_Type` (
  `Account_Type_ID` INT(5) NOT NULL,
  `Account_Type` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Account_Type_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Payment_Collection` (
  `Payment_Collection_ID` INT(10) NOT NULL,
  `Payment_Collection_Number` VARCHAR(15) NULL,
  `Accounts_Information_ID` INT(5) NOT NULL,
  `Type_of_Fee_ID` INT(5) NOT NULL,
  `OR_Date` DATE NULL,
  `OR_No` VARCHAR(20) NULL,
  `Cash_Tendered` DOUBLE(5,2) NULL,
  `Remarks` VARCHAR(255) NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Payment_Collection_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Type_of_Fee` (
  `Type_of_Fee_ID` INT(10) NOT NULL,
  `Account_Information_ID` INT(10) NOT NULL,
  `Type_of_Fee` VARCHAR(255) NULL,
  `Amount` DOUBLE(5,2) NULL,
  `Description` VARCHAR(255) NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Type_of_Fee_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Bank_Account` (
  `Bank_Account_ID` INT(5) NOT NULL,
  `Accounts_Information_ID` INT(10) NOT NULL,
  `Bank_Account_Code` VARCHAR(20) NULL,
  `Bank_Account_No` VARCHAR(20) NULL,
  `Bank_Account_Name` VARCHAR(255) NULL,
  `Check_Number_From` VARCHAR(20) NULL,
  `Check_Number_To` VARCHAR(20) NULL,
  `Active` BIT NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Bank_Account_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Voucher_Status` (
  `Voucher_Status_ID` INT(5) NOT NULL,
  `Voucher_Status` VARCHAR(255) NULL,
  `Active` BIT NULL DEFAULT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Voucher_Status_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Tax_Code` (
  `Tax_Code_ID` INT(5) NOT NULL,
  `Description` VARCHAR(255) NULL,
  `Payment_Type` VARCHAR(20) NULL,
  `BIR_Form_No.` VARCHAR(20) NULL,
  `Rate` VARCHAR(20) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Tax_Code_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Tax_Code` (
  `Tax_Code_ID` INT(5) NOT NULL,
  `Description` VARCHAR(255) NULL,
  `Payment_Type` VARCHAR(20) NULL,
  `BIR_Form_No.` VARCHAR(20) NULL,
  `Rate` VARCHAR(20) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Tax_Code_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Tax_Type` (
  `Tax_Type_ID` INT(5) NOT NULL,
  `Tax_Type` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Tax_Type_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Journal_Type` (
  `Journal_Type_ID` INT(5) NOT NULL,
  `Journal_Type` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Journal_Type_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Fund_Type` (
  `Fund_Type_ID` INT(5) NOT NULL,
  `Fund_Type` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Fund_Type_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Account_Code` (
  `Account_Code_ID` INT(5) NOT NULL,
  `Expenditure_Type_ID` INT(5) NOT NULL,
  `Account_Code` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Account_Code_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`Maintenance_BFAS_Expenditure_Type` (
  `Expenditure_Type_ID` INT(5) NOT NULL,
  `Expenditure_Type` VARCHAR(255) NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Expenditure_Type_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`MAINTENANCE_BFAS_Appropriation_Type` (
  `Appropriation_Type_ID` INT(5) NOT NULL,
  `Appropriation_Type` VARCHAR(255) NULL,
  `Active` BIT NULL DEFAULT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Appropriation_Type_ID`)
);
CREATE TABLE IF NOT EXISTS `dilg_bms`.`BFAS_Card_File` (
  `Card_File_ID` INT(10) NOT NULL,
  `Card_Type_ID` INT(5) NOT NULL,
  `Company_Name` VARCHAR(255) NULL,
  `First_Name` VARCHAR(50) NULL,
  `Middle_Name` VARCHAR(50) NULL,
  `Last_Name` VARCHAR(50) NULL,
  `Phone_No` VARCHAR(15) NULL,
  `Contact_No_1` VARCHAR(20) NULL,
  `Contact_No_2` VARCHAR(20) NULL,
  `Billing_Address` VARCHAR(255) NULL,
  `Delivery_Address` VARCHAR(255) NULL,
  `Email_Address` VARCHAR(255) NULL,
  `Company_Tin` VARCHAR(20) NULL,
  `Barangay_ID` VARCHAR(3) NOT NULL,
  `City_Municipality_ID` VARCHAR(2) NOT NULL,
  `Province_ID` VARCHAR(3) NOT NULL,
  `Region_ID` VARCHAR(2) NOT NULL,
  `Active` BIT NULL,
  `Encoder_ID` INT(5) NOT NULL,
  `Date_Stamp` DATETIME NULL,
  PRIMARY KEY (`Card_File_ID`)
);
