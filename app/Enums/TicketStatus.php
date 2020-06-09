<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TicketStatus extends Enum
{
    const Unpaid = 'unpaid';
    const Paid = 'paid';
    const Cancel = 'cancel';
    const NotRefundYet = 'not refund yet';
    const Refund = 'refund';
    const Booked = 'booked';
}
