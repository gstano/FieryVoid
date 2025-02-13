<?php
class TorataGoltharCC extends BaseShip{

	function __construct($id, $userid, $name,  $slot)
	{
		parent::__construct($id, $userid, $name,  $slot);

		$this->pointCost = 600;
		$this->faction = "Torata Regency";
		$this->phpclass = "TorataGoltharCC";
		$this->imagePath = "img/ships/TorataGolthar.png";
		$this->shipClass = "Golthar Fast Cruiser";
		$this->canvasSize = 200;
		$this->shipSizeClass = 3;
		$this->isd = 2257;

		$this->forwardDefense = 17;
		$this->sideDefense = 15;

		$this->turncost = 1;
		$this->turndelaycost = 0.66;
		$this->accelcost = 2;
		$this->rollcost = 3;
		$this->pivotcost = 3;
		$this->iniativebonus = 0;

		$this->addPrimarySystem(new Reactor(5, 18, 0, 0));
		$this->addPrimarySystem(new CnC(5, 16, 0, 0));
		$this->addPrimarySystem(new Scanner(5, 18, 6, 8));
		$this->addPrimarySystem(new Engine(5, 20, 0, 12, 3));
		$this->addPrimarySystem(new JumpEngine(5, 16, 4, 27));
		$this->addPrimarySystem(new Hangar(5, 2, 0, 0));
		
		$this->addFrontSystem(new PlasmaAccelerator(4, 10, 5, 300, 60));
		$this->addFrontSystem(new Thruster(4, 8, 0, 3, 1));
		$this->addFrontSystem(new Thruster(4, 8, 0, 3, 1));
		$this->addFrontSystem(new Thruster(4, 8, 0, 3, 1));
		
		$this->addAftSystem(new Thruster(4, 10, 0, 3, 2));
		$this->addAftSystem(new Thruster(4, 10, 0, 3, 2));
		$this->addAftSystem(new PentagonArray(3, 0, 0, 90, 270));
		$this->addAftSystem(new Thruster(4, 10, 0, 3, 2));
		$this->addAftSystem(new Thruster(4, 10, 0, 3, 2));

		$this->addLeftSystem(new LaserAccelerator(4, 0, 0, 270, 60));
		$this->addLeftSystem(new PentagonArray(3, 0, 0, 240, 60));
		$this->addLeftSystem(new Thruster(3, 15, 0, 6, 3));

		$this->addRightSystem(new LaserAccelerator(4, 0, 0, 300, 90));
		$this->addRightSystem(new PentagonArray(3, 0, 0, 300, 120));
		$this->addRightSystem(new Thruster(3, 15, 0, 6, 4));

		//0:primary, 1:front, 2:rear, 3:left, 4:right;
		$this->addFrontSystem(new Structure(4, 48));
		$this->addAftSystem(new Structure(4, 48));
		$this->addLeftSystem(new Structure(5, 48));
		$this->addRightSystem(new Structure(5, 48));
		$this->addPrimarySystem(new Structure(5, 50));

		$this->hitChart = array(
			0=> array(
				10 => "Structure",
				12 => "Jump Engine",
				14 => "Scanner",
				16 => "Engine",
				17 => "Hangar",
				19 => "Reactor",
				20 => "C&C",
			),
			1=> array(
				6 => "Thruster",
				8 => "Plasma Accelerator",
				18 => "Structure",
				20 => "Primary",
			),
			2=> array(
				6 => "Thruster",
				8 => "Pentagon Array",
				18 => "Structure",
				20 => "Primary",
			),
			3=> array(
				4 => "Thruster",
				6 => "Laser Accelerator",
				8 => "Pentagon Array",
				18 => "Structure",
				20 => "Primary",
			),
			4=> array(
				4 => "Thruster",
				6 => "Laser Accelerator",
				8 => "Pentagon Array",
				18 => "Structure",
				20 => "Primary",
			),
		);
	}
}



?>