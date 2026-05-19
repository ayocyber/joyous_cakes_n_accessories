<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->required(fn (string $operation): bool => $operation === 'create'),
                TextInput::make('price')
                    ->required()
                    ->numeric(),
                Select::make('currency')
                    ->options([
                        'LRD' => 'LRD',
                        'USD' => 'USD',
                        'NGN' => 'NGN',
                    ])
                    ->default('LRD')
                    ->required(),
                TextInput::make('size_value')
                    ->numeric()
                    ->default(null),
                TextInput::make('size_unit')
                    ->default(null),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('sku')
                    ->label('SKU'),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('featured')
                    ->required(),
            ]);
    }
}
