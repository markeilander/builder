<?php

namespace Eilander\Builder\Makes;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeRepositoryBinding extends RepositoryBase
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
            'builder_repository_binding'=> $this->binding(),
        ];
    }

    protected function binding()
    {
    	return '$this->app->bind("'.$this->pathToNamespace('eloquent.interface').'\\'.$this->name.'Repository", "'.$this->pathToNamespace('eloquent.repository').'\\'.$this->name.'Repository");
        //{{builder_repository_binding}}';
    }

    /**
     * Get root path.
     *
     * @return string
     */
    protected function getFile()
    {
        $path = config($this->configName().'.generator.binding.provider',
                    app_path().'/Providers/RepositoryServiceProvider.php');
        return str_replace('[module]', $this->option('module'), $path);
    }
}