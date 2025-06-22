<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
                
        User::factory()->create([
            'name' => 'DALILA DEL CARMEN MATA PEREZ',
            'email' => 'NEIM@altinbox.net',
            'rfc' => 'NEIM759401JIS',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NEIM354479GSMOII59')
        ]);
        
        User::factory()->create([
            'name' => 'ENA AMERICA GARCIA GARCIA',
            'email' => 'CRIM@skyemail.net',
            'rfc' => 'CRIM594027UDT',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('CRIM778543HOBATU03')
        ]);
        
        User::factory()->create([
            'name' => 'MAYDA ARACELY MAS TUN',
            'email' => 'YNMT@myinbox.net',
            'rfc' => 'YNMT964512RXP',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('YNMT375837MUNLJU11')
        ]);
        
        User::factory()->create([
            'name' => 'GLADYS SOFIA RIVERA LOPEZ',
            'email' => 'FSDA@hotmail.com',
            'rfc' => 'FSDA278068JSS',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('FSDA397356BBOGCJ23')
        ]);
        
        User::factory()->create([
            'name' => 'VERONICA MARGARITA ROCA MENDEZ',
            'email' => 'DMTG@mailxpress.org',
            'rfc' => 'DMTG965971UMB',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DMTG386377TCVDKP95')
        ]);
        
        User::factory()->create([
            'name' => 'FRANCISCA ZARATE LOPEZ',
            'email' => 'PZTO@yahoo.com',
            'rfc' => 'PZTO066253ERW',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('PZTO158522QNLYVZ41')
        ]);
        
        User::factory()->create([
            'name' => 'DIANA LUISA AGUILAR RUELAS',
            'email' => 'NRDE@letterbox.org',
            'rfc' => 'NRDE175885HCQ',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NRDE523003HQXBTE16')
        ]);
        
        User::factory()->create([
            'name' => 'TANIA DOMINGUEZ FERNANDEZ',
            'email' => 'FNTZ@gmail.com',
            'rfc' => 'FNTZ918460SMV',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('FNTZ782102TZTXAU46')
        ]);
        
        User::factory()->create([
            'name' => 'TANIA GONZALEZ PEREZ',
            'email' => 'GIEN@gmail.com',
            'rfc' => 'GIEN559288IKD',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GIEN648806SMCRJL14')
        ]);
        
        User::factory()->create([
            'name' => 'DELMA DEL CARMEN RABELO CUEVAS',
            'email' => 'VAMC@gmail.com',
            'rfc' => 'VAMC902966XYD',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('VAMC334539OWJLFR81')
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DEL ROSARIO CRUZ HERNANDEZ',
            'email' => 'ZODE@blazemail.co',
            'rfc' => 'ZODE825851CQX',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZODE001352GHWYEQ78')
        ]);
        
        User::factory()->create([
            'name' => 'ANA MARIA LOPEZ HERNANDEZ',
            'email' => 'OZIL@zoho.com',
            'rfc' => 'OZIL832729WSU',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OZIL511637HXPTBH16')
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DEL CARMEN AVALOS TRUJILLO',
            'email' => 'RJTI@myinbox.net',
            'rfc' => 'RJTI789493HWS',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RJTI538412MFPHIZ98')
        ]);
        
        User::factory()->create([
            'name' => 'HIPSI MARISOL ESTRELLA GUILLERMO',
            'email' => 'SOPU@securemailbox.org',
            'rfc' => 'SOPU879998WUU',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SOPU469508TTLSYR24')
        ]);
        
        User::factory()->create([
            'name' => 'MONICA FERNANDEZ MONTUFAR',
            'email' => 'TUCN@hey.com',
            'rfc' => 'TUCN902278ZDA',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TUCN430005SSIIZJ82')
        ]);
        
        User::factory()->create([
            'name' => 'MARICELA FLORES MOO',
            'email' => 'EORL@fusionmail.cc',
            'rfc' => 'EORL167920GAW',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EORL243002XYSBZI39')
        ]);
        
        User::factory()->create([
            'name' => 'ABIGAIL GUTIERREZ MORALES',
            'email' => 'SUIO@runbox.com',
            'rfc' => 'SUIO035797XFO',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SUIO333406FPLOOB01')
        ]);
        
        User::factory()->create([
            'name' => 'BALBINA ALEJANDRA HIDALGO ZAVALA',
            'email' => 'OJLE@epicmail.com',
            'rfc' => 'OJLE935645TVA',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OJLE869042FXTSGU48')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE ANTONIO JIMENEZ GUTIERREZ',
            'email' => 'IZUR@digitmail.xyz',
            'rfc' => 'IZUR024958YHJ',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IZUR757674ZUFPNU92')
        ]);
        
        User::factory()->create([
            'name' => 'JORGE PEREZ FALCONI',
            'email' => 'RLOZ@gmx.com',
            'rfc' => 'RLOZ252445JQQ',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RLOZ168974FAPDDI84')
        ]);
        
        User::factory()->create([
            'name' => 'ISMAEL LOPEZ GARCES',
            'email' => 'ZLMS@yandex.com',
            'rfc' => 'ZLMS615192ZSD',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZLMS231343FQBFAI34')
        ]);
        
        User::factory()->create([
            'name' => 'GASPAR DE JESUS NAH MISS',
            'email' => 'HJPD@netpostbox.com',
            'rfc' => 'HJPD319014JUY',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('HJPD224214TPJXPS03')
        ]);
        
        User::factory()->create([
            'name' => 'DAHER ANTONIO PUCH RIVERA',
            'email' => 'AUPR@protonmail.com',
            'rfc' => 'AUPR342417RXV',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('AUPR838121DMPVIQ91')
        ]);
        
        User::factory()->create([
            'name' => 'OMAR ALBERTO TALANGO CERVANTES',
            'email' => 'LCRM@posteo.net',
            'rfc' => 'LCRM658871PQX',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LCRM711864OXLOMI40')
        ]);
        
        User::factory()->create([
            'name' => 'CARLOS ENRIQUE UCAN YAM',
            'email' => 'ROYM@neonmail.biz',
            'rfc' => 'ROYM938352RDP',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ROYM013766GQVGQZ87')
        ]);
        
        User::factory()->create([
            'name' => 'PEDRO ARMENTIA LOPEZ',
            'email' => 'RNPL@airmail.cc',
            'rfc' => 'RNPL186506ZQQ',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RNPL113381YKAIBK07')
        ]);
        
        User::factory()->create([
            'name' => 'ALDO ROMAN CONTRERAS UC',
            'email' => 'MOSR@gmail.com',
            'rfc' => 'MOSR664648MUY',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MOSR652063QGZWUC18')
        ]);
        
        User::factory()->create([
            'name' => 'PEDRO HERNANDEZ MACDONALD',
            'email' => 'REON@warpbox.com',
            'rfc' => 'REON593847YLV',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('REON753452EYTPLY60')
        ]);
        
        User::factory()->create([
            'name' => 'IGNACIO JOSE MUÑOZ HERNANDEZ',
            'email' => 'ÑJDO@hotmail.com',
            'rfc' => 'ÑJDO977555DIN',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ÑJDO651698FVMJGK26')
        ]);
        
        User::factory()->create([
            'name' => 'JORGE SALIM ABRAHAM QUIJANO',
            'email' => 'ABLQ@tutanota.com',
            'rfc' => 'ABLQ018247GIA',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ABLQ817803LLNZKG74')
        ]);
        
        User::factory()->create([
            'name' => 'MIGUEL ANGEL POOL ALPUCHE',
            'email' => 'MCEP@fusionmail.cc',
            'rfc' => 'MCEP598027JGX',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MCEP135353BGVEPD02')
        ]);
        
        User::factory()->create([
            'name' => 'JHOSUE JESUS RODRIGUEZ GOLIB',
            'email' => 'OJUD@outlook.com',
            'rfc' => 'OJUD672622VDB',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OJUD381662FJCYKX50')
        ]);
        
        User::factory()->create([
            'name' => 'ANDRES FERNANDEZ DEL VALLE LAISEQUILLA',
            'email' => 'EQVU@openmailbox.org',
            'rfc' => 'EQVU481017UNF',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EQVU603551MNLEYV34')
        ]);
        
        User::factory()->create([
            'name' => 'PAUL ALFREDO ARCE ONTIVEROS',
            'email' => 'ENAL@digitmail.xyz',
            'rfc' => 'ENAL777959UAS',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ENAL732487AZONEP97')
        ]);
        
        User::factory()->create([
            'name' => 'ELIAS NOE BAEZA AKE',
            'email' => 'LESN@epicmail.com',
            'rfc' => 'LESN636223FON',
            'direction' => 'CONGRESO DEL ESTADO',
            'position' => 'DIPUTADO',
            'sex' => 'masculino',
            'lvl' => '1',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LESN687178BNDJOO33')
        ]);
        
        User::factory()->create([
            'name' => 'ALEJANDRO MOO CERVERA',
            'email' => 'RDJC@skyemail.net',
            'rfc' => 'RDJC678331BCR',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'SECRETARIO GENERAL',
            'sex' => 'masculino',
            'lvl' => '2',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RDJC044808JVLXFL24')
        ]);
        
        User::factory()->create([
            'name' => 'OSCAR JOSUE MUÑOZ SIMA',
            'email' => 'MESC@safeinbox.net',
            'rfc' => 'MESC104791RPS',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'TITULAR ORGANO INTERNO DE CONTROL',
            'sex' => 'masculino',
            'lvl' => '2',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MESC792238GIBIXT53')
        ]);
        
        User::factory()->create([
            'name' => 'ANA ELISA VARGAS ROSADO',
            'email' => 'EAVN@cybermail.io',
            'rfc' => 'EAVN856602CWY',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'ASESOR',
            'sex' => 'masculino',
            'lvl' => '3',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EAVN402147UJHUSM63')
        ]);
        
        User::factory()->create([
            'name' => 'IVÁN ALEJANDRO   ARA ANGULO',
            'email' => 'ADVN@airmail.cc',
            'rfc' => 'ADVN544620REX',
            'direction' => 'DIRECCIÓN DE ARCHIVO LEGISLATIVO',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ADVN848670ZBQQKZ95')
        ]);
        
        User::factory()->create([
            'name' => 'SERGIO MANUEL VEGA CARRILLO',
            'email' => 'LSOV@runbox.com',
            'rfc' => 'LSOV098898NIQ',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LSOV754055ZLOEDB10')
        ]);
        
        User::factory()->create([
            'name' => 'IVAN ALEJANDRO ARA ANGULO',
            'email' => 'OUNJ@mailplan.io',
            'rfc' => 'OUNJ082021OUY',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OUNJ962882KMKETG04')
        ]);
        
        User::factory()->create([
            'name' => 'GILBERTO REYES CUEVAS',
            'email' => 'ILST@safeinbox.net',
            'rfc' => 'ILST701388QBY',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ILST592351JDIVDA34')
        ]);
        
        User::factory()->create([
            'name' => 'FRANCISCO JULIAN TAMAY CHI',
            'email' => 'IJFR@yandex.com',
            'rfc' => 'IJFR533152CCH',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IJFR265338KFLUKC25')
        ]);
        
        User::factory()->create([
            'name' => 'JORGE ANTONIO BAZAN ZUBELDIA',
            'email' => 'ZJIN@aol.com',
            'rfc' => 'ZJIN361938UED',
            'direction' => 'UNIDAD DE TRANSPARENCIA',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZJIN942336TRXJYS65')
        ]);
        
        User::factory()->create([
            'name' => 'ADRIANA GEORGINA SANDOVAL MARTINEZ',
            'email' => 'VZMI@disroot.org',
            'rfc' => 'VZMI490203KGG',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('VZMI417121WRHVOK97')
        ]);
        
        User::factory()->create([
            'name' => 'NESTOR MAURICIO BARRERA ESQUIVEL',
            'email' => 'TEAN@epicmail.com',
            'rfc' => 'TEAN767381FNA',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TEAN381842GSNDOQ75')
        ]);
        
        User::factory()->create([
            'name' => 'SONIA ALEJANDRA CASTILLO PERALTA',
            'email' => 'JCRS@darkmail.xyz',
            'rfc' => 'JCRS779319RMT',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('JCRS583928GIKIDZ07')
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DE LOS ANGELES ZAMORA MAYA',
            'email' => 'SGLI@aol.com',
            'rfc' => 'SGLI900475EXS',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SGLI035467IHECKG77')
        ]);
        
        User::factory()->create([
            'name' => 'MINERVA GUADALUPE REJON MENA',
            'email' => 'JLVD@zoho.com',
            'rfc' => 'JLVD586841HKV',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('JLVD955568ZCKSEL00')
        ]);
        
        User::factory()->create([
            'name' => 'KAREN VIETMEIER CAHUICH',
            'email' => 'KMHU@gmx.com',
            'rfc' => 'KMHU263943TEE',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('KMHU242816XFHXOV53')
        ]);
        
        User::factory()->create([
            'name' => 'MIGUEL GONZALEZ FLORES',
            'email' => 'LRMF@airmail.cc',
            'rfc' => 'LRMF970224RVJ',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LRMF581146EAYSZM58')
        ]);
        
        User::factory()->create([
            'name' => 'RUBEN EDUARDO JIMENEZ JUAREZ',
            'email' => 'DURZ@safeinbox.net',
            'rfc' => 'DURZ659430JFH',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DURZ102283CGWNMP61')
        ]);
        
        User::factory()->create([
            'name' => 'MARITZA DEL CARMEN ARCOS CRUZ',
            'email' => 'TORS@skyemail.net',
            'rfc' => 'TORS972603XYV',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TORS868980YYKLDG04')
        ]);
        
        User::factory()->create([
            'name' => 'IRLANDA JAQUELINE FIERROS BOJORQUEZ',
            'email' => 'IFUJ@driftmail.net',
            'rfc' => 'IFUJ870298GPY',
            'direction' => 'JUNTA DE GOBIERNO Y ADMINISTRACIÓN',
            'position' => 'DIRECTOR',
            'sex' => 'masculino',
            'lvl' => '4',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IFUJ596632PLRLZZ82')
        ]);
        
        User::factory()->create([
            'name' => 'EMILIO RODRIGUEZ HERRERA',
            'email' => 'MGHD@aol.com',
            'rfc' => 'MGHD582157WHF',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MGHD108866VVEUAX40')
        ]);
        
        User::factory()->create([
            'name' => 'EMMANUEL JESUS TURRIZA AGUILAR',
            'email' => 'ZITJ@gmail.com',
            'rfc' => 'ZITJ817719SEH',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZITJ034735IMQNRW74')
        ]);
        
        User::factory()->create([
            'name' => 'ANDRES DE JESUS ALEJANDRE RODRIGUEZ',
            'email' => 'IZDR@stormmail.net',
            'rfc' => 'IZDR897507UNX',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IZDR048752EVDOYR76')
        ]);
        
        User::factory()->create([
            'name' => 'BENJAMIN PINZON QUINTANA',
            'email' => 'OPZA@zoho.com',
            'rfc' => 'OPZA714459UCN',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OPZA389921HVIRSZ55')
        ]);
        
        User::factory()->create([
            'name' => 'LAURA NOEMI UC NAAL',
            'email' => 'ELUN@hotmail.com',
            'rfc' => 'ELUN457103SQH',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ELUN719576AJNMFH68')
        ]);
        
        User::factory()->create([
            'name' => 'SONIA DE LA LUZ ALPUCHE SIERRA',
            'email' => 'IDZR@invisimail.org',
            'rfc' => 'IDZR394383PAU',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IDZR255314XRMJMP76')
        ]);
        
        User::factory()->create([
            'name' => 'MADELEYNE DE LOS ANGELES ACEVEDO PEREZ',
            'email' => 'DEPL@nightpost.io',
            'rfc' => 'DEPL669838LGD',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DEPL169207HAJMPR24')
        ]);
        
        User::factory()->create([
            'name' => 'GENESIS BELEN CASTILLO MAAS',
            'email' => 'MTBS@gmx.com',
            'rfc' => 'MTBS979126EOA',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MTBS173139AXICWB61')
        ]);
        
        User::factory()->create([
            'name' => 'ANDRES ALBERTO CHAN COUOH',
            'email' => 'ATSB@digitmail.xyz',
            'rfc' => 'ATSB048690EZG',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ATSB162699FWDQUP33')
        ]);
        
        User::factory()->create([
            'name' => 'MARIO ENRIQUE MORENO RAMOS',
            'email' => 'NMUO@zoho.com',
            'rfc' => 'NMUO777679ZBV',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NMUO791185HFZCPY46')
        ]);
        
        User::factory()->create([
            'name' => 'ELIUD JOKSAN RIOS MANZANILLA',
            'email' => 'ADKJ@tutanota.com',
            'rfc' => 'ADKJ802517NLS',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ADKJ069227PDHUOS47')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE LUIS SANSORES PEREZ',
            'email' => 'JPRI@bubblemail.org',
            'rfc' => 'JPRI622547MEI',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('JPRI178228MZCYFH37')
        ]);
        
        User::factory()->create([
            'name' => 'JHONI ARMANDO PULIDO YAH',
            'email' => 'ANOP@waveboxmail.com',
            'rfc' => 'ANOP911940BCV',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ANOP761951LAOZML61')
        ]);
        
        User::factory()->create([
            'name' => 'KERREL DICLAUDIA VILLARINO PERERA',
            'email' => 'EODU@gmx.com',
            'rfc' => 'EODU893581RSL',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EODU537866HIWXPK84')
        ]);
        
        User::factory()->create([
            'name' => 'RUSBY AZUL DAMIAN PLASCENCIA',
            'email' => 'ABNY@tutanota.com',
            'rfc' => 'ABNY350852RYG',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ABNY634289XHHKAN83')
        ]);
        
        User::factory()->create([
            'name' => 'JULIA ESPERANZA RUIZ CASTELLOT',
            'email' => 'ILCU@nightpost.io',
            'rfc' => 'ILCU229294INN',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ILCU901825AIFXXP20')
        ]);
        
        User::factory()->create([
            'name' => 'MARIA GUADALUPE CORINA POZOS LANZ',
            'email' => 'DALO@posteo.net',
            'rfc' => 'DALO984650NHZ',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'SUBDIRECTOR',
            'sex' => 'masculino',
            'lvl' => '5',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DALO137217SFCQHA02')
        ]);
        
        User::factory()->create([
            'name' => 'GUADALUPE DEL SOCORRO SOSA HUCHIN',
            'email' => 'DLOU@yandex.com',
            'rfc' => 'DLOU277241BWJ',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DLOU626240HLJWSS73')
        ]);
        
        User::factory()->create([
            'name' => 'SILVIA DEL CARMEN KUMUL MENDOZA',
            'email' => 'DMKO@gmail.com',
            'rfc' => 'DMKO426952DSN',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DMKO348350NSLXMR81')
        ]);
        
        User::factory()->create([
            'name' => 'JUAN DIAZ ORTEGA',
            'email' => 'JDTZ@fusionmail.cc',
            'rfc' => 'JDTZ135341GQP',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('JDTZ590470WPJIWC63')
        ]);
        
        User::factory()->create([
            'name' => 'LAURA DEL CARMEN GUERRERO GARCIA',
            'email' => 'DLAN@mailxpress.org',
            'rfc' => 'DLAN505802RYG',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DLAN100425NCFBRW42')
        ]);
        
        User::factory()->create([
            'name' => 'FLOR DE MARIA GUADALUPE COLLI EK',
            'email' => 'UCAG@hey.com',
            'rfc' => 'UCAG480056UEL',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UCAG885968UILLOI03')
        ]);
        
        User::factory()->create([
            'name' => 'LYDIA MARGARITA CORTEZ ZUBIETA',
            'email' => 'LRZA@fastmail.com',
            'rfc' => 'LRZA041509UKK',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LRZA794885UGLKHS05')
        ]);
        
        User::factory()->create([
            'name' => 'NYLDA MARIA JONGUITUD PEREZ',
            'email' => 'APYU@digitmail.xyz',
            'rfc' => 'APYU615788QNE',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('APYU728692QXMQAG40')
        ]);
        
        User::factory()->create([
            'name' => 'ROBERTO EDUARDO CARRILLO GONZALEZ',
            'email' => 'TZNA@zonemail.co',
            'rfc' => 'TZNA639351CLG',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TZNA011096YEDVOI83')
        ]);
        
        User::factory()->create([
            'name' => 'JOSUE DAVID CASTILLO',
            'email' => 'OEID@letterbox.org',
            'rfc' => 'OEID421588GWC',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OEID365256DZYYEI61')
        ]);
        
        User::factory()->create([
            'name' => 'VICTOR ROMAN ORTIZ ABREU',
            'email' => 'vroa74@gmail.com',
            'rfc' => 'VRAB839549LQG',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 1,
            'status' => true,
            'password' => Hash::make('Campeche1974.')
        ]);
        
        User::factory()->create([
            'name' => 'GLORIA DEL ROSARIO JIMENEZ CUPUL',
            'email' => 'ERLP@netpostbox.com',
            'rfc' => 'ERLP653974AGH',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ERLP350852SLUNVX53')
        ]);
        
        User::factory()->create([
            'name' => 'LAURA DEL JESUS COLLI AKE',
            'email' => 'KEJA@zonemail.co',
            'rfc' => 'KEJA783925PMN',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('KEJA337538DJVMPC22')
        ]);
        
        User::factory()->create([
            'name' => 'GLADYS MARGARITA GRAMAJO PIEDRASANTA',
            'email' => 'PNGI@mailfence.com',
            'rfc' => 'PNGI891120YGG',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('PNGI301302CNGXYY93')
        ]);
        
        User::factory()->create([
            'name' => 'JAVIER DAVID ROMERO TUN',
            'email' => 'RJAM@mail.com',
            'rfc' => 'RJAM017399PMX',
            'direction' => 'DIRECCIÓN DE APOYO PARLAMENTARIO',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RJAM833368KOHNKD95')
        ]);
        
        User::factory()->create([
            'name' => 'RAFAEL ARMANDO DZIB AVILA',
            'email' => 'AVED@protonmail.com',
            'rfc' => 'AVED437202CLZ',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('AVED501506BJDQEM40')
        ]);
        
        User::factory()->create([
            'name' => 'ROMAN LEON HERRERA',
            'email' => 'NRMO@openmailbox.org',
            'rfc' => 'NRMO238884NTQ',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NRMO639898VAWDTE23')
        ]);
        
        User::factory()->create([
            'name' => 'VICTOR HUGO ZAMORANO RUIZ',
            'email' => 'ZICR@mailxpress.org',
            'rfc' => 'ZICR465268ZHG',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZICR917242NGLMNE64')
        ]);
        
        User::factory()->create([
            'name' => 'GERARDO DANIEL MUÑOZ CHAN',
            'email' => 'NOEG@gmx.com',
            'rfc' => 'NOEG235453ZXI',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NOEG853976ZSGXDF17')
        ]);
        
        User::factory()->create([
            'name' => 'JORGE ALBERTO XOOL VILLARREAL',
            'email' => 'LXAR@mail.com',
            'rfc' => 'LXAR253727ZHM',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'JEFE DE DEPARTAMENTO',
            'sex' => 'masculino',
            'lvl' => '7',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LXAR188251MKJWOX27')
        ]);
        
        User::factory()->create([
            'name' => 'ADDA MARISOL RAMOS TORRES',
            'email' => 'LSIM@neonmail.biz',
            'rfc' => 'LSIM159219LNB',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LSIM012054QHWLWC87')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE MANUEL HERNANDEZ VALLE',
            'email' => 'LZNE@securemailbox.org',
            'rfc' => 'LZNE508520TKH',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LZNE445848ZXBKJB72')
        ]);
        
        User::factory()->create([
            'name' => 'CLAUDIA MARIELA CAN VAZQUEZ',
            'email' => 'VNQC@darkmail.xyz',
            'rfc' => 'VNQC169006JYP',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('VNQC136797AGGJIH88')
        ]);
        
        User::factory()->create([
            'name' => 'RICARDO FRANCISCO RODRIGUEZ CERVERA',
            'email' => 'OSIN@startmail.com',
            'rfc' => 'OSIN572680AZT',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OSIN308715AEZTZG71')
        ]);
        
        User::factory()->create([
            'name' => 'TERESITA DE JESUS DELGADO NOVELO',
            'email' => 'OVIA@aol.com',
            'rfc' => 'OVIA425096QGV',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OVIA620399GUUXXM39')
        ]);
        
        User::factory()->create([
            'name' => 'JONHNI ABRAHAM BUZON VERA',
            'email' => 'EIMO@mailplan.io',
            'rfc' => 'EIMO042602OSI',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EIMO901167SPRTNN26')
        ]);
        
        User::factory()->create([
            'name' => 'LILIA MARGARITA PEREZ CAAMAL',
            'email' => 'ZALG@safeinbox.net',
            'rfc' => 'ZALG752261ZRQ',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZALG147676DWNLXM40')
        ]);
        
        User::factory()->create([
            'name' => 'EDUARDO MARTIN VERA REYES',
            'email' => 'STDR@mail.com',
            'rfc' => 'STDR599372LUP',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('STDR053364EWDXLN92')
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL FRANCISCO SOSA HUICAB',
            'email' => 'FORM@aol.com',
            'rfc' => 'FORM957522SKZ',
            'direction' => 'DIRECCIÓN DE INFORMÁTICA',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('FORM933248YVXGUY25')
        ]);
        
        User::factory()->create([
            'name' => 'LUIS FERNANDO ALAYOLA MOO',
            'email' => 'DYFR@stormmail.net',
            'rfc' => 'DYFR000900CZL',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DYFR291161VAFZKO32')
        ]);
        
        User::factory()->create([
            'name' => 'ANA LILIA HERRERA CHI',
            'email' => 'NIEL@darkmail.xyz',
            'rfc' => 'NIEL638342SSA',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NIEL439434GJSQEO72')
        ]);
        
        User::factory()->create([
            'name' => 'ROXANA YOMARA SOLIS GARRIDO',
            'email' => 'RGYL@netpostbox.com',
            'rfc' => 'RGYL079889IRU',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RGYL710614KOMTVW33')
        ]);
        
        User::factory()->create([
            'name' => 'PATRICIA DEL CARMEN HERNANDEZ BAAS',
            'email' => 'RHCB@runbox.com',
            'rfc' => 'RHCB936765CMU',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RHCB115480NQINDU89')
        ]);
        
        User::factory()->create([
            'name' => 'LETICIA DE MONSERRAT LARA GUERRERO',
            'email' => 'GTDU@fastmail.com',
            'rfc' => 'GTDU133544WLZ',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GTDU303999HAQSAM35')
        ]);
        
        User::factory()->create([
            'name' => 'HUGO DANIEL MORA CASANOVA',
            'email' => 'MOAS@myinbox.net',
            'rfc' => 'MOAS767307HEX',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MOAS138826NWSALA23')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE ISRAEL LUNA ARJONA',
            'email' => 'IOJS@invisimail.org',
            'rfc' => 'IOJS810984FSI',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IOJS388361WBNULM96')
        ]);
        
        User::factory()->create([
            'name' => 'LUISA DEL ROSARIO GUERRERO GARCIA',
            'email' => 'DLEA@waveboxmail.com',
            'rfc' => 'DLEA128199DDQ',
            'direction' => 'UNIDAD DE TRANSPARENCIA',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DLEA698896LKMYPC57')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE DEL CARMEN MARTINEZ NUÑEZ',
            'email' => 'LOCJ@altinbox.net',
            'rfc' => 'LOCJ008219URF',
            'direction' => 'ÓRGANO INTERNO DE CONTROL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LOCJ976464ALOURU46')
        ]);
        
        User::factory()->create([
            'name' => 'EDUARDO MARTIN SOBERANIS MONTALVO',
            'email' => 'LVBE@posteo.net',
            'rfc' => 'LVBE878006HJG',
            'direction' => 'DIRECCIÓN DE ARCHIVO DEL PODER LEGISLATIVO',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LVBE615858WKRLTZ43')
        ]);
        
        User::factory()->create([
            'name' => 'FRYNE DEL SOCORRO CRUZ YERBES',
            'email' => 'ZNDL@gmail.com',
            'rfc' => 'ZNDL753369NPM',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZNDL042819RTTTLC37')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE FERNANDO PUC YE',
            'email' => 'UFRE@fusionmail.cc',
            'rfc' => 'UFRE462522HRM',
            'direction' => 'SECRETARÍA GENERAL',
            'position' => 'ANALISTA ESPECIALIZADO',
            'sex' => 'masculino',
            'lvl' => '8',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UFRE918478NKQWRA26')
        ]);
        
        User::factory()->create([
            'name' => 'ENRIQUE HUMBERTO LARA PARRAO',
            'email' => 'BHQN@cybermail.io',
            'rfc' => 'BHQN725138UDB',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('BHQN634406PMAFRH50')
        ]);
        
        User::factory()->create([
            'name' => 'ROCIO VERONICA UC MASS',
            'email' => 'MUSC@bubblemail.org',
            'rfc' => 'MUSC559896MPI',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MUSC057230DFLFLU34')
        ]);
        
        User::factory()->create([
            'name' => 'CHRISTIAN ALEXANDER BE PECH',
            'email' => 'IETA@fusionmail.cc',
            'rfc' => 'IETA813851TUJ',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IETA897041UGDRPD95')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE EDUARDO CHAVARRIA SOLER',
            'email' => 'HJIA@zonemail.co',
            'rfc' => 'HJIA363833AAD',
            'direction' => 'SECRETARÍA TÉCNICA',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('HJIA161393BJVFXE76')
        ]);
        
        User::factory()->create([
            'name' => 'LIGIA DEL JESUS SEGOVIA PRESUEL',
            'email' => 'ELAV@aol.com',
            'rfc' => 'ELAV234511FIS',
            'direction' => 'DIRECCIÓN DE GESTIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ELAV050238WLGSMQ33')
        ]);
        
        User::factory()->create([
            'name' => 'HENRY RENE TUZ BALAN',
            'email' => 'TYUZ@neonmail.biz',
            'rfc' => 'TYUZ986059NYV',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TYUZ598486TFAHWU89')
        ]);
        
        User::factory()->create([
            'name' => 'PERLA LETICIA YAN QUIJANO',
            'email' => 'NCER@fusionmail.cc',
            'rfc' => 'NCER657490CRS',
            'direction' => 'DIRECCION DE CONTROL DE PROCESOS LEGISLATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NCER106316CYDEMP38')
        ]);
        
        User::factory()->create([
            'name' => 'LAURA MARTINA ZAPATA ARCHIVOR',
            'email' => 'ALUI@hey.com',
            'rfc' => 'ALUI515638DPE',
            'direction' => 'COORDINACIÓN DE ASESORES',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ALUI824538YHDOJX60')
        ]);
        
        User::factory()->create([
            'name' => 'NORMA GUADALUPE CORONEL DIAZ',
            'email' => 'RECO@epicmail.com',
            'rfc' => 'RECO819824YKM',
            'direction' => 'DIRECCIÓN DE COMUNICACIÓN SOCIAL',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RECO725418SMOBDB14')
        ]);
        
        User::factory()->create([
            'name' => 'MARDONIO CARMONA NOLASCO',
            'email' => 'SRLC@securemailbox.org',
            'rfc' => 'SRLC860048TPY',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SRLC511388AWTCQS97')
        ]);
        
        User::factory()->create([
            'name' => 'ALONSO PUC YE',
            'email' => 'YAEC@posteo.net',
            'rfc' => 'YAEC094594VDF',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('YAEC043667NAVAYN22')
        ]);
        
        User::factory()->create([
            'name' => 'BERENICE YANET XOOL VILLARREAL',
            'email' => 'EYRX@fastmail.com',
            'rfc' => 'EYRX924442VCO',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EYRX884061POCYUE18')
        ]);
        
        User::factory()->create([
            'name' => 'ALBA JAEL MOO RAMIREZ',
            'email' => 'REZL@yahoo.com',
            'rfc' => 'REZL037555AAI',
            'direction' => 'DIRECCIÓN DE FINANZAS',
            'position' => 'ANALISTA',
            'sex' => 'masculino',
            'lvl' => '9',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('REZL323547MQFFXX25')
        ]);
        
        User::factory()->create([
            'name' => 'SILVIA VERONICA GONZALEZ MUÑOZ',
            'email' => 'CNIL@openmailbox.org',
            'rfc' => 'CNIL507651GOL',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('CNIL664998ELZXQI21')
        ]);
        
        User::factory()->create([
            'name' => 'MARLENE DE JESUS GRAMAJO PIEDRASANTA',
            'email' => 'NTRL@gmx.com',
            'rfc' => 'NTRL360101CGI',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NTRL346615TVQNMF88')
        ]);
        
        User::factory()->create([
            'name' => 'CARMEN ILIANA PEREZ PUERTO',
            'email' => 'LNCI@aol.com',
            'rfc' => 'LNCI375787FRY',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LNCI215095PXRZRM98')
        ]);
        
        User::factory()->create([
            'name' => 'DANIEL DZIB CANCHE',
            'email' => 'LEZN@airmail.cc',
            'rfc' => 'LEZN098691ZSZ',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LEZN627074PTZQOQ74')
        ]);
        
        User::factory()->create([
            'name' => 'MARCOS ELIAS CHE UC',
            'email' => 'AOIE@letterbox.org',
            'rfc' => 'AOIE455119MJH',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('AOIE511872WRZVWA88')
        ]);
        
        User::factory()->create([
            'name' => 'MIREYA LUCELY RIVERO PEREZ',
            'email' => 'IUZL@cryptomail.io',
            'rfc' => 'IUZL747355MZO',
            'direction' => 'UNIDAD DE TRANSPARENCIA',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IUZL147338TECSFX74')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE LUIS MONTENEGRO CU',
            'email' => 'LTOM@zonemail.co',
            'rfc' => 'LTOM329416BGB',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LTOM901704VIMCJC68')
        ]);
        
        User::factory()->create([
            'name' => 'DAVID AGUILAR ESCAMILLA',
            'email' => 'RGLC@blazemail.co',
            'rfc' => 'RGLC756559YZO',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RGLC978913GZREPF26')
        ]);
        
        User::factory()->create([
            'name' => 'FRANCISCO DEL CARMEN MEZA CAAMAL',
            'email' => 'CNEL@runbox.com',
            'rfc' => 'CNEL911731QAT',
            'direction' => 'DIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',
            'position' => 'JEFE DE GRUPO',
            'sex' => 'masculino',
            'lvl' => '10',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('CNEL652375ZHDCOK53')
        ]);
        
        User::factory()->create([
            'name' => 'ALESSANDRA GUADALUPE MARTINEZ VELA',
            'email' => 'SZDM@driftmail.net',
            'rfc' => 'SZDM270289PIS',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SZDM255149OTURZJ54')
        ]);
        
        User::factory()->create([
            'name' => 'BIANCA GRACIELA CHAN CAB',
            'email' => 'GCAE@yahoo.com',
            'rfc' => 'GCAE762952PGK',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GCAE665072JOXVEJ04')
        ]);
        
        User::factory()->create([
            'name' => 'JULIO CESAR CHAVELAS GUERRERO',
            'email' => 'HSRE@bubblemail.org',
            'rfc' => 'HSRE238275NXA',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('HSRE166858LJBLTS08')
        ]);
        
        User::factory()->create([
            'name' => 'SURI YARELI GUZMAN PECH',
            'email' => 'ACPU@myinbox.net',
            'rfc' => 'ACPU073372ZQC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ACPU352353PRJBBK43')
        ]);
        
        User::factory()->create([
            'name' => 'LEOPOLDO SUTTEN MENDOZA',
            'email' => 'NLPZ@digitmail.xyz',
            'rfc' => 'NLPZ526782MRO',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NLPZ597372OQPRSM77')
        ]);
        
        User::factory()->create([
            'name' => 'FABIAN ZAYD ROQUE MARTINEZ',
            'email' => 'IYRT@startmail.com',
            'rfc' => 'IYRT887410JEN',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IYRT383909ZARDTK73')
        ]);
        
        User::factory()->create([
            'name' => 'LUISA FERNANDA PACHECO VALLADARES',
            'email' => 'DRVO@bubblemail.org',
            'rfc' => 'DRVO969537QJX',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DRVO008914JYJZQX97')
        ]);
        
        User::factory()->create([
            'name' => 'MARLENE SARAI GOMEZ LOPEZ',
            'email' => 'PMRE@epicmail.com',
            'rfc' => 'PMRE472688TWV',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('PMRE158523BCGSPI69')
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL FERNANDO VALLE PINZON',
            'email' => 'APIE@fusionmail.cc',
            'rfc' => 'APIE879177MPJ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('APIE741575RAXJWZ92')
        ]);
        
        User::factory()->create([
            'name' => 'MARIA JOSE DE LOS ANGELES GARCIA DE LA CRUZ',
            'email' => 'ZSJM@nightpost.io',
            'rfc' => 'ZSJM014043TQC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZSJM757048DRWDUM21')
        ]);
        
        User::factory()->create([
            'name' => 'FLOR ILEANA RAMIREZ MAY',
            'email' => 'MFNL@mailfence.com',
            'rfc' => 'MFNL811761ARU',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MFNL724271AAUGDT73')
        ]);
        
        User::factory()->create([
            'name' => 'BLANCA LETICIA MIJARES ALEJANDRO',
            'email' => 'RANI@onemail.co',
            'rfc' => 'RANI218869QCH',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RANI916602UHCORM36')
        ]);
        
        User::factory()->create([
            'name' => 'KATHERYN ROMERO YANEZ',
            'email' => 'RKEZ@yandex.com',
            'rfc' => 'RKEZ248578RDB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RKEZ216597ZXLVGX38')
        ]);
        
        User::factory()->create([
            'name' => 'ESTEFANIA ABRAHAM DOMINGUEZ',
            'email' => 'GZAF@safeinbox.net',
            'rfc' => 'GZAF112951HQO',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GZAF510547SHARZX94')
        ]);
        
        User::factory()->create([
            'name' => 'EMILIANO PATRON GONZALEZ',
            'email' => 'LIPN@startmail.com',
            'rfc' => 'LIPN747553DEB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LIPN469658QBGGWH69')
        ]);
        
        User::factory()->create([
            'name' => 'MARIA CONCEPCION ARCOS JIMENEZ',
            'email' => 'OZEM@yahoo.com',
            'rfc' => 'OZEM545557UTR',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OZEM570239TRLYCB53')
        ]);
        
        User::factory()->create([
            'name' => 'SALVADOR JAUREGUI GONZALEZ',
            'email' => 'GALV@blazemail.co',
            'rfc' => 'GALV509908YOJ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GALV828552QIEDNZ18')
        ]);
        
        User::factory()->create([
            'name' => 'JEANCARLO DE JESUS SANCHEZ BOLON',
            'email' => 'NEZR@waveboxmail.com',
            'rfc' => 'NEZR770931WWT',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NEZR694708LXIAYM85')
        ]);
        
        User::factory()->create([
            'name' => 'ANAMITA OCAÑA FRANCO',
            'email' => 'RÑCO@fastmail.com',
            'rfc' => 'RÑCO629532XXN',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RÑCO727359FQMFKM11')
        ]);
        
        User::factory()->create([
            'name' => 'GLADYS BEATRIZ SOSA GARCIA',
            'email' => 'ZRCB@airmail.cc',
            'rfc' => 'ZRCB829276HSB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZRCB124401NYBWHW70')
        ]);
        
        User::factory()->create([
            'name' => 'IRVING HOWARD AC CHI',
            'email' => 'RDIW@posteo.net',
            'rfc' => 'RDIW730203EST',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RDIW410091EGJGGP08')
        ]);
        
        User::factory()->create([
            'name' => 'FATIMA DEL ROSARIO PEREZ GUTIERREZ',
            'email' => 'GDIA@startmail.com',
            'rfc' => 'GDIA680494DCC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GDIA320305UCAATH88')
        ]);
        
        User::factory()->create([
            'name' => 'LUIS GABRIEL CANCHE CANUL',
            'email' => 'UGIC@mailplan.io',
            'rfc' => 'UGIC440232YZO',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UGIC392311KASXTD48')
        ]);
        
        User::factory()->create([
            'name' => 'JUAN DANIEL HERNANDEZ HERNANDEZ',
            'email' => 'ZJUL@hey.com',
            'rfc' => 'ZJUL276977UGM',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZJUL064267OFPTMD62')
        ]);
        
        User::factory()->create([
            'name' => 'EMMA MARTINEZ FLORES',
            'email' => 'ZMAE@nightpost.io',
            'rfc' => 'ZMAE186599LBZ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ZMAE505182ETZKVM24')
        ]);
        
        User::factory()->create([
            'name' => 'FREDY DEL CARMEN VILLANUEVA JIMENEZ',
            'email' => 'EAIY@bubblemail.org',
            'rfc' => 'EAIY180492VSB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EAIY840704GZBTPJ97')
        ]);
        
        User::factory()->create([
            'name' => 'JOSIAS JOSMAR CORDOVA BAEZA',
            'email' => 'AIBR@cryptomail.io',
            'rfc' => 'AIBR124269SCA',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('AIBR682754VEMDQM55')
        ]);
        
        User::factory()->create([
            'name' => 'GILBERTO MATUS ZARATE',
            'email' => 'TROU@yandex.com',
            'rfc' => 'TROU376359BMD',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TROU089062AKNPUF62')
        ]);
        
        User::factory()->create([
            'name' => 'JESSICA MARIA MAYOR PEREZ',
            'email' => 'PCRA@epicmail.com',
            'rfc' => 'PCRA206510KQT',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('PCRA414786WCVEXD00')
        ]);
        
        User::factory()->create([
            'name' => 'ANGEL EDUARDO LEZAMA CANUL',
            'email' => 'UECM@letterbox.org',
            'rfc' => 'UECM590105DZH',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UECM788890VFKSQV76')
        ]);
        
        User::factory()->create([
            'name' => 'CARLOS RAMIRO SOSA PACHECO',
            'email' => 'MILE@ninjaemail.com',
            'rfc' => 'MILE850401USC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MILE480584QERPGU02')
        ]);
        
        User::factory()->create([
            'name' => 'IVETTE DEL CARMEN MOLINA QUE',
            'email' => 'RAQC@mailxpress.org',
            'rfc' => 'RAQC949845ZXT',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RAQC405966FQNWWA86')
        ]);
        
        User::factory()->create([
            'name' => 'LILIANA LIZETH GAMBOA MATOS',
            'email' => 'BSLM@driftmail.net',
            'rfc' => 'BSLM489413MOK',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('BSLM529829FZSSKO31')
        ]);
        
        User::factory()->create([
            'name' => 'EDGAR ALEJANDRO ALMEYDA MALDONADO',
            'email' => 'JDLG@mail.com',
            'rfc' => 'JDLG447638VPT',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('JDLG739059IWHFWW24')
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL ALBERTO ORDOÑEZ MARTINEZ',
            'email' => 'OZÑL@disroot.org',
            'rfc' => 'OZÑL952006QKX',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OZÑL406030NXXIES86')
        ]);
        
        User::factory()->create([
            'name' => 'DANIEL JEZLEEL VILLARREAL HUCHIN',
            'email' => 'REUA@zoho.com',
            'rfc' => 'REUA279851ODY',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('REUA015518NOCEAR83')
        ]);
        
        User::factory()->create([
            'name' => 'ELIEZER ISAI CRUZ LOPEZ',
            'email' => 'SRLO@yahoo.com',
            'rfc' => 'SRLO921074RVS',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SRLO989285FAZUOY76')
        ]);
        
        User::factory()->create([
            'name' => 'HILDA DEL ROSARIO DE LA CRUZ POOT',
            'email' => 'LIHC@yandex.com',
            'rfc' => 'LIHC050726PPJ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LIHC787704PRZJIC34')
        ]);
        
        User::factory()->create([
            'name' => 'LUIS MARIO UITZ POOT',
            'email' => 'OLAT@aol.com',
            'rfc' => 'OLAT084100KFJ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OLAT531727IWHQDI21')
        ]);
        
        User::factory()->create([
            'name' => 'BRISA YAJAIRA DE LA CRUZ SALAZAR',
            'email' => 'UCZJ@outlook.com',
            'rfc' => 'UCZJ168145CLD',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UCZJ345469WHGEJC04')
        ]);
        
        User::factory()->create([
            'name' => 'EDITH DEL CARMEN HERNANDEZ PEREZ',
            'email' => 'ALEC@posteo.net',
            'rfc' => 'ALEC664719AAF',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ALEC985011DAEZIU88')
        ]);
        
        User::factory()->create([
            'name' => 'BENNY DEL JESUS MORENO ZARATE',
            'email' => 'NUBR@hey.com',
            'rfc' => 'NUBR967637OYH',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NUBR192295GJAQVO40')
        ]);
        
        User::factory()->create([
            'name' => 'ROMAN DEL ANGEL TRUJILLO MIJANGOS',
            'email' => 'JAOU@onemail.co',
            'rfc' => 'JAOU031945HZD',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('JAOU666758HOVODS68')
        ]);
        
        User::factory()->create([
            'name' => 'CESAR ALBERTO CHI PEREYRA',
            'email' => 'HRLY@stormmail.net',
            'rfc' => 'HRLY375437OAS',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('HRLY821203WHBYTH28')
        ]);
        
        User::factory()->create([
            'name' => 'NICOLAS US CAHUICH',
            'email' => 'IUON@ninjaemail.com',
            'rfc' => 'IUON559131TQD',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IUON095216MQXBOV96')
        ]);
        
        User::factory()->create([
            'name' => 'LUIS ALBERTO MAY CHUC',
            'email' => 'UOTE@startmail.com',
            'rfc' => 'UOTE352920ZPL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UOTE385398BQCGYD26')
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL DE JESUS RIVERO SALAZAR',
            'email' => 'LOMN@netpostbox.com',
            'rfc' => 'LOMN339859QVL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LOMN669480HHLRJV44')
        ]);
        
        User::factory()->create([
            'name' => 'IRVIN AZIEL ABAN CORTEZ',
            'email' => 'BCNZ@sparkmail.org',
            'rfc' => 'BCNZ669288BKG',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('BCNZ581525KUDTXC39')
        ]);
        
        User::factory()->create([
            'name' => 'MIGUEL ANGEL ESPINO SEGURA',
            'email' => 'AEOG@hotmail.com',
            'rfc' => 'AEOG490301VXP',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('AEOG670900HVVHOX63')
        ]);
        
        User::factory()->create([
            'name' => 'JUAN MANUEL BAEZA CHAVARRIA',
            'email' => 'CUJH@invisimail.org',
            'rfc' => 'CUJH041373YOC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('CUJH792714FPEEQS32')
        ]);
        
        User::factory()->create([
            'name' => 'JENNIFER OSORIO ASCENCIO',
            'email' => 'AEFS@mailxpress.org',
            'rfc' => 'AEFS748709ZPB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('AEFS662187ATWPWW97')
        ]);
        
        User::factory()->create([
            'name' => 'GARY HOUDINE CERVERA MONTERO',
            'email' => 'CAGI@runbox.com',
            'rfc' => 'CAGI355802GWW',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('CAGI352734KMRKKQ80')
        ]);
        
        User::factory()->create([
            'name' => 'ALEJANDRA GUADALUPE RODRIGUEZ BARRERA',
            'email' => 'OJUB@posteo.net',
            'rfc' => 'OJUB243567HUL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OJUB247686ZSOVAN68')
        ]);
        
        User::factory()->create([
            'name' => 'DARWIN ERNESTO ZAVALA MARTINEZ',
            'email' => 'ESLA@darkmail.xyz',
            'rfc' => 'ESLA915936JVI',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ESLA525382SBVOZG96')
        ]);
        
        User::factory()->create([
            'name' => 'JESUS ALBERTO DZUL LOPEZ',
            'email' => 'PEAJ@neonmail.biz',
            'rfc' => 'PEAJ581383CZF',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('PEAJ454541MDGFPS95')
        ]);
        
        User::factory()->create([
            'name' => 'EDUARDO ENRIQUE MAY LOPEZ',
            'email' => 'NMIY@zoho.com',
            'rfc' => 'NMIY668581HSI',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NMIY325343WIGDRP25')
        ]);
        
        User::factory()->create([
            'name' => 'DIANA GISSELLE GONZALEZ AVILA',
            'email' => 'NLVE@startmail.com',
            'rfc' => 'NLVE845985SZX',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NLVE067295FHTNDD31')
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL JESUS GUTIERREZ CAMPOS',
            'email' => 'UIRN@blazemail.co',
            'rfc' => 'UIRN866774HLR',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UIRN566536BGOIGS49')
        ]);
        
        User::factory()->create([
            'name' => 'PRISSILA BEATRIZ MALDONADO FERRAEZ',
            'email' => 'SAOP@airmail.cc',
            'rfc' => 'SAOP331365VIC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SAOP693220IPCZZQ95')
        ]);
        
        User::factory()->create([
            'name' => 'VICENTE HERNANDEZ CABAÑAS',
            'email' => 'RECA@icloud.com',
            'rfc' => 'RECA113202DYX',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RECA380144XRAJRG74')
        ]);
        
        User::factory()->create([
            'name' => 'EMILIO GABRIEL HUCHIN HERNANDEZ',
            'email' => 'NGAE@neonmail.biz',
            'rfc' => 'NGAE170205QHW',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NGAE810560EBWQLJ55')
        ]);
        
        User::factory()->create([
            'name' => 'ORAIMA BARAJAS VILLASEÑOR',
            'email' => 'IEBR@aol.com',
            'rfc' => 'IEBR906942NRU',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IEBR401622TFKJWX59')
        ]);
        
        User::factory()->create([
            'name' => 'CARLOS ALBERTO BAUTISTA ARROYO',
            'email' => 'TBLY@protonmail.com',
            'rfc' => 'TBLY831299EPL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TBLY696029KISIFZ34')
        ]);
        
        User::factory()->create([
            'name' => 'ALONDRA DEL ROSARIO MISS BALAM',
            'email' => 'LMOA@darkmail.xyz',
            'rfc' => 'LMOA832268CZC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LMOA356918VXMSJI61')
        ]);
        
        User::factory()->create([
            'name' => 'JESUS DAVID CARRION MARTIN',
            'email' => 'ODCR@mail.com',
            'rfc' => 'ODCR899522INS',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ODCR128160VIUYJR65')
        ]);
        
        User::factory()->create([
            'name' => 'HECTOR MANUEL PALOMO GONZALEZ',
            'email' => 'MTUN@disroot.org',
            'rfc' => 'MTUN890570KNN',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MTUN550432PTTLFJ27')
        ]);
        
        User::factory()->create([
            'name' => 'CRISTHEL EUNICE CU EK',
            'email' => 'RNTC@airmail.cc',
            'rfc' => 'RNTC712344WOQ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RNTC751225CYPIZT75')
        ]);
        
        User::factory()->create([
            'name' => 'LAURA SURISADAI CRUZ MENDEZ',
            'email' => 'NUIZ@runbox.com',
            'rfc' => 'NUIZ332936MAL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NUIZ368712JMUFGQ03')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE DANIEL VIRRUETA HIDALGO',
            'email' => 'EOJU@mailfence.com',
            'rfc' => 'EOJU687514MID',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('EOJU134297PLDEFU37')
        ]);
        
        User::factory()->create([
            'name' => 'MANUEL HUMBERTO FLORES GAMBOA',
            'email' => 'SMUN@outlook.com',
            'rfc' => 'SMUN720942BOR',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SMUN938362GHCBNZ00')
        ]);
        
        User::factory()->create([
            'name' => 'BRISEYDA XILONEN JIMENEZ CASTILLO',
            'email' => 'JDOI@onemail.co',
            'rfc' => 'JDOI103939LRV',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('JDOI552539WJZWBN07')
        ]);
        
        User::factory()->create([
            'name' => 'SAMANTA JOSEFINA MEDINA R DE LA GALA',
            'email' => 'FMST@ninjaemail.com',
            'rfc' => 'FMST713065TPJ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('FMST349205ZKFGZV02')
        ]);
        
        User::factory()->create([
            'name' => 'KARINA LIZETH AGUILAR RODRIGUEZ',
            'email' => 'RTAZ@gmail.com',
            'rfc' => 'RTAZ729907YDW',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RTAZ061421WZXALZ83')
        ]);
        
        User::factory()->create([
            'name' => 'KARLA GUADALUPE PEREZ LLANOS',
            'email' => 'GZKA@netpostbox.com',
            'rfc' => 'GZKA963568MRG',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GZKA619970TTGXDC44')
        ]);
        
        User::factory()->create([
            'name' => 'IRIS GABRIELA GARCIA MORENO',
            'email' => 'MEBN@darkmail.xyz',
            'rfc' => 'MEBN116562XIA',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MEBN220440NPDTAB06')
        ]);
        
        User::factory()->create([
            'name' => 'EZEQUIAS HERNANDEZ TORRES',
            'email' => 'TQIA@zoho.com',
            'rfc' => 'TQIA301055SFS',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('TQIA800165CLAMUV40')
        ]);
        
        User::factory()->create([
            'name' => 'BRIANDA ISABEL COYOC TORRES',
            'email' => 'LARD@yahoo.com',
            'rfc' => 'LARD167487LAL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('LARD654318CRYDRF28')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE URIEL EUAN PECH',
            'email' => 'SELU@mailplan.io',
            'rfc' => 'SELU472698XCL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('SELU649497KTSPWX13')
        ]);
        
        User::factory()->create([
            'name' => 'JESSICA HERNANDEZ LEON',
            'email' => 'NLRH@fastmail.com',
            'rfc' => 'NLRH072854KTL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NLRH242826LEIJHD45')
        ]);
        
        User::factory()->create([
            'name' => 'DIANA RUBI DELGADO PLASCENCIA',
            'email' => 'PUGB@outlook.com',
            'rfc' => 'PUGB124629QFA',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('PUGB872002EGUACZ12')
        ]);
        
        User::factory()->create([
            'name' => 'FATIMA GUTIERREZ PEREZ',
            'email' => 'ETIF@darkmail.xyz',
            'rfc' => 'ETIF652356VTZ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ETIF245779XCDNAU52')
        ]);
        
        User::factory()->create([
            'name' => 'SERGIO AGUSTIN EK CHE',
            'email' => 'GIAR@tutanota.com',
            'rfc' => 'GIAR154288VBC',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('GIAR481942OIDEGY21')
        ]);
        
        User::factory()->create([
            'name' => 'RAMON ALFONSO MENA PINZON',
            'email' => 'FSAO@safeinbox.net',
            'rfc' => 'FSAO903531FVU',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('FSAO720482FNZXUB90')
        ]);
        
        User::factory()->create([
            'name' => 'HOENER DEL CARMEN COLLI CASANOVA',
            'email' => 'DLOH@ninjaemail.com',
            'rfc' => 'DLOH835121ZRA',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('DLOH222121LYYXOF99')
        ]);
        
        User::factory()->create([
            'name' => 'ALEJANDRO DEL JESUS RAMIREZ MAY',
            'email' => 'MUAS@ninjaemail.com',
            'rfc' => 'MUAS395376KRV',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MUAS743416TEGSAS72')
        ]);
        
        User::factory()->create([
            'name' => 'NICHELDDI CUEVAS VARGAS',
            'email' => 'ANSE@safeinbox.net',
            'rfc' => 'ANSE124831VSE',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ANSE435663PKBIQT36')
        ]);
        
        User::factory()->create([
            'name' => 'RAFAEL ENRIQUE FONOY CALDERON',
            'email' => 'AUYQ@zoho.com',
            'rfc' => 'AUYQ393623RBX',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('AUYQ152384WBQRFV18')
        ]);
        
        User::factory()->create([
            'name' => 'LEON FELIPE REYES PEREZ',
            'email' => 'YLIE@fusionmail.cc',
            'rfc' => 'YLIE797723GIV',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('YLIE604987IDAVBZ84')
        ]);
        
        User::factory()->create([
            'name' => 'JOSE FRANCISCO LOPEZ CORTES',
            'email' => 'NPRJ@warpbox.com',
            'rfc' => 'NPRJ536610HHZ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NPRJ615306XWMYEP92')
        ]);
        
        User::factory()->create([
            'name' => 'JESUS ALEJANDRO BAUTISTA CHAN',
            'email' => 'IBAC@letterbox.org',
            'rfc' => 'IBAC065284DYK',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IBAC109118RPQFDA31')
        ]);
        
        User::factory()->create([
            'name' => 'EDGAR DAMIAN CARRION MARTIN',
            'email' => 'RNMI@mailplan.io',
            'rfc' => 'RNMI883029JBA',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RNMI189219ILPXML00')
        ]);
        
        User::factory()->create([
            'name' => 'FILIBERTO MIGUEL HERNANDEZ ROJAS',
            'email' => 'RFAO@runbox.com',
            'rfc' => 'RFAO406575LNJ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RFAO316773OVFMTL49')
        ]);
        
        User::factory()->create([
            'name' => 'JESUS ALBERTO HEREDIA MAGAÑA',
            'email' => 'ESIO@outlook.com',
            'rfc' => 'ESIO142390TSB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('ESIO940157NASRNH49')
        ]);
        
        User::factory()->create([
            'name' => 'RIBIN CASTRO CORONADO',
            'email' => 'IDRC@sparkmail.org',
            'rfc' => 'IDRC569520GDL',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('IDRC971525TOITJR94')
        ]);
        
        User::factory()->create([
            'name' => 'ROXANA GUADALUPE ESPINOSA CARREON',
            'email' => 'OGIE@mail.com',
            'rfc' => 'OGIE186140AOI',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('OGIE687642LTIADQ23')
        ]);
        
        User::factory()->create([
            'name' => 'GUILLERMO RAMON DZIB QUEB',
            'email' => 'UDRA@altinbox.net',
            'rfc' => 'UDRA279406SUN',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UDRA695293FSUJFE72')
        ]);
        
        User::factory()->create([
            'name' => 'ALBERTO DE JESUS CASTILLO MENDOZA',
            'email' => 'NLCS@stormmail.net',
            'rfc' => 'NLCS819905FYB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('NLCS852213LEZKET50')
        ]);
        
        User::factory()->create([
            'name' => 'NATALI CONCEPCION GONZALEZ MOO',
            'email' => 'MNAI@gmail.com',
            'rfc' => 'MNAI543483DRB',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('MNAI357436DASHVX18')
        ]);
        
        User::factory()->create([
            'name' => 'MARIA DE LOURDES ROSADO BRITO',
            'email' => 'UREA@yahoo.com',
            'rfc' => 'UREA681294RVT',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('UREA924931CBPLAZ73')
        ]);
        
        User::factory()->create([
            'name' => 'GERARDO DE JESUS MEX AVILA',
            'email' => 'RGLI@mail.com',
            'rfc' => 'RGLI297960LYQ',
            'direction' => '',
            'position' => 'PERSONAL DE APOYO',
            'sex' => 'masculino',
            'lvl' => '1114',
            'tipo' => 3,
            'status' => true,
            'password' => Hash::make('RGLI447419QGKSFP74')
        ]);

        @php
            dd(config('jetstream.features'), Laravel\Jetstream\Jetstream::managesProfilePhotos());
        @endphp
    }
}
