<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InfinitivesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InfinitivesTable Test Case
 */
class InfinitivesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.infinitives',
        'app.past_participles',
        'app.preterits',
        'app.translations',
        'app.sets',
        'app.infinitives_sets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Infinitives') ? [] : ['className' => 'App\Model\Table\InfinitivesTable'];
        $this->Infinitives = TableRegistry::get('Infinitives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Infinitives);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
