<?php
class Tetrav extends HeavyCombatVessel{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
	$this->pointCost = 400;
	$this->faction = "Abbai Matriarchate (WotCR)";
        $this->phpclass = "Tetrav";
        $this->imagePath = "img/ships/AbbaiTetrav.png";
        $this->shipClass = "Tetrav Heavy Frigate";

	$this->isd = 2019;
        
        $this->forwardDefense = 14;
        $this->sideDefense = 14;
        
        $this->turncost = 0.5;
        $this->turndelaycost = 0.5;
        $this->accelcost = 3;
        $this->rollcost = 2;
        $this->pivotcost = 2;
        $this->iniativebonus = 30;
        
        $this->addPrimarySystem(new Reactor(5, 11, 0, 0));
        $this->addPrimarySystem(new CnC(5, 6, 0, 0));
        $this->addPrimarySystem(new Scanner(5, 10, 3, 5));
        $this->addPrimarySystem(new Engine(5, 14, 0, 8, 3));
 	$this->addPrimarySystem(new Hangar(5, 1));
        $this->addPrimarySystem(new ShieldGenerator(5, 12, 4, 3));
        $this->addPrimarySystem(new Thruster(4, 13, 0, 4, 3));
        $this->addPrimarySystem(new Thruster(4, 13, 0, 4, 4));
   
        $this->addFrontSystem(new Thruster(3, 8, 0, 3, 1));
        $this->addFrontSystem(new Thruster(3, 8, 0, 3, 1));
        $this->addFrontSystem(new AssaultLaser(3, 6, 4, 240, 0));
        $this->addFrontSystem(new AssaultLaser(3, 6, 4, 0, 120));
        $this->addFrontSystem(new GraviticShield(0, 6, 0, 1, 240, 0));
        $this->addFrontSystem(new LightParticleBeamShip(2, 2, 1, 240, 120));
        $this->addFrontSystem(new GraviticShield(0, 6, 0, 1, 0, 120));

        $this->addAftSystem(new LightParticleBeamShip(2, 2, 1, 180, 0));
        $this->addAftSystem(new GraviticShield(0, 6, 0, 1, 120, 240));
        $this->addAftSystem(new LightParticleBeamShip(2, 2, 1, 0, 180));
        $this->addAftSystem(new Thruster(3, 18, 0, 8, 2));


        
        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure(4, 39));
        $this->addAftSystem(new Structure(4, 39));
        $this->addPrimarySystem(new Structure(5, 24));
		
		$this->hitChart = array(
			0=> array(
					6 => "Structure",
					9 => "Thruster",
					11 => "Scanner",
					13 => "Shield Generator",
					14 => "Hangar",
					16 => "Engine",
					18 => "Reactor",
					20 => "C&C",
			),
			1=> array(
					4 => "Thruster",
					6 => "Assault Laser",
					8 => "Gravitic Shield",	
					10 => "Light Particle Beam",
					17 => "Structure",
					20 => "Primary",
			),
			2=> array(
					6 => "Thruster",
					7 => "Gravitic Shield",	
					9 => "Light Particle Beam",
					17 => "Structure",
					20 => "Primary",
			),
		);
    }
}

?>
