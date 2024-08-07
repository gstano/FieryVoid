<?php
class SshelathAlvekaRefitAM extends BaseShip{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
	$this->pointCost = 415;
	$this->faction = "ZEscalation Sshel'ath Alliance";
        $this->phpclass = "SshelathAlvekaRefitAM";
        $this->imagePath = "img/ships/EscalationWars/SshelathAlveka.png";
        $this->shipClass = "Alveka Scout (1960 Refit)";
			$this->variantOf = "Alveka Scout";
			$this->occurence = "common";		
        $this->limited = 33;
        $this->shipSizeClass = 3;
		$this->canvasSize = 165; //img has 200px per side
		$this->unofficial = true;

		$this->isd = 1960;
        
        $this->forwardDefense = 15;
        $this->sideDefense = 15;
        
        $this->turncost = 1.0;
        $this->turndelaycost = 1.0;
        $this->accelcost = 3;
        $this->rollcost = 3;
        $this->pivotcost = 3;
        $this->iniativebonus = 0;

        //ammo magazine itself (AND its missile options)
        $ammoMagazine = new AmmoMagazine(12); //pass magazine capacity - class-SO launchers hold 12 rounds per mount
        $this->addPrimarySystem($ammoMagazine); //fit to ship immediately
        $ammoMagazine->addAmmoEntry(new AmmoMissileB(), 12); //add full load of basic missiles
        $this->enhancementOptionsEnabled[] = 'AMMO_H';//add enhancement options for other missiles - Class-H
        
        $this->addPrimarySystem(new Reactor(4, 15, 0, 0));
        $this->addPrimarySystem(new CnC(4, 12, 0, 0));
        $this->addPrimarySystem(new ELINTScanner(4, 15, 5, 7));
        $this->addPrimarySystem(new Engine(4, 13, 0, 8, 5));
		$this->addPrimarySystem(new Hangar(4, 4));
		
        $this->addFrontSystem(new Thruster(2, 8, 0, 3, 1));
        $this->addFrontSystem(new Thruster(2, 8, 0, 3, 1));
		$this->addFrontSystem(new LightParticleBeamShip(1, 2, 1, 240, 60));
		$this->addFrontSystem(new LightParticleBeamShip(1, 2, 1, 300, 120));
		$this->addFrontSystem(new AmmoMissileRackSO(2, 0, 0, 240, 120, $ammoMagazine, false));

        $this->addAftSystem(new Thruster(3, 14, 0, 4, 2));
        $this->addAftSystem(new Thruster(3, 14, 0, 4, 2));
		$this->addAftSystem(new JumpEngine(3, 10, 3, 40));

        $this->addLeftSystem(new EWLightGaussCannon(3, 6, 3, 240, 60));
		$this->addLeftSystem(new LightParticleBeamShip(1, 2, 1, 180, 360));
		$this->addLeftSystem(new LightParticleBeamShip(1, 2, 1, 180, 360));
        $this->addLeftSystem(new Thruster(2, 13, 0, 4, 3));

        $this->addRightSystem(new EWLightGaussCannon(3, 6, 3, 300, 120));
		$this->addRightSystem(new LightParticleBeamShip(1, 2, 1, 0, 180));
		$this->addRightSystem(new LightParticleBeamShip(1, 2, 1, 0, 180));
        $this->addRightSystem(new Thruster(2, 13, 0, 4, 4));

        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure(3, 34));
        $this->addAftSystem(new Structure(3, 36));
        $this->addLeftSystem(new Structure(3, 36));
        $this->addRightSystem(new Structure(3, 36));
        $this->addPrimarySystem(new Structure(4, 30));
		
		$this->hitChart = array(
			0=> array(
					8 => "Structure",
					11 => "ELINT Scanner",
					14 => "Engine",
					16 => "Hangar",
					19 => "Reactor",
					20 => "C&C",
			),
			1=> array(
					5 => "Thruster",
					8 => "Class-SO Missile Rack",
					11 => "Light Particle Beam",
					18 => "Structure",
					20 => "Primary",
			),
			2=> array(
					6 => "Thruster",
					10 => "Jump Engine",
					18 => "Structure",
					20 => "Primary",
			),
			3=> array(
					4 => "Thruster",
					6 => "Light Gauss Cannon",
					8 => "Light Particle Beam",
					18 => "Structure",
					20 => "Primary",
			),
			4=> array(
					4 => "Thruster",
					6 => "Light Gauss Cannon",
					8 => "Light Particle Beam",
					18 => "Structure",
					20 => "Primary",
			),
		);
    }
}

?>
