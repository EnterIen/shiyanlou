<?php 

namespace dispatcher;

abstract class Dispatcher
{
    //实例化操作
    abstract protected function getInstance();

    /**
     * 调用不存在的静态方法时执行
     *
     */
    public static function __callstatic($method, $args)
    {
        $instance = static::getInstance();

        if (method_exists($instance, 'init')) {
            call_user_func_array([$instance, 'init'], $args);
        }

        return call_user_func_array(array($instance, $method), $args);
    }

    public function __call($method,$args)
    {
	return call_user_func_array([static::getInstance(),$method],$args);
    }
   
 #   protected function call($method, $args)
 #   {
#	$object = get_called_class ();
 #       $reflect = new \ReflectionMethod($object, $method);
#	$params = [];
#	foreach($reflect->getParameters() as $need){
#	  if ($obj = $need->getClass()->name) {
#	    $params[$need->name] = $obj::register();
#	  }else{
 #	    if (!$need->isDefaultValueAvailable() && !isset($args[$need->name])) {
#	       Throw new \Exception('action [ ' . $method .' ] needs params [ $ ' . $nees->name . ' ]');
#	    }
#            $params[$need->name] = $args[$need->name] ?? $need->getDefaultValue();
#	  }
#	}
#        return $reflect->invokeArgs($object::register(),$params);
#    }

    /**
     * 使用Static延迟静态绑定
     *
     */
    protected function newObject()
    {
        return  new Static;
    }

    /**
     * 获取子类实例
     *
     */
    private function register() 
    {
        return static::getInstance();
    }

    /**
     * 依赖注入，默认参数绑定
     *
     */
    protected function call($method, $args = null)
    {
        $object = get_called_class();
        $reflect = new \ReflectionMethod($object, $method);
        
        $params = [];
        foreach ($reflect->getParameters() as $need) {
            //依赖注入
            if ($obj = $need->getClass()->name) {
                    $params[$need->name] = $obj::register();
            //默认参数
            } else {
                if (!$need->isDefaultValueAvailable()
                && !isset($args[$need->name])) {
                    Throw new \Exception('action [ '.$method.' ] needs params [ $'.$need->name.' ]');
                }
                $params[$need->name] = $args[$need->name] ?? $need->getDefaultValue();
            }
        }
        return $reflect->invokeArgs($object::register(), $params);
    }

}
