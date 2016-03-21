Feature: Serializer model mapping
  In order to use JMS Serializer
  As a developer
  I want to serialize / deserialize model with JMS Serializer

  Background:
    Given there is following serializer mapping:
      | key                   | interface                                                | class                                           |
      | delivery_address      | Webit\Shipment\Address\DeliveryAddressInterface          | Webit\Shipment\Feature\Model\DeliveryAddress    |
      | sender_address        | Webit\Shipment\Address\SenderAddressInterface            | Webit\Shipment\Feature\Model\SenderAddress      |
      | consignment           | Webit\Shipment\Consignment\ConsignmentInterface          | Webit\Shipment\Consignment\Consignment          |
      | dispatch_confirmation | Webit\Shipment\Consignment\DispatchConfirmationInterface | Webit\Shipment\Consignment\DispatchConfirmation |
      | parcel                | Webit\Shipment\Parcel\ParcelInterface                    | Webit\Shipment\Parcel\Parcel                    |
      | vendor                | Webit\Shipment\Vendor\VendorInterface                    | Webit\Shipment\Vendor\Vendor                    |

  Scenario: DeliveryAddress Mapping
    Given json representation like:
    """
    {"name":"My name","address":"21 Street","post":"Post","post_code":"32-022","contact_person":"Person",
    "contact_phone_no":"43313434333","contact_email":"mail@domain.com"}
    """
    When I deserialize it to "Webit\Shipment\Address\DeliveryAddressInterface"
    Then I should get valid "delivery_address" with properties like:
      | property       | value           |
      | name           | My name         |
      | address        | 21 Street       |
      | post           | Post            |
      | postCode       | 32-022          |
      | contactPerson  | Person          |
      | contactPhoneNo | 43313434333     |
      | contactEmail   | mail@domain.com |

  Scenario: SenderAddress Mapping
    Given json representation like:
    """
    {"name":"My name","address":"21 Street","post":"Post","post_code":"32-022"}
    """
    When I deserialize it to "Webit\Shipment\Address\SenderAddressInterface"
    Then I should get valid "sender_address" with properties like:
      | property       | value           |
      | name           | My name         |
      | address        | 21 Street       |
      | post           | Post            |
      | postCode       | 32-022          |

  Scenario: DispatchConfirmation Mapping
    Given json representation like:
    """
    {"number":"23454454","dispatched_at":"2014-04-23 23:33:22"}
    """
    When I deserialize it to "Webit\Shipment\Consignment\DispatchConfirmationInterface"
    Then I should get valid "dispatch_confirmation" with properties like:
      | property     | value               |
      | number       | 23454454            |
      | dispatchedAt |                     |

  Scenario: Parcel Mapping
    Given json representation like:
    """
    {"number":"23454454","weight":"0.22","reference": "#2322222"}
    """
    When I deserialize it to "Webit\Shipment\Parcel\ParcelInterface"
    Then I should get valid "parcel" with properties like:
      | property     | value    |
      | number       | 23454454 |
      | weight       | 0.22     |
      | reference    | #2322222 |

  Scenario: Vendor Mapping
    Given json representation like:
    """
    {"code":"test-code","name":"Test Vendor","description":"Test Vendor Desc","active":true,
    "consignment_options":[{"code":"option-1","name":"Option 1","description":"Option 1 Desc","allowed_values":["value-1","value-2"]}],
    "parcel_options":[{"code":"parcel-option-1","name":"Option 1","description":"Option 1 Desc","allowed_values":["value-1","value-2"]}],
    "label_print_modes":["l-mode-1","l-mode-2"],"dispatch_confirmation_print_modes":["dc-mode-1","dc-mode-2"]}
    """
    When I deserialize it to "Webit\Shipment\Vendor\VendorInterface"
    Then I should get valid "vendor" with properties like:
      | property    | value            |
      | code        | test-code        |
      | name        | Test Vendor      |
      | description | Test Vendor Desc |
      | active      | true             |
    And vendor should have following consignment options:
      | code     | name     | description   | allowedValues   |
      | option-1 | Option 1 | Option 1 Desc | value-1,value-2 |
    And vendor should have following parcel options:
      | code            | name     | description   | allowedValues   |
      | parcel-option-1 | Option 1 | Option 1 Desc | value-1,value-2 |
    And vendor should have following "label" print modes:
      | mode     |
      | l-mode-1 |
      | l-mode-2 |
    And vendor should have following "dispatch_confirmation" print modes:
      | mode      |
      | dc-mode-1 |
      | dc-mode-2 |
  Scenario: Consignment Mapping
    Given json representation like:
    """
    {"id":"123","vendor":{"code":"vendor_code"},
    "delivery_address":{"name":"Address Name","address":"Address"},
    "vendor_options":{
    "option-1":true,
    "option-2":"value2",
    "option-3":["val-1","val-2"]
    },
    "sender_address":{"name":"SenderAddress Name","address":"SenderAddress"},
    "anonymous":true,
    "reference":"reference number",
    "parcels":[{"reference":"parcel-1","weight":0.22},{"reference":"parcel-2","weight":0.88}]
    }
    """
    When I deserialize it to "Webit\Shipment\Consignment\ConsignmentInterface"
    Then I should get valid "consignment" with properties like:
      | property    | value            |
      | id          | 123              |
      | anonymous   | true             |
      | reference   | reference number |
    And consignment should have "delivery_address" like:
      | property    | value            |
      | name        | Address Name     |
      | address     | Address          |
    And consignment should have "sender_address" like:
      | property    | value              |
      | name        | SenderAddress Name |
      | address     | SenderAddress      |
    And consignment should have "parcels" like:
      | reference    | weight |
      | parcel-1     | 0.22   |
      | parcel-2     | 0.88   |
    And consignment should have "vendor_options" like:
      | optionCode | value       |
      | option-1   | true        |
      | option-2   | value2      |
      | option-3   | val-1,val-2 |