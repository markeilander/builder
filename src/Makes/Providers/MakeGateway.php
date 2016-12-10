<?php

namespace Eilander\Builder\Makes\Providers;

use Eilander\Builder\Makes\Repository\RepositoryBase;

class MakeGateway extends RepositoryBase
{
    public function render()
    {
        $this->name = 'GatewayServiceProvider';
        // Zet paden
        $this->path = $this->destinationPath($this->name, 'eloquent.providers');
        // Get stub pre-fill gateway folder
        $this->stubPath = $this->stub('package', 'Providers/gateway.stub');
        // Bestaat het bestand al?
        if ($this->exists()) {
            return 'GatewayServiceProvider already exists!';
        }
        // Maak replacements
        $this->getReplacements();
        // Genereer bestand
        $this->run();

        return 'GatewayServiceProvider created successfully.';
    }

    /**
     * Set replacements.
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
