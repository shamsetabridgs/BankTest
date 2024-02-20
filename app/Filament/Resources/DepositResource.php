<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepositResource\Pages;
use App\Filament\Resources\DepositResource\RelationManagers;
use App\Models\Deposit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\DepositOption;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $options = DepositOption::pluck('name', 'id')->toArray();

        //............. Get the authenticated user's ID..............
        $userId = Auth::id();
        return $form
            ->schema([
                //
                Components\Hidden::make('user_id')->default($userId),
                Forms\Components\TextInput::make('amount')->label('Amount'),
                Forms\Components\Select::make('deposit_option_id')
                    ->label('Method')
                    ->options($options),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'false' => 'False',
                        'true' => 'True',
                    ])
                    ->default('false'),
            ]);
                /*TextInput::make('amount')->label('Amount'),
                Select::make('name')
                    ->label('Method')
                    ->options($options),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'false' => 'False',
                        'true' => 'True',
                    ])
                    ->default('false'),
            ]);*/
            //................ Set the user_id to the authenticated user's ID
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')->label('id'),
                Tables\Columns\TextColumn::make('user_id')->label('user_id'),
                Tables\Columns\TextColumn::make('amount')->label('amount'),
                Tables\Columns\TextColumn::make('deposit_option_id')->label('deposit_option_id'),
                Tables\Columns\TextColumn::make('status')->label('status'),
                Tables\Columns\TextColumn::make('current_amount')->label('current_amount'),
                Tables\Columns\TextColumn::make('available_amount')->label('available_amount'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeposits::route('/'),
            'create' => Pages\CreateDeposit::route('/create'),
            'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}
