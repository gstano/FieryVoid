<?php
class Kasta1973 extends BaseShip{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
		$this->pointCost = 575;
        $this->faction = "Centauri Republic (WotCR)";
        $this->phpclass = "Kasta1973";
        $this->imagePath = "img/ships/celerian.png";
        $this->shipClass = "Kasta Support Carrier (1973)";
        $this->shipSizeClass = 3;
        $this->fighters = array("heavy"=>12);
        $this->variantOf = "Celerian Warcruiser";
	    $this->isd = 1973;
        
        $this->forwardDefense = 15;
        $this->sideDefense = 15;
        
        $this->turncost = 1;
        $this->turndelaycost = 0.66;
        $this->accelcost = 3;
        $this->rollcost = 2;
        $this->pivotcost = 3;
        $this->occurence = "rare";
         
        $this->addPrimarySystem(new Reactor(6, 16, 0, 4));
        $this->addPrimarySystem(new CnC(6, 14, 0, 0));
        $this->addPrimarySystem(new Scanner(5, 22, 4, 7));
        $this->addPrimarySystem(new Engine(5, 18, 0, 9, 3));
		$this->addPrimarySystem(new Hangar(4, 2));		
        
        $this->addFrontSystem(new Thruster(4, 10, 0, 4, 1));
        $this->addFrontSystem(new Thruster(4, 10, 0, 4, 1));
        $this->addFrontSystem(new Hangar(4, 12, 6));      
        $this->addFrontSystem(new LightParticleBeamShip(2, 2, 1, 270, 90));   
        $this->addFrontSystem(new LightParticleBeamShip(2, 2, 1, 270, 90));   
		
        $this->addAftSystem(new Thruster(2, 10, 0, 3, 2));
        $this->addAftSystem(new Thruster(2, 12, 0, 3, 2));
        $this->addAftSystem(new Thruster(2, 10, 0, 3, 2));
        $this->addAftSystem(new JumpEngine(5, 25, 3, 20));
        
		$this->addLeftSystem(new Thruster(4, 14, 0, 5, 3));
        $this->addLeftSystem(new ImperialLaser(3, 8, 5, 300, 360));
		$this->addLeftSystem(new LightParticleBeamShip(2, 2, 1, 180, 360));
        $this->addLeftSystem(new LightParticleBeamShip(2, 2, 1, 180, 360));
        		
		$this->addRightSystem(new Thruster(4, 14, 0, 5, 4));
        $this->addRightSystem(new ImperialLaser(3, 8, 5, 0, 60));
        $this->addRightSystem(new LightParticleBeamShip(2, 2, 1, 0, 180));
        $this->addRightSystem(new LightParticleBeamShip(2, 2, 1, 0, 180));
        
        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure( 4, 38));
        $this->addAftSystem(new Structure( 4, 36));
        $this->addLeftSystem(new Structure( 4, 40));
        $this->addRightSystem(new Structure( 4, 40));
        $this->addPrimarySystem(new Structure( 5, 40));
		
	    
	//d20 hit chart
	$this->hitChart = array(
		
		0=> array(
			10 => "Structure",
			13 => "Scanner",
			16 => "Engine",
			17 => "Hangar",
			19 => "Reactor",
			20 => "C&C",
		),
		1=> array(
			5 => "Thruster",
			7 => "Light Particle Beam",
			10 => "Hangar",
			18 => "Structure",
			20 => "Primary",
		),
		2=> array(
			7 => "Thruster",
			12 => "Jump Engine",
			18 => "Structure",
			20 => "Primary",
		),
		3=> array(
			5 => "Thruster",
			8 => "Imperial Laser",
			10 => "Light Particle Beam",
			18 => "Structure",
			20 => "Primary",
		),
		4=> array(
			5 => "Thruster",
			8 => "Imperial Laser",
			10 => "Light Particle Beam",
			18 => "Structure",
			20 => "Primary",
		),
	);
		
    }
}
?>
