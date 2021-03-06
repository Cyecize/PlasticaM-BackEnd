<?php


namespace App\Service;


use App\Constants\Config;
use App\Utils\YamlParser;
use App\ViewModel\ContactsViewModel;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContactInfoServiceImpl implements ContactInfoService
{
    private const FILE_PATH = "/config/_contacts.yml";

    private $settings;

    private $parameterBag;

    public function __construct(ParameterBagInterface  $parameterBag)
    {
        $this->parameterBag = $parameterBag;
        $this->settings = YamlParser::getFile($this->getFileName());
    }

    public function getContacts(): ContactsViewModel
    {
        return new ContactsViewModel($this->settings['contacts']);
    }

    private function getFileName() : string {
        return $this->parameterBag->get(Config::KERNEL_PROJECT_DIR) . self::FILE_PATH;
    }
}