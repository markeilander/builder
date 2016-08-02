<?php

namespace Eilander\Builder\Makes;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeValidation extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Validator';
        $this->path = $this->destinationPath($this->name, 'eloquent.validation');
        $this->stubPath = $this->stub('package', 'Validation/validator.stub');

        // Bestaat het bestand al?
        if ($this->exists()) {
          return 'Validator '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();
        return 'Validator created successfully';
    }

    /**
     * Set replacements
     *
     * @return string
     */
    protected function getReplacements()
    {
        $this->replacements = array_merge(parent::getReplacements(), [
            'model'             => $this->nameParser->getNames('Name'),
            'namespace'         => $this->pathToNamespace('eloquent.validation'),
        ]);
        return $this->replacements;
    }
}