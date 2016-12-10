<?php

namespace Eilander\Builder\Makes\Repository;

use Eilander\Generators\Makes\BaseMake;
use Eilander\Generators\Migrations\SyntaxBuilder;
use Eilander\Generators\Traits\BuilderTrait;

class RepositoryBase extends BaseMake
{
    use BuilderTrait;

    public function configName()
    {
        return 'builder';
    }

    /**
     * Get the path to where we should store the files.
     *
     * @param $file_name
     * @param string $config
     *
     * @return string
     */
    protected function destinationPath($file_name, $config)
    {
        $path = $this->getBasePath().'/'.$this->getRootPath().'/'.$this->configPath($config).$file_name.'.php';

        return str_replace('[module]', $this->option('module'), $path);
    }

    /**
     * Get the path to where we should store the files.
     *
     * @param string $config
     *
     * @return string
     */
    protected function configPath($config)
    {
        return config($this->configName().'.generator.'.$config);
    }

    /**
     * Get the path to where we should store the files.
     *
     * @param string $config
     *
     * @return string
     */
    protected function pathToNamespace($config)
    {
        $path = $this->getRootNamespace().'/'.$this->configPath($config);
        $namespace = rtrim(str_replace(DIRECTORY_SEPARATOR, '\\', $path), '/\\');

        return str_replace('[module]', $this->option('module'), $namespace);
    }

    protected function buildSyntax($type)
    {
        $syntaxBuilder = new SyntaxBuilder();

        return $syntaxBuilder->create($this->getSchema(), $this->option('meta'), $type);
    }

    /**
     * Get correct package path for stubs eo.
     */
    protected function getPackagePath()
    {
        return realpath(__DIR__.'/../../');
    }
}
