<?php

namespace App\Models;

class LeveringModel extends DatabaseModel
{
    /**
     * Gegevens van het product en de leverancier voor het scherm Levering product.
     */
    public function getLeveringProduct(int $leverancierId, int $productId): ?object
    {
        return $this->callProcedureFirst('sp_GetLeveringProduct', [$leverancierId, $productId]);
    }

    /**
     * Voegt een nieuwe zending toe en verhoogt de voorraad in het magazijn.
     * Geeft Succes (1/0) en bij mislukken de Reden (ONBEKEND of NIET_ACTIEF) terug.
     */
    public function voegLeveringToe(int $leverancierId, int $productId, int $aantal, string $datumEerstvolgendeLevering): object
    {
        return $this->callProcedureFirst('sp_VoegLeveringToe', [
            $leverancierId,
            $productId,
            $aantal,
            $datumEerstvolgendeLevering,
        ]);
    }
}
