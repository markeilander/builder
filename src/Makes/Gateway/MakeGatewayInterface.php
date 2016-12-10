<?php

namespace Eilander\Builder\Makes\Gateway;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeGatewayInterface extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Gateway';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.ginterface');
        // Get stub pre-fill gateway folder
        $this->stubPath = $this->stub('package', 'Gateway/interface.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'Contract'.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();

        return 'Contract created successfully.';
    }

    /**
     * Set replacements.
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = array_merge(parent::getReplacements(), [
            'namespace'            => $this->pathToNamespace('eloquent.ginterface'),
        ]);

        return $this->replacements;
    }
}
