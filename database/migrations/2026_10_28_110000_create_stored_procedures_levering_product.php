<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetLeveringProduct');
        DB::unprepared('
            CREATE PROCEDURE sp_GetLeveringProduct
            (
                 IN p_LeverancierId     TINYINT UNSIGNED
                ,IN p_ProductId         TINYINT UNSIGNED
            )
            BEGIN
                SELECT      PRD.Id                                  AS ProductId
                           ,PRD.Naam                                AS ProductNaam
                           ,CAST(PRD.IsActief AS UNSIGNED)          AS ProductIsActief
                           ,LEV.Id                                  AS LeverancierId
                           ,LEV.Naam                                AS LeverancierNaam
                           ,LEV.ContactPersoon
                           ,LEV.Mobiel

                FROM        Product         AS PRD

                INNER JOIN  Leverancier     AS LEV
                        ON  LEV.Id = p_LeverancierId

                WHERE       PRD.Id = p_ProductId
                  AND       EXISTS (
                                SELECT  1
                                FROM    ProductPerLeverancier AS PPL
                                WHERE   PPL.LeverancierId = p_LeverancierId
                                  AND   PPL.ProductId     = p_ProductId
                            );
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_VoegLeveringToe');
        DB::unprepared('
            CREATE PROCEDURE sp_VoegLeveringToe
            (
                 IN p_LeverancierId                 TINYINT UNSIGNED
                ,IN p_ProductId                     TINYINT UNSIGNED
                ,IN p_Aantal                        SMALLINT UNSIGNED
                ,IN p_DatumEerstvolgendeLevering    DATE
            )
            BEGIN
                DECLARE v_ProductIsActief TINYINT UNSIGNED DEFAULT NULL;

                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    ROLLBACK;
                    RESIGNAL;
                END;

                SELECT      CAST(PRD.IsActief AS UNSIGNED)
                INTO        v_ProductIsActief
                FROM        Product                 AS PRD
                INNER JOIN  ProductPerLeverancier   AS PPL
                        ON  PPL.ProductId = PRD.Id
                WHERE       PRD.Id = p_ProductId
                  AND       PPL.LeverancierId = p_LeverancierId
                LIMIT       1;

                IF v_ProductIsActief IS NULL THEN
                    SELECT 0 AS Succes, "ONBEKEND" AS Reden;
                ELSEIF v_ProductIsActief = 0 THEN
                    SELECT 0 AS Succes, "NIET_ACTIEF" AS Reden;
                ELSE
                    START TRANSACTION;

                    INSERT INTO ProductPerLeverancier
                    (
                         LeverancierId
                        ,ProductId
                        ,DatumLevering
                        ,Aantal
                        ,DatumEerstvolgendeLevering
                    )
                    VALUES
                    (
                         p_LeverancierId
                        ,p_ProductId
                        ,CURDATE()
                        ,p_Aantal
                        ,p_DatumEerstvolgendeLevering
                    );

                    UPDATE  Magazijn
                    SET     AantalAanwezig = IFNULL(AantalAanwezig, 0) + p_Aantal
                    WHERE   ProductId = p_ProductId;

                    COMMIT;

                    SELECT 1 AS Succes, NULL AS Reden;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_VoegLeveringToe');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetLeveringProduct');
    }
};
