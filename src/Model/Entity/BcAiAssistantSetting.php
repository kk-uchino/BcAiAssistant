<?php

declare(strict_types=1);

namespace BcAiAssistant\Model\Entity;

use Cake\ORM\Entity;

/**
 * BcAiAssistantSetting Entity
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class BcAiAssistantSetting extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
