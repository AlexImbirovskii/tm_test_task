<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class HomepageCest
{
    public function testHomepageLayout(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('Simple test system');
        $I->seeElement('input[type=checkbox]');
        $I->seeElement('button[type=submit]');
    }

    public function testHomepageValidation(AcceptanceTester $I): void
    {
        $I->amOnPage('/');

        $I->checkOption('input[type=checkbox]');
        $I->click('Submit Test');
        $I->see('Select at least one option.');
    }

    /**
     * @cleanup
     */
    public function testFormSubmit(AcceptanceTester $I): void
    {
        $I->amOnPage('/');

        $checkboxes = $I->grabMultiple('input[type=checkbox]', 'name');

        foreach ($checkboxes as $checkboxName) {
            $I->checkOption("input[name=\"$checkboxName\"]");
            $I->seeCheckboxIsChecked("input[name=\"$checkboxName\"]");
        }

        $I->click('Submit Test');
        $I->see('Your Result');
        $I->see('Answers');
    }

    public function testRoutingButtons(AcceptanceTester $I): void
    {
        $I->amOnPage('/results');
        $I->click('Back to Test');

        $I->seeCurrentUrlEquals('/');

        $I->click('Results');

        $I->seeCurrentUrlEquals('/results');
    }
}
