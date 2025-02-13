<?php
class OrionDeltaAM extends StarBaseSixSections{

	function __construct($id, $userid, $name,  $slot){
		parent::__construct($id, $userid, $name,  $slot);

		$this->pointCost = 2400;
		$this->faction = "Earth Alliance (defenses)";
		$this->phpclass = "OrionDeltaAM";
		$this->shipClass = "Orion Battle Station (Delta)";
		$this->fighters = array("heavy"=>36); 
		
		$this->occurence = "common";
		$this->variantOf = 'Orion Battle Station';
        $this->isd = 2240;

		$this->shipSizeClass = 3;
        $this->Enormous = true;
		$this->iniativebonus = -200;
		$this->turncost = 0;
		$this->turndelaycost = 0;

		$this->forwardDefense = 20;
		$this->sideDefense = 20;

		$this->imagePath = "img/ships/orion.png";
		$this->canvasSize = 280;

		$this->locations = array(41, 42, 2, 32, 31, 1);
		$this->hitChart = array(			
			0=> array(
				10 => "Structure",
				12 => "Cargo Bay",
				14 => "Scanner",
				16 => "Class-B Missile Rack",
				17 => "Reactor",
				18 => "Hangar",
				20 => "C&C",
			),
		);


        //ammo magazine itself (AND its missile options)
        $ammoMagazine = new AmmoMagazine(480); //pass magazine capacity - class-B launchers hold 60 rounds each!
        $this->addPrimarySystem($ammoMagazine); //fit to ship immediately
        $ammoMagazine->addAmmoEntry(new AmmoMissileB(), 480); //add full load of basic missiles
	    $this->enhancementOptionsEnabled[] = 'AMMO_A';//add enhancement options for other missiles - Class-A
	    $this->enhancementOptionsEnabled[] = 'AMMO_C';//add enhancement options for other missiles - Class-C
	    $this->enhancementOptionsEnabled[] = 'AMMO_F';//add enhancement options for other missiles - Class-F
	    $this->enhancementOptionsEnabled[] = 'AMMO_H';//add enhancement options for other missiles - Class-H
		$this->enhancementOptionsEnabled[] = 'AMMO_I';//add enhancement options for other missiles - Class-I	    
	    $this->enhancementOptionsEnabled[] = 'AMMO_K';//add enhancement options for other missiles - Class-K   
	    $this->enhancementOptionsEnabled[] = 'AMMO_L';//add enhancement options for other missiles - Class-L
	    $this->enhancementOptionsEnabled[] = 'AMMO_M';//add enhancement options for other missiles - Class-M	    
		$this->enhancementOptionsEnabled[] = 'AMMO_P';//add enhancement options for other missiles - Class-P
		$this->enhancementOptionsEnabled[] = 'AMMO_X';//add enhancement options for other missiles - Class-X				
    
		$this->addPrimarySystem(new Reactor(6, 20, 0, 0));
		$this->addPrimarySystem(new CnC(6, 27, 0, 0)); 
		$this->addPrimarySystem(new Scanner(6, 16, 4, 6));
		$this->addPrimarySystem(new Scanner(6, 16, 4, 6));
		$this->addPrimarySystem(new Hangar(6, 6));
		$this->addPrimarySystem(new CargoBay(6, 48));
        $this->addPrimarySystem(new AmmoMissileRackB(6, 0, 0, 0, 360, $ammoMagazine, true)); //$armour, $health (0=auto), $power (0=auto), $startArc, $endArc, $magazine, $base
        $this->addPrimarySystem(new AmmoMissileRackB(6, 0, 0, 0, 360, $ammoMagazine, true)); //$armour, $health (0=auto), $power (0=auto), $startArc, $endArc, $magazine, $base
    


		$this->addPrimarySystem(new Structure( 7, 150));


		for ($i = 0; $i < sizeof($this->locations); $i++){

			$min = 0 + ($i*60);
			$max = 120 + ($i*60);

			$systems = array(
				new Railgun(4, 9, 6, $min, $max),
				new HeavyPulse(4, 6, 4, $min, $max),
        new AmmoMissileRackB(4, 0, 0, $min, $max, $ammoMagazine, true), //$armour, $health (0=auto), $power (0=auto), $startArc, $endArc, $magazine, $base
				new InterceptorMKI(4, 4, 1, $min, $max),
				new InterceptorMKI(4, 4, 1, $min, $max),
				new Hangar(4, 6, 6),
				new SubReactorUniversal(4, 20, 0, 0),
				new Structure( 4, 100)
			);


			$loc = $this->locations[$i];

			$this->hitChart[$loc] = array(
				1 => "TAG:Class-B Missile Rack",
				2 => "TAG:Heavy Pulse Cannon",
				3 => "TAG:Railgun",
				5 => "TAG:Interceptor I",
				6 => "TAG:Hangar",
				7 => "TAG:Sub Reactor",
				18 => "Structure",
				20 => "Primary",
			);

			foreach ($systems as $system){
				$this->addSystem($system, $loc);
			}
		}
    }
}
