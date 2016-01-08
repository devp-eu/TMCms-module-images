<?php

namespace TMCms\Modules\Images\Entity;

use TMCms\Orm\EntityRepository;

/**
 * Class ImageRepository
 * @package TMCms\Modules\Images\Entity
 *
 * @method setWhereItemType(string $type)
 * @method setWhereItemId(int $id)
 */
class ImageRepository extends EntityRepository
{
    protected $table_structure = [
        'fields' => [
            'item_id' => [
                'type' => 'index',
            ],
            'item_type' => [
                'type' => 'varchar',
            ],
            'image' => [
                'type' => 'varchar',
            ],
            'order' => [
                'type' => 'int',
                'unsigned' => true,
            ],
        ],
        'indexes' => [
            'item_type' => [
                'type' => 'key',
            ],
        ],
    ];
}