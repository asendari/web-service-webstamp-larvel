<?php

namespace Asendari\WebServiceWebstamp\Models;

class WebstampStamp extends WebstampModel
{
    public $id;
    public $stamp_id;
    public $order_id;
    public $internal_order_id;
    public $tracking_number;
    public $file_name;
    public $compression;
    public $image_width_mm;
    public $image_height_mm;
    public $image_width_px;
    public $image_height_px;
    public $mime_type;
    public $reference;
    public $print_data;

    public int $address_id;
    public int $wc_order_id;
    public int $time;
}