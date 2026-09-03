<?php

namespace App\Filament\Resources\Accounts;

use App\Filament\Resources\Accounts\Pages\ManageAccounts;
use App\Models\Account;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeEuropeAfrica;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                FileUpload::make('icon')
                    ->disk('public')
                    ->directory('accounts')
                    ->image()
                    ->maxSize(1023) // 1mb
                    ->columnSpan(1),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                TextInput::make('url')
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->default(true)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->emptyStateHeading('No accounts found')
            ->emptyStateDescription('Create first account by clicking the button on top')
            ->emptyStateIcon(Heroicon::UserMinus)
            ->columns([
                ImageColumn::make('icon')
                    ->disk('public')
                    ->circular()
                    ->grow(false)
                    ->imageHeight(25),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Bold),

                TextColumn::make('url')
                    ->sortable()
                    ->searchable()
                    ->label('URL')
                    ->weight(FontWeight::Light),

                ToggleColumn::make('is_active'),

            ])
            ->filters([
                TernaryFilter::make('is_active')
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAccounts::route('/'),
        ];
    }
}
