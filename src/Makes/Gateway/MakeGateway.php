<?php

namespace Eilander\Builder\Makes\Gateway;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeGateway extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Gateway';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.gateway');
        // Get stub pre-fill gateway folder
        $this->stubPath = $this->stub('package', 'Gateway/eloquent.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'Gateway '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();
        return 'Gateway created successfully.';
    }

    /**
     * Set replacements
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = array_merge(parent::getReplacements(), [
            'model'                => $this->nameParser->getNames('Name'),
            'namespace'            => $this->pathToNamespace('eloquent.gateway'),
            'interface_namespace'  => $this->pathToNamespace('eloquent.interface'),
            'ginterface_namespace' => $this->pathToNamespace('eloquent.ginterface'),
            'validation_namespace' => $this->pathToNamespace('eloquent.validation'),
            'presenter_namespace'  => $this->pathToNamespace('eloquent.presenter'),
        ]);
        return $this->replacements;
    }
}
