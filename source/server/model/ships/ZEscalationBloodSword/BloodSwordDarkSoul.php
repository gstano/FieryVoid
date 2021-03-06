<?php
class BloodSwordDarkSoul extends BaseShip{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
	$this->pointCost = 475;
	$this->faction = "ZEscalation Blood Sword Raiders";
        $this->phpclass = "BloodSwordDarkSoul";
        $this->imagePath = "img/ships/EscalationWars/BloodSwordDarksoul.png";
        $this->shipClass = "Dark Soul Battlecruiser";
        $this->shipSizeClass = 3;
		$this->canvasSize = 175; //img has 200px per side
		$this->unofficial = true;
		$this->limited = 10;

        $this->fighters = array("normal"=>12);

		$this->isd = 1943;
        
        $this->forwardDefense = 15;
        $this->sideDefense = 16;
        
        $this->turncost = 1.0;
        $this->turndelaycost = 1.0;
        $this->accelcost = 3;
        $this->rollcost = 2;
        $this->pivotcost = 3;
        $this->iniativebonus = 10;
        
        $this->addPrimarySystem(new Reactor(5, 20, 0, 0));
        $this->addPrimarySystem(new CnC(5, 16, 0, 0));
        $this->addPrimarySystem(new Scanner(4, 15, 3, 7));
        $this->addPrimarySystem(new Engine(4, 18, 0, 13, 2));
		$this->addPrimarySystem(new Hangar(4, 16));
		$this->addPrimarySystem(new JumpEngine(4, 15, 4, 24));
		
        $this->addFrontSystem(new Thruster(3, 13, 0, 4, 1));
        $this->addFrontSystem(new Thruster(3, 13, 0, 4, 1));
		$this->addFrontSystem(new EWLaserBolt(2, 4, 2, 240, 60));
		$this->addFrontSystem(new HeavyPlasma(4, 8, 5, 300, 60));
		$this->addFrontSystem(new EWLaserBolt(2, 4, 2, 300, 120));

        $this->addAftSystem(new Thruster(3, 15, 0, 7, 2));
        $this->addAftSystem(new Thruster(3, 15, 0, 7, 2));
        $this->addAftSystem(new EWLaserBolt(2, 4, 2, 90, 270));
        $this->addAftSystem(new MediumPlasma(2, 5, 3, 90, 270));
        $this->addAftSystem(new EWLaserBolt(2, 4, 2, 90, 270));

        $this->addLeftSystem(new EWRoyalLaser(3, 6, 4, 240, 360));
        $this->addLeftSystem(new MediumPlasma(2, 5, 3, 180, 360));
		$this->addLeftSystem(new CargoBay(3, 12));
        $this->addLeftSystem(new Thruster(3, 15, 0, 5, 3));
		
        $this->addRightSystem(new EWRoyalLaser(3, 6, 4, 0, 120));
        $this->addRightSystem(new MediumPlasma(2, 5, 3, 0, 180));
		$this->addRightSystem(new CargoBay(3, 12));
        $this->addRightSystem(new Thruster(3, 15, 0, 5, 4));

        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addFrontSystem(new Structure(4, 48));
        $this->addAftSystem(new Structure(4, 48));
        $this->addLeftSystem(new Structure(4, 44));
        $this->addRightSystem(new Structure(4, 44));
        $this->addPrimarySystem(new Structure(4, 50));
		
		$this->hitChart = array(
			0=> array(
					8 => "Structure",
					11 => "Jump Engine",
					13 => "Scanner",
					15 => "Engine",
					17 => "Hangar",
					19 => "Reactor",
					20 => "C&C",
			),
			1=> array(
					4 => "Thruster",
					7 => "Heavy Plasma Cannon",
					9 => "Laser Bolt",
					18 => "Structure",
					20 => "Primary",
			),
			2=> array(
					6 => "Thruster",
					8 => "Medium Plasma Cannon",
					10 => "Laser Bolt",
					18 => "Structure",
					20 => "Primary",
			),
			3=> array(
					5 => "Thruster",
					7 => "Royal Laser",
					9 => "Medium Plasma Cannon",
					10 => "Cargo Bay",
					18 => "Structure",
					20 => "Primary",
			),
			4=> array(
					5 => "Thruster",
					7 => "Royal Laser",
					9 => "Medium Plasma Cannon",
					10 => "Cargo Bay",
					18 => "Structure",
					20 => "Primary",
			),
		);
    }
}

?>
