<?php

namespace Eilander\Builder\Makes;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeController extends RepositoryBase
{
    public function render()
    {
        $this->name = $this->nameParser->getNames('Name').'Controller';
        $this->path = $this->destinationPath($this->name, 'controller.'.$this->option('type'));
        $this->stubPath = $this->stub('package', 'Controller/'.$this->option('type').'.stub');

        // Bestaat het bestand al?
        if ($this->exists()) {
          return 'Controller '.$this->name.' already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();
        return 'Controller created successfully';
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
            'model_lower'          => $this->nameParser->getNames('name'),
            'namespace'            => $this->pathToNamespace('controller.'.$this->option('type')),
            'ginterface_namespace' => $this->pathToNamespace('eloquent.ginterface'),
        ]);
        return $this->replacements;
    }
}