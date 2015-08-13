<?php

namespace Engineor\Flysystem\Adapter\Factory;

use BsbFlysystem\Exception\RequirementsException;
use Engineor\Flysystem\RunaboveAdapter as Adapter;
use Engineor\Flysystem\Runabove;
use UnexpectedValueException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BsbFlysystem\Adapter\Factory\AbstractAdapterFactory;

class RunaboveAdapterFactory extends AbstractAdapterFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     */
    public function doCreateService(ServiceLocatorInterface $serviceLocator)
    {
        if (!class_exists('Engineor\Flysystem\RunaboveAdapter')) {
            throw new RequirementsException(
                ['engineor/flysystem-runabove'],
                'AwsS3'
            );
        }

        $client = new Runabove([
            'username'  => $this->options['username'],
            'password'  => $this->options['password'],
            'tenantId'  => $this->options['tenantId'],
            'container' => $this->options['container'],
            'region'    => $this->options['region'],
        ]);

        return new Adapter($client->getContainer(), $this->options['prefix']);
    }

    /**
     * @inheritdoc
     */
    protected function validateConfig()
    {
        if (!isset($this->options['username'])) {
            throw new UnexpectedValueException("Missing 'username' as option");
        }

        if (!isset($this->options['password'])) {
            throw new UnexpectedValueException("Missing 'password' as option");
        }

        if (!isset($this->options['tenantId'])) {
            throw new UnexpectedValueException("Missing 'tenantId' as option");
        }

        if (!isset($this->options['container'])) {
            throw new UnexpectedValueException("Missing 'container' as option");
        }

        if (!isset($this->options['region'])) {
            $this->options['region'] = Runabove::REGION_EUROPE;
        }

        if (!isset($this->options['prefix'])) {
            $this->options['prefix'] = null;
        }
    }
}
