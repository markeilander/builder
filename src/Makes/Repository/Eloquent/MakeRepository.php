<?php

namespace  Eilander\Builder\Makes\Repository\Eloquent;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeRepository extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Repository';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.repository');
        $this->stubPath = $this->stub('package', 'Repository/Eloquent/repository.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'Repository '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();
        return 'Repository created successfully.';
    }

    /**
     * Set replacements
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = array_merge(parent::getReplacements(), [
            'model'               => $this->nameParser->getNames('Name'),
            'namespace'           => $this->pathToNamespace('eloquent.repository'),
            'interface_namespace' => $this->pathToNamespace('eloquent.interface'),
            'entity_namespace' => $this->pathToNamespace('eloquent.entity'),
            'presenter_namespace' => $this->pathToNamespace('eloquent.presenter'),
        ]);
        return $this->replacements;
    }
}
