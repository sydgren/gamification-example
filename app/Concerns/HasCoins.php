<?php

declare(strict_types=1);

namespace App\Concerns;

use RuntimeException;

trait HasCoins
{
    public function addCoins(int $coins): self
    {
        $this->coins += $coins;

        return $this;
    }

    public function subtractCoins(int $coins): self
    {
        if ($coins > $this->coins) {
            throw new RuntimeException('Cannot subtract more coins than available');
        }
        $this->coins -= $coins;

        return $this;
    }
}
