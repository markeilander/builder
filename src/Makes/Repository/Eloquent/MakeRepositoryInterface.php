<?php

namespace  Eilander\Builder\Makes\Repository\Eloquent;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeRepositoryInterface extends RepositoryBase
{

    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Repository';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.interface');
        $this->stubPath = $this->stub('package', 'Repository/repository-contract.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'Contract '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();
        return 'Contract created successfully.';
    }

    /**
     * Set replacements
     *
     * @return string
     */
    protected function getReplacements()
    {
        $schema = $this->buildSyntax('model');

        $this->replacements = array_merge(parent::getReplacements(), [
            'namespace' => $this->pathToNamespace('eloquent.interface'),
        ]);
        return $this->replacements;
    }
}
