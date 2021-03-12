<?php

namespace App\Observers;

use App\Mail\ProductChangedMail;
use App\Models\Product;

class ProductObserver
{
    private $action;
    private $product;

    /**
     * Handle the product "created" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function created(Product $product)
    {
        $this->sendMail($product, 'создан');
    }

    /**
     * Handle the product "updated" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        $this->sendMail($product, 'изменён');
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $this->sendMail($product, 'удалён');
    }

    /**
     * Handle the product "restored" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        $this->sendMail($product, 'восстановлен');
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $this->sendMail($product, 'совсем удалён');
    }

    private function sendMail(Product $product, $action)
    {
        \Mail::to(config('mail.admin-contacts.address'), config('mail.admin-contacts.name'))
            ->send(new ProductChangedMail($product, $action));
    }

}
