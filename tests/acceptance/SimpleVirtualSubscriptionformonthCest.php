<?php

class SimpleVirtualSubscriptionformonthCest
{
  public function _before(AcceptanceTester $I)
  {
      $I->amOnPage('/');
      $I->see('wcvendors');
      $I->click('My account');
      $I->fillField('#username', 'vendor2');
      $I->fillField('#password', '1IZ)h7%J9wQNG@AUqE43y2%c');
      $I->click('button.woocommerce-button:nth-child(4)');
      $I->see('Hello Vendor');
    }


  public function frontpageWorks(AcceptanceTester $I)
  {
    $I->click('Pro Dashboard');
    $I->click('Add product');
    $I->fillField('#post_title','Simple Virtual Subscription for month');
    $I->fillField('#post_content','Simple Product description');
    $I->fillField('#post_excerpt','Simple Product  Short description');
    $I->wait(5);
    $I->scrollTo('.wcv-product-basic > div:nth-child(5) > div:nth-child(2) > span:nth-child(2) > span:nth-child(1) > span:nth-child(1) > ul:nth-child(1) > li:nth-child(1) > input:nth-child(1)');
    $I->wait(5);
    $I->click('#select2-product-type-container');
    $I->fillField('span.select2-search > input:nth-child(1)', 'Simple subscription');//searching for the product added by vendor.
    $I->wait(5); 
    $I->pressKey('span.select2-search > input:nth-child(1)', \Facebook\WebDriver\WebDriverKeys::ENTER);
    $I->wait(3);
    $I->click('#_virtual');
    $I->fillField('#_sku','123sku');
    $I->wait(5);
    $I->amOnPage('/my-account');//Navigation to accounts page to log out.
    $I->click('Log out');
       
    }
}