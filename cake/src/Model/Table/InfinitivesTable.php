<?php
namespace App\Model\Table;

use App\Model\Entity\Infinitive;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Infinitives Model
 *
 * @property \Cake\ORM\Association\HasMany $PastParticiples
 * @property \Cake\ORM\Association\HasMany $Preterits
 * @property \Cake\ORM\Association\HasMany $Translations
 * @property \Cake\ORM\Association\BelongsToMany $Sets
 */
class InfinitivesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('infinitives');

        $this->hasMany('PastParticiples', [
            'foreignKey' => 'infinitive_id'
        ]);
        $this->hasMany('Preterits', [
            'foreignKey' => 'infinitive_id'
        ]);
        $this->hasMany('Translations', [
            'foreignKey' => 'infinitive_id'
        ]);
        $this->belongsToMany('Sets', [
            'foreignKey' => 'infinitive_id',
            'targetForeignKey' => 'set_id',
            'joinTable' => 'infinitives_sets'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->allowEmpty('value');

        return $validator;
    }
}
