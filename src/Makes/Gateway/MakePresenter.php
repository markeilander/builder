<?php

namespace  Eilander\Builder\Makes\Gateway;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakePresenter extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Presenter';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.presenter');
        $this->stubPath = $this->stub('package', 'Gateway/presenter.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'Presenter '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();

        return 'Presenter created successfully.';
    }

    /**
     * Set replacements.
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = array_merge(parent::getReplacements(), [
            'model'                 => $this->nameParser->getNames('Name'),
            'namespace'             => $this->pathToNamespace('eloquent.presenter'),
            'transformer_namespace' => $this->pathToNamespace('eloquent.transformer'),
        ]);

        return $this->replacements;
    }
}
