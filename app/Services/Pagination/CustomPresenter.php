<?php namespace App\Services\Pagination;

use Illuminate\Support\HtmlString;
use Illuminate\Pagination\BootstrapThreePresenter;
use Illuminate\Pagination\UrlWindowPresenterTrait;

class CustomPresenter extends BootstrapThreePresenter
{
    use UrlWindowPresenterTrait;

    /**
     * Determine if the underlying paginator being presented has pages to show.
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages() && count($this->paginator->items()) > 0;
    }

    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render()
    {
        if ($this->hasPages()) {
            return new HtmlString(sprintf(
                '<ul class="pager">%s %s</ul>',
                $this->getPreviousButton(),
                $this->getNextButton()
            ));
        }

        return '';
    }

    /**
     * Get the previous page pagination element.
     *
     * @param  string  $text
     * @return string
     */
    public function getPreviousButton($text = '&laquo;')
    {
        if ($this->paginator->currentPage() <= 1) {
            return '';
        }

        $url = $this->paginator->url($this->paginator->currentPage() - 1);

        return $this->getPageLinkWrapper($url, $text, 'prev');
    }

    /**
     * Get the next page pagination element.
     *
     * @param  string  $text
     * @return string
     */
    public function getNextButton($text = '&raquo;')
    {
        if (! $this->paginator->hasMorePages()) {
            return '';
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text, 'next');
    }


}