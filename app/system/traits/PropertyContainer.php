<?php

namespace System\Traits;

trait PropertyContainer
{
    /**
     * @var array Holds the component layout settings array.
     */
    protected $properties;

    /**
     * Validates the properties against the defined properties of the class.
     * This method also sets default properties.
     *
     * @param  array  $properties The supplied property values.
     * @return array The validated property set, with defaults applied.
     */
    public function validateProperties(array $properties)
    {
        $definedProperties = $this->defineProperties();

        // Determine and implement default values
        $defaultProperties = [];
        foreach ($definedProperties as $name => $information) {
            if (array_key_exists('default', $information)) {
                $defaultProperties[$name] = $information['default'];
            }
        }

        return array_merge($defaultProperties, $properties);
    }

    /**
     * Defines the properties used by this class.
     * This method should be used as an override in the extended class.
     */
    public function defineProperties()
    {
        return [];
    }

    /**
     * Sets multiple properties.
     *
     * @param  array  $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $this->validateProperties($properties);
    }

    /**
     * Merge multiple properties.
     *
     * @param  array  $properties
     */
    public function mergeProperties($properties)
    {
        $this->properties = array_merge($this->properties, $this->validateProperties($properties));
    }

    /**
     * Sets a property value
     *
     * @param  string  $name
     * @param  mixed  $value
     */
    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }

    /**
     * Returns all properties.
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Returns a defined property value or default if one is not set.
     *
     * @param  string  $name The property name to look for.
     * @param  string  $default A default value to return if no name is found.
     * @return mixed The property value or the default specified.
     */
    public function property($name, $default = null)
    {
        return array_key_exists($name, $this->properties)
            ? $this->properties[$name]
            : $default;
    }

    /**
     * Returns options for multi-option properties (drop-downs, etc.)
     *
     * @param  string  $property Specifies the property name
     * @return array Return an array of option values and descriptions
     */
    public function getPropertyOptions($property)
    {
        return [];
    }
}
