<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shape
 *
 * @ORM\Table(name="shape")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShapeRepository")
 */
class Shape
{
    const TYPE_STAR = 1;
    const TYPE_TREE = 2;

    public static $type_list = [
        self::TYPE_STAR => 'Star',
        self::TYPE_TREE => 'Tree'
    ];

    const SIZE_SMALL = 1;
    const SIZE_MEDIUM = 2;
    const SIZE_LARGE = 3;

    public static $size_list = [
        self::SIZE_SMALL => 'Small',
        self::SIZE_MEDIUM => 'Medium',
        self::SIZE_LARGE => 'Large'
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="smallint")
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="raw", type="text")
     */
    private $raw;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Shape
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return Shape
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set raw
     *
     * @param string $raw
     *
     * @return Shape
     */
    public function setRaw($raw)
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * Get raw
     *
     * @param bool $html
     * @return string
     */
    public function getRaw($html = false)
    {
        $raw = $this->raw;
        if ($html) {
            $raw = str_replace(' ', '&nbsp;', $raw);
            $raw = nl2br($raw);
        }

        return $raw;
    }
}

