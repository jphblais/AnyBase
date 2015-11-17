<?php
/**
 * Created by PhpStorm.
 * User: jblais1
 * Date: 15-11-13
 * Time: 05:59
 */

namespace Jphblais\AnyBase;

use InvalidArgumentException;
use LogicException;

/**
 * Class AnyBase
 * @package AppBundle
 */
class AnyBase {

    private $dictionary;
    private $positionValues = [];

    public function __construct($dictionary, $initialValue = null) {
        if(!is_string($dictionary)) {
            throw new InvalidArgumentException('$dictionary should be a string');
        }
        if(!empty($initialValue) && !is_string($initialValue)) {
            throw new InvalidArgumentException('$initialValue should be a string');
        }
        $this->dictionary = str_split($dictionary);
        if(empty($initialValue)) {
            $this->positionValues = [0];
        } else {
            $reversedInitialValue = strrev($initialValue);
            foreach(str_split($reversedInitialValue) as $char) {
                $charPos = array_search($char, $this->dictionary);
                if($charPos !== false) {
                    $this->positionValues[] = $charPos;
                } else {
                    throw new InvalidArgumentException("'$char' not part of dictionary '{$this->dictionary}'");
                }
            }
        }
    }

    /**
     * @return string
     */
    public function __toString() {
        $string = '';
        foreach($this->positionValues as $position) {
            $string .= $this->dictionary[$position];
        }
        return strrev($string);
    }

    /**
     * Increment of one
     */
    public function increment() {
        $this->doIncrement(0);
    }

    /**
     * Recursive increment method
     * @param int $key
     */
    private function doIncrement($key = 0) {
        if($key == count($this->positionValues)) {
            $this->positionValues[] = 1;
            return;
        }
        if($key > count($this->positionValues)) {
            throw new LogicException();
        }
        $nextValue = $this->positionValues[$key] + 1;
        if($nextValue >= count($this->dictionary)) {
            $this->positionValues[$key] = 0;
            $this->doIncrement($key+1);
        } else {
            $this->positionValues[$key] = $nextValue;
        }
    }
}
