<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

/**
 * @author Wolfgang Hinzmann <wolfgang.hinzmann@doccheck.com>
 * @license 2024 DocCheck Community GmbH
 */
class ImagePreviewField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null)
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)

            // this template is used in 'index' and 'detail' pages
            ->setTemplatePath('admin/field/image_preview.html.twig')
            ->addCssFiles('assets/styles/admin.scss')
            ->addWebpackEncoreEntries('admin')
            ;
    }
}
