<?php


namespace App\Utils;

use App\Exception\ApiException;
use Symfony\Component\Yaml\Yaml;

class YamlParser
{

    public static function getFile(string $path = null): array
    {
        if ($path == null) {
            throw new ApiException("Path cannot be null!");
        }

        return Yaml::parse(file_get_contents($path));
    }

    public static function saveFile(array $params, string $path): void
    {
        $yamlFile = YAML::dump($params);
        file_put_contents($path, $yamlFile);
    }
}

