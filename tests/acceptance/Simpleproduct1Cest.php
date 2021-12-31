<?php

class Simpleproduct1Cest
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
    $I->fillField('#post_title','Simple Product 1');
    $I->fillField('#post_content','Simple Product description');
    $I->fillField('#post_excerpt','Simple Product  Short description');
    $I->wait(5);
    $I->scrollTo('.wcv-product-basic > div:nth-child(5) > div:nth-child(2) > span:nth-child(2) > span:nth-child(1) > span:nth-child(1) > ul:nth-child(1) > li:nth-child(1) > input:nth-child(1)');
    $I->wait(5);
    $I->click('#select2-product-type-container');
    $I->wait(5);
    $I->fillField('span.select2-search > input:nth-child(1)', 'Simple product');//searching for the product added by vendor.
    $I->wait(5); 
    $I->pressKey('span.select2-search > input:nth-child(1)', \Facebook\WebDriver\WebDriverKeys::ENTER);
    $I->wait(3);
    $I->fillField('#_sku','123sku');
    $I->wait(5);
    $I->fillField('#_regular_price','100'); 
    $I->click('#product_save_button');
    $I->see('Product Added.');
    $I->amOnPage('/my-account');//Navigation to accounts page to log out.
    $I->click('Log out'); 
    $I->fillField('#username', 'customer1');
    $I->fillField('#password', 'dM^gc87RPE&Osuj(EKPY)X8(');
    $I->click('Log in');
    $I->fillField('#woocommerce-product-search-field-0', 'Simple Product 1');//searching for the product.
    $I->pressKey('#woocommerce-product-search-field-0', \Facebook\WebDriver\WebDriverKeys::ENTER);//Was difficult to find the exact syntax to pass enter key lol.
    $I->wait(5);
    $I->scrollTo('#main > div:nth-child(2) > form > select');//This will require 2 products with same name or simply run the script twice to add the product twice.
    $I->click('Add to cart');
    $I->wait(10);
    $I->amOnPage('/cart');//Change in URL was the only option left
    $I->click('Proceed to checkout');
    $I->scrollTo('#billing_first_name');
    $I->fillField('#billing_first_name', 'Customer');
    $I->fillField('#billing_last_name', 'Automated One');
    $I->scrollTo('#billing_address_1');
    $I->fillField('#billing_address_1', 'sample billing address line');
    $I->scrollTo('#billing_city');
    $I->fillField('#billing_city', 'Nadiad');
    $I->scrollTo('#billing_postcode');
    $I->fillField('#billing_postcode', '387002');
    $I->scrollTo('#billing_phone');
    $I->fillField('#billing_phone', '1234567890');
    $I->scrollTo('#billing_email');
    $I->fillField('#billing_email', 'automation.customer.one@yopmail.com');
    $I->wait(5);
    $I->scrollTo('#payment > ul > li.wc_payment_method.payment_method_wcvendors_test_gateway > label'); //Clicking the WC Vendors Test Gateway for payment.
    $I->executeJS('document.querySelector("#payment > ul > li.wc_payment_method.payment_method_wcvendors_test_gateway > label").click()');
    $I->waitForText('This is a test gateway — not to be used on live sites for live transactions. Click here to visit WCVendors.com.', 20);//Make sure that the test gateway is set correct.
    $I->executeJS('document.querySelector("#place_order").click()');
    $I->waitForText('Order received', 300);
    $I->see('Thank you. Your order has been received.');
    $I->scrollTo('#post-8 > div > div > div > ul > li.woocommerce-order-overview__email.email');
    $I->see('automation.customer.one@yopmail.com');
    $I->amOnPage('/my-account');//Navigation to accounts page to log out.
    $I->click('Log out');
      //Product purchased by the customer
      //Loggin in as Admin to complete the purchase.
      //$I->amOnPage('/my-account');//Navigation to accounts page to log out.
      $I->fillField('#username', 'admin');
      $I->fillField('#password', '123456');
      $I->click('Log in');
      $I->amOnPage('/wp-admin');
      $I->executeJS('document.querySelector("#toplevel_page_woocommerce > a > div.wp-menu-name").click()');
      $I->executeJS('document.querySelector("#toplevel_page_woocommerce > ul > li:nth-child(3) > a").click()');
      $I->fillField('#post-search-input', 'Simple Product 1');//searching for the product.
      $I->pressKey('#post-search-input', \Facebook\WebDriver\WebDriverKeys::ENTER);
      $I->wait(3);
      $I->click('//*[@name="post[]"][1]');//Clicking the first order that is visible after searching for the product.
      $I->click('#bulk-action-selector-top');
      $I->wait(2);
      $I->click('#bulk-action-selector-top > option:nth-child(6)');
      $I->wait(2);
      $I->executeJS('document.querySelector("#doaction").click()');
      $I->waitForText('order status changed.', 300);
      $I->amOnPage('/my-account');
      $I->click('Log out');//Admin login out 
     
    }
}