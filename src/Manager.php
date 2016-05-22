<?php

namespace Artesaos\Shield;

use InvalidArgumentException;
use Illuminate\Filesystem\Filesystem;
use Artesaos\Shield\Contracts\Manager as ManagerContract;

class Manager implements ManagerContract
{
    /**
     * @var array
     */
    protected $rules;

    /**
     * @var array
     */
    protected $hints;

    /**
     * @var Filesystem
     */
    private $files;

    /**
     * Manager constructor.
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->rules = [];
        $this->hints = [];
        $this->files = $files;
    }

    /**
     * @param $name
     *
     * @return Rules
     */
    public function getRules($name)
    {
        if (isset($this->rules[$name])) {
            return $this->rules[$name];
        }

        return $this->loadRules($name);
    }

    /**
     * @param $path
     * @param $namespace
     *
     * @return Manager
     */
    public function addRulesNamespace($path, $namespace)
    {
        $this->hints[$namespace] = $path;

        return $this;
    }

    /**
     * @param $name
     *
     * @return Rules
     */
    protected function loadRules($name)
    {
        list($hint, $file) = $this->getNamespaceSegments($name);

        $file = $this->hints[$hint].'/'.$file.'.php';

        if (! $this->files->exists($file)) {
            throw new InvalidArgumentException("Rule [$name] not found.");
        }

        return $this->rules[$name] = $this->loadFromFile($file);
    }

    /**
     * Load rules from file.
     *
     * @param $file
     *
     * @return Rules
     *
     * @throws \InvalidArgumentException
     */
    protected function loadFromFile($file)
    {
        $content = require $file;

        if (! is_array($content)) {
            throw new InvalidArgumentException("File [$file] not return array.");
        }

        $rules = array_get($content, 'rules', []);
        $messages = array_get($content, 'messages', []);

        return new Rules($rules, $messages);
    }

    /**
     * Get the segments of a rule with a named path.
     *
     * @param string $name
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    protected function getNamespaceSegments($name)
    {
        $segments = explode(static::HINT_PATH_DELIMITER, $name);

        if (count($segments) != 2) {
            throw new InvalidArgumentException("Rule [$name] has an invalid name.");
        }

        if (! isset($this->hints[$segments[0]])) {
            throw new InvalidArgumentException("No hint path defined for [{$segments[0]}].");
        }

        return $segments;
    }
}
