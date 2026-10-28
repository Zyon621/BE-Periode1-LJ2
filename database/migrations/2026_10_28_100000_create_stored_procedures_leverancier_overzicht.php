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
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetLeveranciersOverzicht');
        DB::unprepared('
            CREATE PROCEDURE sp_GetLeveranciersOverzicht()
            BEGIN
                SELECT      LEV.Id
                           ,LEV.Naam
                           ,LEV.ContactPersoon
                           ,LEV.LeverancierNummer
                           ,LEV.Mobiel
                           ,COUNT(DISTINCT PPL.ProductId)   AS AantalVerschillendeProducten

                FROM        Leverancier             AS LEV

                LEFT JOIN   ProductPerLeverancier   AS PPL
                        ON  PPL.LeverancierId = LEV.Id
                       AND  PPL.IsActief = 1

                WHERE       LEV.IsActief = 1

                GROUP BY    LEV.Id
                           ,LEV.Naam
                           ,LEV.ContactPersoon
                           ,LEV.LeverancierNummer
                           ,LEV.Mobiel

                ORDER BY    AantalVerschillendeProducten DESC
                           ,LEV.Naam ASC;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetLeverancierById');
        DB::unprepared('
            CREATE PROCEDURE sp_GetLeverancierById(IN p_LeverancierId TINYINT UNSIGNED)
            BEGIN
                SELECT      LEV.Id
                           ,LEV.Naam
                           ,LEV.ContactPersoon
                           ,LEV.LeverancierNummer
                           ,LEV.Mobiel

                FROM        Leverancier AS LEV

                WHERE       LEV.Id = p_LeverancierId
                  AND       LEV.IsActief = 1;
            END
        ');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetGeleverdeProductenByLeverancier');
        DB::unprepared('
            CREATE PROCEDURE sp_GetGeleverdeProductenByLeverancier(IN p_LeverancierId TINYINT UNSIGNED)
            BEGIN
                SELECT      PRD.Id                          AS ProductId
                           ,PRD.Naam                        AS ProductNaam
                           ,MAG.AantalAanwezig
                           ,MAG.VerpakkingsEenheid
                           ,MAX(PPL.DatumLevering)          AS DatumLaatsteLevering

                FROM        ProductPerLeverancier   AS PPL

                INNER JOIN  Product                 AS PRD
                        ON  PRD.Id = PPL.ProductId

                LEFT JOIN   Magazijn                AS MAG
                        ON  MAG.ProductId = PRD.Id

                WHERE       PPL.LeverancierId = p_LeverancierId
                  AND       PPL.IsActief = 1

                GROUP BY    PRD.Id
                           ,PRD.Naam
                           ,MAG.AantalAanwezig
                           ,MAG.VerpakkingsEenheid

                ORDER BY    MAG.AantalAanwezig DESC
                           ,PRD.Naam ASC;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetGeleverdeProductenByLeverancier');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetLeverancierById');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_GetLeveranciersOverzicht');
    }
};
