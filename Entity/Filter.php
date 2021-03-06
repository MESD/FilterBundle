<?php

namespace Mesd\FilterBundle\Entity;

/**
 * Filter
 */
class Filter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Mesd\FilterBundle\Entity\FilterCategory
     */
    private $filterCategory;

    /**
     * @var \Mesd\FilterBundle\Entity\FilterEntity
     */
    private $filterEntity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $filterRow;

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filterRow = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Updates the description based on the filter rows
     *
     * @return Filter
     */
    public function updateDescription()
    {
        $filterRows = $this->getFilterRow();

        $descriptions = array();

        foreach ($filterRows as $filterRow) {
            $descriptions[] = '(' . $filterRow->getDescription() . ')';
        }

        sort($descriptions);
        
        $n = count($descriptions);
        if (1 < $n) {
            $descriptions[$n - 1] = 'or ' . $descriptions[$n - 1];
        }

        $description = implode(', ', $descriptions);

        $this->setDescription($description);

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Filter
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Filter
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set filterCategory
     *
     * @param \Mesd\FilterBundle\Entity\FilterCategory $filterCategory
     * @return Filter
     */
    public function setFilterCategory(\Mesd\FilterBundle\Entity\FilterCategory $filterCategory = null)
    {
        $this->filterCategory = $filterCategory;

        return $this;
    }

    /**
     * Get filterCategory
     *
     * @return \Mesd\FilterBundle\Entity\FilterCategory
     */
    public function getFilterCategory()
    {
        return $this->filterCategory;
    }

    /**
     * Set filterEntity
     *
     * @param \Mesd\FilterBundle\Entity\FilterEntity $filterEntity
     * @return Filter
     */
    public function setFilterEntity(\Mesd\FilterBundle\Entity\FilterEntity $filterEntity = null)
    {
        $this->filterEntity = $filterEntity;

        return $this;
    }

    /**
     * Get filterEntity
     *
     * @return \Mesd\FilterBundle\Entity\FilterEntity
     */
    public function getFilterEntity()
    {
        return $this->filterEntity;
    }

    /**
     * Add filterRow
     *
     * @param \Mesd\FilterBundle\Entity\FilterRow $filterRow
     * @return Filter
     */
    public function addFilterRow(\Mesd\FilterBundle\Entity\FilterRow $filterRow)
    {
        $this->filterRow[] = $filterRow;

        return $this;
    }

    /**
     * Remove filterRow
     *
     * @param \Mesd\FilterBundle\Entity\FilterRow $filterRow
     */
    public function removeFilterRow(\Mesd\FilterBundle\Entity\FilterRow $filterRow)
    {
        $this->filterRow->removeElement($filterRow);
    }

    /**
     * Get filterRow
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilterRow()
    {
        return $this->filterRow;
    }
}
