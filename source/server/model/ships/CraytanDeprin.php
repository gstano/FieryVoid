<?php
class CraytanDeprin extends OSAT{
    
    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);
        
		$this->pointCost = 700;
		$this->faction = "ZNexus Craytan Union";
        $this->phpclass = "CraytanDeprin";
        $this->imagePath = "img/ships/Nexus/CraytanDeprin.png";
        $this->shipClass = "GOD Heavy Satellite (Beta)";
	    $this->variantOf = "GOD Heavy Satellite (Alpha)";

        
        $this->forwardDefense = 12;
        $this->sideDefense = 12;
        
        $this->turncost = 0;
        $this->turndelaycost = 0;
        $this->accelcost = 0;
        $this->rollcost = 0;
        $this->pivotcost = 0;	
        $this->iniativebonus = 60;


        //ammo magazine itself (AND its missile options)
        $ammoMagazine = new AmmoMagazine(240); //pass magazine capacity - 60 rounds per launcher
        $this->addPrimarySystem($ammoMagazine); //fit to ship immediately
        $ammoMagazine->addAmmoEntry(new AmmoMissileB(), 240); //add full load of basic missiles
        $this->enhancementOptionsEnabled[] = 'AMMO_L';//add enhancement options for other missiles - Class-L
        $this->enhancementOptionsEnabled[] = 'AMMO_H';//add enhancement options for other missiles - Class-L
        $this->enhancementOptionsEnabled[] = 'AMMO_F';//add enhancement options for other missiles - Class-L
        $this->enhancementOptionsEnabled[] = 'AMMO_A';//add enhancement options for other missiles - Class-L
        $this->enhancementOptionsEnabled[] = 'AMMO_P';//add enhancement options for other missiles - Class-P
		
        $this->addPrimarySystem(new AmmoMissileRackB(3, 0, 0, 270, 90, $ammoMagazine, true)); //$armour, $health (0=auto), $power (0=auto), $startArc, $endArc, $magazine, $base
        $this->addPrimarySystem(new AmmoMissileRackB(3, 0, 0, 270, 90, $ammoMagazine, true)); //$armour, $health (0=auto), $power (0=auto), $startArc, $endArc, $magazine, $base
        $this->addPrimarySystem(new AmmoMissileRackB(3, 0, 0, 270, 90, $ammoMagazine, true)); //$armour, $health (0=auto), $power (0=auto), $startArc, $endArc, $magazine, $base
        $this->addPrimarySystem(new AmmoMissileRackB(3, 0, 0, 270, 90, $ammoMagazine, true)); //$armour, $health (0=auto), $power (0=auto), $startArc, $endArc, $magazine, $base
        $this->addPrimarySystem(new HvyParticleCannon(5, 12, 9, 300, 60));
        $this->addPrimarySystem(new LightPulse(2, 4, 2, 180, 360));
        $this->addPrimarySystem(new LightPulse(2, 4, 2, 180, 360));
        $this->addPrimarySystem(new LightPulse(2, 4, 2, 0, 180));
        $this->addPrimarySystem(new LightPulse(2, 4, 2, 0, 180));
        $this->addPrimarySystem(new InterceptorMkII(2, 4, 2, 0, 360));
        $this->addPrimarySystem(new InterceptorMkII(2, 4, 2, 0, 360));
        $this->addPrimarySystem(new Reactor(4, 24, 0, 0));
        $this->addPrimarySystem(new Scanner(4, 16, 3, 6));   
        $this->addPrimarySystem(new Thruster(4, 20, 0, 0, 2));
                
        //0:primary, 1:front, 2:rear, 3:left, 4:right;
        $this->addPrimarySystem(new Structure(4, 60));
		
		$this->hitChart = array(
			0=> array(
				6 => "Structure",
				8 => "Thruster",
				10 => "Heavy Particle Cannon",
				13 => "Class-B Missile Rack",
				15 => "Light Pulse Cannon",
				17 => "Scanner",
				19 => "Reactor",
				20 => "Interceptor II",
			),
			1=> array(
				20 => "Primary",
			),
			2=> array(
				20 => "Primary",
			),
        );
    }
}

?>
