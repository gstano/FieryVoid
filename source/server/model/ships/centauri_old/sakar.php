<?php
class Sakar extends BaseShip{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
		$this->pointCost = 485;
        $this->faction = "Centauri Republic (WotCR)";
        $this->phpclass = "Sakar";
        $this->imagePath = "img/ships/sakar.png"; 
        $this->shipClass = "Sakar Carrier";
        $this->shipSizeClass = 3;
        $this->limited = 33;
        $this->fighters = array("normal"=>48);
	    $this->isd = 1875;

        $this->forwardDefense = 17;
        $this->sideDefense = 17;
        
        $this->turncost = 1.33;
        $this->turndelaycost = 1.33;
        $this->accelcost = 4;
        $this->rollcost = 4;
        $this->pivotcost = 3;
                 
        $this->addPrimarySystem(new Reactor(5, 18, 0, 0));
        $this->addPrimarySystem(new CnC(5, 25, 0, 0));
        $this->addPrimarySystem(new Scanner(5, 16, 4, 7));
        $this->addPrimarySystem(new Engine(5, 20, 0, 10, 3));
		$this->addPrimarySystem(new Hangar(5, 4));
        
        $this->addFrontSystem(new Thruster(4, 10, 0, 4, 1));
        $this->addFrontSystem(new Thruster(4, 10, 0, 4, 1));
        $this->addFrontSystem(new ParticleProjector(2, 6, 1, 240, 120));
        $this->addFrontSystem(new ParticleProjector(2, 6, 1, 240, 120));
        $this->addFrontSystem(new Hangar(4, 12));
        $this->addFrontSystem(new Hangar(4, 12));
        
        $this->addAftSystem(new Thruster(2, 8, 0, 2, 2));
        $this->addAftSystem(new Thruster(2, 8, 0, 2, 2));
        $this->addAftSystem(new Thruster(2, 8, 0, 2, 2));
        $this->addAftSystem(new Thruster(2, 8, 0, 2, 2));
        $this->addAftSystem(new Thruster(2, 8, 0, 2, 2));
        $this->addAftSystem(new JumpEngine(4, 24, 3, 20));      
        $this->addAftSystem(new ParticleProjector(2, 6, 1, 90, 270));
        $this->addAftSystem(new ParticleProjector(2, 6, 1, 90, 270));
        
	$this->addLeftSystem(new Thruster(4, 15, 0, 5, 3));
        $this->addLeftSystem(new ParticleProjector(2, 6, 1, 180, 360));
        $this->addLeftSystem(new Hangar(4, 12));
        
	$this->addRightSystem(new Thruster(4, 15, 0, 5, 4));
        $this->addRightSystem(new ParticleProjector(2, 6, 1, 0, 180));
        $this->addRightSystem(new Hangar(4, 12));
                
        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure( 5, 56));
        $this->addAftSystem(new Structure( 3, 48));
        $this->addLeftSystem(new Structure( 4, 48));
        $this->addRightSystem(new Structure( 4, 48));
        $this->addPrimarySystem(new Structure( 5, 48));
	    
	    
	//d20 hit chart
	$this->hitChart = array(
		
		0=> array(
			11 => "Structure",
			14 => "Scanner",
			16 => "Engine",
			17 => "Hangar",
			19 => "Reactor",
			20 => "C&C",
		),
		1=> array(
			5 => "Thruster",
			8 => "Particle Projector",
			12 => "Hangar",
			18 => "Structure",
			20 => "Primary",
		),
		2=> array(
			6 => "Thruster",
			9 => "Jump Engine",
			11 => "Particle Projector",
			18 => "Structure",
			20 => "Primary",
		),
		3=> array(
			6 => "Thruster",
			8 => "Particle Projector",
			12 => "Hangar",
			18 => "Structure",
			20 => "Primary",
		),
		4=> array(
			6 => "Thruster",
			8 => "Particle Projector",
			12 => "Hangar",
			18 => "Structure",
			20 => "Primary",
		),
	);
    }
}
?>
