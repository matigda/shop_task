<?php
declare(strict_types = 1);

use Behat\Mink\Driver\BrowserKitDriver;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ApplicationContext extends MinkContext
{
    use KernelDictionary;

    /**
     * @BeforeScenario
     */
    public function setUp()
    {
        $driver = $this->getSession()->getDriver();
        $client = $driver->getClient();

        $client->disableReboot();
    }

    /**
     * @Then message should be put on a queue
     */
    public function eventShouldBeProduced()
    {
        $producer = $this->getContainer()->get('old_sound_rabbit_mq.product_producer');

        if (empty($producer->getMessages()) || $producer->getMessages()[0]['routingKey'] !== 'product.added') {
            throw new Exception('Message is not added to rabbit.');
        }
    }


    /**
     * @Given /^I am authenticated as "([^"]*)"$/
     */
    public function iAmAuthenticatedAs($username)
    {
        $driver = $this->getSession()->getDriver();
        if (!$driver instanceof BrowserKitDriver) {
            throw new UnsupportedDriverActionException('This step is only supported by the BrowserKitDriver', $driver);
        }

        $client = $driver->getClient();
        $client->getCookieJar()->set(new Cookie(session_name(), true));

        $session = $client->getContainer()->get('session');

        $user = $username;
        $providerKey = 'admin';

        $token = new UsernamePasswordToken($user, null, $providerKey, ['ROLE_USER']);
        $session->set('_security_'.$providerKey, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }
}
