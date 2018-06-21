<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 14.06.18
 * Time: 15:02
 */

trait Entity
{
    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $colName => $value){
            if(property_exists($class = __TRAIT__, $colName)){
                throw new \InvalidArgumentException("Property does not exists in $class");
            }
            $this->$colName = $value;
        }
    }
}