<?php
declare(strict_types=1);

namespace App\Service;

use App\Command\InitRandomCommand;
use App\Entity\RandomImage;
use App\Repository\RandomImageRepository;
use App\Repository\RandomTextRepository;

/**
 * @author Wolfgang Hinzmann <wolfgang.hinzmann@doccheck.com>
 * @license 2024 DocCheck Community GmbH
 */
class RandomService
{

    public function __construct(private RandomImageRepository $imageRepository, private RandomTextRepository $textRepository)
    {
    }

    public function getRandomSet(): RandomSet
    {
        $all = [
            InitRandomCommand::GAFFEL => $this->imageRepository->findBy(['owner' => InitRandomCommand::GAFFEL]),
            InitRandomCommand::FRUEH => $this->imageRepository->findBy(['owner' => InitRandomCommand::FRUEH]),
            InitRandomCommand::REISI => $this->imageRepository->findBy(['owner' => InitRandomCommand::REISI]),
        ];

        $set = new RandomSet();

        // get the statistic
        $total = 0;
        array_walk(
            $all[InitRandomCommand::GAFFEL],
            function (RandomImage $image) use (&$total){
                $total = $total + $image->getCounter();
            }
        );
        $set->setTotalGaffel($total);

        $total = 0;
        array_walk(
            $all[InitRandomCommand::REISI],
            function (RandomImage $image) use (&$total){
                $total = $total + $image->getCounter();
            }
        );
        $set->setTotalReisi($total);

        $total = 0;
        array_walk(
            $all[InitRandomCommand::FRUEH],
            function (RandomImage $image) use (&$total){
                $total = $total + $image->getCounter();
            }
        );
        $set->setTotalFrueh($total);

        /** @var array<RandomImage> $winners */
        $winners = $this->getRandomElement($all);

        $winnerBeer = $winners[0]->getOwner();
        $allBeers = array_keys($all);
        $looserBeerKeys = array_diff($allBeers, [$winnerBeer]);

        $texts = $this->textRepository->findBy(['owner' => $winnerBeer]);

        $winnerText = $this->getRandomElement($texts);
        $winnerImages = $this->getRandomElements($winners);
        /** @var RandomImage $winnerImage */
        $winnerImage = $winnerImages[0];

        $loserImages = [];
        $loserImages[] = $winnerImages[1];

        $loserImages = array_merge($loserImages, $this->getRandomElements($all[$looserBeerKeys[array_key_first($looserBeerKeys)]]));
        $loserImages = array_merge($loserImages, $this->getRandomElements($all[$looserBeerKeys[array_key_last($looserBeerKeys)]]));

        $set->setWinnerImage($winnerImage);
        $set->setText($winnerText);
        $set->setLooserImages($loserImages);
        $set->setWinnerClass($winnerBeer);

        $winnerImage->setCounter($winnerImage->getCounter()+1);
        $this->imageRepository->save($winnerImage);

        return $set;
    }

    function getRandomElement($array) {
        $keys = array_keys($array);

        // Get the number of elements in the array
        $count = count($array);

        // Generate a random index within the range of the array
        $randomIndex = rand(0, $count - 1);

        // Return the element at the random index
        return $array[$keys[$randomIndex]];
    }


    function getRandomElements($array) {
        // Get the number of elements in the array
        $count = count($array);

        // Generate two different random indexes
        $randomIndex1 = rand(0, $count - 1);
        $randomIndex2 = rand(0, $count - 1);

        // Make sure the indexes are different
        while ($randomIndex2 == $randomIndex1) {
            $randomIndex2 = rand(0, $count - 1);
        }

        // Return the two elements at the random indexes
        return [$array[$randomIndex1], $array[$randomIndex2]];
    }
}
