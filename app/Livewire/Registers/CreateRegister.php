<?php

namespace App\Livewire\Registers;

use App\Models\Institution;
use App\Models\Register;
use App\Models\Sector;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Filament\Notifications\Actions\Action;

class CreateRegister extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
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
                    Forms\Components\Select::make('media')
                    ->label('Tipo de medio utilizado para la difusión')
                    ->options(fn (Get $get): array => match ($get('area')) {
                        '1' => [
                            '01' => 'Television',
                            '02' => 'Radio',
                            '27' => 'Cine',
                        ],
                        '2' => [
                            '01' => 'Radio-01',
                            '02' => 'TV-02',
                            '27' => 'Cine-27',
                            '03' => 'Radio/TV-03',
                            '04' => 'Diarios-04',
                            '05' => 'Revistas-05',
                            '06' => 'Diarios/Revistas-06',
                            '07' => 'Medios Complementarios-07',
                            '08' => 'Radio/Diarios-08',
                            '09' => 'Radio/Revistas-09',
                            '10' => 'Radio/Medios Complementarios-10',
                            '11' => 'TV/Diarios-11',
                            '12' => 'TV/Revistas-12',
                            '13' => 'TV/Medios Complementarios-13',
                            '14' => 'Diarios/Medios Complementarios-14',
                            '15' => 'Revistas/Medios Complementarios-15',
                            '16' => 'Diarios/Revistas/Radio-16',
                            '17' => 'Diarios/Revistas/Televisión-17',
                            '18' => 'Diarios/Revistas/Radio/Televisión-18',
                            '19' => 'Diarios/Revistas/Medios Complementarios-19',
                            '20' => 'Diarios/Revistas/Radio/Medios Complementarios-20',
                            '21' => 'Diarios/Revistas/Televisión/Medios Complementarios-21',
                            '22' => 'Diarios/Revistas/Radio/Televisión/Medios Complementarios-22',
                            '23' => 'Todos-23',
                            '24' => 'Cualitativo-24',
                            '25' => 'Cuantitativo-25',
                            '26' => 'Mixto-26',
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

    public function create() 
    {
        $data = $this->form->getState();

        $valorNumCamp = 0;

        // Obtener los dos últimos dígitos del año
        $anio = substr($data['anio'], -2);

        // Contar el número de campañas con el mismo valor en el campo area NUMERO VERSION
        $numCampania = Register::where('campaign', $data['campaign'])
        ->where('area', $data['area'])
        ->count();
        
        //dd($numCampania);

        
        // Incrementar el contador para la versión
        $numVersion = str_pad($numCampania + 1, 3, '0', STR_PAD_LEFT);

        // Obtener el código de la institución 00656
        $institution = Institution::find($data['institution_id']);
        $claveEntidad = str_pad($institution->code, 5, '0', STR_PAD_LEFT);
        
        // Campañas nuevas si el contador es igual a 0
        if ($numCampania == 0) {
            // Contar el número de campañas únicas registradas
            
            $numeroCampanasUnicas = Register::distinct($data['campaign'])->count('campaign');
            // Incrementar en 1 para obtener el identificador de la nueva campaña
            $numeroUI = $numeroCampanasUnicas + 1;
            // Asegurar que el identificador tenga al menos 3 dígitos
            $valorNumCamp = str_pad($numeroUI, 3, '0', STR_PAD_LEFT);
            // Formatear el número de versión para asegurar que tenga al menos 3 dígitos
            $numVersionClave = str_pad($numVersion, 3, '0', STR_PAD_LEFT);
            // Construir el código de la campaña
            $code = $valorNumCamp . '/' . $anio . "-" . $data['area'] . $numVersionClave . '-' . $data['type'] . $data['media'] . "-" .  $claveEntidad;
        } else {
            // Buscar la campaña existente por su nombre
            $campaniaEncontrada = Register::where('campaign', $data['campaign'])->first();
            
            // Suponiendo que el código de la campaña existente tiene un formato como '123/20-XYZ...'
            // y necesitas extraer '123' como el número clave
            $valorNumCamp = explode('/', $campaniaEncontrada->code)[0];

            // Asegurar que el número clave tenga al menos 3 dígitos
            $valorNumCamp = str_pad($valorNumCamp, 3, '0', STR_PAD_LEFT);

            // Formatear el número de versión para asegurar que tenga al menos 3 dígitos
            $numVersionClave = str_pad($numVersion, 3, '0', STR_PAD_LEFT);
            // Construir el código de la campaña usando el número de campaña existente
            $code = $valorNumCamp . '/' . $anio . "-" . $data['area'] . $numVersionClave . '-' . $data['type'] . $data['media'] . "-" .  $claveEntidad;

             // Notificar al usuario que ya existía
             
             Notification::make()
            ->title('Nombre de Campaña ya existe con el siguiente número: '.$valorNumCamp)
            ->success()
            ->seconds(7)
            ->actions([
                Action::make('undo')
                    ->color('gray'),
            ])
            ->send();
            
        }
    
        $data['code'] = $code;

        $record = Register::create($data);

        $this->form->model($record)->saveRelationships();

        Notification::make()
        ->title('Clave generada exitosamente '.$code)
        ->success()
        ->seconds(7)
        ->send();

        // Redirigir al dashboard después de guardar el registro
        return redirect()->route('registers.list-registers');
    }
   
    public function render(): View
    {
        return view('livewire.registers.create-register');
    }
}