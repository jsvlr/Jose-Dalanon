<?php

namespace App\Filament\Resources\Companies;

use App\Enums\NavigationGroupEnum;
use App\Filament\Resources\Companies\Pages\ManageCompanies;
use App\Models\Company;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|UnitEnum|null $navigationGroup = NavigationGroupEnum::CREDENTIALS;

    protected static ?int $navigationSort = 0;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components(self::formSchema());
    }

    public static function formSchema(): array
    {
        return [
            FileUpload::make('logo')
                ->disk('public')
                ->directory('companies')
                ->image()
                ->imageEditor()
                ->maxSize(1024) // 1mb
                ->columnSpanFull()
                ->imagePreviewHeight('100'),

            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->columnSpan(2),

            TextInput::make('slug')
                ->required()
                ->readOnly()
                ->dehydrated(),

            TextInput::make('url')
                ->label('Website URL')
                ->url()
                ->prefixIcon('heroicon-o-link')
                ->columnSpan(2),

            Select::make('type')
                ->options([
                    'technical' => 'Technical',
                    'academic' => 'Academic',
                    'general' => 'General',

                ])
                ->native(false),

            Textarea::make('description')
                ->rows(3)
                ->columnSpanFull(),

            Toggle::make('is_verified')
                ->default(false)
                ->columnSpan(1),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No companies found')
            ->emptyStateDescription('Create first company to start organizing credentials')
            ->emptyStateIcon('heroicon-o-folder-open')
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('logo')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Bold),

                TextColumn::make('slug')
                    ->searchable()
                    ->weight('light')
                    ->toggleable(),

                TextColumn::make('url')
                    ->searchable()
                    ->weight('normal')
                    ->extraAttributes(['class' => 'italic'])
                    ->color('primary')
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->searchable()
                    ->badge()
                    ->alignCenter(),

                IconColumn::make('is_verified')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('certificates.count')
                    ->default(0)
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_verified')
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
            'index' => ManageCompanies::route('/'),
        ];
    }
}
