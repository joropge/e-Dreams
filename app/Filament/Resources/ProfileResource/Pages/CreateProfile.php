<?php

namespace App\Filament\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;


class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;
    protected function fields()
    {
        return [
            // Other fields...

            // Add fields for the address table
            \Filament\Forms\Components\TextInput::make('id')
                ->label('Address Line 1')
                ->required(),
            
            \Filament\Forms\Components\TextInput::make('address_line_2')
                ->label('Address Line 2'),

            \Filament\Forms\Components\TextInput::make('city')
                ->label('City')
                ->required(),

            \Filament\Forms\Components\TextInput::make('state')
                ->label('State')
                ->required(),

            \Filament\Forms\Components\TextInput::make('postal_code')
                ->label('Postal Code')
                ->required(),

            \Filament\Forms\Components\TextInput::make('country')
                ->label('Country')
                ->required(),
        ];
    }
}
