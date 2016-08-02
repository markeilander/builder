<?php

namespace Eilander\Builder\Makes\Providers;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeRepository extends RepositoryBase
{
    public function render()
    {
        $this->name = 'RepositoryServiceProvider';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.providers');
        // Get stub pre-fill gateway folder
        $this->stubPath = $this->stub('package', 'Providers/repository.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'RepositoryServiceProvider already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();
        return 'RepositoryServiceProvider created successfully.';
    }

    /**
     * Set replacements
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = array_merge(parent::getReplacements(), [
            'namespace'            => $this->pathToNamespace('eloquent.providers'),
        ]);
        return $this->replacements;
    }
}
