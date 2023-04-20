<?php

namespace Asendari\WebServiceWebstamp\Models;

class WebstampOrder extends WebstampModel
{
        public int $id;
        public int $order_id;
        public float $price;
        public float $item_price;
        public int $valid_days;
        public int $valid_until;
        public int $product; /*** */
        public int $post_product; /*** */
        public string $delivery_receipt;
        public int $category;
        public WebstampCategory $category_object;
        public int $zone;
        public WebstampZone $zone_object;
        public string $delivery_method;
        public string $format;
        public mixed $additions;
        public int $address_id;
        public WebstampAddress $address;
        public array $a_addresses; /*** */
        public int $media; /*** */
        public WebstampMedia $media_object;
        public int $media_type;
        public WebstampMediaType $media_type_object;
        public string $license_number; /*** */
        public string $status;
        public int $wc_order_id;
        public string $reference; /*** */
        public bool $use_sender_address;
        public bool $use_address;
        public WebstampAddress $sender; /*** */
        public int $sender_id;
        public int $media_startpos; /*** */
        public int $quantity; /*** */
        public mixed $image; /*** */
        public int $image_id;
        public string $image_url;
        public string $order_comment; /*** */
        public string $cash_on_delivery_info; /*** */
        public WebstampCustomMedia $custom_media; /*** */
        public array $reference_to_address;
        public bool $single; /*** */
        public string $file_type; /*** */
}