<?php

namespace Modules\Forum\Domain\Services\Spam;

use Exception;

class InvalidKeywords
{
    protected array $keywords = [
        'yahoo customer support',
    ];

    /**
     * @param $body
     * @return void
     * @throws Exception
     */
    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('your reply contains spam');
            }
        }
    }

}
