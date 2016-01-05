<?php
namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Animes Model
 */
class AnimesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     *
     * @author Marcelo Rocha <marcelo@promosapiens.com.br>
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->table('animes');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     *
     * @author Marcelo Rocha <marcelo@promosapiens.com.br>
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator->requirePresence('name')
            ->notEmpty('name', 'We need the anime name.');

        $validator->requirePresence('episodes')
            ->notEmpty('episodes', 'We need the episodes number.')
            ->add('episodes', [
                'naturalNumber' => [
                    'rule' => ['naturalNumber'],
                    'message' => 'We need a valid episodes number',
                ]
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     *
     * @author Marcelo Rocha <marcelo@promosapiens.com.br>
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
}
