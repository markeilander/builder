<?php

namespace Eilander\Builder\Makes;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeRoute extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name');
        $this->path = $this->getRouteFile();
        $this->stubPath = $this->path;
        // Set replacement start
        $this->replacementStart = '//{{';
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();

        return 'Route added successfully';
    }

    /**
     * Set replacements.
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = [
            'builder_'.$this->option('type').'_routes'=> $this->route(),
        ];
    }

    protected function route()
    {
        return "Route::resource('".strtolower($this->name)."', '".ucfirst($this->name)."Controller');
//{{builder_".$this->option('type').'_routes}}';
    }

    /**
     * Get root path.
     *
     * @return string
     */
    protected function getRouteFile()
    {
        $path = config($this->configName().'.generator.route', app_path().'/Http/routes.php');

        return str_replace('[module]', $this->option('module'), $path);
    }
}
