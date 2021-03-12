<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductChangedMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Product
     */
    private $product;
    /**
     * @var string
     */
    private $action;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product, $action)
    {
        //
        $this->product = $product;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->view('mail.product-changed')
            ->with([
                'product' => $this->product,
                'action' => $this->action
            ]);
    }
}
