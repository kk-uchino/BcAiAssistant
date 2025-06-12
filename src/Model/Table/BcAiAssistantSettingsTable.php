<?php

declare(strict_types=1);

namespace BcAiAssistant\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BcAiAssistantSettings Model
 *
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantSetting newEmptyEntity()
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantSetting newEntity(array $data, array $options = [])
 * @method array<\BcAiAssistant\Model\Entity\BcAiAssistantSetting> newEntities(array $data, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantSetting get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantSetting findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\BcAiAssistant\Model\Entity\BcAiAssistantSetting> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantSetting|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantSetting saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantSetting>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantSetting>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantSetting>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantSetting> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantSetting>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantSetting>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantSetting>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantSetting> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BcAiAssistantSettingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bc_ai_assistant_settings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('BaserCore.BcKeyValue');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('value')
            ->requirePresence('value', 'create')
            ->allowEmptyString('value');

        return $validator;
    }

    /**
     * Validation Key Value
     *
     * @param Validator $validator
     * @return Validator
     */
    public function validationKeyValue(Validator $validator): Validator
    {
        $validator
            ->scalar('openai_api_key')
            ->notEmptyString('openai_api_key', __d('baser_core', '必須項目です'));
        return $validator;
    }
}
