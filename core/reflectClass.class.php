<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-15
 * Time: 下午6:58
 * 反射类扩展
 */

namespace core;


use ReflectionProperty;

class ReflectClass extends \ReflectionClass{

    /**
     * 通过过滤器获取类的属性
     * @param null $filter  过滤器 参照reflectProperty常量
     * @return array|null   如果返回数组 则数组每个元素都是ReflectionProperty对象实例
     */
    public function getProperties($filter = null)
    {
        $properties = null;

        if($filter % 3 == 0){
            switch($filter){
                case 3 :
                            foreach(parent::getProperties() as $property ){
                                    if(!$property -> isStatic())
                                        $properties[] = $property;
                            }
                    break;

                default :;
            }
        }else{
            $properties  =  parent::getProperties($filter);
        }

       return $properties;
    }

    /**
     * 设置反射取得的类对象实例的所有属性的值为null
     * @param null $filter   过滤器 参照reflectProperty常量
     * @param null $object 如果属性包含非静态属性的话 需要指定该反射类的对象实例
     */
    public function setPropertiesNull($filter = null,$object=null){
           $properties = $this->getProperties($filter);
           foreach($properties as &$property){
                 if(!$property->isStatic())
                     $property->setValue($object,null);
                 else
                     $property->setValue(null);
           }
    }
} 