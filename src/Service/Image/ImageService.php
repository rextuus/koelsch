<?php

declare(strict_types=1);

namespace App\Service\Image;

use App\Entity\Image;
use App\Message\ImageUpload;
use App\Repository\ImageRepository;
use App\Service\Image\Form\ImageData;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @author  Wolfgang Hinzmann <wolfgang.hinzmann@doccheck.com>
 * @license 2023 DocCheck Community GmbH
 */
class ImageService
{

    public function __construct(
        private ImageRepository $repository,
        private ImageFactory $factory,
        private MessageBusInterface $bus
    )
    {
    }

    public function createByData(ImageData $data): Image
    {
        $image = $this->factory->create();
        $this->factory->mapData($image, $data);

        $this->repository->save($image);

//        $this->bus->dispatch(new ImageUpload($image->getId()));

        return $image;
    }

    public function update(Image $image, ImageData $data): void
    {
        $this->factory->mapData($image, $data);
        $this->repository->save($image);
    }

    public function find(int $imageId): ?Image
    {
        return $this->repository->find($imageId);
    }


    public function findAll()
    {
        return $this->repository->findBy([], ['created' => 'DESC'], 10);
    }
}