<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\User;
use App\Traits\DeviceDetectionTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Mcreate extends Component
{
    use WithFileUploads, DeviceDetectionTrait;

    // Campos del formulario
    public $fecha_inv = '';
    public $user_id = '';
    public $res_id = '';
    public $fecha = '';
    public $dir = '';
    public $resguardante = '';
    public $user = '';
    public $is_pc = false;
    public $gpo = '';
    public $disp = '';
    public $type = '';
    public $articulo = '';
    public $ni = '';
    public $marca = '';
    public $modelo = '';
    public $ns = '';
    public $nombres = '';
    public $apa = '';
    public $ama = '';
    public $fullname = '';
    public $software_instalado = '';
    public $info_pc = '';
    public $observaciones = '';
    public $status = true;

    // Propiedades para móviles
    public $isMobile = false;
    public $deviceType = '';
    public $showMobileSections = false;
    public $limitResults = 20;

    // Modal properties
    public $showModal = false;
    public $modalTitle = '';
    public $modalType = '';
    public $userSearch = '';
    public $selectedUserId = null;
    public $selectedUserName = '';
    public $modalParam1 = null;

    protected $rules = [
        'fecha_inv' => 'nullable|date|before_or_equal:today',
        'user_id' => 'nullable|exists:users,id',
        'res_id' => 'nullable|exists:users,id',
        'fecha' => 'nullable|date|before_or_equal:today',
        'dir' => 'nullable|string|max:40',
        'resguardante' => 'nullable|string|max:70',
        'user' => 'nullable|string|max:140',
        'is_pc' => 'boolean',
        'gpo' => 'nullable|string|max:20',
        'disp' => 'nullable|string|max:30',
        'type' => 'nullable|string|max:30',
        'articulo' => 'nullable|string|max:70',
        'ni' => 'nullable|string|max:35',
        'marca' => 'nullable|string|max:50',
        'modelo' => 'nullable|string|max:50',
        'ns' => 'nullable|string|max:35',
        'nombres' => 'nullable|string|max:50',
        'apa' => 'nullable|string|max:35',
        'ama' => 'nullable|string|max:35',
        'fullname' => 'nullable|string',
        'software_instalado' => 'nullable|string',
        'info_pc' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'status' => 'boolean',
    ];

    protected $messages = [
        'fecha_inv.date' => 'La fecha de inventario debe ser una fecha válida.',
        'fecha_inv.before_or_equal' => 'La fecha de inventario no puede ser futura.',
        'fecha.date' => 'La fecha debe ser una fecha válida.',
        'fecha.before_or_equal' => 'La fecha no puede ser futura.',
        'user_id.exists' => 'El usuario seleccionado no existe en la base de datos.',
        'res_id.exists' => 'El responsable seleccionado no existe en la base de datos.',
        'dir.max' => 'La dirección no puede tener más de 255 caracteres.',
        'resguardante.max' => 'El resguardante no puede tener más de 70 caracteres.',
        'user.max' => 'El usuario no puede tener más de 140 caracteres.',
        'gpo.max' => 'El grupo no puede tener más de 20 caracteres.',
        'disp.max' => 'El dispositivo no puede tener más de 30 caracteres.',
        'type.max' => 'El tipo no puede tener más de 30 caracteres.',
        'articulo.max' => 'El artículo no puede tener más de 70 caracteres.',
        'ni.max' => 'El número de inventario no puede tener más de 35 caracteres.',
        'marca.max' => 'La marca no puede tener más de 50 caracteres.',
        'modelo.max' => 'El modelo no puede tener más de 50 caracteres.',
        'ns.max' => 'El número de serie no puede tener más de 35 caracteres.',
        'nombres.max' => 'Los nombres no pueden tener más de 50 caracteres.',
        'apa.max' => 'El campo APA no puede tener más de 35 caracteres.',
        'ama.max' => 'El campo AMA no puede tener más de 35 caracteres.',
        'dir.max' => 'La dirección no puede tener más de 40 caracteres.',
    ];

    public function mount()
    {
        $this->detectDevice();
        $this->optimizeForMobile();
        $this->enhanceTouchExperience();
        $this->optimizeScroll();
        
        // Establecer valores por defecto
        $this->fecha_inv = now()->format('Y-m-d');
        $this->fecha = now()->format('Y-m-d');
        $this->status = true;
    }

    public function detectDevice()
    {
        $userAgent = request()->header('User-Agent');
        $this->isMobile = preg_match('/(android|iphone|ipad|mobile|tablet)/i', $userAgent);
        $this->deviceType = $this->isMobile ? 'Mobile' : 'Desktop';
    }

    public function optimizeForMobile()
    {
        if ($this->isMobile) {
            $this->dispatch('optimize-for-mobile');
        }
    }

    public function enhanceTouchExperience()
    {
        if ($this->isMobile) {
            $this->dispatch('enhance-touch-experience');
        }
    }

    public function optimizeScroll()
    {
        if ($this->isMobile) {
            $this->dispatch('optimize-scroll');
        }
    }

    public function optimizeCache()
    {
        if ($this->isMobile) {
            $this->dispatch('optimize-cache');
        }
    }

    public function handleSlowConnection()
    {
        if ($this->isMobile) {
            $this->dispatch('handle-slow-connection');
        }
    }

    public function openUserModal($type, $param1 = null)
    {
        $this->modalType = $type;
        $this->modalParam1 = $param1;
        $this->modalTitle = "Seleccionar Usuario - Tipo: {$type}";
        $this->showModal = true;
        $this->userSearch = '';
        $this->selectedUserId = null;
        $this->selectedUserName = '';
    }

    public function selectUser($userId, $userName)
    {
        $this->selectedUserId = $userId;
        $this->selectedUserName = $userName;

        if ($this->modalType === 'user') {
            $this->user_id = $userId;
            $this->user = $userName;
        } elseif ($this->modalType === 'responsible') {
            $this->res_id = $userId;
            $this->resguardante = $userName;
        }

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->modalTitle = '';
        $this->modalType = '';
        $this->userSearch = '';
        $this->selectedUserId = null;
        $this->selectedUserName = '';
    }

    public function saveInventory()
    {
        try {
            // Validar los datos del formulario
            $this->validate();

            // Preparar los datos para crear
            $createData = [
                'fecha_inv' => $this->fecha_inv ?: null,
                'user_id' => $this->user_id ?: null,
                'res_id' => $this->res_id ?: null,
                'fecha' => $this->fecha ?: null,
                'dir' => $this->dir ?: null,
                'resguardante' => $this->resguardante ?: null,
                'user' => $this->user ?: null,
                'is_pc' => $this->is_pc,
                'gpo' => $this->gpo ?: null,
                'disp' => $this->disp ?: null,
                'type' => $this->type ?: null,
                'articulo' => $this->articulo ?: null,
                'ni' => $this->ni ?: null,
                'marca' => $this->marca ?: null,
                'modelo' => $this->modelo ?: null,
                'ns' => $this->ns ?: null,
                'nombres' => $this->nombres ?: null,
                'apa' => $this->apa ?: null,
                'ama' => $this->ama ?: null,
                'fullname' => $this->fullname ?: null,
                'software_instalado' => $this->software_instalado ?: null,
                'info_pc' => $this->info_pc ?: null,
                'observaciones' => $this->observaciones ?: null,
                'status' => $this->status,
            ];

            // Crear el inventario
            $inventory = Inventory::create($createData);

            session()->flash('message', '✅ Artículo de inventario creado correctamente.');
            return redirect()->route('inventario.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Errores de validación - Mensajes más específicos
            Log::error('Error de validación al crear inventario: ' . json_encode($e->errors()));
            
            $errorDetails = [];
            foreach ($e->errors() as $field => $errors) {
                $fieldName = $this->getFieldDisplayName($field);
                foreach ($errors as $error) {
                    $errorDetails[] = "• {$fieldName}: {$error}";
                }
            }
            
            $errorMessage = "❌ Error de validación en los siguientes campos:\n" . implode("\n", $errorDetails);
            session()->flash('error', $errorMessage);
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Errores de base de datos - Mensajes más específicos
            Log::error('Error de base de datos al crear inventario: ' . $e->getMessage());
            
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            
            if (str_contains($errorMessage, 'foreign key constraint')) {
                if (str_contains($errorMessage, 'user_id')) {
                    session()->flash('error', '❌ Error: El usuario seleccionado no existe en la base de datos. Por favor, seleccione un usuario válido.');
                } elseif (str_contains($errorMessage, 'res_id')) {
                    session()->flash('error', '❌ Error: El responsable seleccionado no existe en la base de datos. Por favor, seleccione un responsable válido.');
                } else {
                    session()->flash('error', '❌ Error: Uno de los usuarios seleccionados no existe en la base de datos. Por favor, verifique las selecciones.');
                }
            } elseif (str_contains($errorMessage, 'duplicate entry')) {
                if (str_contains($errorMessage, 'ni')) {
                    session()->flash('error', '❌ Error: Ya existe un artículo con el mismo Número de Inventario (NI): ' . $this->ni . '. Los números de inventario deben ser únicos.');
                } elseif (str_contains($errorMessage, 'ns')) {
                    session()->flash('error', '❌ Error: Ya existe un artículo con el mismo Número de Serie (NS): ' . $this->ns . '. Los números de serie deben ser únicos.');
                } else {
                    session()->flash('error', '❌ Error: Ya existe un artículo con los mismos datos únicos. Verifique que no esté duplicando información.');
                }
            } elseif (str_contains($errorMessage, 'Data too long')) {
                session()->flash('error', '❌ Error: Uno o más campos exceden el límite de caracteres permitido. Verifique la longitud de los datos ingresados.');
            } elseif (str_contains($errorMessage, 'Cannot add or update a child row')) {
                session()->flash('error', '❌ Error: No se puede crear el registro porque hay restricciones de integridad en la base de datos.');
            } else {
                session()->flash('error', '❌ Error de base de datos: ' . $errorMessage . ' (Código: ' . $errorCode . ')');
            }
            
        } catch (\Exception $e) {
            // Otros errores
            Log::error('Error inesperado al crear inventario: ' . $e->getMessage());
            session()->flash('error', '❌ Error inesperado del sistema: ' . $e->getMessage() . '. Por favor, contacte al administrador si el problema persiste.');
        }
    }

    /**
     * Obtiene el nombre de visualización para los campos del formulario
     */
    private function getFieldDisplayName($field)
    {
        $fieldNames = [
            'fecha_inv' => 'Fecha de Inventario',
            'user_id' => 'Usuario',
            'res_id' => 'Responsable',
            'fecha' => 'Fecha',
            'dir' => 'Dirección',
            'resguardante' => 'Resguardante',
            'user' => 'Usuario',
            'is_pc' => 'Es PC',
            'gpo' => 'Grupo',
            'disp' => 'Dispositivo',
            'type' => 'Tipo',
            'articulo' => 'Artículo',
            'ni' => 'Número de Inventario',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'ns' => 'Número de Serie',
            'nombres' => 'Nombres',
            'apa' => 'APA',
            'ama' => 'AMA',
            'fullname' => 'Nombre Completo',
            'software_instalado' => 'Software Instalado',
            'info_pc' => 'Información PC',
            'observaciones' => 'Observaciones',
            'status' => 'Estado',
        ];

        return $fieldNames[$field] ?? ucfirst(str_replace('_', ' ', $field));
    }

    public function render()
    {
        $this->detectDevice();
        
        $users = User::when($this->userSearch, function ($query) {
            $query->where('name', 'like', '%' . $this->userSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->userSearch . '%');
        })->limit($this->isMobile ? $this->limitResults : 100)->get();

        return view('livewire.inventory.mcreate', [
            'users' => $users,
            'isMobile' => $this->isMobile,
            'deviceType' => $this->deviceType,
        ]);
    }
}
