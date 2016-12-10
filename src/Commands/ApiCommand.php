<?php

namespace Eilander\Builder\Commands;

use Eilander\Builder\Makes\Gateway\MakeGateway;
use Eilander\Builder\Makes\Gateway\MakeGatewayInterface;
use Eilander\Builder\Makes\Gateway\MakePresenter;
use Eilander\Builder\Makes\Gateway\MakeTransformer;
use Eilander\Builder\Makes\MakeController;
use Eilander\Builder\Makes\MakeGatewayBinding;
use Eilander\Builder\Makes\MakeRepositoryBinding;
use Eilander\Builder\Makes\MakeRoute;
use Eilander\Builder\Makes\MakeValidation;
use Eilander\Builder\Makes\Providers\MakeGateway as GatewayProvider;
use Eilander\Builder\Makes\Providers\MakeRepository as RepositoryProvider;
use Eilander\Builder\Makes\Repository\Eloquent\MakeEntity;
use Eilander\Builder\Makes\Repository\Eloquent\MakeRepository;
use Eilander\Builder\Makes\Repository\Eloquent\MakeRepositoryInterface;
use Eilander\Generators\Commands\BaseCommand;
use Illuminate\Support\Collection;

class ApiCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'eilander:scaffold
                            {name : The name of the entities (Ex: Respondent)}
                            {--module= : The name of the module (Ex: Respondent)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a full logic scaffolding';

    /**
     * @var Collection
     */
    protected $generators = null;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Start
        $this->info('Configuring '.$this->getNames('Name').' for module '.$this->option('module').'...');
        // ask some questions
        $table = $this->ask('Which database table would you like to use?');
        //$table = 'onderzoek-overzicht';
        // ask some questions
        $type = 'api';
        // fill generators with response
        $this->generators = new Collection();
        $this->generators->push(new MakeEntity([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
            'table'   => $table,
        ]));
        $this->generators->push(new MakeRepositoryInterface([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeRepository([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeController([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
            'type'    => $type,
        ]));
        // Gateway generator
        $this->generators->push(new MakeGateway([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeGatewayInterface([
            'name'         => $this->argument('name'),
            'module'       => $this->option('module'),
        ]));
        $this->generators->push(new MakePresenter([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeTransformer([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeValidation([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeRoute([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
            'type'    => $type,
        ]));
        $this->generators->push(new RepositoryProvider([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new GatewayProvider([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeRepositoryBinding([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        $this->generators->push(new MakeGatewayBinding([
            'name'    => $this->argument('name'),
            'module'  => $this->option('module'),
        ]));
        // Run commands
        foreach ($this->generators as $generator) {
            $this->info($generator->render());
        }
        // Round up
        $this->info('Dump-autoload...');
        $this->composer->dumpAutoloads();
    }
}
