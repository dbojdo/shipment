<?php

namespace Webit\Shipment\Feature;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Webit\Shipment\Serializer\VendorOptionCollectionHandler;
use Webit\Tools\Serializer\MixedTypeHandler;
use Webit\Tools\Serializer\TypeAliasHandler;

/**
 * Defines application features from the specific context.
 */
class MappingFeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $json;

    /**
     * @var mixed
     */
    private $result;

    /**
     * @Given there is following serializer mapping:
     */
    public function thereIsFollowingSerializerMapping(TableNode $table)
    {
        AnnotationRegistry::registerAutoloadNamespace('JMS\\Serializer\\Annotation\\', __DIR__.'/../../vendor/jms/serializer/src');

        $builder = SerializerBuilder::create();
        $builder->addMetadataDir(__DIR__.'/../../src/Resources/serializer', 'Webit\Shipment');
        $builder->addDefaultHandlers();
        $builder->configureHandlers(function (HandlerRegistryInterface $handlerRegistry) {
            $handler = new VendorOptionCollectionHandler();
            $methods = VendorOptionCollectionHandler::getSubscribingMethods();
            foreach ($methods as $method) {
                $handlerRegistry->registerHandler($method['direction'], $method['type'], $method['format'], array($handler, $method['method']));
            }
        });


        $map = array();
        foreach ($table as $row) {
            $map[$row['interface']] = $row['class'];
        }

        $builder->configureHandlers(function (HandlerRegistryInterface $handlerRegistry) use ($map) {
            $handler = new TypeAliasHandler($map);
            $methods = TypeAliasHandler::getSubscribingMethods();
            foreach ($methods as $method) {
                $handlerRegistry->registerHandler($method['direction'], $method['type'], $method['format'], array($handler, $method['method']));
            }
        });

        $builder->configureHandlers(function (HandlerRegistryInterface $handlerRegistry) use ($map) {
            $handler = new MixedTypeHandler();
            $methods = MixedTypeHandler::getSubscribingMethods();
            foreach ($methods as $method) {
                $handlerRegistry->registerHandler($method['direction'], $method['type'], $method['format'], array($handler, $method['method']));
            }
        });

        $this->serializer = $builder->build();
    }

    /**
     * @Given json representation like:
     */
    public function jsonRepresentationLike(PyStringNode $string)
    {
        $this->json = $string->getRaw();
    }

    /**
     * @When I deserialize it to :arg1
     * @param $type
     */
    public function iDeserializeItTo($type)
    {
        $this->result = $this->serializer->deserialize($this->json, $type, 'json');
    }

    /**
     * @Then I should get instance of :arg1
     */
    public function iShouldGetInstanceOf($type)
    {
        \PHPUnit_Framework_Assert::assertInstanceOf($type, $this->result);
    }

    /**
     * @Then Instance should have properties like:
     */
    public function instanceShouldHavePropertiesLike(TableNode $table)
    {
        foreach ($table as $row) {
            $getter = 'get'.ucfirst($row['property']);
            $value = $this->result->{$getter}();

            if ($value instanceof \DateTime) {
                \PHPUnit_Framework_Assert::assertEquals($row['value'], $value->format('Y-m-d H:i:s'));
            } else {
                \PHPUnit_Framework_Assert::assertEquals($row['value'], $value);
            }
        }
    }
}
