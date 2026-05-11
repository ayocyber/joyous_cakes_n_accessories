<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_id')
                    ->required()
                    ->numeric(),
                TextInput::make('provider')
                    ->required(),
                TextInput::make('transaction_reference')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('currency')
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'successful' => 'Successful', 'failed' => 'Failed'])
                    ->required(),
            ]);
    }
}
