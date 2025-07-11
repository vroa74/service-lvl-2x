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


    public function mostrarQr($item)
    {
        $ni = preg_replace('/[^a-zA-Z0-9]/', '_', $item->ni);
        $filename = "qr_{$ni}.png";
        $path = public_path("qr/{$filename}");

        $wasJustRegenerated = isset($this->qrTimestamps[$item->ni]);

        // ⚠️ NO retornes base64 nunca más
        if (file_exists($path) && !$wasJustRegenerated) {
            return [
                'src' => asset("qr/{$filename}"),
                'from_file' => true,
            ];
        }

        // 🔁 Siempre guarda en disco, y retorna la URL
        return [
            'src' => $this->getQrCode($item),
            'from_file' => false,
        ];
    }


//----------------------------------------------------------------------------------------------------------------------
    protected $listeners = ['qrRegenerado' => 'regenerateQrTimestamp'];

//----------------------------------------------------------------------------------------------------------------------
    public function regenerateQrTimestamp($ni)
    {
        $this->qrTimestamps[$ni] = now()->timestamp;
    }

//----------------------------------------------------------------------------------------------------------------------
    public $qrTimestamps = [];

    public function regenerarQr($ni)
    {
        $item = Inventory::where('ni', $ni)->first();

        if (!$item) return;

        $filename = 'qr_' . preg_replace('/[^a-zA-Z0-9]/', '_', $ni) . '.png';
        $path = public_path("qr/{$filename}");

        if (file_exists($path)) {
            unlink($path); // eliminar QR viejo
        }

        $this->getQrCode($item);
        $this->regenerateQrTimestamp($ni);
    }

//----------------------------------------------------------------------------------------------------------------------
### creacion de QR

    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Label\Label;
    use Endroid\QrCode\Logo\Logo;
    use Endroid\QrCode\RoundBlockSizeMode;
    use Endroid\QrCode\Writer\ValidationException;




    public $data;

    public function getQrCode($data)
    {
        if (empty($data)) {
            return null;
        }

        $datos = is_array($data) || is_object($data) ? json_encode($data) : (string)$data;
        $decoded = json_decode($datos, true);
        $name = $decoded['ni'] ?? 'SinNombre';

        $qrText = 'ID: ' . ($decoded['id'] ?? '') . "\n";
        $qrText .= 'Dir: ' . ($decoded['dir'] ?? '') . "\n";
        $qrText .= 'Resguardante: ' . ($decoded['resguardante'] ?? '') . "\n";
        $qrText .= 'NI: ' . ($decoded['ni'] ?? '') . "\n";
        $qrText .= 'Artículo: ' . ($decoded['articulo'] ?? '') . "\n";
        $qrText .= 'Marca: ' . ($decoded['marca'] ?? '') . "\n";
        $qrText .= 'Modelo: ' . ($decoded['modelo'] ?? '') . "\n";
        $qrText .= 'NS: ' . ($decoded['ns'] ?? '') . "\n";
        $qrText .= 'By L.I. Victor Román Ortiz Abreu, MDIS & MCCC';

        try {
            $qrCode = new QrCode(
                data: $qrText,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 20,
                roundBlockSizeMode: RoundBlockSizeMode::None,
                foregroundColor: new Color(0, 0, 255),
                backgroundColor: new Color(255, 255, 255)
            );
            // 🔳 LOGO con fondo blanco
            $logo = null;
            $logonameico = 'favicon.png';
            $ico = random_int(0, 6);
            switch ($ico) {
                case 0:
                    $logonameico = 'favicon.png';
                    break;
                case 1:
                    $logonameico = 'favicon1.png';
                    break;
                case 2:
                    $logonameico = 'favicon2.png';
                    break;
                case 3:
                    $logonameico = 'favicon3.png';
                    break;
                case 4:
                    $logonameico = 'favicon4.png';
                    break;
                case 5:
                    $logonameico = 'favicon5.png';
                    break;
                case 5:
                    $logonameico = 'favicon6.png';
                    break;
                default:
                    $logonameico = 'favicon.png';
                    break;
                }
                                            
            $logoPath = public_path($logonameico);
            if (file_exists($logoPath)) {
                $logoImage = imagecreatefrompng($logoPath);
                $width = imagesx($logoImage);
                $height = imagesy($logoImage);
                $background = imagecreatetruecolor($width, $height);
                $white = imagecolorallocate($background, 255, 255, 255);
                imagefilledrectangle($background, 0, 0, $width, $height, $white);
                imagecopy($background, $logoImage, 0, 0, 0, 0, $width, $height);

                $tempLogoPath = storage_path('app/temp_logo_with_bg.png');
                imagepng($background, $tempLogoPath);
                imagedestroy($logoImage);
                imagedestroy($background);
                $logo = new Logo($tempLogoPath, 75);
            }

            // 🏷️ LABEL con texto
            $label = new Label($name, textColor: new Color(255, 30, 30));
            $writer = new PngWriter();
            $result = $writer->write($qrCode, $logo, $label);

            // 🗂️ Guardar imagen en disco (public/qr)
            $filename = 'qr_' . preg_replace('/[^a-zA-Z0-9]/', '_', $name) . '.png';
            $fullPath = public_path('qr/' . $filename);

            if (!file_exists(public_path('qr'))) {
                mkdir(public_path('qr'), 0755, true);
            }

            file_put_contents($fullPath, $result->getString());

            // ✅ Retornar URL pública del QR
            return asset('qr/' . $filename);

        } catch (\Exception $e) {
            \Log::error('Error generando QR: ' . $e->getMessage());
            return null;
        }
    }



========================================================================================================

cartas resposivas

php artisan make:model Responsiva -m
php artisan make:model InventoryResponsiva -m
php artisan make:model InventoryPhoto -m

 pa make:livewire cartasresponsivas.create 
========================================================================================================

divide el total de la pagina en 3 columnas en la primera que deben del mismo tamaño var a pones el formulario actual la segunda y la tercera estaran pendiente.@Create.php @create.blade.php 

========================================================================================================

php artisan make:livewire cartasresponsivas.edit
php artisan make:livewire cartasresponsivas.show



========================================================================================================
php artisan make:model OldInventy -mcr
php artisan migrate --force

========================================================================================================
junto al input inserta un boton que cuando se presione verifique que en la tabla user solo tenga un registro y en la tablas inventory todos los registroe que se muestren tengan el mismo dato en el campos resguardante, su pasa esas 2 condiciones de la tabla inventory cambiara el valor de user_id y res_id por el id que este omo unico campo en la tabla user  antes de hacer esto con un mensaje de sweetaler2 que se van hacer calbion en la tabla inventory si en sweetalert2 presionan si o caceptar los cambios se aplicaran si ponen no o cancelar no se hara nada cuando termine mandara un mensaje que disga los cambion se han aplicado si es que aceptaron hacer los cambios en caso contrario manda un mensaje que los cambion fueron cancelados


========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================



========================================================================================================






























