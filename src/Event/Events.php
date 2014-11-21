<?php
/**
 * Events.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@dxi.eu>
 * Created on Nov 21, 2014, 16:40
 * Copyright (C) DXI Ltd
 */

namespace Webit\Shipment\Event;

/**
 * Class Events
 * @package Webit\Shipment\Event
 */
final class Events
{
    const PRE_CONSIGNMENT_SYNCHRONIZE = 'shipment.pre_consignment_synchronize';
    const POST_CONSIGNMENT_SYNCHRONIZE = 'shipment.post_consignment_synchronize';

    const PRE_CONSIGNMENT_STATUS_SYNCHRONIZE = 'shipment.pre_consignment_status_synchronize';
    const POST_CONSIGNMENT_STATUS_SYNCHRONIZE = 'shipment.post_consignment_status_synchronize';

    const PRE_CONSIGNMENT_SAVE = 'shipment.pre_consignment_save';
    const POST_CONSIGNMENT_SAVE = 'shipment.post_consignment_save';

    const PRE_CONSIGNMENT_REMOVE = 'shipment.pre_consignment_remove';
    const POST_CONSIGNMENT_REMOVE = 'shipment.post_consignment_remove';

    const PRE_PARCEL_ADD = 'shipment.pre_parcel_add';
    const POST_PARCEL_ADD = 'shipment.post_parcel_add';

    const PRE_CONSIGNMENT_DISPATCH = 'shipment.pre_consignment_dispatch';
    const POST_CONSIGNMENT_DISPATCH = 'shipment.post_consignment_dispatch';

    const PRE_CONSIGNMENT_CANCEL = 'shipment.pre_consignment_cancel';
    const POST_CONSIGNMENT_CANCEL = 'shipment.post_consignment_cancel';
}
