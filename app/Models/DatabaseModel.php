<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use PDO;

abstract class DatabaseModel
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connection()->getPdo();
    }

    /**
     * Roept een stored procedure aan via PDO en geeft alle rijen terug als objecten.
     *
     * @param  array<int, mixed>  $parameters
     * @return array<int, object>
     */
    protected function callProcedure(string $procedure, array $parameters = []): array
    {
        $placeholders = implode(', ', array_fill(0, count($parameters), '?'));

        $statement = $this->pdo->prepare("CALL {$procedure}({$placeholders})");
        $statement->execute(array_values($parameters));

        $rows = $statement->fetchAll(PDO::FETCH_OBJ);
        $statement->closeCursor();

        return $rows;
    }

    /**
     * Roept een stored procedure aan en geeft alleen de eerste rij terug (of null).
     *
     * @param  array<int, mixed>  $parameters
     */
    protected function callProcedureFirst(string $procedure, array $parameters = []): ?object
    {
        return $this->callProcedure($procedure, $parameters)[0] ?? null;
    }
}
