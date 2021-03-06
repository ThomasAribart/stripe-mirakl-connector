<?php

namespace App\Message;

use App\Entity\MiraklRefund;

class RefundFailedMessage implements NotifiableMessageInterface
{
    /**
     * @var array
     */
    private $content;

    private static function getType(): string
    {
        return 'refund.failed';
    }

    public function __construct(MiraklRefund $refund)
    {
        $this->content = [
            'type' => self::getType(),
            'payload' => [
                'internalId' => $refund->getId(),
                'amount' => $refund->getAmount(),
                'currency' => $refund->getCurrency(),
                'miraklOrderId' => $refund->getMiraklOrderId(),
                'miraklRefundId' => $refund->getMiraklRefundId(),
                'stripeRefundId' => $refund->getStripeRefundId(),
                'stripeReversalId' => $refund->getStripeReversalId(),
                'status' => $refund->getStatus(),
                'failedReason' => $refund->getFailedReason(),
            ],
        ];
    }

    public function getContent(): array
    {
        return $this->content;
    }
}
