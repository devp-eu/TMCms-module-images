<?php
namespace TMCms\Modules\Images;

use TMCms\Orm\Entity;
use TMCms\Modules\Images\Entity\ImageCollection;
use TMCms\Modules\IModule;

defined('INC') or exit;

class ModuleImages implements IModule {
	public static $tables = [
		'images' => 'm_images'
	];

	/** @var $this */
	private static $instance;

	public static function getInstance() {
		if (!self::$instance) self::$instance = new self;
		return self::$instance;
	}

	/**
	 * @param string $item_type
	 * @param int $item_id
	 * @return string
	 */
	public static function getPathForItemImages($item_type, $item_id)
	{
		return DIR_PUBLIC_URL . 'images' . DIRECTORY_SEPARATOR . $item_type . DIRECTORY_SEPARATOR . $item_id . DIRECTORY_SEPARATOR;
	}

    public static function getObjectImages(Entity $object)
    {
        $class = strtolower(join('', array_slice(explode('\\', get_class($object)), -1)));

        // Get existing images in DB
        $image_collection = new ImageCollection;
        $image_collection->setWhereItemType($class);
        $image_collection->setWhereItemId($object->getId());
        $image_collection->addOrderByField('order');
        return $image_collection->getAsArrayOfObjects();
    }

    public static function deleteEntityImages(Entity $object)
    {
        $class = strtolower(join('', array_slice(explode('\\', get_class($object)), -1)));

        // Get existing images in DB
        $image_collection = new ImageCollection;
        $image_collection->setWhereItemType($class);
        $image_collection->setWhereItemId($object->getId());

		return $image_collection->deleteObjectCollection();
    }
}