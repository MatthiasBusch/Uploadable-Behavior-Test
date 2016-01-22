<?php
namespace App\Model\Table;

use App\Model\Entity\Product;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 */
class ProductsTable extends Table
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
        $this->addBehavior('Utils.Uploadable', [
            'image' => ['path' => 'uploads/{model}/{field}/']
        ]);

        $this->table('products');
        $this->displayField('name');
        $this->primaryKey('id');

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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        // $validator
        //     ->add('image', [
        //             'fileSize' => [
        //                     'rule' => [
        //                         'fileSize', '<', '1MB'
        //                     ],
        //                     'message' => 'The image exceeds the maximum size of 1MB'
        //                 ],
        //             'mimeType' => [
        //                 'rule' => [
        //                     'mimeType', ['image/png', 'image/jpeg']
        //                 ],
        //                 'message' => 'Only images are allowed'
        //             ]
        //         ]
        //     );

        return $validator;
    }
}
