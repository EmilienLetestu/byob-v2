<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 10:03
 */

namespace App\Tests\Helper;


use App\Helper\IdentifierHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class IdentifierHelperTest
 * @package App\Tests\Helper
 */
class IdentifierHelperTest extends TestCase
{
    public function testIdentifierHelper()
    {
        $helper = new IdentifierHelper();

        $token    = $helper->generateToken(20);
        $password = $helper->generateTempPassword(8);

        $dateInTreeDay = date('Y-m-d', strtotime(' + 3 days'));
        $expiresOn = explode('_', $token);

        $this->assertEquals($dateInTreeDay, $expiresOn[0]);
        $this->assertInternalType('string', $password);
    }
}