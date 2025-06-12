<?php

declare(strict_types=1);

namespace BcAiAssistant\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BcAiAssistantLogs Model
 *
 * @property \BcAiAssistant\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantLog newEmptyEntity()
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantLog newEntity(array $data, array $options = [])
 * @method array<\BcAiAssistant\Model\Entity\BcAiAssistantLog> newEntities(array $data, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\BcAiAssistant\Model\Entity\BcAiAssistantLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \BcAiAssistant\Model\Entity\BcAiAssistantLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantLog>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantLog>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantLog>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\BcAiAssistant\Model\Entity\BcAiAssistantLog>|\Cake\Datasource\ResultSetInterface<\BcAiAssistant\Model\Entity\BcAiAssistantLog> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BcAiAssistantLogsTable extends Table
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

        $this->setTable('bc_ai_assistant_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'BaserCore.Users',
        ]);
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('response_id')
            ->maxLength('response_id', 255)
            ->allowEmptyString('response_id');

        $validator
            ->scalar('previous_response_id')
            ->maxLength('previous_response_id', 255)
            ->allowEmptyString('previous_response_id');

        $validator
            ->scalar('model')
            ->maxLength('model', 255)
            ->allowEmptyString('model');

        $validator
            ->scalar('request')
            ->allowEmptyString('request');

        $validator
            ->scalar('response')
            ->allowEmptyString('response');

        $validator
            ->integer('input_tokens')
            ->allowEmptyString('input_tokens');

        $validator
            ->integer('output_tokens')
            ->allowEmptyString('output_tokens');

        $validator
            ->integer('total_tokens')
            ->allowEmptyString('total_tokens');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
