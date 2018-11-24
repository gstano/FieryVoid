<?php
class BaseShip
{

    public $shipSizeClass = 3; //0:Light, 1:Medium, 2:Heavy, 3:Capital, 4:Enormous
    public $Enormous = false; //size class 4 is NOT implemented!!! for semi-Enormous unit, set this variable to True
    public $imagePath, $shipClass;
    public $systems = array();
    public $EW = array();
    public $fighters = array();
    public $hitChart = array();
    public $notes = ''; //notes to be displayed on fleet selection screen

    public $occurence = "common";
    public $variantOf = ''; //variant of what? - MUST be the same as $shipClass of base unit, or this unit will not be displayed on fleet selection screen!
    public $limited = 0;
    public $agile = false;
    public $accelcost, $rollcost, $pivotcost, $evasioncost;
    public $currentturndelay = 0;
    public $iniative = "N/A";
    public $unmodifiedIniative = null;
    public $iniativebonus = 0;
    public $iniativeadded = 0; //Initiative bonus difference - compared to base bonus! Just for display to player.
    public $gravitic = false;
    public $phpclass;
    public $forwardDefense, $sideDefense;
    public $destroyed = false;
    public $pointCost = 0;
    public $faction = null;
    public $slot;
    public $unavailable = false;
    public $minesweeperbonus = 0;
    public $base = false;
    public $smallBase = false;
    public $critRollMod = 0; //penalty to critical damage roll: positive means crit is more likely, negative less likely (for all systems)

    public $jinkinglimit = 0; //just in case there will be a ship actually able to jink; NOT SUPPORTED!

    public $enabledSpecialAbilities = array();

    public $canvasSize = 200;

    public $outerSections = array(); //for determining hit locations in GUI: loc, min, max, call (loc is location id, min/max is for arc, call is true if location systems can be called)

    protected $activeHitLocations = array(); //$shooterID->targetSection ; no need for this to go public! just making sure that firing from one unit is assigned to one section
    //following values from DB
    public $id, $userid, $name, $campaignX, $campaignY;
    public $rolled = false;
    public $rolling = false;
    public $EMHardened = false; //EM Hardening (Ipsha have it) - some weapons would check for this value!

    public $team;
    private $expectedDamage = array(); //loc=>dam; damage the unit is expected to take this turn (at outer locations), to decide where to take ambiguous shots

    public $slotid;

    public $movement = array();

    protected $advancedArmor = false; //set to true if ship is equipped with advanced armor!

    public function __construct($id, $userid, $name, $slot)
    {
        $this->id = (int) $id;
        $this->userid = (int) $userid;
        $this->name = $name;
        $this->slot = $slot;
        $this->fillLocationsGUI(); //so called shots work properly
    }

    public function getAdvancedArmor()
    {
        return $this->advancedArmor;
    }

    public function getCommonIniModifiers($gamedata)
    { //common Initiative modifiers: speed, criticals
        $mod = 0;

        if (!($this instanceof OSAT)) {
            $CnC = $this->getSystemByName("CnC");
            if ($CnC) {
                $mod += -5 * ($CnC->hasCritical("CommunicationsDisrupted", $gamedata->turn));
                $mod += -10 * ($CnC->hasCritical("ReducedIniativeOneTurn", $gamedata->turn));
                $mod += -10 * ($CnC->hasCritical("ReducedIniative", $gamedata->turn));
                //additional: SWTargetHeld (ship being held by Tractor Beam - reduces Initiative
                $mod += -20 * ($CnC->hasCritical("swtargetheld", $gamedata->turn)); //-4 Ini per hit
                //additional: tmpinidown (temporary Ini reduction - Abbai weapon scan do so!
                $mod += -5 * ($CnC->hasCritical("tmpinidown", $gamedata->turn)); //-1 Ini per crit
            }
            if ($this instanceof FighterFlight) {
                $firstFighter = $this->getSampleFighter();
                if ($firstFighter) {
                    $mod += -5 * $firstFighter->hasCritical("tmpinidown", $gamedata->turn);
                }
            }
        }
        return $mod;
    }

    public function stripForJson()
    {
        $strippedShip = new stdClass();
        $strippedShip->name = $this->name;
        $strippedShip->team = $this->team;
        $strippedShip->currentturndelay = $this->currentturndelay;
        $strippedShip->iniative = $this->iniative;
        $strippedShip->unmodifiedIniative = $this->unmodifiedIniative;
        $strippedShip->iniativeadded = $this->iniativeadded;
        $strippedShip->destroyed = $this->destroyed;
        $strippedShip->slot = $this->slot;
        $strippedShip->unavailable = $this->unavailable;
        $strippedShip->id = $this->id;
        $strippedShip->userid = $this->userid;
        $strippedShip->rolled = $this->rolled;
        $strippedShip->rolling = $this->rolling;
        $strippedShip->slotid = $this->slotid;
        $strippedShip->EW = $this->EW;
        $strippedShip->movement = $this->movement;
        $strippedShip->faction = $this->faction;
        $strippedShip->phpclass = $this->phpclass;
        $strippedShip->systems = array_map(function ($system) {return $system->stripForJson();}, $this->systems);
        return $strippedShip;
    }

    public function getInitiativebonus($gamedata)
    {
        if ($this->faction == "Centauri") {
            return $this->doCentauriInitiativeBonus($gamedata);
        }
        if ($this->faction == "Yolu") {
            return $this->doYoluInitiativeBonus($gamedata);
        }
        if ($this->faction == "Dilgar") {
            return $this->doDilgarInitiativeBonus($gamedata);
        }
        return $this->iniativebonus;
    }

    private function doCentauriInitiativeBonus($gamedata)
    {
        foreach ($gamedata->ships as $ship) {
            if (!$ship->isDestroyed()
                && ($ship->faction == "Centauri")
                && ($this->userid == $ship->userid)
                && ($ship instanceof PrimusMaximus)
                && ($this->id != $ship->id)) {
                return ($this->iniativebonus + 5);
            }
        }
        return $this->iniativebonus;
    }

    private function doDilgarInitiativeBonus($gamedata)
    {

        $mod = 0;

        if ($gamedata->turn > 0 && $gamedata->phase >= 0) {
            $pixPos = $this->getCoPos();
            //TODO: Better distance calculation
            $ships = $gamedata->getShipsInDistance($this, 9);

            foreach ($ships as $ship) {
                if (!$ship->isDestroyed()
                    && ($ship->faction == "Dilgar")
                    && ($this->userid == $ship->userid)
                    && ($ship->shipSizeClass == 3)
                    && ($this->id != $ship->id)) {
                    $cnc = $ship->getSystemByName("CnC");
                    $bonus = $cnc->output;
                    if ($bonus > $mod) {
                        $mod = $bonus;
                    } else {
                        continue;
                    }

                }
            }
        }
        //    debug::log($this->phpclass."- bonus: ".$mod);
        return $this->iniativebonus + $mod * 5;
    }

    private function doYoluInitiativeBonus($gamedata)
    {
        foreach ($gamedata->ships as $ship) {
            if (!$ship->isDestroyed()
                && ($ship->faction == "Yolu")
                && ($this->userid == $ship->userid)
                && ($ship instanceof Udran)
                && ($this->id != $ship->id)) {
                $cnc = $ship->getSystemByName("CnC");
                $bonus = $cnc->output;
                return ($this->iniativebonus + $bonus * 5);
            }
        }
        return $this->iniativebonus;
    }

    public function setEW($ew)
    {
        $this->EW[] = $ew;
    }

    public function setMovement($movement)
    {
        $this->movement[] = $movement;
    }

    public function setMovements($movements)
    {
        $this->movement = $movements;
    }

    public function onConstructed($turn, $phase, $gamedata)
    {
        foreach ($this->systems as $system) {
            $system->onConstructed($this, $turn, $phase);
            $this->enabledSpecialAbilities = $system->getSpecialAbilityList($this->enabledSpecialAbilities);
        }
        //fill $this->iniativeadded
        $modifiedbonus = $this->getInitiativebonus($gamedata) + $this->getCommonIniModifiers($gamedata);
        $modifiedbonus = $modifiedbonus - $this->iniativebonus;
        $this->iniativeadded = $modifiedbonus;
    }

    public function hasSpecialAbility($ability)
    {
        return (isset($this->enabledSpecialAbilities[$ability]));
    }

    public function getSpecialAbilitySystem($ability)
    {
        if (isset($this->enabledSpecialAbilities[$ability])) {
            return $this->getSystemById($this->enabledSpecialAbilities[$ability]);
        }

        return null;
    }

    public function getSpecialAbilityValue($ability, $args = null)
    {
        $system = $this->getSpecialAbilitySystem($ability);
        if ($system) {
            return $system->getSpecialAbilityValue($args);
        }

        return false;
    }

    public function isElint()
    {
        return $this->getSpecialAbilityValue("ELINT");
    }

    protected function addSystem($id, $system, $loc)
    {

        if (!$id) {
            throw new Exception("Adding system requires an id");
        }

        $system->setId($id);
        $system->location = $loc;
        $system->setUnit($this);

        array_push($this->systems, $system);

        if ($system instanceof Structure) {
            $this->structures[$loc] = $system->id;
        }

    }

    protected function addFrontSystem($id, $system)
    {
        $this->addSystem($id, $system, 1);
    }
    protected function addAftSystem($id, $system)
    {
        $this->addSystem($id, $system, 2);
    }
    protected function addPrimarySystem($id, $system)
    {
        $this->addSystem($id, $system, 0);
    }

    protected function addLeftSystem($id, $system)
    {
        $this->addSystem($id, $system, 3);
    }

    protected function addRightSystem($id, $system)
    {
        $this->addSystem($id, $system, 4);
    }

    public function addDamageEntry($damage)
    {

        $system = $this->getSystemById($damage->systemid);
        $system->damage[] = $damage;

    }

    public function getLastTurnMoved()
    {
        $turn = 0;
        foreach ($this->movement as $elementKey => $move) {
            if (!$move->preturn && $move->type != "deploy") {
                $turn = $move->turn;
            }

        }

        return $turn;
    }

    public function getMovementById($id)
    {
        foreach ($this->movement as $move) {
            if ($move->id === $id) {
                return $move;
            }

        }

        return null;
    }

    public function getLastMovement()
    {
        $m = 0;

        if (!is_array($this->movement)) {
            return null;
        }

        foreach ($this->movement as $elementKey => $move) {
            $m = $move;
        }

        return $m;
    }

    public function getSystemById($id)
    {
        foreach ($this->systems as $system) {
            if ($system->id === $id) {
                return $system;
            }
        }

        return null;
    }

    public function getSystemByName($name)
    {
        foreach ($this->systems as $system) {
            if ($system instanceof $name) {
                return $system;
            } else {
                if ($system instanceof Weapon && $system->duoWeapon) {
                    foreach ($system->weapons as $weapon) {
                        if ($weapon instanceof $name) {
                            return $weapon;
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getSystemsByNameLoc($name, $location, $acceptDestroyed = false)
    { /*get list of required systems on a particular location*/
        /*name may indicate different location?...*/
        /*'destroyed' means either destroyed as of PREVIOUS turn, OR reduced to health 0*/
        $location_different_array = explode(':', $name);
        if (sizeof($location_different_array) == 2) { //indicated different section: exactly 2 items - first location, then name
            return $this->getSystemsByNameLoc($location_different_array[1], $location_different_array[0], $acceptDestroyed);
        } else {
            $returnTab = array();
            if ($name == 'Structure') { //Structure is special, as it might actually belong to a different section! (on MCVs)
                $system = $this->getStructureSystem($location);
                if (($acceptDestroyed == true) || (!$system->isDestroyed())) {
                    $returnTab[] = $system;
                }
            } else {
                foreach ($this->systems as $system) {
                    if (($system->displayName == $name) && ($system->location == $location)) {
                        if (($acceptDestroyed == true) || (!$system->isDestroyed())) {
                            $returnTab[] = $system;
                        }
                    }
                }
            }
            return $returnTab;
        }
        return array(); //should never reach here
    } //end of function getSystemsByNameLoc

    public function getSystemsByName($name, $acceptDestroyed = false)
    { /*get list of required systems anywhere on a ship*/
        /*'destroyed' means either destroyed as of PREVIOUS turn, OR reduced to health 0*/
        $returnTab = array();
        foreach ($this->systems as $system) {
            if (($system->displayName == $name)) {
                if (($acceptDestroyed == true) || (!$system->isDestroyed())) {
                    $returnTab[] = $system;
                }
            }
        }
        return $returnTab;
    } //end of function getSystemsByName

    public function getHitChanceMod($shooter, $pos, $turn, $weapon)
    {
        if ($pos !== null) {
            $pos = Mathlib::hexCoToPixel($pos);
        }
        $affectingSystems = array();
        foreach ($this->systems as $system) {
            if (!$this->checkIsValidAffectingSystem($system, $shooter, $pos, $turn, $weapon)) {
                continue;
            }

            $mod = $system->getDefensiveHitChangeMod($this, $shooter, $pos, $turn, $weapon);
            if (!isset($affectingSystems[$system->getDefensiveType()]) //no system of this kind is taken into account yet, or it is but it's weaker
                 || $affectingSystems[$system->getDefensiveType()] < $mod) {
                $affectingSystems[$system->getDefensiveType()] = $mod;
            }
        }
        return (-array_sum($affectingSystems));
    }

    public function getDamageMod($shooter, $pos, $turn, $weapon)
    {
        if ($pos !== null) {
            $pos = Mathlib::hexCoToPixel($pos);
        }
        $affectingSystems = array();
        foreach ($this->systems as $system) {
            if (!$this->checkIsValidAffectingSystem($system, $shooter, $pos, $turn, $weapon)) {
                continue;
            }

            $mod = $system->getDefensiveDamageMod($this, $shooter, $pos, $turn, $weapon);
            if (!isset($affectingSystems[$system->getDefensiveType()])
                || $affectingSystems[$system->getDefensiveType()] < $mod) {
                $affectingSystems[$system->getDefensiveType()] = $mod;
            }
        }
        return array_sum($affectingSystems);
    }

    private function checkIsValidAffectingSystem($system, $shooter, $pos, $turn, $weapon)
    {
        if (!($system instanceof DefensiveSystem)) {
            return false;
        }
        //this isn't a defensive system at all

        //If the system was destroyed last turn continue
        //(If it has been destroyed during this turn, it is still usable)
        if ($system->isDestroyed($turn - 1)) {
            return false;
        }

        //If the system is offline either because of a critical or power management, continue
        if ($system->isOfflineOnTurn($turn)) {
            return false;
        }

        //if the system has arcs, check that the position is on arc
        if (is_int($system->startArc) && is_int($system->endArc)) {
            //get bearing on incoming fire...
            if ($pos != null) { //firing position is explicitly declared
                $relativeBearing = $this->getBearingOnPos($pos);
            } else { //check from shooter...
                $relativeBearing = $this->getBearingOnUnit($shooter);
            }

            //if not on arc, continue!
            if (!mathlib::isInArc($relativeBearing, $system->startArc, $system->endArc)) {
                return false;
            }
        }

        return true;
    }

    public function getLastTurnMovement($turn)
    {
        /*new code - returns last move of turn previous to indicated*/
        $trgtTurn = $turn - 1;
        $movement = null;
        foreach ($this->movement as $move) { //should be sorted from oldest to newest...
            if ($move->type == "start") {
                continue;
            }
            //not a real move
            if (($move->turn > $trgtTurn) && ($move->type != 'deploy')) {
                continue;
            }
            //future move; but always include deployment!
            $movement = $move;
        }
        return $movement;
    }

    public function getCoPos()
    {

        $movement = null;
        if (!is_array($this->movement)) {
            return array("x" => 0, "y" => 0);
        }
        foreach ($this->movement as $move) {
            $movement = $move;
        }
        return $movement->getCoPos();

    }

    public function getHexPos(): OffsetCoordinate
    {

        $movement = null;
        if (!is_array($this->movement)) {
            return new OffsetCoordinate(0, 0);
        }

        foreach ($this->movement as $move) {
            $movement = $move;
        }

        return $movement->position;
    }

    public function getPreviousCoPos()
    {
        $pos = $this->getCoPos();

        for ($i = sizeof($this->movement) - 1; $i >= 0; $i--) {
            $move = $this->movement[$i];
            $pPos = $move->getCoPos();

            if ($pPos["x"] != $pos["x"] || $pPos["y"] != $pos["y"]) {
                return $pPos;
            }

        }

        return $pos;
    }

    public function getEWbyType($type, $turn, $target = null)
    {
        foreach ($this->EW as $EW) {
            if ($EW->turn != $turn) {
                continue;
            }

            if ($target && $EW->targetid != $target->id) {
                continue;
            }

            if ($EW->type == $type) {
                return $EW->amount;
            }
        }

        return 0;

    }

    public function getDEW($turn)
    {

        foreach ($this->EW as $EW) {
            if ($EW->type == "DEW" && $EW->turn == $turn) {
                return $EW->amount;
            }

        }

        return 0;

    }

    public function getBlanketDEW($turn)
    {
        foreach ($this->EW as $EW) {
            if ($EW->type == "BDEW" && $EW->turn == $turn) {
                return $EW->amount;
            }

        }

        return 0;
    }

    public function getOEW($target, $turn)
    {

        if ($target instanceof FighterFlight) {
            foreach ($this->EW as $EW) {
                if ($EW->type == "CCEW" && $EW->turn == $turn) {
                    return $EW->amount;
                }

            }
        } else {
            foreach ($this->EW as $EW) {
                if ($EW->type == "OEW" && $EW->targetid == $target->id && $EW->turn == $turn) {
                    return $EW->amount;
                }

            }
        }

        return 0;
    }

    public function getOEWTargetNum($turn)
    {

        $amount = 0;
        foreach ($this->EW as $EW) {
            if ($EW->type == "OEW" && $EW->turn == $turn) {
                $amount++;
            }

        }

        return $amount;
    }

    public function getFacingAngle()
    {
        $movement = null;

        foreach ($this->movement as $move) {
            $movement = $move;
        }

        return $movement->getFacingAngle();
    }

    public function getStructureSystem($location)
    {
        foreach ($this->systems as $system) {
            if ($system instanceof Structure && $system->location == $location) {
                return $system;
            }
        }
        if ($location != 0) { //if there is no appropriate structure for a section, then it must be PRIMARY Structure!
            return $this->getStructureSystem(0);
        } else {
            return null;
        }
    }

    public function getFireControlIndex()
    {
        return 2;
    }

    public function isDestroyed($turn = false)
    {
        foreach ($this->systems as $system) {
            if ($system instanceof Reactor && $system->isDestroyed($turn)) {
                return true;
            }

            if ($system instanceof Structure && $system->location == 0 && $system->isDestroyed($turn)) {
                return true;
            }

        }

        return false;
    }

    public function isDisabled()
    {
        if ($this->isPowerless()) {
            return true;
        }

        $CnC = $this->getSystemByName("CnC");
        if (!$CnC || $CnC->destroyed || $CnC->hasCritical("ShipDisabledOneTurn", TacGamedata::$currentTurn)) {
            return true;
        }

        return false;
    }

    public function isPowerless()
    {
        $output = 0;
        foreach ($this->systems as $system) {
            if ($system->isDestroyed()) {
                continue;
            }

            if ($system instanceof Reactor) {
                $output += $system->outputMod;
            } else if ($system->powerReq > 0) {
                $output += $system->powerReq;
            }

        }

        if ($output >= 0) {
            return false;
        }

        return true;
    }

    public function getBearingOnPos($pos)
    { //returns relative angle from this unit to indicated coordinates
        $tf = $this->getFacingAngle(); //ship facing
        $compassHeading = mathlib::getCompassHeadingOfPos($this, $pos); //absolute bearing
        $relativeBearing = Mathlib::addToDirection($compassHeading, -$tf); //relative bearing
        if (Movement::isRolled($this)) { //if ship is rolled, mirror relative bearing
            if ($relativeBearing != 0) { //mirror of 0 is 0
                $relativeBearing = 360 - $relativeBearing;
            }
        }
        return $relativeBearing;
    }

    public function getBearingOnUnit($unit)
    { //returns relative angle from this unit to indicated unit
        $tf = $this->getFacingAngle(); //ship facing
        $compassHeading = mathlib::getCompassHeadingOfShip($this, $unit); //absolute bearing
        $relativeBearing = Mathlib::addToDirection($compassHeading, -$tf); //relative bearing
        if (Movement::isRolled($this)) { //if ship is rolled, mirror relative bearing
            if ($relativeBearing != 0) { //mirror of 0 is 0
                $relativeBearing = 360 - $relativeBearing;
            }
        }
        return $relativeBearing;
    }

    public function doGetHitSectionBearing($relativeBearing)
    { //pick section hit from given bearing; return array with all data!
        $locs = $this->getLocations();
        $valid = array();
        foreach ($locs as $loc) {
            if (mathlib::isInArc($relativeBearing, $loc["min"], $loc["max"])) {
                $valid[] = $loc;
            }
        }
        $valid = $this->fillLocations($valid);
        $pick = $this->pickLocationForHit($valid);
        return $pick;
    }

    public function doGetHitSectionPos($pos)
    { //pick section hit from given coordinates; return array with all data!
        $relativeBearing = $this->getBearingOnPos($pos);
        $result = $this->doGetHitSectionBearing($relativeBearing);
        return $result;
    }

    public function doGetHitSection($shooter)
    { //pick section hit from given unit; return array with all data!
        $relativeBearing = $this->getBearingOnUnit($shooter);
        $result = $this->doGetHitSectionBearing($relativeBearing);
        return $result;
    }

    public function isHitSectionAmbiguous($shooter, $turn)
    { //for a shot from indicated unit - would there be choice of target section?
        $locs = $this->getLocations();
        $relativeBearing = $this->getBearingOnUnit($shooter);
        $valid = array();
        foreach ($locs as $loc) {
            if (mathlib::isInArc($relativeBearing, $loc["min"], $loc["max"])) {
                $valid[] = $loc;
            }
        }
        $valid = $this->fillLocations($valid);
        //count non-destroyed locations...
        $numValidLocs = 0;
        foreach ($valid as $loc) {
            if ($loc["remHealth"] > 0) {
                $numValidLocs++;
            }

        }
        //ambiguous: if there is more than 1 valid choice
        if ($numValidLocs > 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isHitSectionAmbiguousPos($pos, $turn)
    { //for a shot from indicated unit - would there be choice of target section?
        $locs = $this->getLocations();
        $relativeBearing = $this->getBearingOnPos($pos);
        $valid = array();
        foreach ($locs as $loc) {
            if (mathlib::isInArc($relativeBearing, $loc["min"], $loc["max"])) {
                $valid[] = $loc;
            }
        }
        $valid = $this->fillLocations($valid);
        //count non-destroyed locations...
        $numValidLocs = 0;
        foreach ($valid as $loc) {
            if ($loc["remHealth"] > 0) {
                $numValidLocs++;
            }

        }
        //ambiguous: if there is more than 1 valid choice
        if ($numValidLocs > 1) {
            return true;
        } else {
            return false;
        }
    }

/*outer locations of unit and their arcs, used for GUI called shots*/
    public function fillLocationsGUI()
    {
        $call = ($this->shipSizeClass > 1); //MCVs are one big PRIMARY
        $this->outerSections = array();
        $allOuter = $this->getLocations();
        foreach ($allOuter as $curr) {
            if ($curr['loc'] != 0) {
                $outer = array("loc" => $curr['loc'], "min" => $curr['min'], "max" => $curr['max'], "call" => $call);
                $this->outerSections[] = $outer;
            }
        }
    }

/*outer locations of unit and their arcs, used for assigning incoming fire*/
    public function getLocations()
    {
        $locs = array();
        $locs[] = array("loc" => 1, "min" => 330, "max" => 30, "profile" => $this->forwardDefense);
        $locs[] = array("loc" => 4, "min" => 30, "max" => 150, "profile" => $this->sideDefense);
        $locs[] = array("loc" => 2, "min" => 150, "max" => 210, "profile" => $this->forwardDefense);
        $locs[] = array("loc" => 3, "min" => 210, "max" => 330, "profile" => $this->sideDefense);
        return $locs;
    }

    public function fillLocations($locs)
    {
        foreach ($locs as $key => $loc) {
            $structure = $this->getStructureSystem($locs[$key]["loc"]);
            if ($structure) {
                $locs[$key]["remHealth"] = $structure->getRemainingHealth();
                if ($locs[$key]["remHealth"] > 0) { //else section is destroyed anyway!
                    if (isset($expectedDamage[$locs[$key]["loc"]])) {
                        $locs[$key]["remHealth"] -= round($expectedDamage[$locs[$key]["loc"]]);
                        $locs[$key]["remHealth"] = max(1, $locs[$key]["remHealth"]);
                    }
                }
                $locs[$key]["armour"] = $structure->armour;
            } else {
                return null; //should never happen!
            }
        }
        return $locs;
    }

    public function pickLocationForHit($locs)
    { //return array! ONLY OUTER LOCATIONS!!! (unless PRIMARY can be hit directly and is on hit table)
        $pick = array("loc" => 0, "profile" => 80, "remHealth" => 0, "armour" => 0);
        foreach ($locs as $loc) {
            //compare current best pick with current loop iteration, change if new pick is better
            $toughnessPick = $pick["remHealth"] + round($pick["remHealth"] * $pick["armour"] * 0.15); //toughness: remaining structure toughened by armor
            $toughnessLoc = $loc["remHealth"] + round($loc["remHealth"] * $loc["armour"] * 0.15); //every point of armor increases toughness by 15%

            //now, depending on which profile is larger - modify toughness of smaller profile
            //every point of size difference increases perceived toughness by 12 points
            //that's a lot if remaining structure is low, but not all that much if it's high
            $profileImpact = 17; //equiv. to almost 10 Str boxes at armor 5, or 11 at 4
            if ($pick["profile"] < $loc["profile"]) { //old profile smaller
                $profileDiff = $loc["profile"] - $pick["profile"];
                if ($toughnessPick > 0) // profile shouldn't cause destroyed section to be chosen
                {
                    $toughnessPick = $toughnessPick + ($profileDiff * $profileImpact);
                }

            } elseif ($pick["profile"] > $loc["profile"]) { //old profile larger
                $profileDiff = $pick["profile"] - $loc["profile"];
                if ($toughnessLoc > 0) // profile shouldn't cause destroyed section to be chosen
                {
                    $toughnessLoc = $toughnessLoc + ($profileDiff * $profileImpact);
                }

            }

            if ($toughnessLoc > $toughnessPick) { //if new toughness is better, it wins (already takes profile into account)
                $pick = $loc;
            } elseif (($toughnessLoc == $toughnessPick) && ($loc["profile"] < $pick["profile"])) { //if toughness is equal, better profile wins
                $pick = $loc;
            } //else old choice stays
        }

        return $pick;
    }

    public function getHitSectionChoice($shooter, $fireOrder, $weapon, $returnDestroyed = false)
    { //returns value - location! chooses method based on weapon and fire order!
        $foundLocation = 0;
        if ($weapon->ballistic) {
            $movement = $shooter->getLastTurnMovement($fireOrder->turn); //turn - 1?...
            $posLaunch = mathlib::hexCoToPixel($movement->position);
            $foundLocation = $this->getHitSectionPos($posLaunch, $fireOrder->turn);
        } else {
            $foundLocation = $this->getHitSection($shooter, $fireOrder->turn, $returnDestroyed);
        }
        return $foundLocation;
    }
    public function getHitSection($shooter, $turn, $returnDestroyed = false)
    { //returns value - location! DO NOT USE FOR BALLISTICS!
        $foundLocation = 0;
        if (isset($this->activeHitLocations[$shooter->id])) {
            $foundLocation = $this->activeHitLocations[$shooter->id]["loc"];
        } else {
            $loc = $this->doGetHitSection($shooter); //finds array with relevant data!
            $this->activeHitLocations[$shooter->id] = $loc; //save location for further hits from same unit
            $foundLocation = $loc["loc"];
        }

        if ($foundLocation > 0 && $returnDestroyed == false) { //return it only if not destroyed as of previous turn
            $structure = $this->getStructureSystem($foundLocation); //this always returns appropriate structure
            if ($structure->isDestroyed($turn - 1)) {
                $foundLocaton = 0;
            }

        }
        return $foundLocation;
    }
    public function getHitSectionPos($pos, $turn, $returnDestroyed = false)
    { //returns value - location! THIS IS FOR BALLISTICS!
        $foundLocation = 0;
        $loc = $this->doGetHitSectionPos($pos); //finds array with relevant data!
        $foundLocation = $loc["loc"];
        if ($foundLocation > 0 && $returnDestroyed == false) { //return it only if not destroyed as of previous turn
            $structure = $this->getStructureSystem($foundLocation); //this always returns appropriate structure
            if ($structure->isDestroyed($turn - 1)) {
                $foundLocaton = 0;
            }

        }
        return $foundLocation;
    }

    public function getHitSectionProfileChoice($shooter, $fireOrder, $weapon)
    { //returns value - profile! chooses method based on weapon and fire order!
        $foundProfile = 0;
        if ($weapon->ballistic) {
            $movement = $shooter->getLastTurnMovement($fireOrder->turn); //turn-1?...
            $posLaunch = mathlib::hexCoToPixel($movement->position);
            $foundProfile = $this->getHitSectionProfilePos($posLaunch);
        } else {
            $foundProfile = $this->getHitSectionProfile($shooter);
        }
        return $foundProfile;
    }
    public function getHitSectionProfile($shooter)
    { //returns value - profile! DO NOT USE FOR BALLISTICS!
        $foundProfile = 0;
        if (isset($this->activeHitLocations[$shooter->id])) {
            $foundProfile = $this->activeHitLocations[$shooter->id]["profile"];
        } else {
            $loc = $this->doGetHitSection($shooter, $preGoal); //finds array with relevant data!
            $this->activeHitLocations[$shooter->id] = $loc; //save location for further hits from same unit
            $foundProfile = $loc["profile"];
        }
        return $foundProfile;
    }
    public function getHitSectionProfilePos($pos)
    { //returns value - profile! THIS IS FOR BALLISTICS!
        $foundProfile = 0;
        $loc = $this->doGetHitSectionPos($pos); //finds array with relevant data!
        $foundProfile = $loc["profile"];
        return $foundProfile;
    }

    public function getHitSystemPos($pos, $shooter, $fireOrder, $weapon, $location = null)
    {
        /*find target section (based on indicated position) before finding location*/
        if ($location == null) {
            $location = $this->getHitSectionPos($pos, $fireOrder->turn);
        }
        $foundSystem = $this->getHitSystem($shooter, $fireOrder, $weapon, $location);
        return $foundSystem;
    }

    public function getHitSystem($shooter, $fireOrder, $weapon, $location = null)
    {
        /*if something has to choose system by firing position, use getHitSystemPos instead*/
        if (isset($this->hitChart[0])) {
            $system = $this->getHitSystemByTable($shooter, $fireOrder, $weapon, $location);
        } else {
            $system = $this->getHitSystemByDice($shooter, $fireOrder, $weapon, $location);
        }
        return $system;
    }

    public function getHitSystemByTable($shooter, $fire, $weapon, $location)
    {
        /*DOES NOT take care of overkill!!! returns section structure if no system can be hit, whether that section is still alive or not*/
        $system = null;
        $name = false;
        //$location_different = false; //target system may be on different location?
        //$location_different_array = array(); //array(location,system) if so indicated
        $systems = array();

        if ($fire->calledid != -1) {
            $system = $this->getSystemById($fire->calledid);
        }

        if ($system != null && !$system->isDestroyed()) {
            return $system;
        }
        //if destroted, allocate s if it wasn't called

        if ($location === null) {
            $location = $this->getHitSectionChoice($shooter, $fire, $weapon);
        }

        $hitChart = $this->hitChart[$location];
        $rngTotal = 20; //standard hit chart has 20 possible locations
        if ($weapon->damageType == 'Flash') { //Flash - change hit chart! - only undestroyed systems
            $hitChart = array();
            //use only non-destroyed systems on section hit
            $rngTotal = 0; //range of current system
            $rngCurr = 0; //total range of live systems
            for ($roll = 1; $roll <= 20; $roll++) {
                $rngCurr++;
                if (isset($this->hitChart[$location][$roll])) {
                    $name = $this->hitChart[$location][$roll];
                    if ($name != 'Primary') { //no PRIMARY penetrating hits for Flash!
                        $systemsArray = $this->getSystemsByNameLoc($name, $location, false); //undestroyed ystems of this name
                        if (sizeof($systemsArray) > 0) { //there actually are such systems!
                            $rngTotal += $rngCurr;
                            $hitChart[$rngTotal] = $name;
                        }
                    }
                    $rngCurr = 0;
                }
            }
            if ($rngTotal == 0) {
                return $this->getStructureSystem(0);
            }
//there is nothing here! penetrate to PRIMARY...
        }
        $noPrimaryHits = ($weapon->noPrimaryHits || ($weapon->damageType == 'Piercing'));
        if ($noPrimaryHits) { //change hit chart! - no PRIMARY hits!
            $hitChart = array();
            //use only non-destroyed systems on section hit
            $rngTotal = 0; //range of current system
            $rngCurr = 0; //total range of live systems
            for ($roll = 1; $roll <= 20; $roll++) {
                $rngCurr++;
                if (isset($this->hitChart[$location][$roll])) {
                    $name = $this->hitChart[$location][$roll];
                    if ($name != 'Primary') { //no PRIMARY penetrating hits
                        $systemsArray = $this->getSystemsByNameLoc($name, $location, true); //accept destroyed systems too
                        if (sizeof($systemsArray) > 0) { //there actually are such systems!
                            $rngTotal += $rngCurr;
                            $hitChart[$rngTotal] = $name;
                        }
                    }
                    $rngCurr = 0;
                }
            }
            if ($rngTotal == 0) {
                return $this->getStructureSystem($location);
            }
//there is nothing here! return facing Structure anyway, overkill methods will handle it
        }

        //now choose system from chart...
        $roll = Dice::d($rngTotal);
        $name = '';
        $isSystemKiller = $weapon->systemKiller;
        while ($name == '') {
            if (isset($hitChart[$roll])) {
                $name = $hitChart[$roll];
                if ($name == 'Structure' && $isSystemKiller) { //for systemKiller weapon, reroll Structure hits
                    $isSystemKiller = false; //don't do that again
                    $name = ''; //reset
                    $roll = Dice::d($rngTotal); //new location roll
                }
            } else {
                $roll++;
                if ($roll > $rngTotal) //out of range already! return facing Structure... Should not happen.
                {
                    return $this->getStructureSystem($location);
                }
            }
        }

        if ($name == 'Primary') { //redirect to PRIMARY!
            return $this->getHitSystemByTable($shooter, $fire, $weapon, 0);
        }
        $systems = $this->getSystemsByNameLoc($name, $location, false); //do NOT accept destroyed systems!
        if (sizeof($systems) == 0) { //if empty, damage is done to Structure
            $struct = $this->getStructureSystem($location);
            return $struct;
        }

        //now choose one of equal eligible systems (they're already known to be undestroyed... well, they may be destroyed, but then they're to be returned anyway)
        $roll = Dice::d(sizeof($systems));
        $system = $systems[$roll - 1];
        return $system;

    } //end of function getHitSystemByTable

    public function getHitSystemByDice($shooter, $fire, $weapon, $location)
    {
        /*same as by table, but prepare table out of available systems...*/
        $system = null;
        $name = false;
        //$location_different = false; //target system may be on different location?
        //$location_different_array = array(); //array(location,system) if so indicated
        $systems = array();

        if ($fire->calledid != -1) {
            $system = $this->getSystemById($fire->calledid);
        }

        if ($system != null && !$system->isDestroyed()) {
            return $system;
        }
        //if destroted, allocate s if it wasn't called

        if ($location === null) {
            $location = $this->getHitSectionChoice($shooter, $fire, $weapon);
        }

        $hitChart = array(); //$hitChart will contain system names, as usual!
        //use only non-destroyed systems on section hit
        $rngTotal = 0; //range of current system
        $rngCurr = 0; //total range of live systems

        foreach ($this->systems as $system) { //ok, do use actual systems...
            if (($system->location == $location) && (!($system instanceof Structure))) {
                //Flash - undestroyed only
                if (($weapon->damageType != 'Flash') || (!$system->isDestroyed())) {
                    //Structure and C&C will get special treatment...
                    $multiplier = 1;
                    if ($system->displayName == 'C&C') {
                        $multiplier = 0.5;
                    }
                    //C&C should have relatively low chance to be hit!
                    $rngCurr = ceil($system->maxhealth * $multiplier);
                    $rngCurr += 1; //small systems usually have relatively high chance of being hit
                    $rngTotal = $rngTotal + $rngCurr;
                    $hitChart[$rngTotal] = $system->displayName;
                }
            }
        }
        //add Structure
        $system = $this->getStructureSystem($location);
        if (($weapon->damageType != 'Flash') || (!$system->isDestroyed())) {
            if ($location == 0) {
                $multiplier = 2; //PRIMARY has relatively low Structure, increase chance
            } else {
                $multiplier = 0.5; //non-PRIMARY have relatively high structure, reduce chance
            }
            $rngCurr = ceil($system->maxhealth * $multiplier);
            $rngCurr += 1; //small systems usually have relatively high chance of being hit
            $rngTotal = $rngTotal + $rngCurr;
            $hitChart[$rngTotal] = $system->displayName;
        }
        //is there anything to be hit? if not, just return facing Structure...
        if ($rngTotal == 0) {
            $struct = $this->getStructureSystem($location); //if Structure destroyed, overkill to PRIMARY Structure
            return $struct;
        }

        //for non-Flash/Piercing, add PRIMARY to hit table...
        $noPrimaryHits = ($weapon->noPrimaryHits || ($weapon->damageType == 'Piercing') || ($weapon->damageType == 'Flash'));
        if (!$noPrimaryHits) {
            $multiplier = 0.1; //10% chance for PRIMARY penetration
            if ($this->shipSizeClass <= 1) {
                $multiplier = 0.15;
            }
//for MCVs - 15%...
            $rngCurr = ceil($rngTotal * $multiplier);
            $rngTotal = $rngTotal + $rngCurr;
            $hitChart[$rngTotal] = 'Primary';
        }

        //now choose system from chart...
        $roll = Dice::d($rngTotal);
        $name = '';
        $isSystemKiller = $weapon->systemKiller;
        while ($name == '') {
            if (isset($hitChart[$roll])) {
                $name = $hitChart[$roll];
                if ($name == 'Structure' && $isSystemKiller) { //for systemKiller weapon, reroll Structure
                    $isSystemKiller = false; //don't do that again
                    $name = '';
                    $roll = Dice::d($rngTotal); //new location roll
                }
            } else {
                $roll++;
                if ($roll > $rngTotal) //out of range already!
                {
                    return $this->getStructureSystem(0);
                }
            }
        }

        if ($name == 'Primary') { //redirect to PRIMARY!
            return $this->getHitSystemByDice($shooter, $fire, $weapon, 0);
        }
        $systems = $this->getSystemsByNameLoc($name, $location, false); //do NOT accept destroyed systems!
        if (sizeof($systems) == 0) { //if empty, just return Structure - whether destroyed or not
            $struct = $this->getStructureSystem($location);
            return $struct;
        }

        //now choose one of equal eligible systems (they're already known to be undestroyed)
        $roll = Dice::d(sizeof($systems));
        $system = $systems[$roll - 1];
        return $system;

    } //end of function GetHitSystemByDice

    public static function hasBetterIniative($a, $b)
    {
        if ($a->iniative > $b->iniative) {
            return true;
        }

        if ($a->iniative < $b->iniative) {
            return false;
        }

        if ($a->unmodifiedIniative != null && $b->unmodifiedIniative != null) {
            if ($a->unmodifiedIniative > $b->unmodifiedIniative) {
                return true;
            }

            if ($a->unmodifiedIniative < $b->unmodifiedIniative) {
                return false;
            }

        }

        if ($a->iniative == $b->iniative) {
            if ($a->iniativebonus > $b->iniativebonus) {
                return true;
            }

            if ($b->iniativebonus > $a->iniativebonus) {
                return false;
            }

            if ($a->id > $b->id) {
                return true;
            }

        }

        return false;
    }

    public function getAllFireOrders($turn = -1)
    {
        $orders = array();

        foreach ($this->systems as $system) {
            $orders = array_merge($orders, $system->getFireOrders($turn));
        }

        return $orders;
    }

    protected function getUndamagedSameSystem($system, $location)
    {
        foreach ($this->systems as $sys) {
            // check if there is another system of the same class on this location.
            if ($sys->location == $location && get_class($system) == get_class($sys) && !$sys->isDestroyed()) {
                return $sys;
            }
        }
        return null;
    }

/*note expected damage - important for deciding ambiguous shots!*/
    public function setExpectedDamage($hitLoc, $hitChance, $weapon)
    {
        //add to table private $expectedDamage = array(); //loc => dam; damage the unit is expected to take this turn
        if (($hitLoc == 0) || ($hitChance <= 0)) {
            return;
        }
        //no point checking, PRIMARY damage not relevant for this decision; same when hit chance is less than 0
        if (!isset($this->expectedDamage[$hitLoc])) {
            $this->expectedDamage[$hitLoc] = 0;
        }
        $structureSystem = $this->getStructureSystem($hitLoc);
        $armour = $structureSystem->getArmour($this, null, $weapon->damageType); //shooter relevant only for fighters - and they don't care about calculating ambiguous damage!
        $expectedDamageMax = $weapon->maxDamage - $armour;
        $expectedDamageMin = $weapon->minDamage - $armour;
        $expectedDamageMax = max(0, $expectedDamageMax);
        $expectedDamageMin = max(0, $expectedDamageMin);
        $expectedDamage = ($expectedDamageMin + $expectedDamageMax) / 4; //halve damage as not all would go to Structure! - hence /4 and not /2
        //reduce damage for non-Standard modes...
        switch ($weapon->damageType) {
            case 'Raking': //Raking damage gets reduced multiple times
                $expectedDamage = $expectedDamage * 0.9;
                break;
            case 'Piercing': //Piercing does little damage to actual outer section...
                $expectedDamage = $expectedDamage * 0.4;
                break;
            case 'Pulse': //multiple hits - assume half of max pulses hit!
                $expectedDamage = 0.5 * $expectedDamage * max(1, $weapon->maxpulses);
                break;
            default: //something else: can't be as good as Standard!
                $expectedDamage = $expectedDamage * 0.9;
                break;
        }
        //multiply by hit chance!
        $expectedDamage = $expectedDamage * min(100, $hitChance) / 100;
        $this->expectedDamage[$hitLoc] += $expectedDamage;
    } //endof function setExpectedDamage

    /*returns calculated ramming factor for ship (so will never use explosive charge if, say, Delegor or HK is rammed instead of ramming itself!*/
    /*approximate raming factor as full Structure of undestroyed sections *110% */
    public function getRammingFactor()
    {
        $structuretotal = 0;
        $prevturn = max(0, TacGamedata::$currentTurn - 1);
        $activeStructures = $this->getSystemsByName("Structure", true); //list of all Structure blocks (check for being destroyed will come later)
        foreach ($activeStructures as $struct) {
            if (!$struct->isDestroyed($prevturn)) { //if structure is not destroyed AS OF PREVIOUS TURN
                $structuretotal += $struct->maxhealth;
            }
        }
        $multiplier = 1.1;
        if ($this->shipSizeClass == 1) {
            $multiplier = 1.2;
        }
        //MCVs seem to use a bit larger multiplier...
        $dmg = ceil($structuretotal * $multiplier);
        return $dmg;
    } //endof function getRammingFactor

} //endof class BaseShip