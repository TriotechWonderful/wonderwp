<?php
/**
 * Created by PhpStorm.
 * User: jeremydesvaux
 * Date: 11/04/2017
 * Time: 20:54
 */

namespace WonderWp\Framework\Search;

class SearchResultSetsRenderer implements SearchResultsRendererInterface
{
    /**
     * @var SearchResultSetInterface[]
     */
    protected $sets;

    /**
     * @return SearchResultSetInterface[]
     */
    public function getSets()
    {
        return $this->sets;
    }

    /**
     * @param SearchResultSetInterface[] $sets
     *
     * @return static
     */
    public function setSets($sets)
    {
        $this->sets = $sets;

        return $this;
    }

    public function getMarkup(array $results, array $opts = [])
    {
        $this->setSets($results);

        $markup = '';
        if (!empty($this->sets)) {
            foreach ($this->sets as $set) {
                $markup .= $this->getSetMarkup($set);
            }
        } else {
            $markup = $this->getNoResultMarkup($opts);
        }

        return $markup;
    }

    public function getSetMarkup(SearchResultSetInterface $set)
    {
        if ($set->getTotalCount() <= 0) {
            return '';
        }

        $markup = '';
        $results = $set->getCollection();
        if (!empty($results)) {
            $markup .= '<ul>';
            foreach ($results as $res) {
                $markup .= '<li>';
                if (!empty($res->getLink())) {
                    $markup .= '<a href="' . $res->getLink() . '">';
                }
                $markup .= '<span class="res-title">' . $res->getTitle() . '</span>';

                if (!empty($res->getContent())) {
                    $markup .= '<div class="res-content">' . $res->getContent() . '</div>';
                }

                if (!empty($res->getLink())) {
                    $markup .= '</a>';
                }
                $markup .= '</li>';
            }
            $markup .= '</ul>';
        }

        return $markup;
    }

    public function getNoResultMarkup(array $opts = [])
    {
        return 'Pas de résultat';
    }
}
