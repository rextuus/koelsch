<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\RandomImage;
use App\Entity\RandomText;

/**
 * @author Wolfgang Hinzmann <wolfgang.hinzmann@doccheck.com>
 * @license 2024 DocCheck Community GmbH
 */
class RandomSet
{
    private RandomText $text;
    private RandomImage $winnerImage;
    private array $looserImages;

    private string $winnerClass;

    private int $totalGaffel;
    private int $totalReisi;
    private int $totalFrueh;

    public function getText(): RandomText
    {
        return $this->text;
    }

    public function setText(RandomText $text): RandomSet
    {
        $this->text = $text;
        return $this;
    }

    public function getWinnerImage(): RandomImage
    {
        return $this->winnerImage;
    }

    public function setWinnerImage(RandomImage $winnerImage): RandomSet
    {
        $this->winnerImage = $winnerImage;
        return $this;
    }

    public function getLooserImages(): array
    {
        return $this->looserImages;
    }

    public function setLooserImages(array $looserImages): RandomSet
    {
        $this->looserImages = $looserImages;
        return $this;
    }

    public function getWinnerClass(): string
    {
        return $this->winnerClass;
    }

    public function setWinnerClass(string $winnerClass): RandomSet
    {
        $this->winnerClass = $winnerClass;
        return $this;
    }

    public function getTotalGaffel(): int
    {
        return $this->totalGaffel;
    }

    public function setTotalGaffel(int $totalGaffel): RandomSet
    {
        $this->totalGaffel = $totalGaffel;
        return $this;
    }

    public function getTotalReisi(): int
    {
        return $this->totalReisi;
    }

    public function setTotalReisi(int $totalReisi): RandomSet
    {
        $this->totalReisi = $totalReisi;
        return $this;
    }

    public function getTotalFrueh(): int
    {
        return $this->totalFrueh;
    }

    public function setTotalFrueh(int $totalFrueh): RandomSet
    {
        $this->totalFrueh = $totalFrueh;
        return $this;
    }
}
