<?php

namespace App\Models;

class LeverancierModel extends DatabaseModel
{
    /**
     * Alle leveranciers met het aantal verschillende producten, aflopend gesorteerd.
     *
     * @return array<int, object>
     */
    public function getOverzicht(): array
    {
        return $this->callProcedure('sp_GetLeveranciersOverzicht');
    }

    public function getById(int $leverancierId): ?object
    {
        return $this->callProcedureFirst('sp_GetLeverancierById', [$leverancierId]);
    }

    /**
     * De door de leverancier geleverde producten, aflopend gesorteerd op Aantal in magazijn.
     *
     * @return array<int, object>
     */
    public function getGeleverdeProducten(int $leverancierId): array
    {
        return $this->callProcedure('sp_GetGeleverdeProductenByLeverancier', [$leverancierId]);
    }
}
