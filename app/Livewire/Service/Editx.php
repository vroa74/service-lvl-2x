<?php

namespace App\Livewire\Service;

use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $serviceId;
    
    // Campos del formulario
    public $id_s = '';
    public $F_serv = '';
    public $solicitante1_id = '';
    public $solicitante2_id = '';
    public $efectuo_id = '';
    public $vobo_id = '';
    public $obj_sol = '';
    public $actividades = '';
    public $mantenimiento = '';
    public $observaciones = '';
    
    // Tipo de servicio
    public $correctivo = false;
    public $preventivo = false;
    public $transparencia = false;
    public $a_tec = false;
    public $web_ins = false;
    public $print = false;
    
    // Via de solicitud
    public $email = false;
    public $tel = false;
    public $sol_ser = false;
    public $oficio = false;
    public $calendario = false;
    
    public $capturo = '';
    public $estatus_servicio = false;
    public $impressions = false;

    protected $rules = [
        'id_s' => 'nullable|string|max:25',
        'F_serv' => 'nullable|date',
        'solicitante1_id' => 'nullable|exists:users,id',
        'solicitante2_id' => 'nullable|exists:users,id',
        'efectuo_id' => 'nullable|exists:users,id',
        'vobo_id' => 'nullable|exists:users,id',
        'obj_sol' => 'nullable|string',
        'actividades' => 'nullable|string',
        'mantenimiento' => 'nullable|string',
        'observaciones' => 'nullable|string',
        'correctivo' => 'boolean',
        'preventivo' => 'boolean',
        'transparencia' => 'boolean',
        'a_tec' => 'boolean',
        'web_ins' => 'boolean',
        'print' => 'boolean',
        'email' => 'boolean',
        'tel' => 'boolean',
        'sol_ser' => 'boolean',
        'oficio' => 'boolean',
        'calendario' => 'boolean',
        'capturo' => 'nullable|string|max:50',
        'estatus_servicio' => 'boolean',
        'impressions' => 'boolean',
    ];

    protected $messages = [
        'F_serv.date' => 'La fecha debe ser válida',
        'solicitante1_id.exists' => 'El solicitante 1 debe ser un usuario válido',
        'solicitante2_id.exists' => 'El solicitante 2 debe ser un usuario válido',
        'efectuo_id.exists' => 'El usuario que efectuó debe ser válido',
        'vobo_id.exists' => 'El usuario de VºBº debe ser válido',
    ];

    public function mount($id)
    {
        $this->serviceId = $id;
        $service = Service::findOrFail($id);
        
        $this->id_s = $service->id_s;
        $this->F_serv = $service->F_serv ? $service->F_serv->format('Y-m-d') : '';
        $this->solicitante1_id = $service->solicitante1_id;
        $this->solicitante2_id = $service->solicitante2_id;
        $this->efectuo_id = $service->efectuo_id;
        $this->vobo_id = $service->vobo_id;
        $this->obj_sol = $service->obj_sol;
        $this->actividades = $service->actividades;
        $this->mantenimiento = $service->mantenimiento;
        $this->observaciones = $service->observaciones;
        $this->correctivo = $service->correctivo;
        $this->preventivo = $service->preventivo;
        $this->transparencia = $service->transparencia;
        $this->a_tec = $service->a_tec;
        $this->web_ins = $service->web_ins;
        $this->print = $service->print;
        $this->email = $service->email;
        $this->tel = $service->tel;
        $this->sol_ser = $service->sol_ser;
        $this->oficio = $service->oficio;
        $this->calendario = $service->calendario;
        $this->capturo = $service->capturo;
        $this->estatus_servicio = $service->estatus_servicio;
        $this->impressions = $service->impressions;
    }

    public function updateService()
    {
        $this->validate();

        $serviceData = [
            'id_s' => $this->id_s,
            'F_serv' => $this->F_serv,
            'solicitante1_id' => $this->solicitante1_id,
            'solicitante2_id' => $this->solicitante2_id,
            'efectuo_id' => $this->efectuo_id,
            'vobo_id' => $this->vobo_id,
            'obj_sol' => $this->obj_sol,
            'actividades' => $this->actividades,
            'mantenimiento' => $this->mantenimiento,
            'observaciones' => $this->observaciones,
            'correctivo' => $this->correctivo,
            'preventivo' => $this->preventivo,
            'transparencia' => $this->transparencia,
            'a_tec' => $this->a_tec,
            'web_ins' => $this->web_ins,
            'print' => $this->print,
            'email' => $this->email,
            'tel' => $this->tel,
            'sol_ser' => $this->sol_ser,
            'oficio' => $this->oficio,
            'calendario' => $this->calendario,
            'capturo' => $this->capturo,
            'estatus_servicio' => $this->estatus_servicio,
            'impressions' => $this->impressions,
        ];

        Service::find($this->serviceId)->update($serviceData);
        session()->flash('message', 'Servicio actualizado correctamente.');
        
        // Redirigir a la lista de servicios
        return redirect()->route('servicios.index');
    }

    public function render()
    {
        $users = User::where('status', true)->orderBy('name')->get();

        return view('livewire.service.edit', [
            'users' => $users
        ]);
    }
} 