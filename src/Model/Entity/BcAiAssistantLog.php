<?php

declare(strict_types=1);

namespace BcAiAssistant\Model\Entity;

use Cake\ORM\Entity;

/**
 * BcAiAssistantLog Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $response_id
 * @property string $previous_response_id
 * @property string|null $model
 * @property string|null $request
 * @property string|null $response
 * @property int|null $input_tokens
 * @property int|null $output_tokens
 * @property int|null $total_tokens
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \BcAiAssistant\Model\Entity\User $user
 */
class BcAiAssistantLog extends Entity
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
        'user_id' => true,
        'response_id' => true,
        'previous_response_id' => true,
        'model' => true,
        'request' => true,
        'response' => true,
        'input_tokens' => true,
        'output_tokens' => true,
        'total_tokens' => true,
        'created' => true,
        'user' => true,
    ];
}
