-- Stap: 01
-- Doel: Maak een nieuwe database opdracht1-jamin aan
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

-- Controleer of de database al bestaat
DROP DATABASE IF EXISTS `opdracht1-jamin`;

-- Maak een nieuwe database aan
CREATE DATABASE IF NOT EXISTS `opdracht1-jamin`;

-- Gebruik database opdracht1-jamin
Use `opdracht1-jamin`;


-- Stap: 02
-- Doel: Maak een nieuwe tabel Voorraad aan
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

-- Verwijder tabel Voorraad
DROP TABLE IF EXISTS Voorraad;

CREATE TABLE IF NOT EXISTS Voorraad
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Productid                       VARCHAR(50)                     NOT NULL
   ,VerpakkingsEenheidinKilogram    VARCHAR(10)                     NOT NULL
   ,AantalAanwezig                  VARCHAR(50)                        NULL    DEFAULT NULL
   ,IsActief                        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen                     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt                 DateTime(6)                     NOT NULL
   ,DatumGewijzigd                  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Voorraad_Id   PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Stap: 03
-- Doel: Vul tabel Voorraad met data
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

INSERT INTO Voorraad
(
     Productid
    ,VerpakkingsEenheidinKilogram
    ,AantalAanwezig
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('1', '5',   '453', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('2', '2,5', '400', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('3', '5',   '1',   1, NULL, SYSDATE(6), SYSDATE(6))
    ,('4', '1',   '800', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('5', '3',   '234', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('6', '2',   '345', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('7', '1',   '795', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('8', '10',  '233', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('9', '2,5', '123', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('10', '3',  NULL,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,('11', '2',  '367', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('12', '1',  '467', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('13', '5',  '20',  1, NULL, SYSDATE(6), SYSDATE(6));


-- Stap: 04
-- Doel: Maak een nieuwe tabel Product aan
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

-- Verwijder tabel Product
DROP TABLE IF EXISTS Product;

CREATE TABLE IF NOT EXISTS Product
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam            VARCHAR(50)                     NOT NULL
   ,Barcode         VARCHAR(13)                     NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Product_Id   PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Stap: 05
-- Doel: Vul tabel Product met data
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

INSERT INTO Product
(
     Naam
    ,Barcode
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Mintnopjes', '8719587231278', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Schoolkrijt', '8719587326713', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Honingdrop', '8719587327836', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Zure Beren', '8719587321441', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Cola Flesjes', '8719587321237', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Turtles', '8719587322245', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Witte Muizen', '8719587328256', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Reuzen Slangen', '8719587325641', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Zoute Rijen', '8719587322739', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Winegums', '8719587327527', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Drop Munten', '8719587322345', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Kruis Drop', '8719587322265', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Zoute Ruitjes', '8719587323256', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Stap: 06
-- Doel: Maak een nieuwe tabel Allergeen aan
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

-- Verwijder tabel Allergeen
DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam            VARCHAR(50)                     NOT NULL
   ,Omschrijving    VARCHAR(250)                    NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Allergeen_Id   PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Stap: 07
-- Doel: Vul tabel Allergeen met data
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

INSERT INTO Allergeen
(
     Naam
    ,Omschrijving
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Gluten', 'Dit product bevat gluten', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Gelatine', 'Dit product bevat gelatine', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('AZO-Kleurstof', 'Dit product bevat AZO-kleurstoffen', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Lactose', 'Dit product bevat lactose', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Soja', 'Dit product bevat soja', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Stap: 08
-- Doel: Maak een nieuwe tabel ProductPerAllergeen aan
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

-- Verwijder tabel ProductPerAllergeen
DROP TABLE IF EXISTS ProductPerAllergeen;

CREATE TABLE IF NOT EXISTS ProductPerAllergeen
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,ProductId       TINYINT         UNSIGNED        NOT NULL
   ,AllergeenId     TINYINT         UNSIGNED        NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_ProductPerAllergeen_Id   PRIMARY KEY (Id)
   ,CONSTRAINT      FK_ProductPerAllergeen_ProductId_Product_Id  FOREIGN KEY (ProductId) REFERENCES Product(Id)
   ,CONSTRAINT      FK_ProductPerAllergeen_AllergeenId_Allergeen_Id  FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id)
) ENGINE=InnoDB;


-- Stap: 09
-- Doel: Vul tabel ProductPerAllergeen met data
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

INSERT INTO ProductPerAllergeen
(
     ProductId
    ,AllergeenId
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1, 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 3, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(6, 5, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9, 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9, 5, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(10, 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(12, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 5, 1, NULL, SYSDATE(6), SYSDATE(6));


-- Stap: 10
-- Doel: Maak een nieuwe tabel Leverancier aan
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

-- Verwijder tabel Leverancier
DROP TABLE IF EXISTS Leverancier;

CREATE TABLE IF NOT EXISTS Leverancier
(
    Id                  TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam                VARCHAR(50)                     NOT NULL
   ,ContactPersoon      VARCHAR(50)                     NOT NULL
   ,LeverancierNummer   VARCHAR(20)                     NOT NULL
   ,Mobiel              VARCHAR(15)                     NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Leverancier_Id   PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- Stap: 11
-- Doel: Vul tabel Leverancier met data
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

INSERT INTO Leverancier
(
     Naam
    ,ContactPersoon
    ,LeverancierNummer
    ,Mobiel
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Venco', 'Bert van Linge', 'L1029384719', '06-28493827', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Haribo', 'Sven Stalman', 'L1029324748', '06-24383291', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Stap: 12
-- Doel: Maak een nieuwe tabel ProductPerLeverancier aan
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

-- Verwijder tabel ProductPerLeverancier
DROP TABLE IF EXISTS ProductPerLeverancier;

CREATE TABLE IF NOT EXISTS ProductPerLeverancier
(
    Id                              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,LeverancierId                   TINYINT         UNSIGNED        NOT NULL
   ,ProductId                       TINYINT         UNSIGNED        NOT NULL
   ,DatumLevering                   DATE                            NOT NULL
   ,Aantal                          SMALLINT        UNSIGNED        NOT NULL
   ,DatumEerstvolgendeLevering      DATE                                NULL    DEFAULT NULL
   ,IsActief                        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen                     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt                 DateTime(6)                     NOT NULL
   ,DatumGewijzigd                  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_ProductPerLeverancier_Id   PRIMARY KEY (Id)
   ,CONSTRAINT      FK_ProductPerLeverancier_LeverancierId_Leverancier_Id  FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id)
   ,CONSTRAINT      FK_ProductPerLeverancier_ProductId_Product_Id  FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;


-- Stap: 13
-- Doel: Vul tabel ProductPerLeverancier met data
-- **********************************************************************************
-- Versie        Datum:          Auteur:                     Omschrijving:
-- *******       **********      ****************            ******************
-- 01            09-09-2026      Zyon Kolf                   Nieuw
-- **********************************************************************************/

INSERT INTO ProductPerLeverancier
(
     LeverancierId
    ,ProductId
    ,DatumLevering
    ,Aantal
    ,DatumEerstvolgendeLevering
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1, 1, '2024-10-09', 23, '2024-10-16', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 1, '2024-10-18', 21, '2024-10-25', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 2, '2024-10-09', 12, '2024-10-16', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 3, '2024-10-10', 11, '2024-10-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 4, '2024-10-14', 16, '2024-10-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 4, '2024-10-21', 23, '2024-10-28', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 5, '2024-10-14', 45, '2024-10-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 6, '2024-10-14', 30, '2024-10-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 7, '2024-10-12', 12, '2024-10-19', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 7, '2024-10-19', 23, '2024-10-26', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 8, '2024-10-10', 12, '2024-10-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 9, '2024-10-11', 1,  '2024-10-18', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(4, 10, '2024-10-16', 24, '2024-10-30', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 11, '2024-10-10', 47, '2024-10-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 11, '2024-10-19', 60, '2024-10-26', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 12, '2024-10-11', 45, NULL,          1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 13, '2024-10-12', 23, NULL,          1, NULL, SYSDATE(6), SYSDATE(6));
