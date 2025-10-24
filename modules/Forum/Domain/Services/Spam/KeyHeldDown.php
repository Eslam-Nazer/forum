<?php

namespace Modules\Forum\Domain\Services\Spam;

use Exception;

class KeyHeldDown
{
    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)) {
            throw new Exception('your text contains spam');
        }
    }
}
