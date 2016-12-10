<?php

namespace Eilander\Builder\Makes\Repository\Eloquent;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeEntity extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name');

        $this->path = $this->destinationPath($this->name, 'eloquent.entity');
        $this->stubPath = $this->stub('package', 'Repository/Eloquent/entity.stub');

        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'Model '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();

        return 'Model created successfully';
    }

    /**
     * Set replacements.
     *
     * @return string
     */
    protected function getReplacements()
    {
        $schema = $this->buildSyntax('model');

        $this->replacements = array_merge(parent::getReplacements(), [
            'namespace' => $this->pathToNamespace('eloquent.entity'),
            'fillables' => $schema,
        ]);

        return $this->replacements;
    }
}
