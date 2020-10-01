<?php

declare(strict_types=1);

namespace App\Concerns;

trait HasExperience
{
    public function addExperience(int $experience): self
    {
        $this->experience += $experience;

        return $this;
    }

    public function getLevel(): int
    {
        return (int) floor((25 + sqrt(625 + 100 * $this->experience)) / 50);
    }

    public function getExperienceToLevelUp(): int
    {
        $nextLevel = $this->getLevel() + 1;
        return (25 * $nextLevel * $nextLevel - 25 * $nextLevel) - $this->experience;
    }
}
