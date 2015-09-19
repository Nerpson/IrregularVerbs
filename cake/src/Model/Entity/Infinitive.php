<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Infinitive Entity.
 *
 * @property int $id
 * @property string $value
 * @property \App\Model\Entity\PastParticiple[] $past_participles
 * @property \App\Model\Entity\Preterit[] $preterits
 * @property \App\Model\Entity\Translation[] $translations
 * @property \App\Model\Entity\Set[] $sets
 */
class Infinitive extends Entity
{

}
