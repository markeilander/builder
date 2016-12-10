<?php

namespace  Eilander\Builder\Makes\Gateway;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeTransformer extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Transformer';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.transformer');
        $this->stubPath = $this->stub('package', 'Gateway/transformer.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'Transformer '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();

        return 'Transformer created successfully.';
    }

    /**
     * Set replacements.
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = array_merge(parent::getReplacements(), [
            'model'            => $this->nameParser->getNames('Name'),
            'namespace'        => $this->pathToNamespace('eloquent.transformer'),
            'entity_namespace' => $this->pathToNamespace('eloquent.entity'),
        ]);

        return $this->replacements;
    }
}
