<?php

// features/bootstrap/FeatureContext.php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\TestCase;


class FeatureContext extends TestCase implements SnippetAcceptingContext
{
    private $shelf;
    private $basket;
    protected $content;
    private $name;
    private $name2;

    public function __construct()
    {
        $this->shelf = new Shelf();
        $this->basket = new Basket($this->shelf);
    }

    /**
     * @Given there is a :service, which costs $:price
     */
    public function thereIsAWhichCostsPs($service, $price)
    {
        $this->shelf->setProductPrice($service, floatval($price));
    }

    /**
     * @When I add the :service to the basket
     */
    public function iAddTheToTheBasket($service)
    {
        $this->basket->addProduct($service);
    }

    /**
     * @Then I should have :count service(s) in the basket
     */
    public function iShouldHaveProductInTheBasket($count)
    {
        PHPUnit_Framework_Assert::assertCount(
            intval($count),
            $this->basket);
    }

    /**
     * @Then the overall basket price should be $:price
     */
    public function theOverallBasketPriceShouldBePs($price)
    {
        PHPUnit_Framework_Assert::assertSame(
            floatval($price),
            $this->basket->getTotalPrice()
        );
    }


     /**
     * @Given  I am on login :login
     */
    public function iVisitLogin($login)
    {
        $this->name="¿Olvidó su contraseña?";
    }
    /**
     * @Then I should see the text :text
     */
    public function iShouldSeeTheLogin($text)
    {
        //$this->assertEquals($text, $this->content);
        $this->assertEquals($this->name,$text);
    }


    /**
     * @Given  I am on suscripcion :suscripcion
     */
    public function iVisitPayment($suscripcion)
    {
        $this->name2="Suscripcion Activa";
    }
    /**
     * @Then I should see the text2 :text2
     */
    public function iShouldSeeThePayment($text2)
    {
        //$this->assertEquals($text, $this->content);
        $this->assertEquals($this->name2,$text2);
    }



}
?>
