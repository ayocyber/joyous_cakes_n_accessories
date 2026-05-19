<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('slug'),
                ImageEntry::make('image_path')
                     ->disk('public')
                     ->directory('products')
                    ->square(),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('currency'),
                TextEntry::make('size_value')
                    ->numeric(),
                TextEntry::make('size_unit'),
                TextEntry::make('stock')
                    ->numeric(),
                TextEntry::make('sku')
                    ->label('SKU'),
                IconEntry::make('is_active')
                    ->boolean(),
                IconEntry::make('featured')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
