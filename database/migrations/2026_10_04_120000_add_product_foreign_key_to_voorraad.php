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
        DB::statement('ALTER TABLE Voorraad MODIFY Productid TINYINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE Voorraad ADD CONSTRAINT FK_Voorraad_ProductId_Product_Id FOREIGN KEY (Productid) REFERENCES Product (Id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE Voorraad DROP FOREIGN KEY FK_Voorraad_ProductId_Product_Id');
        DB::statement('ALTER TABLE Voorraad MODIFY Productid VARCHAR(50) NOT NULL');
    }
};
