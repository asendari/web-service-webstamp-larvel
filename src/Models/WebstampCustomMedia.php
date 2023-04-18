<?php

namespace Asendari\WebServiceWebstamp\Models;

class WebstampCustomMedia extends WebstampModel
{
    public $name;
    public $id;

    // wsws_custom_media properties.
    public $type;
    public $page_width;
    public $page_height;
    public $margin_top;
    public $margin_bottom;
    public $margin_left;
    public $margin_right;
    public $cols;
    public $orws;
    public $colspacing;
    public $rowspacing;
    public $recipient_orientation;
    public $recipient_x;
    public $recipient_y;
    public $sender_orientation;
    public $sender_x;
    public $sender_y;
    public $franking_orientation;
    public $franking_x;
    public $franking_y;

}