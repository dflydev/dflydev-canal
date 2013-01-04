<?php

namespace Dflydev\Canal\Metadata;

class Metadata
{
    const RESOURCE_NAME_KEY = 'resourceName';

    private $metadata = array();

    public function get($name)
    {
        $values = $this->getList($name);

        if (count($values)) {
            return $values[0];
        }

        return null;
    }

    public function getList($name)
    {
        if (!isset($this->metadata[$name])) {
            return array();
        }

        return $this->metadata[$name];
    }

    public function set($name, $value)
    {
        if (!isset($this->metadata[$name])) {
            $this->metadata[$name] = array();
        }

        $this->metadata[$name] = is_array($value) ? $value : array($value);
    }
}
