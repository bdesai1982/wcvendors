<?php

class CapabilitiesGeneralExportOrdersCest
{
    public function _before(AcceptanceTester $I)
    {
		//Customer places an order.
		$I->amOnPage('/');
        $I->see('wcvendors');
		$I->click('My account');
		$I->fillField('#username', 'customer2');
		$I->fillField('#password', 'VBe5L45nFE^3)MW#r*X3p82O');
		$I->click('Log in');
		$I->fillField('#woocommerce-product-search-field-0', 'Var Pro 1');//searching for the product added by vendor.
		$I->pressKey('#woocommerce-product-search-field-0', \Facebook\WebDriver\WebDriverKeys::ENTER);
		$I->wait(5);
		$I->scrollTo('#main > div:nth-child(2) > form > select');//This will require 2 products with same name or simply run the script twice to add the product twice.
		$I->click('Select options');
		$I->waitForText('Var Pro 1', 300);
		$I->scrollTo('#product-547 > div.summary.entry-summary > h1');
		$I->click('#sizes');
		$I->wait(2);
		$I->click('#sizes > option:nth-child(2)');
		$I->click('Add to cart');
		$I->waitForText('has been added to your cart.', 300);
		$I->amOnPage('/cart');
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
		$I->scrollTo('#payment > ul > li.wc_payment_method.payment_method_paypal > label > img'); //Clicking the WC Vendors Test Gateway for payment.
		$I->executeJS('document.querySelector("#payment > ul > li.wc_payment_method.payment_method_wcvendors_test_gateway > label").click()');
		$I->waitForText('This is a test gateway — not to be used on live sites for live transactions. Click here to visit WCVendors.com.', 20);//Make sure that the test gateway is set correct.
		$I->executeJS('document.querySelector("#place_order").click()');
		$I->waitForText('Order received', 300);
		$I->see('Thank you. Your order has been received.');
		$I->scrollTo('#post-8 > div > div > div > ul > li.woocommerce-order-overview__email.email');
		$I->see('automation.customer.one@yopmail.com');
		$I->amOnPage('/my-account');//Navigation to accounts page to log out.
		$I->click('Log out');
    }

    // Making sure that exporting orders is working as per permission set at Admin panel.
    public function tryToTest(AcceptanceTester $I)
    {
		//Vendor views export orders button.
		$I->fillField('#username', 'vendor1');
		$I->fillField('#password', '#*mr4Xk)R2l)W^XuI^P85jP');
		$I->click('Log in');
		$I->click('Vendor Dashboard');
		$I->click('Show');
		$I->waitForText('Show Orders', 30);
		$I->click('Show Orders');
		$I->waitForElement('//*[@name="export_orders"]', 30);
		
		//Admin removing the permission to export orders.
		$I->click('My account');
		$I->click('Log out');
		$I->fillField('#username', 'admin');
		$I->fillField('#password', '123456');
		$I->click('Log in');
		$I->amOnPage('/wp-admin/admin.php?page=wcv-settings&tab=capabilities');
		$I->waitForText('Allow vendors to export their orders to a CSV file', 300);
		$I->executeJS('document.querySelector("#mainform > table:nth-child(12) > tbody > tr:nth-child(2) > td > fieldset > label").click()');
		$I->scrollTo('#mainform > table:nth-child(15) > tbody > tr:nth-child(5) > td > fieldset > label');
		$I->click('Save changes');
		$I->waitForText('Your settings have been saved.', 300);
		$I->amOnPage('/my-account');//Navigation to accounts page to log out.
		$I->click('Log out');
		
		//Vendor logs in to check export order button is no longer made available to them.
		$I->fillField('#username', 'vendor1');
		$I->fillField('#password', '#*mr4Xk)R2l)W^XuI^P85jP');
		$I->click('Log in');
		$I->click('Vendor Dashboard');
		$I->click('Show');
		$I->waitForText('Show Orders', 30);
		$I->click('Show Orders');
		$I->dontSeeElement('//*[@name="export_orders"]', 30);
		
		//Admin settings default permission.
		$I->click('My account');
		$I->click('Log out');
		$I->fillField('#username', 'admin');
		$I->fillField('#password', '123456');
		$I->click('Log in');
		$I->amOnPage('/wp-admin/admin.php?page=wcv-settings&tab=capabilities');
		$I->waitForText('Allow vendors to export their orders to a CSV file', 300);
		$I->executeJS('document.querySelector("#mainform > table:nth-child(12) > tbody > tr:nth-child(2) > td > fieldset > label").click()');
		$I->scrollTo('#mainform > table:nth-child(15) > tbody > tr:nth-child(5) > td > fieldset > label');
		$I->click('Save changes');
		$I->waitForText('Your settings have been saved.', 300);
    }
}
