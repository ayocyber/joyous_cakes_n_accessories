<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('country')
                    ->required(),
                TextInput::make('state')
                    ->default(null),
                TextInput::make('city')
                    ->required(),
                Textarea::make('address_line')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
