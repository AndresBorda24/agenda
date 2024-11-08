<?php

declare(strict_types=1);

namespace App\OrderItems;

use App\DataObjects\Tax;

use function App\iva;

class CertificadoNoAtencionItems extends GeneralItems
{
    public function getTaxes(): array
    {
        $ivaIncluido = iva($this->getAmount()->value);

        return [
            new Tax('valueAddedTax', $ivaIncluido)
        ];
    }
}
