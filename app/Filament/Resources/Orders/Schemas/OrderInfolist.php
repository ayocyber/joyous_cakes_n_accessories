<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer_id')
                    ->numeric(),
                TextEntry::make('subtotal')
                    ->numeric(),
                TextEntry::make('shipping_fee')
                    ->numeric(),
                TextEntry::make('total_price')
                    ->numeric(),
                TextEntry::make('currency'),
                TextEntry::make('status'),
                TextEntry::make('payment_status'),
                TextEntry::make('payment_method'),
                TextEntry::make('ordered_at')
                    ->dateTime(),
                TextEntry::make('shipped_at')
                    ->dateTime(),
                TextEntry::make('delivered_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
