<?php
/**
 * Singleton with configuration info
 * 
 * @author Patrick Forget - http://geekpad.ca
 * @since Sun Jan 17 03:29:42 GMT 2010
 * @copyright 2010 Patrick Forget
 */

/**
 * Singleton with configuration info
 * 
 * @author Patrick Forget - http://geekpad.ca
 * @since Sun Jan 17 03:29:42 GMT 2010
 */
class SimpleConfig implements ArrayAccess, Countable, IteratorAggregate
{
    
    /**
     * instance
     * @var SimpleConfig
     */
    protected static $_instance = null;
    
    /**
     * instance
     * @var SimpleConfig
     */
    protected static $_configFile = '';
    
    /**
     * config array
     * @var array
     */
    protected $_values = array();
    
    /**
     * retreive one and only instance of config
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:30:44 GMT 2010 
     */
    public static function getInstance() 
    {
        if (self::$_instance === null) {
            $c = __CLASS__;
            self::$_instance = new $c;
        } //if
        
        return self::$_instance;
    } // getInstance()
    
    /**
     * sets the path to the config file
     *
     * @author digit
     * @since Mon Jan 18 05:50:43 GMT 2010 
     */
    public function setFile($filePath) 
    {
        /* make sure instance doesn't exist yet */
        if (self::$_instance !== null) {
            throw new Exception('You need to set the path before calling '. __CLASS__ .'::getInstance() method', 0);
        } else {
            self::$_configFile = $filePath;
        } //if
    } // setFile()
    
    
    /**
     * class constructor
     */
    protected function __construct()
    {
        
        $values = @include( self::$_configFile );
        if (is_array($values)) {
            $this->_values = &$values;
        } //if
        
    } // __construct()
    
    /**
     * prevent cloning
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:32:57 GMT 2010 
     */
    final protected function __clone() { 
        // no cloning allowed
    } // __clone()
    
    /**
     * returns number of elements iside config
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:53:00 GMT 2010 
     * @return integer number of elements inside config
     */
    public function count() 
    {
        return sizeof($this->_values);
    } // count()
    
    /**
     * checks if a given key exists
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:56:35 GMT 2010 
     * @param mixed $offset key of item to check
     * @return boolean true if key exisits, false otherwise
     */
    public function offsetExists($offset) 
    {
        return key_exists($offset, $this->_values);
    } // offsetExists()
    
    /**
     * retreive the value of a given key
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:57:08 GMT 2010 
     * @param mixed $offset key of item to fetch
     * @return mixed value of the matched element
     */
    public function offsetGet($offset) 
    {
        return $this->_values[$offset];
    } // offsetGet()
    
    /**
     * assigns a new value to a key
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:58:20 GMT 2010 
     * 
     * @param mixed $offset key of the element to set
     * @param mixed $value value to assign
     */
    public function offsetSet($offset, $value) 
    {
        $this->_values[$offset] = $value;
    } // offsetSet()
    
    /**
     * removes an item from the config
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:58:54 GMT 2010 
     * 
     * @param mixed $offset key of the elment to remove
     */
    public function offsetUnset($offset) 
    {
        unset($this->_values[$offset]);
    } // offsetUnset()
    
    /**
     * retrive an iterator for config values
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 03:59:56 GMT 2010 
     * @return Iterator iterator of config values
     */
    public function getIterator() 
    {
        return new ArrayIterator($this->_values);
    } // getIterator()
    
    /**
     * enables to set values using the object notation i.e. $config->myValue = 'something';
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 04:00:48 GMT 2010 
     */
    public function __set($key, $value) 
    {
        $this->_values[$key] = $value;
    } // __set()
    
    /**
     * enables to get values using the object notation i.e. $config->myValue;
     *
     * @author Patrick Forget - http://geekpad.ca
     * @since Sun Jan 17 04:03:33 GMT 2010 
     */
    public function __get($key) 
    {
        return $this->_values[$key];
    } // __get()
    
} // SimpleConfig class