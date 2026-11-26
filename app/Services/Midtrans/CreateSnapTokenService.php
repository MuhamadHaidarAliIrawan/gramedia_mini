<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Checkout;

class CreateSnapTokenService extends Midtrans
{
    public function __construct(protected Checkout $checkout)
    {
        parent::__construct();
    }

    public function getSnapToken()
    {
        //checkout : with
        $this->checkout->loadMissing(['checkoutBooks', 'checkoutBooks.book',
        'user']);
        $params = [
            'transaction_details' => [
                'order_id' => $this->checkout->order_code,
                'gross_amount' => $this->checkout->total_price,
            ],
            //looping data checkouts, untuk data barang yg dibeli
            'item_details' => $this->checkout->checkoutBooks->map(
                fn($row) =>
                    [
                        'id' => $row->id,
                        'price' => $row->price,
                        'quantity' => 1,
                        'name' => $row->book->title,//nama barang diambil dr table books
                    ]
            ),
            'customer_details' => [
                'first_name' => $this->checkout->user->name,
                'email' => $this->checkout->user->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}