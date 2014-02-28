<?php

//DADES:
$zones = array(
			"zona1"=>array(
						"km"=>150,
						"zona"=>"Barcelona"
					),
			"zona1"=>array(
						"km"=>2400,
						"zona"=>"Catalunya"
					),
			"zona1"=>array(
						"km"=>3120,
						"zona"=>"Espanya"
					)
			);
//PLACEHOLDERS!!!
$usuaris = array(
			"paquita"=>array(
						"nom"=>"Pakita",
						"password"=>"pakitareshulona",
						"direccio"=>"calle pascual",
						"telefon"=>038752304875,
						"tipus"=>"client"
						),
			"ramon"=>array(
						"nom"=>"Ramon",
						"password"=>"ramonalforn",
						"direccio"=>"carrer misèria",
						"telefon"=>3547648466754,
						"tipus"=>"client"						
						),
			"nami"=>array(
						"nom"=>"Nami",
						"password"=>"socunanoob",
						"direccio"=>"calle fiambre",
						"telefon"=>5868687767575,
						"tipus"=>"client"						
						),
			"berta"=>array(
						"nom"=>"berta",
						"password"=>"salom",
						"direccio"=>"1234",
						"telefon"=>92385409359834509,
						"tipus"=>"admin"						
						),													
		);

$encarrecs = array(
			"encarrec1"=>array(
						"id"=>"00Z",
						"producte"=>"Sofá",
						"pes"=>150.40,
						"volum"=>2.3,
						"direccio"=>"calle pascual",
						"poblacio"=>"granollers",
						"zona"=>"1",
						"client"=>"Nami",
						"km"=>132,
						"transportista"=>""				
						),
			"encarrec2"=>array(
						"id"=>"00X",
						"producte"=>"Televisió",
						"pes"=>37.490,
						"volum"=>0.7,
						"direccio"=>"carrer miracle",
						"poblacio"=>"la garriga",
						"zona"=>"3",
						"client"=>"Nami",
						"km"=>234,						
						"transportista"=>"T001"											
						),
			"encarrec3"=>array(
						"id"=>"00Y",
						"producte"=>"Nevera",
						"pes"=>127.88,
						"volum"=>1.7,
						"direccio"=>"carrer gibraltar",
						"poblacio"=>"parets del vallès",
						"zona"=>"2",
						"client"=>"Pakita",	
						"km"=>78,						
						"transportista"=>""												
						),									
		);

$transportistes = array(
			"trans1"=>array(
						"id"=>"T001",
						"nom"=>"Julian",
						"zona"=>"3"						
						),
			"trans2"=>array(
						"id"=>"T002",				
						"nom"=>"Pedro",
						"zona"=>"2"						
						),
			"trans3"=>array(
						"id"=>"T003",				
						"nom"=>"Fernandez",
						"zona"=>"1"						
						),									
		);


?>