<?php
class ProtectorateTishat extends FighterFlight{

    function __construct($id, $userid, $name,  $slot){
        parent::__construct($id, $userid, $name,  $slot);

		$this->pointCost = 75*6;
		$this->faction = "Minbari Protectorate";
		$this->phpclass = "ProtectorateTishat";
		$this->shipClass = "Protectorate Tishat flight";
		// need picture
		$this->imagePath = "img/ships/tishat.png";

        $this->forwardDefense = 6;
        $this->sideDefense = 7;
        $this->freethrust = 14;
        $this->offensivebonus = 6;
        $this->jinkinglimit = 8;
        $this->turncost = 0.33;
        $this->iniativebonus = 95;
        $this->gravitic = true;
        $this->populate();
        $this->isd = 1880;
    }

    public function populate(){

        $current = count($this->systems);
        $new = $this->flightSize;
        $toAdd = $new - $current;

        for ($i = 0; $i < $toAdd; $i++){
            $armour = array(3, 3, 3, 3);
            $tishat = new Fighter("Tishat", $armour, 9, $this->id);
            $tishat->displayName = "Tishat";
        // need picture
            $tishat->imagePath = "img/ships/tishat.png";
        // need picture
            $tishat->iconPath = "img/ships/tishat-large.png";
            $tishat->addFrontSystem(new LightFusionCannon(330, 30, 4, 2));
		
		$tishat->addAftSystem(new RammingAttack(0, 0, 360, $tishat->getRammingFactor(), 0)); //ramming attack
			
		
            $this->addSystem($tishat);
        }
    }
}
?>