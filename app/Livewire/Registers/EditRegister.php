<?php

namespace App\Livewire\Registers;

use App\Models\Institution;
use App\Models\Register;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Get;

class EditRegister extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Register $register;

    public function mount(Register $register): void
    {
        // Llena el formulario con los datos del registro
        $this->form->fill($register->toArray());
        //dd($register);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Creación y Registro de Claves de Autorización 2024')
                ->description('Por favor, requisita los datos del siguiente formulario.')
                ->schema([
                    
                    Forms\Components\Select::make('area')
                    ->label('Unidad Administrativa')
                    ->options([
                        '1' => 'Dirección General de Radio Televisión y Cinematografía',
                        '2' => 'Dirección General de Normatividad de Comunicación',
                    ])
                    ->live(),

                    Forms\Components\Hidden::make('date_of_register')
                    ->default(now()->toDateString()), // Registrar automáticamente el día de hoy

                    Forms\Components\Hidden::make('anio')
                    ->default('2024'), 
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2, // 3 columns on medium and larger screens
                    ]),  
                    
                Section::make('Selecciona el Sector y la Entidad')
                    ->description('Si deseas agregar o modificar Sectores y Entidades, comunicate con el Administrador del Sistema.')
                    ->schema([    
                
                Select::make('sector_id')
                    ->label('Sector')
                    ->options(Sector::query()->pluck('name', 'id'))
                    ->live(),
                    
                Select::make('institution_id')
                ->label('Entidad')
                    ->options(fn (Get $get): Collection => Institution::query()
                        ->where('sector_id', $get('sector_id'))
                        ->pluck('name', 'id')),
                        ])
                        ->columns([
                            'default' => 1,
                            'md' => 2, // 3 columns on medium and larger screens
                        ]), 

                Section::make('Información del tipo de Difusión')
                ->schema([    
                                        
                    Forms\Components\Select::make('type')
                    ->label('Modalidad de difusión')
                    ->options(fn (Get $get): array => match ($get('area')) {
                        
                        '1' => [
                            'TF' => 'Tiempos Fiscales',
                            'TE' => 'Tiempos de Estado',
                        ],
                        '2' => [
                            
                            'TC' => 'Tiempos Comerciales',
                            'MI' => 'Medios Impresos',
                            'MP' => 'Medios Públicos',
                            'MC' => 'Medios Complementarios',
                            'EI' => 'Estudios de Investigación',
                            'SP' => 'Servicios de Producción',
                        ],
                        default => [],
                    }),
                    
                     // Asegura que el valor seleccionado se muestre correctamente
                    
                     Forms\Components\Select::make('media')
                    ->label('Tipo de medio utilizado para la difusión')
                    ->options(fn (Get $get): array => match ($get('area')) {
                       '1' => [
                            '01' => 'Television',
                            '02' => 'Radio',
                            '27' => 'Cine',
                        ],
                        '2' => [
                            '01' => 'Radio',
                            '02' => 'TV',
                            '27' => 'Cine',
                            '03' => 'Radio/TV',
                            '04' => 'Diarios',
                            '05' => 'Revistas',
                            '06' => 'Diarios/Revistas',
                            '07' => 'Medios Complementarios',
                            '08' => 'Radio/Diarios',
                            '09' => 'Radio/Revistas',
                            '10' => 'Radio/Medios Complementarios',
                            '11' => 'TV/Diarios',
                            '12' => 'TV/Revistas',
                            '13' => 'TV/Medios Complementarios',
                            '14' => 'Diarios/Medios Complementarios',
                            '15' => 'Revistas/Medios Complementarios',
                            '16' => 'Diarios/Revistas/Radio',
                            '17' => 'Diarios/Revistas/Televisión',
                            '18' => 'Diarios/Revistas/Radio/Televisión',
                            '19' => 'Diarios/Revistas/Medios Complementarios',
                            '20' => 'Diarios/Revistas/Radio/Medios Complementarios',
                            '21' => 'Diarios/Revistas/Televisión/Medios Complementarios',
                            '22' => 'Diarios/Revistas/Radio/Televisión/Medios Complementarios',
                            '23' => 'Todos',
                            '24' => 'Cualitativo',
                            '25' => 'Cuantitativo',
                            '26' => 'Mixto',
                        ],
                        
                        default => [],
                    }),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 3, // 3 columns on medium and larger screens
                    ]),   
                    
                
                Section::make('Datos de Campaña')
                    ->schema([    
                                
                Forms\Components\TextInput::make('campaign')
                    ->label('Nombre de Campaña')    
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('version')
                    ->label('Versión')
                    ->required()
                    ->maxLength(255),
                Select::make('coverage')
                    ->label('Cobertura')
                    ->multiple()
                    ->options([
                        'Nacional' => 'Nacional',
                        'Estatal' => 'Estatal',
                    ]),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2, // 3 columns on medium and larger screens
                    ]),   
                   
 
                Section::make('Información del Documento de Entrada')
                    ->schema([  
                                        
                Forms\Components\TextInput::make('input_document')
                    ->label('Oficio de Entrada')    
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_document')
                    ->label('Fecha de Oficio')    
                    ->required(),

                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 1, // 3 columns on medium and larger screens
                    ]),

                Forms\Components\TextInput::make('code')
                    ->default('VACIO')
                    ->hidden()
                    ->maxLength(255),
                    
                    ])
            ->statePath('data')
            ->model(Register::class);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->register->update($data);

        Notification::make()
        ->title('Registro Editado Exitosamente')
        ->success()
        ->seconds(5)
        ->send();
        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('registers.list-registers');
    }

    public function render(): View
    {
        return view('livewire.registers.edit-register');
    }
}

