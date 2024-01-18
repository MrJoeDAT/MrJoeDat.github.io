-- USING ORACLE METADATA

-- Exploring System Tables and Views
SELECT table_name FROM all_tables
SELECT view_name FROM all_views

-- Retrieving Table Metadata
SELECT column_name, data_type FROM all_tab_columns WHERE table_name = 'NASHVILLEHOUSING'

-- Handling Indexes and Constraints
SELECT index_name, table_name FROM all_indexes WHERE table_name = 'TBL'
SELECT constraint_name, constraint_type FROM all_constraints WHERE table_name = 'TBL'

-- Analysing User-defined Objects
SELECT * FROM all_objects
SELECT object_name, object_type FROM all_objects
SELECT object_name, object_type FROM all_objects WHERE object_type = 'PROCEDURE'
SELECT object_name, object_type FROM all_objects WHERE object_type = 'FUNCTION'
SELECT referenced_name, referenced_type FROM all_dependencies

-- -- -- -- --

-- Recent Modification Time
SELECT * FROM all_objects
SELECT * FROM all_objects WHERE owner = 'HR' order by last_ddl_time desc

-- Find Specific Date-Related Information
SELECT * FROM all_tab_cols WHERE owner = 'HR' and column_name = 'START_DATE'
SELECT * FROM all_tab_cols WHERE table_name = 'JOB_HISTORY'

-- Job History Data
SELECT * FROM all_source
SELECT * FROM all_source WHERE UPPER(TEXT) LIKE '%JOB_HISTORY%' AND owner = 'HR'

-- Status of Database Objects
SELECT * FROM all_objects WHERE owner = 'HR' AND status = 'VALID'
SELECT * FROM all_objects WHERE owner = 'HR' AND status = 'INVALID'

-- Most Recent Analysis Date
SELECT * FROM all_tables
SELECT last_analyzed, A.* FROM all_tables A WHERE A.owner = 'HR' ORDER BY A.last_analyzed desc

-- Constraints in Database Scheme
SELECT * FROM all_constraints WHERE owner = 'HR'


---------------------------


-- ANALYTICAL FUNCTION

-- Syntax
Analytic-Function(Column1, Column2, ...) min(saleprice)
    OVER (
[Query-Partition-Clause]
[Order-By-Clause]
[Windowing-Clause]
)

-- Find the Average Sale Price of Property(Land), their use along with other details
SELECT AVG(SalePrice) OVER (PARTITION BY LandUse) AS Avg_LandUse_SalePrice, A.* FROM NashvilleHousing A ORDER BY LandUse
SELECT LandUse, AVG(SalePrice) FROM NashvilleHousing group by LandUse

-- Find Total Sale for Each UniqueID in Each District
SELECT UniqueID, TaxDistrict, SUM(SalePrice) OVER (PARTITION BY UniqueID, TaxDistrict) AS TotalSales FROM NashvilleHousing ORDER BY TaxDistrict

-- Find the Details of Most Recent Land Sold for use
SELECT LEAD(SaleDate) OVER (PARTITION BY LandUse ORDER BY SaleDate) AS Recent_Sale, A.* FROM NashvilleHousing A ORDER BY LandUse, UniqueID

-- Using Multiple Analytic Function
--SELECT UniqueID, SalePrice, AVG(SalePrice) OVER (PARTITION BY UniqueID) AS AvgSales,
--Max(SalePrice) OVER (PARTITION BY UniqueID) AS MaxSales FROM NashvilleHousing

-- Top-Performing TaxDistrict Based on Average Sales
--SELECT UniqueID, TaxDistrict, AVG(SalePrice) OVER (PARTITION BY TaxDistrict ORDER BY AVG(SalePrice) DESC) AS Avg_Sales_Rank FROM NashvilleHousing

-- Find the Minimum Sale Price of Property(Land), their Tax District along with other details
SELECT MIN(SalePrice) OVER (PARTITION BY TaxDistrict) AS Min_SalePrice_By_TaxDistrict, A.* FROM NashvilleHousing A ORDER BY TaxDistrict
SELECT TaxDistrict, MIN(SalePrice) FROM NashvilleHousing group by TaxDistrict

-- Find the Maximum Total Value of Property(Land), their use along with other details
SELECT MAX(TotalValue) OVER (PARTITION BY LandUse) AS Max_TotalValue_By_LandUse, A.* FROM NashvilleHousing A ORDER BY LandUse
SELECT LandUse, MAX(TotalValue) FROM NashvilleHousing group by LandUse

SELECT * FROM (
SELECT LEAD(SaleDate) OVER (PARTITION BY LandUse ORDER BY SaleDate) AS Recent_Sale, A.* FROM NashvilleHousing A --ORDER BY LandUse, UniqueID
) WHERE Recent_Sale IS NULL

-- Find Cumulative Sale Price
SELECT SUM(SalePrice) OVER (PARTITION BY LandUse ORDER BY UniqueID) AS Cum_SalePrice_By_LandUse, A.* FROM NashvilleHousing A ORDER BY LandUse, UniqueID

SELECT SUM(SalePrice) OVER (ORDER BY UniqueID) AS Cum_SalePrice_By_LandUse, A.* FROM NashvilleHousing A ORDER BY UniqueID DESC, LandUse

SELECT SUM(TotalValue) AS Sum_Of_TotalValue FROM NashvilleHousing ORDER BY UniqueID DESC

-- Windowing Function

-- Average Sale Price of Previous or Most Recent(3) Land Sales
SELECT AVG(SalePrice) OVER (PARTITION BY LandUse ORDER BY SaleDate ROWS 3 PRECEDING) AS SalePrice_Of_LandUse_Avg_3, A.* FROM NashvilleHousing A ORDER BY LandUse, UniqueID

-- Running Total Sales of Each District and their Use
SELECT UniqueID, TaxDistrict, LandUse, SaleDate, SUM(SalePrice) OVER (PARTITION BY UniqueID ORDER BY SaleDate ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS RunningTotal FROM NashvilleHousing



-----------------------------------


-- ORACLE VIEWS

-- Security
-- Abstraction
-- DML Operations
-- Drop Table and View Fails

-- Syntax
CREATE VIEW view_name AS
    SELECT columns
    FROM tables
    [WHERE conditions];
    
-- Create View for different Tax District

-- Urban Service District VIEW
CREATE VIEW VW_UrbanServiceDistrict AS SELECT * FROM NashvilleHousing WHERE TaxDistrict = 'URBAN SERVICES DISTRICT'
SELECT * FROM VW_UrbanServiceDistrict
-- General Services District VIEW
CREATE VIEW VW_GeneralServiceDistrict AS SELECT * FROM NashvilleHousing WHERE TaxDistrict = 'GENERAL SERVICES DISTRICT'
SELECT * FROM VW_GeneralServiceDistrict
-- City of Oak Hill VIEW
CREATE VIEW VW_CityOfOakHill AS SELECT * FROM NashvilleHousing WHERE TaxDistrict = 'CITY OF OAK HILL'
SELECT * FROM VW_CityOfOakHill

-- View with Joins
-- View for Customer Info Using Two Tables
CREATE VIEW VW_CustInfo AS SELECT A.CustomerID, A.First_Name AS CustomerName, B.CustomerStore FROM CustomerInfo A INNER JOIN StoreInfo B ON A.CustomerID = B.CustomerID
SELECT * FROM VW_CustInfo

-- Filtering Data in View
-- View that shows Lands Sold as Vacant and other filtered details
CREATE VIEW VW_SoldAsVacant AS SELECT TaxDistrict, SoldAsVacant, PropertyAddress, LandUse, SalePrice, SaleDate FROM NashvilleHousing WHERE SoldAsVacant = 'YES' OR SoldAsVacant = 'Y'
SELECT * FROM VW_SoldAsVacant

-- DML Operations on Views
SELECT * FROM VW_UrbanServiceDistrict

UPDATE VW_UrbanServiceDistrict SET SALEPRICE = 180000 WHERE UniqueID = 6970

DELETE VW_UrbanServiceDistrict WHERE UniqueID = 5778

-- Data Abstraction
CREATE VIEW VW_UrbanServiceDistrict_EX AS SELECT UniqueID, LandUse, PropertyAddress, SalePrice, TaxDistrict FROM NashvilleHousing
SELECT * FROM VW_UrbanServiceDistrict_EX

UPDATE VW_UrbanServiceDistrict_EX SET TaxDistrict = 'Urban Service District' WHERE UniqueID = 53419

DELETE FROM VW_UrbanServiceDistrict_EX WHERE UniqueID = 22718

-- Securing Views (Manage Privileges)
GRANT DELETE, INSERT, SELECT, UPDATE ON VW_GeneralServiceDistrict TO HR
SELECT * FROM VW_GeneralServiceDistrict
UPDATE VW_GeneralServiceDistrict SET LandUse = 'SINGLE FAMILY' WHERE UniqueID = 2045
REVOKE DELETE, INSERT, SELECT, UPDATE ON VW_GeneralServiceDistrict FROM HR

-- -- --
-- What Properties in Different Districts are Used For
SELECT * FROM VW_UrbanServiceDistrict_EX
SELECT TaxDistrict, LandUse FROM VW_UrbanServiceDistrict_EX GROUP BY TaxDistrict, LandUse

CREATE VIEW VW_SP_UrbanServiceDistrict_EX AS
SELECT TaxDistrict, LandUse FROM VW_UrbanServiceDistrict_EX GROUP BY TaxDistrict, LandUse
SELECT * FROM VW_SP_UrbanServiceDistrict_EX


----------------------------------------


-- JOINS IN ORACLE

-- 
SELECT * FROM CustomerInfo
SELECT * FROM StoreInfo

--Self Join
-- Compare Two Tax District with their Land Use
--SELECT A.TaxDistrict AS TaxDistrict_Gen, A.LandUse AS LandUse_Gen, B.TaxDistrict AS TaxDistrict_Urb, B.LandUse AS LandUse_Urb
--FROM NashvilleHousing A
--JOIN NashvilleHousing B
--ON A.ParcelID = B.ParcelID AND A.UniqueID = B.UniqueID
--WHERE A.TaxDistrict = 'GENERAL SERVICES DISTRICT' OR
--B.TaxDistrict = 'URBAN SERVICES DISTRICT'

-- Inner Join
-- Show How Many Times each Customer Purchased a Product
SELECT A.CustomerID, COUNT(1), SUM(PRICE)
FROM CustomerInfo A
INNER JOIN StoreInfo B
ON A.CustomerID = B.CustomerID
GROUP BY A.CustomerID
ORDER BY A.CustomerID 

-- Left Outer Join
-- Based on ProductID, Calculate Sum of Revenue Generated on Each Product
SELECT ProductID, SUM(PRICE)
FROM CustomerInfo A
LEFT OUTER JOIN StoreInfo B
ON A.CustomerID = B.CustomerID
GROUP BY ProductID
ORDER BY ProductID

-- Right Outer Join
-- Display all Product Sold
SELECT A.CustomerID, SUM(PRICE)
FROM CustomerInfo A
RIGHT OUTER JOIN StoreInfo B
ON A.CustomerID = B.CustomerID
GROUP BY A.CustomerID
ORDER BY A.CustomerID

-- Full Outer Join
-- Display all Data in Each Tables
SELECT A.CustomerID, First_Name AS CustomerName, CustomerStore, Product, Price
FROM CustomerInfo A
FULL JOIN StoreInfo B
ON A.CustomerID = B.CustomerID



THANK YOU!




























