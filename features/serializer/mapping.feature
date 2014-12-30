Feature: Serializer model mapping
  In order to use JMS Serializer
  As a developer
  I want to serialize / deserialize model with JMS Serializer

  Background:
    Given there is following serializer mapping:
      | interface                                                | class                                           |
      | Webit\Shipment\Address\DeliveryAddressInterface          | Webit\Shipment\Feature\Model\DeliveryAddress    |
      | Webit\Shipment\Address\SenderAddressInterface            | Webit\Shipment\Feature\Model\SenderAddress      |
      | Webit\Shipment\Consignment\DispatchConfirmationInterface | Webit\Shipment\Consignment\DispatchConfirmation |
      | Webit\Shipment\Parcel\ParcelInterface                    | Webit\Shipment\Parcel\Parcel                    |
      | Webit\Shipment\Vendor\VendorInterface                    | Webit\Shipment\Vendor\Vendor                    |

  Scenario: DeliveryAddress Mapping
    Given json representation like:
    """
    {"name":"My name","address":"21 Street","post":"Post","post_code":"32-022","contact_person":"Person",
    "contact_phone_no":"43313434333","contact_email":"mail@domain.com"}
    """
    When I deserialize it to "Webit\Shipment\Address\DeliveryAddressInterface"
    Then I should get instance of "Webit\Shipment\Address\DeliveryAddressInterface"
    And Instance should have properties like:
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
    Then I should get instance of "Webit\Shipment\Address\SenderAddressInterface"
    And Instance should have properties like:
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
    Then I should get instance of "Webit\Shipment\Consignment\DispatchConfirmationInterface"
    And Instance should have properties like:
      | property     | value               |
      | number       | 23454454            |
      | dispatchedAt |                     |

  Scenario: Parcel Mapping
    Given json representation like:
    """
    {"number":"23454454","weight":"0.22","reference": "#2322222"}
    """
    When I deserialize it to "Webit\Shipment\Parcel\ParcelInterface"
    Then I should get instance of "Webit\Shipment\Parcel\Parcel"
    And Instance should have properties like:
      | property     | value    |
      | number       | 23454454 |
      | weight       | 0.22     |
      | reference    | #2322222 |

  Scenario: Vendor Mapping
    Given json representation like:
    """
    {"number":"23454454","weight":"0.22","reference": "#2322222"}
    """
    When I deserialize it to "Webit\Shipment\Parcel\ParcelInterface"
    Then I should get instance of "Webit\Shipment\Parcel\Parcel"
    And Instance should have properties like:
      | property     | value    |
      | number       | 23454454 |
      | weight       | 0.22     |
      | reference    | #2322222 |