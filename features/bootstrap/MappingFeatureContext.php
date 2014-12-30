<?php

namespace Webit\Shipment\Feature;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Webit\Shipment\Consignment\ConsignmentInterface;
use Webit\Shipment\Serializer\VendorOptionCollectionHandler;
use Webit\Shipment\Vendor\VendorInterface;
use Webit\Shipment\Vendor\VendorOptionCollection;
use Webit\Tools\Serializer\MixedTypeHandler;
use Webit\Tools\Serializer\TypeAliasHandler;

/**
 * Defines application features from the specific context.
 */
class MappingFeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var array
     */
    private $keyMap = array();

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
//        die(var_dump(json_encode(array('dupa'=>array('cycki-1', 'cucki-2')))));
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
            $this->keyMap[$row['key']] = $row['class'];
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
     * @Then I should get valid :arg1 with properties like:
     */
    public function iShouldGetValidWithPropertiesLike($key, TableNode $table)
    {
        \PHPUnit_Framework_Assert::assertInstanceOf($this->keyMap[$key], $this->result);

        $this->checkProperties($this->result, $this->getProperties($table));
    }

    private function getProperties(TableNode $table)
    {
        $properties = array();
        foreach ($table as $row) {
            $properties[$row['property']] = $row['value'];
        }

        return $properties;
    }

    /**
     * @Then Instance should have properties like:
     */
    private function checkProperties($result, $properties)
    {
        foreach ($properties as $property => $expectedValue) {
            $getter = 'get'.ucfirst($property);
            if (! method_exists($result, $getter)) {
                $getter = 'is'.ucfirst($property);
            }

            if (preg_match('/^is/', $getter)) {
                $expectedValue = $expectedValue == 'true' ? true : false;
            }

            $value = $result->{$getter}();
            if ($value instanceof \DateTime) {
                \PHPUnit_Framework_Assert::assertEquals($expectedValue, $value->format('Y-m-d H:i:s'));
            } else {
                \PHPUnit_Framework_Assert::assertEquals($expectedValue, $value);
            }
        }
    }

    /**
     * @Then vendor should have following consignment options:
     */
    public function vendorShouldHaveFollowingConsignmentOptions(TableNode $table)
    {
        /** @var VendorInterface $vendor */
        $vendor = $this->result;
        $this->checkOptions($vendor->getConsignmentOptions(), $table);
    }

    /**
     * @Then vendor should have following parcel options:
     * @param TableNode $table
     */
    public function vendorShouldHaveFollowingParcelOptions(TableNode $table)
    {
        /** @var VendorInterface $vendor */
        $vendor = $this->result;
        $this->checkOptions($vendor->getParcelOptions(), $table);
    }

    private function checkOptions(VendorOptionCollection $collection, TableNode $table) {
        \PHPUnit_Framework_Assert::assertInstanceOf('Webit\Shipment\Vendor\VendorOptionCollection', $collection);
        foreach ($table as $row) {
            $option = $collection->getOption($row['code']);
            \PHPUnit_Framework_Assert::assertNotNull($option);
            $properties = array(
                'code' => $row['code'],
                'name' => $row['name'],
                'description' => $row['description'],
                'allowedValues' => new ArrayCollection(explode(',',$row['allowedValues']))
            );

            $this->checkProperties($option, $properties);
        }
    }

    /**
     * @Then vendor should have following :arg1 print modes:
     */
    public function vendorShouldHaveFollowingPrintModes($printType, TableNode $table)
    {
        /** @var VendorInterface $result */
        $result = $this->result;
        $modes = null;
        switch($printType) {
            case 'label':
                $modes = $result->getLabelPrintModes();
                break;
            case 'dispatch_confirmation':
                $modes = $result->getDispatchConfirmationPrintModes();
                break;
            default:
                throw new \UnexpectedValueException('Unsupported print type: '.$printType);
        }

        $expectedModes = new ArrayCollection();
        foreach ($table as $row) {
            $expectedModes->add($row['mode']);
        }

        \PHPUnit_Framework_Assert::assertEquals($expectedModes, $modes);
    }

    /**
     * @Then consignment should have :arg1 like:
     */
    public function consignmentShouldHaveLike($type, TableNode $table)
    {
        switch ($type) {
            case 'sender_address':
                $this->checkProperties($this->result->getSenderAddress(), $this->getProperties($table));
                break;
            case 'delivery_address':
                $this->checkProperties($this->result->getDeliveryAddress(), $this->getProperties($table));
                break;
            case 'parcels':
                $this->checkParcels($this->result, $table);
                break;
            case 'vendor_options':
                $this->checkVendorOptions($this->result, $table);
                break;
            default:
                throw new \UnexpectedValueException('Unsupported type: '. $type);
        }

    }

    private function checkParcels(ConsignmentInterface $consignment, TableNode $table)
    {
        $parcels = $consignment->getParcels();
        foreach ($table as $key => $parcel) {
            $currentParcel = $parcels->get($key);
            \PHPUnit_Framework_Assert::assertNotNull($currentParcel);
            $this->checkProperties($currentParcel, $parcel);
        }
    }

    private function checkVendorOptions(ConsignmentInterface $consignmentInterface, TableNode $table)
    {
        $options = $consignmentInterface->getVendorOptions();
        foreach ($table as $key => $properties) {
            $option = $options->getValue($properties['optionCode']);
            if ($properties['value'] == 'true') {
                $properties['value'] = true;
            }

            if (preg_match('/,/', $properties['value'])) {
                $properties['value'] = explode(',', $properties['value']);
            }
            $this->checkProperties($option, $properties);
        }
    }
}
