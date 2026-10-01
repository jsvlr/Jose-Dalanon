<?php

namespace App\Filament\Resources\Skills;

use App\Filament\Resources\Skills\Pages\ManageSkills;
use App\Models\Skill;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Enums\FontWeight;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|UnitEnum|null $navigationGroup = \App\Enums\NavigationGroupEnum::CREDENTIALS;

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
                'sm' => 1
            ])
            ->components([
                FileUpload::make('icon')
                    ->disk('public')
                    ->directory('skills_icon')
                    ->image()
                    ->imageEditor()
                    ->helperText('max size 1 mb')
                    ->maxSize(1024) // 1mb
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan([
                        'lg' => 2,
                        'sm' => 'full'
                    ]),

                Select::make('type')
                    ->options(\App\Enums\SkillTypeEnum::class)
                    ->default(\App\Enums\SkillTypeEnum::PROGRAMMING_LANGUAGE),

                TextInput::make('level')
                    ->label('Proficiency Level')
                    ->type('range')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.01)
                    ->required()
                    ->default(0)
                    ->columnSpan([
                        'lg' => 2,
                        'sm' => 'full'
                    ])
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('level_label', $state)),

                TextEntry::make('level_label')
                    ->suffix('%')
                    ->weight(FontWeight::Bold)
                    ->alignCenter()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->emptyStateHeading('No Skill found')
            ->emptyStateDescription('We coudln\'t find any skill. Try changing your filters or search, or add a new one.')
            ->emptyStateIcon(
                fn($livewire) =>
                !empty($livewire->tableFilters) || !empty($livewire->tableSearch)
                    ? 'heroicon-o-magnifying-glass'
                    : 'heroicon-o-document-text'
            )
            ->columns([
                ImageColumn::make('icon')
                    ->disk('public')
                    ->imageHeight(40),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->badge(),

                ViewColumn::make('level')
                    ->view('filament.tables.columns.proficiency-level')

            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(\App\Enums\SkillTypeEnum::class)
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
            'index' => ManageSkills::route('/'),
        ];
    }
}
