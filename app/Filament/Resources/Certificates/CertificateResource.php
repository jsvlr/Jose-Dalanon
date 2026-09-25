<?php

namespace App\Filament\Resources\Certificates;

use App\Enums\NavigationGroupEnum;
use App\Filament\Resources\Certificates\Pages\ManageCertificates;
use App\Filament\Resources\Companies\CompanyResource;
use App\Models\Certificate;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookmarkSquare;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = NavigationGroupEnum::CREDENTIALS;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
                'sm' => 1,
            ])
            ->components([
                FileUpload::make('image')
                    ->label('Certificate Image')
                    ->disk('public')
                    ->directory('certificates')
                    ->image()
                    ->maxSize(5120) // 5mb
                    ->imageEditor()
                    ->imagePreviewHeight('250')
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                Select::make('company_id')
                    ->required()
                    ->label('Company/Organization')
                    ->relationship('company', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Grid::make(3)
                            ->schema(CompanyResource::formSchema())
                    ]),

                TextInput::make('credential_url')
                    ->label('Credential URL')
                    ->required()
                    ->url()
                    ->prefixIcon('heroicon-o-link')
                    ->columnSpan(2),

                TextInput::make('credential_id')
                    ->label('Credential ID'),

                DatePicker::make('issue_date')
                    ->required()
                    ->native(false)
                    ->default(now()),

                DatePicker::make('expiry_date')
                    ->native(false)
                    ->helperText('Leave empty if the certificate has no expiration.'),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first.'),

                Toggle::make('is_featured')
                    ->default(false)
                    ->inline(false),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No certificates found')
            ->emptyStateDescription('Create your first certificate to start organizing.')
            ->emptyStateIcon('heroicon-o-folder-open')
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ManageCertificates::route('/'),
        ];
    }
}
