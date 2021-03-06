<?php
namespace Chadicus\Marvel\Api\Entities;

use DominionEnterprises\Util;
use DominionEnterprises\Util\Arrays;

/**
 * Represents a Url entity type within the Marvel API.
 */
class Url
{
    /**
     * A text identifier for the URL.
     *
     * @var string
     */
    private $type;

    /**
     * A full URL (including scheme, domain, and path).
     *
     * @var string
     */
    private $url;

    /**
     * Construct a new instance of Url.
     *
     * @param string $type The text identifier for the URL.
     * @param string $url  The full URL (including scheme, domain, and path).
     */
    final public function __construct($type, $url)
    {
         Util::throwIfNotType(['string' => [$type, $url]], true, true);
         $this->type = $type;
         $this->url = $url;
    }

    /**
     * Returns the text identifier for the URL.
     *
     * @return string
     */
    final public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the full URL (including scheme, domain, and path).
     *
     * @return string
     */
    final public function getUrl()
    {
        return $this->url;
    }

    /**
     * Filters the given array $input into a Url.
     *
     * @param array $input The value to be filtered.
     *
     * @return Url
     *
     * @throws \Chadicus\Filter\Exception Thrown if the input did not pass validation.
     */
    final public static function fromArray(array $input)
    {
        $filters = ['type' => [['string']], 'url' => [['string']]];

        list($success, $result, $error) = \DominionEnterprises\Filterer::filter($filters, $input);
        if (!$success) {
            throw new \Chadicus\Filter\Exception($error);
        }

        return new Url(Arrays::get($result, 'type'), Arrays::get($result, 'url'));
    }

    /**
     * Filters the given array[] $inputs into Url[].
     *
     * @param array[] $inputs The value to be filtered.
     *
     * @return Url[]
     *
     * @throws \Chadicus\Filter\Exception Thrown if the inputs did not pass validation.
     */
    final public static function fromArrays(array $inputs)
    {
        Util::throwIfNotType(['array' => $inputs]);

        $urls = [];
        foreach ($inputs as $key => $input) {
            $urls[$key] = self::fromArray($input);
        }

        return $urls;
    }
}
