# Proyecto de cdi responsives

## creacion de la primera inteface 
    index, inventories

    php artisan make:controller UsuariosController  --resource
    
    php artisan make:model Service -mf
    php artisan make:controller ServiceController  --resource
    
    php artisan make:model Inventory -mf
    php artisan make:controller InventoryController  --resource
    

    php artisan make:model Log -mf
    php artisan make:controller LogController  --resource

    php artisan make:model responsive-letter -mf
    php artisan make:controller ResponsiveLetterController  --resource

    php artisan make:model responsive-letter -mf
    php artisan make:controller UserController  --resource

    php artisan make:model responsive-letter -mf
    php artisan make:controller UsuariosController  --resource


ya quedo lista la primera pagina ahora vamos a ver el primer componente de livewire

    php artisan make:livewire usuario.index

    php artisan make:livewire Inventory.index
    php artisan make:livewire Inventory.create
    php artisan make:livewire Inventory.edit
    php artisan make:livewire Inventory.user-inv


    php artisan make:livewire Service\index
    php artisan make:livewire service.edit
    php artisan make:livewire Service\create

    php artisan make:livewire usuarios.index
    php artisan make:livewire usuarios.edit

se crea el componente livewire para capturar la pagina de inicio

       php artisan make:livewire Service\
       
migraciones

Schema::create('service_requests', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('area_adscripcion');
    $table->string('jefe_inmediato');
    $table->date('fecha_solicitud');
    $table->timestamps();
});
       
Schema::create('service_request_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('service_request_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['equipo', 'pagina_web', 'transparencia']);
    $table->text('description')->nullable();
    $table->timestamps();
});

Schema::create('equipment_details', function (Blueprint $table) {
    $table->id();
    $table->foreignId('service_request_item_id')->constrained()->onDelete('cascade');
    $table->string('equipo');
    $table->string('numero_inventario');
    $table->timestamps();
});

Schema::create('web_page_details', function (Blueprint $table) {
    $table->id();
    $table->foreignId('service_request_item_id')->constrained()->onDelete('cascade');
    $table->enum('pagina_tipo', ['institucional', 'leyes'])->nullable();
    
    $table->boolean('archivo_xls')->default(false);
    $table->boolean('archivo_pdf')->default(false);
    $table->boolean('archivo_doc')->default(false);
    $table->boolean('archivo_png')->default(false);
    $table->boolean('archivo_jpg')->default(false);
    $table->boolean('archivo_zip')->default(false);
    $table->string('otro_archivo')->nullable();
    
    $table->string('nombre_ley')->nullable();
    $table->string('nombre_archivo')->nullable();
    $table->string('materia')->nullable();
    $table->text('detalle_servicio')->nullable();
    $table->timestamps();
});


Schema::create('transparency_details', function (Blueprint $table) {
    $table->id();
    $table->foreignId('service_request_item_id')->constrained()->onDelete('cascade');
    
    $table->boolean('archivo_xls')->default(false);
    $table->boolean('archivo_pdf')->default(false);
    $table->boolean('archivo_doc')->default(false);
    $table->boolean('archivo_png')->default(false);
    $table->boolean('archivo_jpg')->default(false);
    $table->boolean('archivo_zip')->default(false);
    $table->string('otro_archivo')->nullable();
    
    $table->string('nombre_archivo')->nullable();
    $table->string('articulo_ley')->nullable();
    $table->string('fraccion')->nullable();
    $table->string('inciso')->nullable();
    $table->text('detalle_servicio')->nullable();
    $table->timestamps();
});


php artisan make:model ServiceRequest -m
php artisan make:model ServiceRequestItem -m
php artisan make:model EquipmentDetail -m
php artisan make:model WebPageDetail -m
php artisan make:model TransparencyDetail -m

Relación en modelos (hasMany / belongsTo)
Agregá estas relaciones en los modelos:
========================================================================================================0

ServiceRequest.php
public function items()
{
    return $this->hasMany(ServiceRequestItem::class);
}

========================================================================================================0
ServiceRequestItem.php
public function serviceRequest()
{
    return $this->belongsTo(ServiceRequest::class);
}

public function equipmentDetail()
{
    return $this->hasOne(EquipmentDetail::class);
}

public function webPageDetail()
{
    return $this->hasOne(WebPageDetail::class);
}

public function transparencyDetail()
{
    return $this->hasOne(TransparencyDetail::class);
}



========================================================================================================0
EquipmentDetail, WebPageDetail

public function item()
{
    return $this->belongsTo(ServiceRequestItem::class, 'service_request_item_id');
}


========================================================================================================0

php artisan make:controller ServiceRequestController --resource
php artisan make:controller ServiceRequestItemController --resource



========================================================================================================0

creacion de una lista de  de inventario para poder agregar grupo de pc de inventario

invgruop


========================================================================================================0

Quiero que en el componente Livewire [NombreDelComponente] y su vista, muestres los datos de las llaves foráneas igual que en InvGroup, es decir, cargando las relaciones necesarias en la consulta con with(['owner', 'responsible']) y mostrando los datos en la vista usando $modelo->owner?->name y $modelo->responsible?->name.
O más corto:
> Haz que en el componente [NombreDelComponente] y su vista, se muestren los datos de las llaves foráneas igual que en InvGroup (usando with(['owner', 'responsible']) y accediendo a los datos en la vista como en inv-group.blade.php).


========================================================================================================
actualizar en el server el commit

git push origin master

alias gitup

========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================






























