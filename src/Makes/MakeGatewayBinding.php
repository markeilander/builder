<?php

namespace Eilander\Builder\Makes;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeGatewayBinding extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name');
        $this->path = $this->getFile();
        $this->stubPath = $this->path;
        // Set replacement start
        $this->replacementStart = '//{{';
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();
        return 'Binding added successfully';
    }

    /**
     * Set replacements
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = [
            'builder_gateway_binding'=> $this->binding(),
        ];
    }

    protected function binding()
    {
    	return '$this->app->bind("'.$this->pathToNamespace('eloquent.ginterface').'\\'.$this->name.'Gateway", "'.$this->pathToNamespace('eloquent.gateway').'\\'.$this->name.'Gateway");
        //{{builder_gateway_binding}}';
    }

    /**
     * Get root path.
     *
     * @return string
     */
    protected function getFile()
    {
        $path = config($this->configName().'.generator.binding.gateway',
                    app_path().'/Providers/GatewayServiceProvider.php');
        return str_replace('[module]', $this->option('module'), $path);
    }
}