<?php

namespace SilverStripe\Registry\Tests\Stub;

use SilverStripe\Dev\TestOnly;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use Silverstripe\Control\Controller;
use SilverStripe\Registry\RegistryDataInterface;
use SilverStripe\Registry\Tests\Stub\RegistryPageTestPage;

class RegistryPageTestContact extends DataObject implements RegistryDataInterface, TestOnly
{
    private static $table_name = 'RegistryPageTestContact';

    private static $use_link = false;

    private static $db = [
        'FirstName' => 'Varchar(50)',
        'Surname' => 'Varchar(50)',
    ];

    private static $summary_fields = [
        'FirstName' => 'First name',
        'Surname' => 'Surname',
    ];

    private static $searchable_fields = [
        'FirstName',
        'Surname'
    ];

    public function getSearchFields()
    {
        return new FieldList(
            new TextField('FirstName', 'First name'),
            new TextField('Surname', 'Surname')
        );
    }

    public function Link($action = null)
    {
        $page = RegistryPageTestPage::get()->filter('DataClass', RegistryPageTestContact::class)->First();
        return Controller::join_links($page->Link(), $action, $this->ID);
    }
}
