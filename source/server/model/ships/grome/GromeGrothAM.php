<?php
class GromeGrothAM extends BaseShip{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
		$this->pointCost = 1000;
		$this->faction = "Grome Autocracy";
        $this->phpclass = "GromeGrothAM";
        $this->imagePath = "img/ships/GromeGroth.png";
        $this->shipClass = "Groth Gunship";
			$this->limited = 33;
        $this->shipSizeClass = 3;
		$this->canvasSize = 175; //img has 200px per side

	    $this->notes = 'Antiquated Sensors (cannot be boosted)';

        $this->fighters = array("normal"=>6);

		$this->isd = 2249;
        
        $this->forwardDefense = 18;
        $this->sideDefense = 19;
        
        $this->turncost = 1.0;
        $this->turndelaycost = 1.0;
        $this->accelcost = 4;
        $this->rollcost = 99; //cannot roll
        $this->pivotcost = 4;
        $this->iniativebonus = 0;

 	//ammo magazine itself (AND its missile options)
	$ammoMagazine = new AmmoMagazine(500); //pass magazine capacity 
	    $this->addPrimarySystem($ammoMagazine); //fit to ship immediately
	    $ammoMagazine->addAmmoEntry(new AmmoHShellBasic(), 200); //add full load of basic shells  
	    $ammoMagazine->addAmmoEntry(new AmmoMShellBasic(), 300); //add full load of basic shells  
	    	    
		$this->enhancementOptionsEnabled[] = 'SHELL_HFLH';//add enhancement options for ammo - Heavy Flash Shell
	    $this->enhancementOptionsEnabled[] = 'SHELL_MFLH';//add enhancement options for ammo - Medium Flash Shell
	    $this->enhancementOptionsEnabled[] = 'SHELL_HSCT';//add enhancement options for ammo - Heavy Scatter Shell	    
	    $this->enhancementOptionsEnabled[] = 'SHELL_MSCT';//add enhancement options for ammo - Medium Scatter Shell	
	    $this->enhancementOptionsEnabled[] = 'SHELL_HHVY';//add enhancement options for ammo - Heavy Heavy Shell	    
	    $this->enhancementOptionsEnabled[] = 'SHELL_MHVY';//add enhancement options for ammo - Medium Heavy Shell 
	    $this->enhancementOptionsEnabled[] = 'SHELL_HLR';//add enhancement options for ammo - Heavy Long Range Shell	    
	    $this->enhancementOptionsEnabled[] = 'SHELL_MLR';//add enhancement options for ammo - Medium Long Range Shell	
	    $this->enhancementOptionsEnabled[] = 'SHELL_HULR';//add enhancement options for ammo - Heavy Ultra Long Range Shell	
        
        $this->addPrimarySystem(new Reactor(4, 23, 0, 0));
        $this->addPrimarySystem(new CnC(4, 20, 0, 0));
        $this->addPrimarySystem(new AntiquatedScanner(3, 20, 6, 6));
        $this->addPrimarySystem(new GromeTargetingArray(2, 0, 0, 0, 360, 2, false, false)); //Armor, health, power, startarc, endarc, output, escort, base	
        $this->addPrimarySystem(new GromeTargetingArray(2, 0, 0, 0, 360, 2, false, false)); //Armor, health, power, startarc, endarc, output, escort, base	
        $this->addPrimarySystem(new Engine(4, 28, 0, 8, 4));
		$this->addPrimarySystem(new Hangar(2, 8));
		$this->addPrimarySystem(new JumpEngine(4, 20, 4, 36));
		
        $this->addFrontSystem(new Thruster(3, 10, 0, 3, 1));
        $this->addFrontSystem(new Thruster(3, 10, 0, 3, 1));
		$this->addFrontSystem(new AmmoMediumRailGun(3, 9, 6, 300, 360, $ammoMagazine));
		$this->addFrontSystem(new AmmoMediumRailGun(3, 9, 6, 0, 60, $ammoMagazine));
		$this->addFrontSystem(new GromeFlakCannon(5, 4, 2, 240, 60));
		$this->addFrontSystem(new GromeFlakCannon(5, 4, 2, 300, 120));
        $this->addFrontSystem(new ConnectionStrut(4));

        $this->addAftSystem(new Thruster(3, 16, 0, 4, 2));
        $this->addAftSystem(new Thruster(3, 16, 0, 4, 2));
		$this->addAftSystem(new AmmoMediumRailGun(3, 9, 6, 180, 240, $ammoMagazine));
		$this->addAftSystem(new AmmoMediumRailGun(3, 9, 6, 120, 180, $ammoMagazine));
        $this->addAftSystem(new ConnectionStrut(4));

        $this->addLeftSystem(new GromeFlakCannon(2, 4, 2, 180, 360));
		$this->addLeftSystem(new AmmoMediumRailGun(3, 9, 6, 210, 330, $ammoMagazine));
		$this->addLeftSystem(new AmmoHeavyRailGun(3, 12, 9, 300, 360, $ammoMagazine));
		$this->addLeftSystem(new AmmoHeavyRailGun(3, 12, 9, 180, 240, $ammoMagazine));
        $this->addLeftSystem(new Thruster(3, 15, 0, 4, 3));
        $this->addLeftSystem(new ConnectionStrut(4));

        $this->addRightSystem(new GromeFlakCannon(2, 4, 2, 0, 180));
		$this->addRightSystem(new AmmoMediumRailGun(3, 9, 6, 30, 150, $ammoMagazine));
		$this->addRightSystem(new AmmoHeavyRailGun(3, 12, 9, 0, 60, $ammoMagazine));
		$this->addRightSystem(new AmmoHeavyRailGun(3, 12, 9, 120, 180, $ammoMagazine));
        $this->addRightSystem(new Thruster(3, 15, 0, 4, 4));
        $this->addRightSystem(new ConnectionStrut(4));

        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure(4, 94));
        $this->addAftSystem(new Structure(4, 90));
        $this->addLeftSystem(new Structure(4, 110));
        $this->addRightSystem(new Structure(4, 110));
        $this->addPrimarySystem(new Structure(4, 80));
		
		$this->hitChart = array(
			0=> array(
					6 => "Structure",
					20 => "Targeting Array",
					10 => "Jump Engine",
					13 => "Engine",
					16 => "Scanner",
					17 => "Hangar",
					19 => "Reactor",
					20 => "C&C",
			),
			1=> array(
					5 => "Thruster",
					8 => "Medium Railgun",
					11 => "Flak Cannon",
					15 => "Structure",
					18 => "Connection Strut",
					20 => "Primary",
			),
			2=> array(
					6 => "Thruster",
					8 => "Medium Railgun",
					15 => "Structure",
					18 => "Connection Strut",
					20 => "Primary",
			),
			3=> array(
					4 => "Thruster",
					7 => "Heavy Railgun",
					9 => "Medium Railgun",
					11 => "Flak Cannon",
					15 => "Structure",
					18 => "Connection Strut",
					20 => "Primary",
			),
			4=> array(
					4 => "Thruster",
					7 => "Heavy Railgun",
					9 => "Medium Railgun",
					11 => "Flak Cannon",
					15 => "Structure",
					18 => "Connection Strut",
					20 => "Primary",
			),
		);
    }
}

?>
