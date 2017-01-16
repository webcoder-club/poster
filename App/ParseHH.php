<?php
namespace App;

use Sunra\PhpSimple\HtmlDomParser;

class ParseHH
{
    private $data = [];
    private $id;

    /**
     * ParseHH constructor.
     * @param int $id
     * @return $this
     */
    function parseText(int $id)
    {
        $this->id = $id;

        $link = 'https://hh.ru/vacancy/' . $this->id;
        $html = file_get_contents($link);
        $dom = HtmlDomParser::str_get_html($html);

        $this->data['vacancy'] = $dom->find('h1', 0)->text();
        $this->data['salary'] = $dom->find('.l-content-colum-1 .l-paddings', 1)->text();
        $this->data['town'] = $dom->find('.l-content-colum-2', 1)->text();
        $this->data['exp'] = $dom->find('[itemprop=experienceRequirements]', 0)->text();

        return $this;
    }

    /**
     * @return Text\BaseAbstract[]
     */
    public function execute()
    {
        return [
            new Text\Vacancy($this->data['vacancy']),
            new Text\Salary($this->data['salary']),
            new Text\Town($this->data['town']),
            new Text\Experience($this->data['exp'])
        ];
    }

    /**
     * @return array
     */
    public function getTexts()
    {
        return $this->data;
    }
}