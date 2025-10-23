<?php

namespace Modules\Forum\Domain\Services\Spam;

use Exception;
use Modules\Forum\Domain\Services\Spam\InvalidKeywords;
use Modules\Forum\Domain\Services\Spam\KeyHeldDown;

class Spam
{
    protected array $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class,
    ];

    /**
     * @param string $body
     * @return bool
     * @throws Exception
     */
    public function detect(string $body): bool
    {

        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }
}
